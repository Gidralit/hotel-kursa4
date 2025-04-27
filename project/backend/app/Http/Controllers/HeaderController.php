<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Header;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function index(): JsonResponse
    {
        $header = Header::first();
        if (!$header){
            return response()->json(['error' => 'No header found'], 404);
        }
        return response()->json($header);
    }
}
