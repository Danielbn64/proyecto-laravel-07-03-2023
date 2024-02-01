<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    //Para que este método funcione cómentar la siguiente linea del kernel: 
    //\App\Http\Middleware\VerifyCsrfToken::class,
    public function getTags(Request $request)
    {
        $input = $request->input('input'); 
        $tags = Tag::where('tags', 'like', '%' . $input . '%')->get();
        $responseData = array(
            'status' => 'success',
            'code' => 200,
            'message' => 'Búsqueda de etiquetas exitosa',
            'data' => $tags
        );

        return response()->json($responseData, $responseData['code']);
    }
}
