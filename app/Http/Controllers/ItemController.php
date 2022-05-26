<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("item.index", ["items" => Item::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("item.create", ["categories" => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        DB::transaction(function () use ($request) {
            $item = new Item();
            $item->name = $request->name;
            $item->price = $request->price;
            $item->category_id = $request->category_id;

            $photo = $request->file('photo');
            $photoName = uniqid() . "-item." . $photo->extension();
            $item->photo = $photoName;
            $item->save();

            $photo->storeAs("public/item-photo/", $photoName);
        });
        return redirect()->back()->with('status', "$request->name is created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view("item.edit", ["item" => $item, "categories" => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        DB::transaction(function () use ($request, $item) {
            $item->name = $request->name;
            $item->price = $request->price;
            $item->category_id = $request->category_id;

            if ($request->hasFile("photo")) {
                $photo = $request->file("photo");
                $photoName = uniqid() . "-item." . $photo->extension();
                Storage::delete("public/item-photo/" . $item->photo);
                $item->photo = $photoName;
                $photo->storeAs("public/item-photo/", $photoName);
            }

            $item->update();
        });
        return redirect()->back()->with('status', "$request->name is updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        Storage::delete("public/item-photo/" . $item->photo);
        $item->delete();
        return redirect()->back()->with('status', "Deleted successfully");
    }
}
