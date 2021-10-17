<?php

namespace App\Http\Traits;
use Intervention\Image\ImageManagerStatic as Image;

trait ImageManipulationTrait
{
    /**
     * Fit and save image to user defined dimensions and quality.
     *
     * @param  \Illuminate\Http\UploadedFile  $image
     * @param  int  $width
     * @param  int  $height
     * @param  int  $quality
     * @param  string  $oldImage
     * @return string  $imageName
     */
    public function fitAndSaveImage($image, $quality, $width, $height)
    {
        $imageManager = Image::make($image)->fit($width, $height, function ($constraint) {
            $constraint->upsize();
        });

        $imageName = '/storage/'.time().'.'.$image->extension();
        $imageManager->save(public_path($imageName), $quality);
        return $imageName;
    }
}
