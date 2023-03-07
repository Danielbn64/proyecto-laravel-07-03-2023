<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
//use App\Image;

Route::get('/', function () {
    /*
    $images = Image::all();//Conseguir todas las imagenes en la tabla de la base de datos
    foreach($images as $image){
        echo $image->image_path."<br/>";
        echo $image->description."<br/>";
        echo $image->user->name." ".$image->user->surname."<br/>";
        //Cuando escribes un metodo de un modelo con orm se convierte
        //en una propiedad:
        if(count($image->comments) >= 1){
            echo "<h4>Cometarios</h4>";
            foreach($image->comments as $comment){
                echo $comment->user->name." ".$comment->user->surname.": ";
                echo $comment->content."<br>";
            }
        }

        echo "LIKES: ".count($image->likes);
        echo "<hr/>";
    }

    die();*/
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get("/configuracion", "UserController@config")->name('config');
Route::post("/user/update", "UserController@update")->name('user.update');
Route::get("/user/avatar/{filename}", "UserController@getImage")->name('user.avatar');
Route::get("/create-image", "ImageController@create")->name('image.create');
Route::post("/image/save", "ImageController@save")->name('image.save');
Route::get("/image/file{filename}", "ImageController@getImage")->name('image.file');
Route::get("/image/{id}", "ImageController@detail")->name('image.detail');
Route::post("/comment/save", "CommentController@save")->name('comment.save');
Route::get("/comment/delete{id}", "CommentController@delete")->name('comment.delete');
Route::get("/like/{image_id}", "LikeController@like")->name('like.save');
Route::get("/dislike/{image_id}", "LikeController@dislike")->name('like.delete');
Route::get("/likes","LikeController@index")->name('likes');
Route::get("/profile/{id}", "UserController@profile")->name('profile');
Route::get("/image/delete{id}", "ImageController@delete")->name('image.delete');
Route::get("/image/edit{id}", "ImageController@edit")->name('image.edit');
Route::get("/people/{search?}", "UserController@index")->name('user.index');

//http://localhost/proyecto-laravel/public/create-image