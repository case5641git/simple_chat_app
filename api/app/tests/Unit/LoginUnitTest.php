<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class LoginUnitTest extends TestCase
{
    /**
     * ログイン処理　バリデーションエラー
     * @return void
     */
    public function test_validate_error(): void
    {
        $response = $this->post('/login', [
            'email' => 'inbalid-email',
            'password' => '',
        ]);
        $response->assertSessionHasErrors(['email']);
    }

    /**
     * ログイン処理　認証失敗
     * @return void
     */
    public function test_login_error():void
    {
        $user = User::factory()->create([
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login',[
            'email' => 'user@test.com',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors(['email']);
        $response->assertGuest();
    }

    /**
     * ログイン処理　認証成功
     * @return void
     */
    public function test_login_success(): void
    {
        $user = User::factory()->create([
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'user@test.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/');
        $response->assertAuthenticated($user);
    }
}
