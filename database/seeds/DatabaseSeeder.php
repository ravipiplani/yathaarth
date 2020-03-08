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
        $this->call(DepartmentsTableSeeder::class);
        $this->call(DesignationsTableSeeder::class);
        $this->call(EstablishmentTypesTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
    }
}
