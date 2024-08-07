<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Message;


class MessageController extends Controller
{
    /**
     * メッセージ登録処理
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'message' => 'required|string|max:255',
            ]);
            Message::createMessage($request->only(['user_id', 'message', 'channel_id','privatechat_id']));
            return response()->json(['message' => 'メッセージを送信しました。'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'メッセージの送信に失敗しました。'], Response::HTTP_INTERNAL_SERVER_ERROR);
        };

    }

    /**
     * チャンネルメッセージ取得処理
     */
    public function show_channel_messages(string $id)
    {
        try {
            $messages = Message::find($id);
            return response()->json($messages, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'メッセージの取得に失敗しまいた。'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $message = Message::find($id);
            $message->delete();
            return resposne()->json(['message' => 'メッセージを削除しました。'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'メッセージの削除に失敗しました。'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
