<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Breed;
use App\Http\Requests\StoreCatRequest;
use App\Http\Requests\UpdateCatRequest;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cats.index', [
            'cats' => Cat::with('breeds')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cats.create')->with('breeds', Breed::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCatRequest $request)
    {
        $cat = Cat::create($request->validated());
        $cat->breeds()->attach($request->breed);
        return redirect() -> route('cats.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cat $cat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cat $cat)
    {
        return view('cats.edit', [
            'cat' => $cat,
            'breeds' => Breed::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCatRequest $request, Cat $cat)
    {
        $cat -> update($request->validated());
        $cat->breeds()->sync([$request->breed]);
        return redirect()->route('cats.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cat $cat)
    {
        Cat::destroy($cat -> id);
        return redirect()->route('cats.index');
    }
}
