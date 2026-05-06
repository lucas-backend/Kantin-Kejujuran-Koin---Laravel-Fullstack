<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::latest()->get();

        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.menus.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->boolean('is_active');

        // Upload gambar
        $validated['image_path'] = $request->file('image_path')->store('menu-images', 'public');

        Menu::create($validated);

        return redirect()->route('menus.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $categories = Category::all();

        return view('admin.menus.edit', compact('menu', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_path')) {
            if ($menu->image_path) {
                Storage::disk('public')->delete($menu->image_path);
            }

            $validated['image_path'] = $request->file('image_path')->store('menu-images', 'public');
        } else {
            $validated['image_path'] = $menu->image_path;
        }

        $menu->update($validated);

        return redirect()->route('menus.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        if ($menu->image_path) {
            Storage::disk('public')->delete($menu->image_path);
        }

        $menu->delete();

        return redirect()->route('menus.index');
    }
}
