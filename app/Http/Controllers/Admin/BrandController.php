<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::withCount('products')->latest()->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
        ]);

        Brand::create($request->only('name'));

        return redirect()->route('admin.brands.index')->with('success', 'Merek berhasil ditambahkan!');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
        ]);

        $brand->update($request->only('name'));

        return redirect()->route('admin.brands.index')->with('success', 'Merek berhasil diperbarui!');
    }

    public function destroy(Brand $brand)
    {
        if ($brand->products()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus merek yang masih memiliki produk!');
        }

        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Merek berhasil dihapus!');
    }
}
