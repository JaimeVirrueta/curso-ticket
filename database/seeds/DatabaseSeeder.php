<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        try {
            Schema::disableForeignKeyConstraints();

            $this->call(UsersTableSeeder::class);

            Schema::enableForeignKeyConstraints();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
}
