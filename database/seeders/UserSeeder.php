<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = bcrypt('12345678');

        DB::table('users')->insertOrIgnore([
            'id' => 1,
            'uuid' => Uuid::uuid4()->toString(),
            'name' => 'Usuário Master',
            'email' => 'master@gmail.com',
            'password' => $password,
            'document' => '43397614007',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

    }
}
