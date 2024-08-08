<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;


    /**
     * ログイン処理　バリデーションエラー
     * @return void
     */
    public function test_validate_error(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'invalid-email',
            'password' => '',
        ]);
        $response->assertSessionHasErrors([
            'email' => '正しいメールアドレスを入力してください。',
        ]);
    }

    /**
     * ログイン処理　認証失敗
     * @return void
     */
    public function test_login_error():void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/api/login',[
            'email' => 'user@test.com',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors([
            'email' => '正しいメールアドレスを入力してください。',
            'password' => '正しいパスワードを入力してください。',
        ]);
        $this->assertGuest();
    }

    /**
     * ログイン処理　認証成功
     * @return void
     */
    public function test_login_success(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->assertGuest();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/');
    }

    /**
     * ログアウト処理
     * @return void
     * 
     */
    public function test_logout(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();
        $response = $this->post('/api/logout');
        $this->assertGuest();
        $response->assertRedirect('/api/login');
        
    }
}
