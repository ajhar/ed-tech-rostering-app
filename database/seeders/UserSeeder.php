<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\StudentActivity;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::getCount()) return;
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
            'role' => UserRoleEnum::ADMIN
        ]);
    }
}
