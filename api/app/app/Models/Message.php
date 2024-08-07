<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Message extends Model
{
    use HasFactory;

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
    public static function createMessage(array $data):mixed
    {
        try {
            return self::create($data);
        } catch (\Exception $e) {
            Log::error("Error creatting message:" . $e->getMessage());
            throw $e;
        }
    }
}
