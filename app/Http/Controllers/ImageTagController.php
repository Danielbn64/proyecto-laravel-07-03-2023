<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Tag;

class ImageTagController extends Controller
{
    public function updateImageTags(Request $request)
    {
        $list_tags = $request->input('tags'); //array de etiquetas que vienen del cliente
        $image_id = $request->input('imageId'); //el id de la imagen que viene del cliente

        $tags_array = json_decode($list_tags, true); //transforma el json de etiquetas en un array

        try {
            //Encuentra en la base de datos la imagen que tenga ese id:
            $image = Image::find($image_id);
            //Elimina las etiquetas anteriores asociadas a la imagen:
            $image->tags()->detach();
            //Recorre el array de etiquetas
            foreach ($tags_array as $tag) {
                //Si la etiqueta no existe en la tabla tags se crea:
                $tag_object = Tag::firstOrCreate(
                    ['tags' => $tag]
                );
                //Obtiene el id de la etiqueta una vez creada:
                $tag_id = $tag_object->id;
                //Asocia las nuevas etiquetas con la imagen:
                $image->tags()->attach($tag_id);
            }

            $response_data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Lista de etiquetas recibida correctamente',
                'data' => $tags_array, $image_id
            );

            return response()->json($response_data, $response_data['code']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Ocurrió un error interno en el servidor'], 500);
        }
    }
}
