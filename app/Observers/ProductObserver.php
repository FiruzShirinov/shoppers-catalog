<?php

namespace App\Observers;

use App\Models\Product;
use App\Http\Traits\ImageManipulationTrait;

class ProductObserver
{
    use ImageManipulationTrait;

    /**
     * Handle the Product "saving" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function saving(Product $product)
    {
        $img = request()->file('image');
        if($img){
            $image = $this->fitAndSaveImage($img, 80, 300, 300);
            $product->image = $image;
        }
    }

    /**
     * Handle the Product "creating" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->admin_created_id = auth()->id();
        $product->admin_updated_id = auth()->id();
    }

    /**
     * Handle the Product "updating" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
        $product->admin_updated_id = auth()->id();
    }
}
