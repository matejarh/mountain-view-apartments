<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image as ImageFacade;

trait HasPhoto
{
    /**
     * Update the Images photo.
     *
     * @param  \Illuminate\Http\UploadedFile $photo
     * @param  string  $storagePath
     * @return void
     */
    public function updatePhoto(UploadedFile $photo, $storagePath = 'galleries-photos')
    {
        $disk = Storage::disk('public')->path('/');
        $path = $storagePath . '/' . str(auth()->user()->name)->slug() . '/';
        $thumbpath = $storagePath . '/' . str(auth()->user()->name)->slug() . '/thumbs/';
        $destinationPath = $disk . $path;
        $destinationPathThumbnail = $disk . $thumbpath;

        if (!file_exists($destinationPath)) mkdir($destinationPath, 755, true);
        if (!file_exists($destinationPathThumbnail)) mkdir($destinationPathThumbnail, 755, true);

        $imageName = hash('sha256', now()->timestamp . '-' . $photo->getClientOriginalName()) . '.' . $photo->getClientOriginalExtension();
        $image = ImageFacade::read($photo);

        $this->handleImage($path, $image, $imageName, $destinationPath);
        $this->handleThumb($thumbpath, $image, $imageName, $destinationPathThumbnail);

    }

    private function handleImage($path, $image, $imageName, $destinationPath) : void {
        tap($this->image_path, function ($previous) use ($path, $image, $imageName, $destinationPath) {

            // Main Image Upload on Folder Code
            $image->save($destinationPath . $imageName);

            $this->forceFill([
                'image_path' => $path . $imageName,
            ])->save();

            if ($previous) {
                Storage::disk($this->photoDisk())->delete($previous);
            }
        });
    }

    private function handleThumb($thumbpath, $image, $imageName, $destinationPathThumbnail) : void {
        tap($this->thumb_path, function ($previous) use ($thumbpath, $image, $imageName, $destinationPathThumbnail) {
            // Generate Thumbnail Image Upload on Folder Code
            if ($image->width() > $image->height()) {
                $image->scaleDown(null, 360);

            } elseif ($image->width() < $image->height()) {
                $image->scaleDown(480, null);
            }
            $image->crop(480, 360);

            $image->save($destinationPathThumbnail . $imageName);

            $this->forceFill([
                'thumb_path' => $thumbpath . $imageName,
            ])->save();

            if ($previous) {
                Storage::disk($this->photoDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the image photo.
     *
     * @return void
     */
    public function deletePhoto()
    {
        if (is_null($this->image_path)) {
            return;
        }

        Storage::disk($this->photoDisk())->delete($this->image_path);

        $this->forceFill([
            'image_path' => null,
        ])->save();
    }

    /**
     * Delete the image thumbnail.
     *
     * @return void
     */
    public function deleteThumb()
    {
        if (is_null($this->thumb_path)) {
            return;
        }

        Storage::disk($this->photoDisk())->delete($this->thumb_path);

        $this->forceFill([
            'thumb_path' => null,
        ])->save();
    }

    /**
     * Get the URL to the image photo.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function photoUrl(): Attribute
    {
        return Attribute::get(function (): string {
            return $this->image_path
                ? Storage::disk($this->photoDisk())->url($this->image_path)
                : $this->defaultPhotoUrl();
        });
    }

    /**
     * Get the URL to the image thumb.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function thumbUrl(): Attribute
    {
        return Attribute::get(function (): string {
            return $this->thumb_path
                ? Storage::disk($this->photoDisk())->url($this->thumb_path)
                : $this->defaultPhotoUrl();
        });
    }

    /**
     * Get the default image photo URL if no photo has been uploaded.
     *
     * @return string
     */
    protected function defaultPhotoUrl(): string
    {
        return "https://api.dicebear.com/8.x/pixel-art/svg?seed=" . urlencode($this->slug) . ""; // icons | pixel-art | ident ...  check https://www.dicebear.com/styles/
    }


    /**
     * Get the disk that galleries photos should be stored on.
     *
     * @return string
     */
    protected function photoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.galleries_photo_disk', 'public');
    }
}
