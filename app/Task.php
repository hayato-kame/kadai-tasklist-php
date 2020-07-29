<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    
   
   
   //  'content' の他に 'status'も入れていいはず？
    protected $fillable = ['content', 'status'];
    
    
    /**
     * この投稿を所有するユーザは一人 だから単数形で  user() というメソッドにする。
     * // （ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
}


/**
 * 作成したモデルファイルに $fillable を設定しておきましょう
 * そして、モデルファイルの中にも一対多の関係を記述しておきましょう。
 * Taskを持つUserは1人であるため、
 * function user() のように単数形userでメソッドを定義し、
 * 中身は return $this->belongsTo(User::class) とします。
 * このようにすることで、 Taskのインスタンスが所属している唯一のUser（投稿者の情報）を 
 * $task->user()->first()
 * もしくは $task->user という簡単な記述で取得できるようになります。
 * 
 * 
 */ 
