<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ServiceKindsTableSeeder::class);
        $this->call(ServiceTypesTableSeeder::class);
        $this->call(ServersTableSeeder::class);
        $this->call(WinBoostingsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RolesAndPermissionsTablesSeeder::class);
        $this->call(ServicesTableSeeder::class);
    }
}