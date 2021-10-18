<?php

namespace App\Observers;

use App\Http\Traits\ImageManipulationTrait;
use App\Models\Shopper;

class ShopperObserver
{
    use ImageManipulationTrait;

    /**
     * Handle the Shopper "saving" event.
     *
     * @param  \App\Models\Shopper  $shopper
     * @return void
     */
    public function saving(Shopper $shopper)
    {
        $img = request()->file('image');
        if($img){
            $image = $this->fitAndSaveImage($img, 80, 300, 300);
            $shopper->image = $image;
        }
    }

    /**
     * Handle the Shopper "creating" event.
     *
     * @param  \App\Models\Shopper  $shopper
     * @return void
     */
    public function creating(Shopper $shopper)
    {
        $shopper->admin_created_id = auth()->check() ? auth()->id() : 1;
        $shopper->admin_updated_id = auth()->check() ? auth()->id() : 1;
    }

    /**
     * Handle the Shopper "updating" event.
     *
     * @param  \App\Models\Shopper  $shopper
     * @return void
     */
    public function updating(Shopper $shopper)
    {
        $shopper->admin_updated_id = auth()->check() ? auth()->id() : 1;
    }
}
