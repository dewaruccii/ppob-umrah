<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk dengan filter optional
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Filter berdasarkan provider (misal: Telkomsel)
        if ($request->has('provider')) {
            $query->where('provider', $request->provider);
        }

        // Filter berdasarkan category (misal: Roaming Asia)
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Gunakan paginate agar lebih ringan (default 10 data per halaman)
        $products = $query->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Produk',
            'data'    => $products
        ], 200);
    }

    /**
     * Menampilkan detail produk berdasarkan ID atau UUID
     */
    public function show($id)
    {
        // Mencari produk berdasarkan ID
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan!',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Produk',
            'data'    => $product
        ], 200);
    }
    public function tabsNavigation()
    {
        $categories = Product::pluck('category')->unique()->values();

        // Mapping menjadi format object { id, name }
        $tabs = $categories->map(function ($item) {
            return [
                'id'   => strtolower(str_replace(' ', '_', $item)), // id: "internet"
                'name' => ucfirst($item)                           // name: "Internet"
            ];
        });

        // Jika ingin menambahkan tab "Semua Paket" secara manual di paling depan:
        $tabs->prepend(['id' => 'all', 'name' => 'Semua Paket']);

        return response()->json([
            'success' => true,
            'message' => 'Tabs Navigation',
            'data'    => $tabs
        ], 200);
    }
}
