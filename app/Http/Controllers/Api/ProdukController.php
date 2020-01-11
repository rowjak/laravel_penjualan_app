<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produk;
use App\Http\Resources\ProdukResource;


class ProdukController extends Controller
{
    public function get_produk_kategori(Request $request){
        $kd_kategori = $request->input('kd_kategori');
        $produk = Produk::where([
            ['kd_kategori',$kd_kategori],
            ['stok','>',0]
        ])->get();

        if ($produk->isEmpty()) {
            return response()->json([
                'status'=>FALSE,
                'message'=>'Produk Tidak Ada'
            ], 200);
        }

        // fungsi dari collection adalah apabila data lebih dari 1
        return ProdukResource::collection($produk);

    }
}
