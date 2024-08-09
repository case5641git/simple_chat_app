<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * ログイン処理
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => '正しいメールアドレスを入力してください。',
            'password' => '正しいパスワードを入力してください。',
        ]);
    }

    /**
     * ログアウト処理
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    /**
     * 新規登録処理
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function register(Request $request): RedirectResponse|JsonResponse
    {
        $credentials = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        try {
            User::create($credentials);
        } catch (\Exception $e) {
            return response()->json(['message' => 'ユーザー登録に失敗しました。'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }        
        return redirect()->route('login');
    }

    /**
     * 退会処理
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function delete(Request $request): RedirectResponse|JsonResponse
    {
        $user = Auth::user();
        try {
            $user->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'ユーザー削除に失敗しました。'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return redirect()->route('register');
    }
}
