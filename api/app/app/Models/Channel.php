<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return self::create([
            'name' => $name,
            'user_id' => $id,
        ]);
    }
}
