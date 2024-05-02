<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageFacade;

trait HasPhoto
{
    /**
     * Update the Images photo.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @param  string  $storagePath
     * @return void
     */
    public function updatePhoto(UploadedFile $photo, $storagePath = 'galleries-photos')
    {
        tap($this->image_path, function ($previous) use ($photo, $storagePath) {
            $photo = $this->optimizePhoto($photo);
            $this->forceFill([
                'image_path' => $photo->storePublicly(
                    $storagePath,
                    ['disk' => $this->photoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->photoDisk())->delete($previous);
            }
        });
    }

    /**
     * Optimize photo using Intervention\Image
     *
     * @param UploadedFile $photo
     * @return  $output
     */
    protected function optimizePhoto($photo)
    {
        $output = $photo;  // TODO

        return $output;
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
