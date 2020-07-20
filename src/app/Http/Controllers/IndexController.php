<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
	$posts = \App\Models\Post::orderBy('created_at', 'desc')->get();
        $data = [
            'posts' => $posts,
        ];
        return view('index',$data);
    }
}
