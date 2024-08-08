<?php

namespace Tests\Feature;

use App\Events\ChatCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use App\Models\Message;

class MessageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * バリデーションテスト
     * @return void
     */
    public function test_validation_error(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        /** @var User $user */
        $this->actingAs($user);
        $user_id = Auth::id();
        $response = $this->postJson('/api/messages', [
            'user_id' => $user_id,
            'message' => ''
        ]);
        $response->assertStatus(500);
    }

    /**
     * 正常なメッセージ作成テスト
     * @return void
     */
    public function test_successfull_message_creation(): void
    {
        
        $this->withoutExceptionHandling();

        $user = User::factory()->create()->first();
        /** @var User $user */
        $this->actingAs($user);
        $user_id = Auth::id();

        $response = $this->postJson('/api/messages', [
            'user_id' => $user_id,
            'message' => 'Hello World.'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'メッセージを送信しました。']);
        $this->assertDatabaseHas('messages', [
            'user_id' => $user->id,
            'message' => 'Hello World.'
        ]);

        // Event::fake()->assertDispatched(ChatCreated::class, function ($event){
        //     return $event->message->message === 'Hello World.';
        // });
    }

    /**
     * メッセージ作成失敗テスト
     * 
     * @return void
     * 
     */
    public function test_message_creation_failure(): void
    {
        $this->withoutExceptionHandling();
        Event::fake();

        $user = User::factory()->create();
        Auth::login($user);

        $this->mock(Message::class, function ($mock) {
            $mock->shouldReceive('createMessage')->andThrow(new \Exception('メッセージ作成失敗'));
        });

        $response = $this->postJson('/api/messages', [
            'message' => 'メッセージの送信に失敗しました。',
        ]);

        $response->assertStatus(500);
        $response->assertJson(['message' => 'メッセージの送信に失敗しました。']);

        Event::assertNotDispatched(ChatCreated::class);
    }
}
