<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



/**
 * 
 * create() を使ってデータを保存するときには、
 * そのModelファイルの中に $fillable を定義し、create() で保存可能なパラメータを配列として代入しておく必要があることを覚えておいてください。
 * 
 * $hidden
 * パスワードなど秘匿しておきたいカラムを、
 * モデルで $hidden に指定しておくと、見られないように隠してくれます。
 * たとえば、 tinkerで User::first() で取得したときに、 Userモデルのコーディングで $hidden = ['password'] と代入されていると、password は表示されません。
 * ただし、 User::first()->password と明示すれば表示されます。
 * 
 * 
 * 今回は必要ありませんが $table という変数も指定できます。

モデルと接続されるテーブル名は、モデル名によって決められます。
たとえば、 Taskモデルはtasksテーブルと自動的に接続されます。
この規則を破って独自のテーブル名をつけたい場合に、 $table を使用します。
たとえば、 Taskモデルだけど、 tskテーブルを使いたいとなれば $table = 'tsk' とすれば接続されます。

今回はUserモデルに対して $table = 'users' で、規則通りであるため省略されています。

まだ利用していませんが Hash ファサードについても、ここで触れておきます。
Hash ファサードはハッシュの機能を提供します。
セキュリティの観点から、パスワードはハッシュしてからデータベースに保存すべきで、パスワードを平文（そのまま）保存すべきではありません。
パスワードは必ずハッシュしましょう

 */ 
 
 // Userモデル  Laravelプロジェクトを作成した時点で用意されています
 // これに紐づいている usersテーブル のユーザテーブル設計のマイグレーションファイルも、
 // Laravelが あらかじめ用意してくれています
 // マイグレーションを実行して、 usersテーブルを作成することにします  php artisan migrate  コマンドで作成できる
 // マイグレーションが実行済みになったことを   php artisan migrate:status コマンド  で確認しておきましょう
 
 // 見えませんが、モデルクラスには、たくさんのプロパティやメソッドが定義されています。
 // クラスに紐づいたメソッドなので、クラスメソッドといいます
 // createメソッドなどあります User::create([ , , , , ...]) などとクラス名.メソッド名のように書いて使います
 
 // create() を使ってデータを保存するときには、そのModelファイルの中に $fillable を定義し、
 // create() で保存可能なパラメータを配列として代入しておく必要があることを覚えておいてください。
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * 
     * 後ほど、ユーザの作成に create() という関数を使います。create() は save() と同じくデータベースにINSERTを発行する関数です
     * create() は save() のようにインスタンスを作成する必要がなく、データを代入してそのままユーザを作成できます。
     * create() は一気にデータを代入できますが、
     * すべての項目がデフォルトで「一気に保存可能」になっていると、想定外のデータが保存されるかもしれず、
     * セキュリティ上それは良いことでありません
     * 
     * そこで通常は、すべてのカラムをデフォルトでは「一気に保存不可」とし
     * $fillable で「一気に保存可能」なパラメータを指定します
     * 
     * こうすることで、想定外のデータが代入されるのを防ぎ、なおかつ、一気にデータを代入することが可能になります
     * 
     * create() を使ってデータを保存するときには、
     * そのModelファイルの中に $fillable を定義し、
     * create() で保存可能なパラメータを配列として代入しておく必要があることを覚えておいてください。
     * 
     * ログイン時には内部で Hash::check() が呼び出され、入力されたパスワードとデータベースに保存されているハッシュ値が一致しているかを確認しています。
     * 
     * これで、ユーザ登録時のパスワードをハッシュしてからデータベースに保存することができ、
     * さらに、ログイン時にもパスワードの一致を確認できます。
     * 
     * プロパティとして
     * $fillable と $hidden という配列が書かれています。
     * 後ほど ユーザの作成に create() という関数を使います
     * 
     * create() は save() と同じくデータベースにINSERTを発行する関数です。

create() は save() のようにインスタンスを作成する必要がなく、データを代入してそのままユーザを作成できます

create() は一気にデータを代入できますが、すべての項目がデフォルトで「一気に保存可能」になっていると、想定外のデータが保存されるかもしれず、セキュリティ上それは良いことでありません
そこで通常は、すべてのカラムをデフォルトでは「一気に保存不可」とし、$fillable で「一気に保存可能」なパラメータを指定します。こうすることで、想定外のデータが代入されるのを防ぎ、なおかつ、一気にデータを代入することが可能になります。
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    
    /**
     * このユーザが所有する投稿は複数あるので tasks() メソッド　というふうに
     * 複数形にしています。（ Taskモデルとの関係を定義）
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    
    
    
    
    
    /**
     * このユーザに関係するモデルの件数をロードする。
     * 
     * これをアクションで $user->loadRelationshipCounts() のように呼び出した後、
     * ビューで $user->tasks_count のように件数を取得することになります
     * 
     * 
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount('tasks');
    }
    
    
    
}


// tinker などで　まず   use App\User としてから User::all() などを実行する

/**
 * 
 * Userモデルファイルにも一対多の表現を記述しておきます。
 * Userが持つTaskは複数存在するため、 function tasks() のように複数形tasksでメソッドを定義します。
 * 中身は return $this->hasMany(Task::class); とします
 * （先ほどとは異なりhasManyを使用していることに着目してください）
 * 
 * 
 * 
 * Taskのときと同様に記述することで、
 * UserのインスタンスからそのUserが持つTaskを 
 * $user->tasks()->get() 
 * もしくは $user->tasks という簡単な記述で取得できるようになります
 * 
 */