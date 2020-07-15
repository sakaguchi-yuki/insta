<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use App\Models\Post;
#use Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Socialite;

class PostController extends Controller
{
    public function index()
    {
	return view('post');
    }
    //画像およびコメントアップロード
public function upload(Request $request){

//Validatorファサードのmakeメソッドの第１引数は、バリデーションを行うデータ。
//第２引数はそのデータに適用するバリデーションルール
        $validator = Validator::make($request->all(), [
            'file' => 'required|max:10240|mimes:jpeg,gif,png',
            'comment' => 'required|max:191'
        ]);

//上記のバリデーションがエラーの場合、ビューにバリデーション情報を渡す
      #  if ($validator->fails()){
      #      return back()->withInput()->withErrors($validator);
      #  }
//s3に画像を保存。第一引数はs3のディレクトリ。第二引数は保存するファイル。
//第三引数はファイルの公開設定。
        $file = $request->file('file');
        $path = Storage::disk('s3')->putFile('/', $file, 'public');
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

//カラムに画像のパスとタイトルを保存
        Post::create([
	    'user' => $user->nickname,
            'image_file_name' => $path,
            'image_title' => $request->comment
        ]);

        return redirect('index');
    }

}
