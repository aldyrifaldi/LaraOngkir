<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    public function getProvince()
    {
        $provinsi = Http::withHeaders([
            'key' => env('RAJA_ONGKIR_API_KEY')
        ])->get(env('RAJA_ONGKIR_URL_API').'/province');

        return response()->json([
            'data' => $provinsi->json()['rajaongkir']['results']
        ]);
    }

    public function getCity()
    {
        $provinsi = Http::withHeaders([
            'key' => env('RAJA_ONGKIR_API_KEY')
        ])->get(env('RAJA_ONGKIR_URL_API').'/city?province='.$_GET['province_id']);

        return response()->json([
            'data' => $provinsi->json()['rajaongkir']['results']
        ]);
    }

    public function getCost(Request $request)
    {
        $cost = Http::withHeaders([
            'key' => env('RAJA_ONGKIR_API_KEY')
        ])
        ->post(env('RAJA_ONGKIR_URL_API').'/cost',[
            'origin' => $request->city_origin,
            'destination' => $request->city_destination,
            'weight' => $request->weight,
            'courier' => $request->courier,
        ]);

        return response()->json([
            'data' => $cost->json()['rajaongkir']['results']
        ]);
    }
}
