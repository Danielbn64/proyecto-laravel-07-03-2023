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


Auth::routes();

Route::get('/', 'StockController@index')->name('stock');

Route::post('search', 'StockController@searchResults')->name('stock.search');

Route::get("file{filename}", "ImagePublicController@getImage")->name('image.stock');

Route::get("/detail_public/{id}", "ImagePublicController@publicIndex")->name('detail.public');

Route::get("download/{filename}", "ImagePublicController@downloadImage")->name('image.download');

Route::get('/home', 'HomeController@index')->name('home');

Route::get("/configuracion", "UserController@config")->name('config');

Route::post("/user/update", "UserController@update")->name('user.update');

Route::get("/user/avatar/{filename}", "UserController@getImage")->name('user.avatar');

Route::get("/user/avatar_public/{filename}", "ImagePublicController@getUserAvatar")->name('user.avatar_public');

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

Route::get("/image/delete/{id}", "ImageController@delete")->name('image.delete');

Route::get("/image/edit/{id}", "ImageController@edit")->name('image.edit_image');

Route::post("/edit_description", "ImageController@editDescription")->name('edit_description');

Route::get("/people/{search?}", "UserController@index")->name('user.index');

Route::post("/get_tags", "TagController@getTags")->name('tag.get_tags');

Route::put("/update_images_tags", "ImageTagController@updateImageTags")->name('ImageTags.update_images_tags');


//http://localhost/proyecto-laravel/public/create-image