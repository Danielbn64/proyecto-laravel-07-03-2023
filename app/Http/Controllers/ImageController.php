<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponseRedirectResponseredirect;
use App\Image;
use App\User;
use App\Comment;
use App\Like;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('image.create');
    }

    public function save(Request $request)
    {
        //Validación
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required|mimes:jpg,jpeg,png,gif|max:2000000',
        ]);

        //Recojer datos
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //Asignar valores nuevos al objeto
        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;

        //Subir imagen
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->save();
        return redirect()->route('home')->with([
            'message' => 'La foto a sido subida corrctamente'
        ]);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);
        return response($file, 200);
    }

    public function detail($id)
    {
        $image = Image::find($id);
        $user = User::find($image->user_id);
        return view('image.detail', [
            'image' => $image,
            'user' => $user
        ]);
    }

    public function delete($id)
    {
        $user = \Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();
        try {
            if ($user && $image && $image->user->id == $user->id || $user->role == "admin") {

                // Eliminar comentarios
                if ($comments && count($comments) >= 1) {
                    foreach ($comments as $comment) {
                        $comment->delete();
                    }
                }

                // Eliminar los likes
                if ($likes && count($likes) >= 1) {
                    foreach ($likes as $like) {
                        $like->delete();
                    }
                }

                // Eliminar ficheros de imagen
                Storage::disk('images')->delete($image->image_path);

                //Eliminar relación cn las etiquetas:
                $image->tags()->detach();

                // Eliminar registro imagen
                $image->delete();

                $message = array('message' => 'La imagen se ha borrado correctamente.');
            } else {
                $message = array('message' => 'La imagen no se ha borrado.');
            }

            return redirect()->route('home')->with($message);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }

    public function edit($id)
    {
        $user = \Auth::user();
        $image = Image::find($id);
        if ($user && $image && $image->user->id == $user->id || $user->role == "admin") {
            return view('image.edit_image', [
                'image' => $image
            ]);
        } else {
            return redirect()->route('login');
        }
    }

    public function editDescription(Request $request)
    {
        $user = \Auth::user();
        $image_id = $request->input('imageIdDescription');
        $image = Image::find($image_id);
        $description_edit = $request->input('descriptionEdit');

        if ($user && $image->user->id == $user->id || $user->role == "admin") {
            $image->description = $description_edit;
            $image->update();
            $message = array('message' => 'La imagen se ha editado correctamente.');
            return redirect()->route('home')->with($message);
        } else {
            $message = array('message' => 'La imagen no se ha editado correctamente.');
            return redirect()->route('home')->with($message);
        }
    }
}
