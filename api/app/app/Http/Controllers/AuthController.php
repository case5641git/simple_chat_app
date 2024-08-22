<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * ログイン処理
     * @param Request $request
     * @return JsonResponse
     */
    // public function login(Request $request): JsonResponse
    // {
    //     $credentials = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         return response()->json(['token' => $request->user()->createToken('API Token')->plainTextToken]);
    //     }
    //     return response()->json(['message'=>'ログインに失敗しました。'], Response::HTTP_UNAUTHORIZED);
    // }
    public function login(Request $request) {
        $data = $request->validated([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'メールアドレスかパスワードが正しくありません'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $cookie = cookie('token', $token, 60 * 24);

        return response()->json([
            'user' => new UserResource($user),
        ])->withCookie($cookie);
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
        return response()->json(['message' => 'ユーザー登録が完了しました。'], Response::HTTP_CREATED);
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
