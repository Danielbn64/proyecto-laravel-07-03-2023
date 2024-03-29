<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use app\User;
use app\Image;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($search = null)
    {
        if (!empty($search)) {
            $users = User::where('nick', 'LIKE', '%' . $search . '%')
                ->orWhere('name', 'LIKE', '%' . $search . '%')
                ->orWhere('surname', 'LIKE', '%' . $search . '%')
                ->orderBy('id', 'desc')
                ->paginate(5);
        } else {
            $users = User::orderBy('id', 'desc')->paginate(5);
        }

        return view('user.index', [
            'users' => $users
        ]);
    }

    public function config()
    {
        return view('user.config');
    }

    public function update(Request $request)
    {
        //Conseguir el usuario identificado
        $user = \Auth::user();
        $id = $user->id;
        //Validación del formulario
        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,' . $id, //Exepcion que el nick coincida
            //con el nick del id del usuario correspondiente
        ]);
        //Recojer los datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');

        //Asignar nuevos valores al objeto del usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;

        //Subir la imagen
        $image_path = $request->file('image_path'); //Al ser una imagen se recoje con file
        if ($image_path) {
            // Poner nombre unico
            $image_path_name = time() . $image_path->getClientOriginalName();
            // Guardar imagen en el disk storage (storage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path));
            //Setea el nombre de la imagen en el objeto
            $user->image = $image_path_name;
        }

        //Ejecutar consulta y cambiar la base de datos
        $user->update();
        return redirect()->route('config')
            ->with(['message' => "Usuario actualizado correctamente"]);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return response($file, 200);
    }

    public function profile($id)
    {
        $user = User::find($id);
        $images = $user->images()->orderBy('created_at', 'desc')->paginate(12);
        return view('user.profile', [
            'images' => $images,
            'user' => $user
        ]);
    }
}
