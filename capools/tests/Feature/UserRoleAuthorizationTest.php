<?php

namespace Tests\Feature;

use App\Models\User;
use App\ValueObjects\UserRole\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRoleAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 管理者ユーザで管理者ページへのアクセスを実行
     */
    public function testAdministrator()
    {
        // ユーザ生成
        $user = factory(User::class)->create(['role' => UserRole::ADMINISTRATOR]);

        // ログイン
        $this->actingAs($user)
            ->withSession(['user_id' => $user->id])
            ->get(route('home'));

        // 認証を確認
        $this->assertAuthenticated();

        // 管理者専用配下を表示できる
        $response = $this->get('/admin');
        $response->assertStatus(200);

    }

    /**
     * 管理者ユーザで管理者ページへのアクセスを実行
     */
    public function testUser()
    {
        // ユーザ生成
        $user = factory(User::class)->create(['role' => UserRole::NORMAL]);

        // ログイン
        $this->actingAs($user)
            ->withSession(['user_id' => $user->id])
            ->get(route('home'));

        // 認証を確認
        $this->assertAuthenticated();

        // 管理者専用配下を表示できる
        $response = $this->get('/admin');
        $response->assertStatus(403);

    }
}
