<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BeritaResource;
use App\Models\Berita;
use Symfony\Component\HttpFoundation\Response;

class BeritaController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => new BeritaResource($berita),
        ]);
    }
}
