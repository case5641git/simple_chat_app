<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

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


    /**
     * 新規登録処理　バリデーションエラー
     * @return void
     */
    public function test_registrate_validate_error():void
    {
        $response = $this->post('/api/register', [
            'name' => '',
            'email' => 'invalid-email',
            'password' => '',
        ]);
        $response->assertSessionHasErrors([
            'name' => '名前 を入力してください。',
            'email' => '正しいメールアドレスを入力してください。',
            'password' => 'パスワード を入力してください。',
        ]);
    }

    /**
     * 新規登録処理　登録済みメールアドレス
     * @return void
     */
    public function test_registrate_email_exists():void
    {
        User::factory()->create([
            'email' => 'test@example.com',
        ]);
        $response = $this->post('/api/register', [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        $response->assertSessionHasErrors([
            'email' => 'この メールアドレス は既に使用されています。'
        ]);
    }

    /**
     * 新規登録処理
     * @return void
     */
    public function test_registrate_success():void
    {
        $response = $this->post('/api/register', [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/api/login');
    }
}
