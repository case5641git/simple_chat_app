<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Channel extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    /**
     * チャンネルを登録する
     * @param string $name
     * @param int $id
     * @return mixed
     */
    public static function createChannel(string $name, int $id): mixed
    {
        try {
            return self::create([
                'name' => $name,
                'user_id' => $id,
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating channel: '. $e->getMessage());
            throw $e;
        }
    }

    /**
     * チャンネルを更新する
     * @param string $name
     * @param int $id
     * @return mixed
     */
    public static function updateChannel(string $name, int $id): mixed
    {
        try {
            $channel = self::find($id);
            $channel->name = $name;
            $result = $channel->save();
            return $result;
        } catch (\Exception $e){
            Log::error('Error updating channel:' . $e->getMessage());
        }
    }
}
