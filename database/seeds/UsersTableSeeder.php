<?php

use App\Entities\Admin\User;
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
        User::truncate();
        /*
        'first_name'
        'last_name'
        'email'
        'username'
        'password'
        'email_verified_at'
        'start_date'
        'end_date'
        */
        $root = new User();
        $root->email = 'root@ticket.com';
        $root->username = 'root';
        $root->first_name = 'Root';
        $root->password = 'password';
        $root->created_by = 1;
        $root->updated_by = 1;
        $root->save();

        $user = new User();
        $user->email = 'jaime@jaimevirruetaf.com';
        $user->username = 'jaime';
        $user->first_name = 'Jaime D.';
        $user->last_name = 'Virrueta Fuentes';
        $user->password = bcrypt('password');
        $user->created_by = $root->id;
        $user->updated_by = $root->id;
        $user->save();

        factory(User::class, 10)->create([
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);
    }
}
