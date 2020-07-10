<?php

use App\EstablishmentType;
use Illuminate\Database\Seeder;

class EstablishmentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $establishment_type = EstablishmentType::firstOrNew(['name' => 'Retailer']);
        if (!$establishment_type->exists) {
            $establishment_type->save();
        }

        $establishment_type = EstablishmentType::firstOrNew(['name' => 'Distributor']);
        if (!$establishment_type->exists) {
            $establishment_type->save();
        }

        $establishment_type = EstablishmentType::firstOrNew(['name' => 'Super Stockist']);
        if (!$establishment_type->exists) {
            $establishment_type->save();
        }
    }
}
