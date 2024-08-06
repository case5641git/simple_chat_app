<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $channels = Channel::all();
            return response()->json($channels, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'チャンネルの取得に失敗しました。'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            $channel = new Channel();
            $credentials = $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $channel->name = $credentials['name'];
            $channel->user_id = $user->id;
            $channel->save();

            return response()->json(['message' => 'チャンネルを作成しました。'], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['message'=>'チャンネルの作成に失敗しました。'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(Request $request, string $id):JsonResponse
    {
        try {
            $credentials = $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $channel = Channel::find($id);
            $channel->name = $credentials['name'];
            $channel->save();

            return response()->json(['message' => 'チャンネルを更新しました。'], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json(['message' => 'チャンネルの更新に失敗しました。'], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    /**
     * Remove the specified resource from storage.
     * @param strin $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $channel = Channel::find($id);
            $channel->delete();
            return response()->json(['message' => 'チャンネルを削除しました。'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'チャンネルの削除に失敗しました。'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
