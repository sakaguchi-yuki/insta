<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use App\Models\Post;
#use Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
//カラムに画像のパスとタイトルを保存
        Post::create([
            'image_file_name' => $path,
            'image_title' => $request->comment
        ]);

        return redirect('index');
    }

}
