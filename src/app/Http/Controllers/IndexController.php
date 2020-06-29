<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
	$posts = \App\Models\Post::all();
        $data = [
            'posts' => $posts,
        ];
        return view('index',$data);
    }
}
