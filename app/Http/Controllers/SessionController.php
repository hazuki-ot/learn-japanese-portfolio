<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function startSession(Request $request)
    {
        // フォームから送信された'language'の値を取得
        $language = $request->input('language');
        $name     = $request->input('name');

        // セッションに'user_language'というキーで言語を保存
        session(['user_language' => $language]);
        session(['user_name' => $name]);

        // 任意のページにリダイレクト
        return redirect()->route('starting');
    }

    public function endSession()
    {
        // 'user_language'というキーのセッションデータを削除
        session()->forget('user_language');

        // 全てのセッションデータを削除する場合は `session()->flush();` を使用
        // request()->session()->flush();

        // 任意のページにリダイレクト
        return redirect()->route('home');
    }
}
