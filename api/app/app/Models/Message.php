<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    /**
     * 操作を許可しないカラム
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    /**
     * メッセージを登録する
     * @param array $data
     * @return mixed
     */
    public static function createMessage(int $id, string $message):mixed
    {
        try {
            return self::create([
                'user_id' => $id,
                'message' => $message,
            ]);
        } catch (\Exception $e) {
            Log::error("Error creating message:" . $e->getMessage());
            throw $e;
        }
    }
}
