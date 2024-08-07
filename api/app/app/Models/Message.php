<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return self::create($data);
    }
}
