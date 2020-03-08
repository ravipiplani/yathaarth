<?php

use App\State;
use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = fopen(storage_path().'/csv/location/districts.csv', "r");
        $state_arr = [];
        while (($district = fgetcsv($file, 10000, ",")) !== FALSE) {
            $state = $district[1];
            $state_arr[$state][] = [
                'name' => $district[0]
            ];
        }
        fclose($file);
        foreach ($state_arr as $state => $districts) {
            $state = State::where('name', 'like', '%'.trim($state).'%')->first();
            $state->districts()->createMany($districts);
        }
    }
}
