<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class DniController extends Controller
{
    public function consultar($dni) {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('RENIEC_TOKEN')
            ])->get("https://api.decolecta.com/v1/reniec/dni/".$dni);

            return response()->json($response->json());

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error'], 500);
        }
    }
}
