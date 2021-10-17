<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shopper;
use App\Models\Purchase;
use App\Http\Requests\PurchaseRequest;

class PurchaseController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shoppers = Shopper::get(['id', 'name']);
        $products = Product::get(['id', 'name']);
        return view('purchases.create', compact('shoppers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {
        Purchase::create($request->validated());
        return redirect()->route('shoppers.index');
    }
}
