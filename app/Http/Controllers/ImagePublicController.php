<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\User;

class ImagePublicController extends Controller
{
    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);
        return response($file, 200);
    }

    public function getUserAvatar($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return response($file, 200);
    }

    public function publicIndex($id)
    {
        $image = Image::find($id);
        $user = User::find($image->user_id);
        return view('image.public_detail', [
            'image' => $image,
            'user' => $user
        ]);
    }

    public function downloadImage($filename)
    {
        $file = Storage::disk('images')->get($filename);
        $response = response($file, 200);

        // Agregar encabezados para la descarga del archivo
        $response->header('Content-Type', 'image/jpeg'); // Ajusta el tipo de contenido según el tipo de imagen
        $response->header('Content-Disposition', 'attachment; filename="' . $filename . '"');

        return $response;
    }
}
