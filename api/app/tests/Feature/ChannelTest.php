<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ChannelTest extends TestCase
{
    // /**
    //  * チャンネル作成　バリデーションエラー
    //  * @return void
    //  */
    // public function test_channel_validate_error(): void
    // {
    //     $user = User::factory()->create();
    //     /** @var User $user */
    //     $this->actingAs($user);
    //     $this->assertAuthenticated();
    //     // チャンネル名が空の場合
    //     $response_empty = $this->post('/api/channel', [
    //         'name' => '',
    //     ]);
    //     dd($response_empty->json());
    //     //dd($response_empty);
    //     $response_empty->assertJsonValidationErrors([
    //         'name' => 'チャンネル名は必ず指定してください。',
    //     ]);

    //     // チャンネル名が256文字以上の場合
    //     $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
    //     $randomStr = substr(str_repeat($chars, 10),0, 256);
    //     $response_max_string = $this->post('/api/channel',[
    //         'name' => $randomStr,
    //     ]);
    //     $response_max_string->assertJsonValidationErrors([
    //         'name' => 'チャンネル名は255文字以下で指定してください。',
    //     ]);

    //     //チャンネル名が重複している場合
    //     $response_pre_registrate = $this->post([
    //         'name' => 'test_channle',
    //     ]);
    //     $response_pre_registrate->assertStatus(200);
    //     $response_duplicate = $this->post('/api/channel', [
    //         'name' => 'test_channle',
    //     ]);
    //     $response_duplicate->assertJsonValidationErrors([
    //         'name' => 'チャンネル名は既に使用されています。',
    //     ]);
    // }


    /**
     * チャンネル作成
     * @return void
     */
    public function test_channel_creation(): void
    {
        $user = User::factory()->create();
        /** @var User $user */
        $this->actingAs($user);
        $this->assertAuthenticated();
        $response = $this->post('/api/channel', [
            'name' => 'test_channel',
        ]);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'チャンネルを作成しました。']);
    }
}
