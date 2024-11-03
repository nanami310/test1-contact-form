<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Authファサードをインポート

class AuthController extends Controller
{
    public function index()
    {
        return view('admin');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // ユーザーをログアウト
        
        // リダイレクト先を/adminに設定
        return redirect('/login');
    }
}