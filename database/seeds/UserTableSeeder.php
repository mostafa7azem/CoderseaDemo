<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userClass = config('dashboard.user_model', 'App\Models\User');
        $user = $userClass::firstOrCreate([
            'email'    => 'admin@admin.com'
        ], [
            'email'    => 'admin@admin.com',
            'password' => '123456',
        ]);
    }
}
