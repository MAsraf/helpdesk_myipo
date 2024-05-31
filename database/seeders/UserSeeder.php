<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Seeders\DateTime;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            array(
                'name' => 'administrator',
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'technician',
                'email' => 'tech@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'asraf',
                'email' => 'asraf.educ.it@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            )
        );
    }
}
