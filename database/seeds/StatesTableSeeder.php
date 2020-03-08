<?php

use App\State;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = fopen(storage_path().'/csv/location/states.csv', "r");
        $state_arr = [];
        while (($state = fgetcsv($file, 10000, ",")) !== FALSE) {
            $state = State::firstOrNew(['name' => $state[0]]);
            if (!$state->exists) {
                $state->save();
            }
        }
        fclose($file);
    }
}
