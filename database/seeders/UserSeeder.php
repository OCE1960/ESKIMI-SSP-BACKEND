<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Okeke Chukwuemeka';
        $user->email = 'admin@eskimi.com';
        $user->password = bcrypt('password');
        $user->save();

        $user = new User;
        $user->name = 'Christian Onyeo';
        $user->email = 'chris@eskimi.com';
        $user->password = bcrypt('password');
        $user->save();

        $user = new User;
        $user->name = 'Igbokwe Ann';
        $user->email = 'ann@eskimi.com';
        $user->password = bcrypt('password');
        $user->save();

        $user = new User;
        $user->name = 'Okechukwu Chime';
        $user->email = 'chime@eskimi.com';
        $user->password = bcrypt('password');
        $user->save();
    }
}
