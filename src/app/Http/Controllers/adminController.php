<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Hashをインポート

class adminController extends Controller
{
    // 新規登録フォームの表示
    public function showRegistrationForm()
    {
        return view('register'); // 新規登録ビューを返す
    }

    // 新規登録処理
    public function register(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 新規ユーザーの作成
        admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // パスワードをハッシュ化
        ]);

        // 登録後、ログイン
        Auth::attempt($request->only('email', 'password'));

        return redirect()->route('admin'); // ダッシュボードへリダイレクト
    }

    // ログインフォームの表示
    public function showLoginForm()
    {
        return view('login'); // ログインビューを返す
    }

    // ログイン処理
    public function login(Request $request)
    {
        // バリデーション
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 認証を試みる
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('admin'); // ダッシュボードへリダイレクト
        }

        // 認証失敗時、エラーメッセージを表示
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが間違っています。',
        ]);
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout(); // ユーザーをログアウト
        return redirect()->route('login.form'); // ログインページへリダイレクト
    }

}
