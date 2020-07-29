<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


//  ユーザを登録するためのControllerもあらかじめ用意されています
//  RegisterControllerはユーザ登録のためのコントローラです
class RegisterController extends Controller
{
    /*
    
     このコントローラーは、新しいユーザーの登録とそのユーザーの登録を処理します。
     検証と作成。デフォルトでは、このコントローラーは
     追加のコードを必要とせずにこの機能を提供します
     RegistersUsers  は　トレイトです 
     トレイト    メソッドをまとめているもの
     そして use [トレイト名]; によって、まとめた機能をそのまま取り込めます。
     RegistersUsers を取り込んだRegisterControllerは、 RegistersUsers で定義されているメソッドをそのまま取り込むことができます
     
      RegistersUsersトレイトのソースコードを見てみると、確かに showRegistrationForm() と register() が定義されていることが確認できます
    */

    use RegistersUsers;    //  RegistersUsersトレイトには、routes/web.phpで　ユーザ登録のルーティング追加
    // showRegistrationForm アクションと register アクション が定義してあります

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;




    /**
     * Create a new controller instance.
     * 
     * middleware() について
     * コントローラの __construct() でミドルウェア（middleware)を指定できます
     * 
     * Laravelにおけるミドルウェアは コントローラのアクションが実行される前（後）に実行される前処理（後処理） であると思ってください。 
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');  // このコントローラの全アクションに guest ミドルウェアを指定している
        // ゲスト（guest）とは、ログインしていない閲覧者のことです。
        // guest ミドルウェアは、アクションの実行前にログイン状態を確認し、ログインしていない場合はそのまま実行させますが、
        // ログインしている場合は実行させず別のURLへ飛ばします。別のURLへ飛ばすことを リダイレクト という
        // これらのコントローラでは、ゲストにだけユーザ登録やログインを実行させるため
        // guest ミドルウェアを指定している
        // guest の正体は \App\Http\Middleware\RedirectIfAuthenticated というクラスである
        // guest は エイリアス（ニックネームのようなもの）
        // guest の定義は App\Http\Kernel クラスで確認できます。app/Http/Kernel.phpを見てみてください
        
        //  'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        // と書いてあります   ::class は名前空間を含む正しいクラス名（完全修飾名）を取得するための指定
        
        
    }

   
   
   
    /**
     * Get a validator for an incoming registration request.
     * 
     * validator() では、ユーザ登録の際のフォームデータのバリデーションを行っています。
     * 
     * RegistersUsersトレイトのregisterメソッドの中身を見ると、 validator() を呼び出しているのがわかります。
     * 
     * 
     * RegisterControllerの中で validator() を実装することで、ユーザ登録時のバリデーション処理の内容を定義しています。
     * 
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }




    /**
     * Create a new user instance after a valid registration.
     * これはRESTfulなアクション7つの内の1つであるcreateアクションではなく、Userを新規作成しているメソッドになります
     * 
     * これもRegistersUsersトレイトのregisterメソッドの中で呼び出されているのがわかります。
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}




//  ユーザ登録直後のリダイレクト先の設定
// ユーザ登録が完了すると、ログイン状態になった上で、指定のリダイレクト先へ飛ぶようになっています。
// そのリダイレクト先は $redirectTo 変数に設定されている定数 RouteServiceProvider::HOME で定義されています。

// app/Http/Controllers/Auth/RegisterController.php（抜粋）
/**
    protected $redirectTo = RouteServiceProvider::HOME;
app/Providers/RouteServiceProvider.php（抜粋）

    public const HOME = '/home';
これを以下のように変更しましょう。これでリダイレクト先がトップページになります。

app/Providers/RouteServiceProvider.php（抜粋）

変更しました

    public const HOME = '/';
    
    
*/