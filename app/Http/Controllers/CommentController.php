<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function save(Request $request){
        //Valdiacion:
        $validate = $this->validate($request,[
            'image_id' => 'integer|required',
            'content' => 'string|required'
        ]);
        //Recojer datos del formulario:
        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');
        
        //Asignar nuevos valores al objeto a guardar
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;  
        
        //Guardar en la base de datos
        $comment->save();

        //Redirección
        return redirect()->route('image.detail',['id' => $image_id])
                         ->with([
                            'message' => 'Has publicado tu comentario correctamente'
                         ]);

    }

    public function delete($id){
        // Conseguir datos del usuario identificado
        $user = \Auth::user();

        // Conseguir objetos del comentario
        $comment = Comment::find($id);

        //Comprobar si soy el dueño del comentario o de la publicacion
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id || $user->role == 'admin')){
            $comment->delete();
            
            return redirect()->route('image.detail',['id' => $comment->image->id])
                         ->with([
                            'message' => 'Comentario eliminado correctamente'
                         ]);
        }else{
            return redirect()->route('image.detail',['id' => $comment->image->id])
                         ->with([
                            'message' => 'El comentario no se a eliminado'
                         ]);
        }
    }
}
