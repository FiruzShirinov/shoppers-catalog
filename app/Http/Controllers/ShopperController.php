<?php

namespace App\Http\Controllers;

use App\Models\Shopper;
use Illuminate\Http\Request;

class ShopperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shoppers = Shopper::paginate(50);
        return view('shoppers.index', compact('shoppers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shoppers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Shopper::create($request->validated());
        return redirect()->route('shoppers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shopper  $shopper
     * @return \Illuminate\Http\Response
     */
    public function show(Shopper $shopper)
    {
        return view('shoppers.show', compact('shopper'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shopper  $shopper
     * @return \Illuminate\Http\Response
     */
    public function edit(Shopper $shopper)
    {
        return view('shoppers.edit', compact('shopper'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shopper  $shopper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shopper $shopper)
    {
        $shopper->update($request->validated());
        return redirect()->route('shoppers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shopper  $shopper
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shopper $shopper)
    {
        $shopper->delete();
        return redirect()->route('shoppers.index');
    }
}
