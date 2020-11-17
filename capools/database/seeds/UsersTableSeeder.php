<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'  => 'システム開発者',
            'email' => 'admin@example.com',
            'password' => '$2y$10$Sph1AvyUkRIeYQRC3Ve7AuDvyy.HTIrycnWaJtaZd.1siLYViWsni',
            'role'  => 9
        ]);

        DB::table('users')->insert([
            'name'  => '一般ユーザ(管理者)',
            'email' => 'user1@example.com',
            'password' => '$2y$10$jVC9esUe0VofJ0HUSkRQ0eDn7YMAnuTpqL5OW0h0yzJQbMSeS5QMe',
            'role'  => 5
        ]);

        DB::table('users')->insert([
            'name'  => '一般ユーザ',
            'email' => 'mentenance@example.com',
            'password' => '$2y$10$jVC9esUe0VofJ0HUSkRQ0eDn7YMAnuTpqL5OW0h0yzJQbMSeS5QMe',
        ]);


        // シーケンスの手動更新
        DB::unprepared("SELECT setval('users_id_seq', (SELECT MAX(id) FROM users))");

        // ファクトリによるテストデータの追加
        factory(App\Models\User::class, 5)->create();
    }
}
