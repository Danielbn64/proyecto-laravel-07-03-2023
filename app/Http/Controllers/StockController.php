<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Image;
use App\Tag;

class StockController extends Controller
{
    public function index()
    {
        $images = Image::orderBy('id', 'desc')->paginate(45);
        return view('layouts.welcome', [
            'images' => $images
        ]);
    }

    public function searchResults(Request $request)
    {
        $search_request = $request->input('search');
        $search_array = explode(' ', $search_request);

        foreach ($search_array as $search) {
            $tags = Tag::where('tags', 'like', '%' . $search . '%')->get();
            foreach ($tags as $tag) {
                $tag_ids[] = $tag->id;
            }
        }
        if (empty($tag_ids)) {
            $images = Image::orderBy('id', 'desc')->paginate(45);
            $message = array('message' => 'No se ha encontrado ninguna imagen. ');
            return redirect()->route('stock')->with($message);
        } else {
            $image_ids = DB::table('images_tags')
                ->whereIn('tag_id', $tag_ids)
                ->pluck('image_id')
                ->toArray();

            $images = Image::whereIn('id', $image_ids)->paginate(45);
            return view('layouts.welcome', [
                'images' => $images
            ]);
        }
    }
}
