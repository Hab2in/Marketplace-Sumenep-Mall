<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class SearchController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index(Request $request)
    // {
    //     $searchTerm = $request->input('query');
        
    //     if ($searchTerm) {
    //         // Lakukan pencarian langsung di database jika query ada
    //         $products = Product::where('name', 'LIKE', "%{$searchTerm}%")->get();
    //     } else {
    //         // Jika tidak ada query, set produk kosong
    //         $products = collect();
    //     }
        
    //     return view('pages.search', ['products' => $products, 'searchTerm' => $searchTerm]);
    // }

    public function index(Request $request)
    {
        $searchTerm = $request->input('query');
        
        if ($searchTerm) {
            $allProducts = Product::all(); // Ambil semua produk

            // Lakukan pencarian secara sequential di PHP
            $products = $allProducts->filter(function ($product) use ($searchTerm) {
                return stripos($product->name, $searchTerm) !== false;
            });
        } else {
            $products = collect(); // Jika tidak ada query, set produk kosong
        }
        
        return view('pages.search', ['products' => $products, 'searchTerm' => $searchTerm]);
    }


}
