<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
     */
    public function destroy(string $id)
    {
        //
    }
}
