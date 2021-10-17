<?php

namespace App\Observers;

use App\Models\Purchase;

class PurchaseObserver
{
    /**
     * Handle the Purchase "created" event.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return void
     */
    public function created(Purchase $purchase)
    {
        $purchase->products()->attach(request()->product_ids);
        $purchase->total = $purchase->products()->sum('price');
        $purchase->save();
    }
}
