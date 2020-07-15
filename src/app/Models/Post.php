<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
    return $this->belongsTo('App\User');
    }
    //後にcreate()メソッドで保存するカラムを指定
    protected $fillable = [
        'user', 'image_file_name', 'image_title',
    ];
}
