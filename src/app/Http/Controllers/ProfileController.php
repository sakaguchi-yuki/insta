<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Illuminate\Database\Eloquent\Collection;

class ProfileController extends Controller
{
    public function index(Request $request){
        $token = $request->session()->get('github_token', null);
        try {
            $user = Socialite::driver('github')->userFromToken($token);
        } catch (\Exception $e) {
            return redirect('login/github');
        }

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://api.github.com/user/repos', [
            'auth' => [$user->user['login'], $token]
        ]);
      $posts = \App\Models\Post::orderBy('created_at', 'desc')->get();
      $data = [
          'posts' => $posts,
	  'username' => $user->nickname
      ];      
      return view('profile',$data);
    }
}
