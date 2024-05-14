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
    public function updatePhoto(UploadedFile $photo, $storagePath = 'galleries-photos'): void
    {
        $disk = Storage::disk('public')->path('/');
        $path = $storagePath . '/' . str(auth()->user()->name)->slug() . '/';
        $thumbpath = $storagePath . '/' . str(auth()->user()->name)->slug() . '/thumbs/';
        $tilepath = $storagePath . '/' . str(auth()->user()->name)->slug() . '/tiles/';
        $destinationPath = $disk . $path;
        $destinationPathThumbnail = $disk . $thumbpath;
        $destinationPathTile = $disk . $tilepath;

        if (!file_exists($destinationPath)) mkdir($destinationPath, 755, true);
        if (!file_exists($destinationPathThumbnail)) mkdir($destinationPathThumbnail, 755, true);
        if (!file_exists($destinationPathTile)) mkdir($destinationPathTile, 755, true);

        $imageName = hash('sha256', now()->timestamp . '-' . $photo->getClientOriginalName()) . '.' . $photo->getClientOriginalExtension();

        $image = ImageFacade::read($photo);
        $this->handleImage($path, $image, $imageName, $destinationPath);
        $image = ImageFacade::read($photo);
        $this->handleThumb($thumbpath, $image, $imageName, $destinationPathThumbnail);
        $image = ImageFacade::read($photo);
        $this->handleTile($tilepath, $image, $imageName, $destinationPathTile);

    }

    /**
     * Creates and saves main image
     *
     * @param string $path
     * @param \Intervention\Image\Image $image
     * @param string $imageName
     * @param string $destinationPath
     * @return void
     */
    private function handleImage(string $path, \Intervention\Image\Image $image, string $imageName, string $destinationPath) : void {
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

    /**
     * Creates and savesthumbnail
     *
     * @param string $thumbpath
     * @param \Intervention\Image\Image $image
     * @param string $imageName
     * @param string $destinationPathThumbnail
     * @return void
     */
    private function handleThumb(string $thumbpath, \Intervention\Image\Image $image, string $imageName, string $destinationPathThumbnail) : void {
        tap($this->thumb_path, function ($previous) use ($thumbpath, $image, $imageName, $destinationPathThumbnail) {

            // Generate Thumbnail Image Upload on Folder Code
            if ($image->width() > $image->height()) {
                $image->scale(null, 366);
            } elseif ($image->width() < $image->height()) {
                $image->scale(512, null);
            }

            $image->cover(512, 366, 'center');
            // $image->crop(512, 288, 0, 0, 'transparent', 'center'); 512 = 1.4   x = 1

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
     * Creates and saves tile
     *
     * @param string $tilepath
     * @param \Intervention\Image\Image $image
     * @param string $imageName
     * @param string $destinationPathTile
     * @return void
     */
    private function handleTile(string $tilepath, \Intervention\Image\Image $image, string $imageName, string $destinationPathTile) : void {
        tap($this->tile_path, function ($previous) use ($tilepath, $image, $imageName, $destinationPathTile) {

/*             if ($image->width() > $image->height()) {
                $image->scale(200, null);
            } elseif ($image->width() < $image->height()) {
                $image->scale(200, null);
            } */
            $image->scaleDown(width: 200);

            $image->save($destinationPathTile . $imageName);

            $this->forceFill([
                'tile_path' => $tilepath . $imageName,
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
     * Delete the image tile.
     *
     * @return void
     */
    public function deleteTile()
    {
        if (is_null($this->tile_path)) {
            return;
        }

        Storage::disk($this->photoDisk())->delete($this->tile_path);

        $this->forceFill([
            'tile_path' => null,
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
     * Get the URL to the image tile.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function tileUrl(): Attribute
    {
        return Attribute::get(function (): string {
            return $this->tile_path
                ? Storage::disk($this->photoDisk())->url($this->tile_path)
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
