<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Meta;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    public function getSeoData($page_name)
    {
        $seo = Meta::where('page_name', $page_name)->first();

        if (!$seo) {
            return response()->json([
                'status' => false,
                'message' => 'SEO data not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'SEO Data Retrieved Successfully',
            'data' => $seo
        ], 200);
    }
}
