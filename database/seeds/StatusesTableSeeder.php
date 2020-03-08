<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = Status::firstOrNew(['name' => 'DRAFT', 'category' => 'ESTABLISHMENT']);
        if (!$status->exists) {
            $status->save();
        }

        $status = Status::firstOrNew(['name' => 'REGISTERED', 'category' => 'ESTABLISHMENT']);
        if (!$status->exists) {
            $status->save();
        }

        $status = Status::firstOrNew(['name' => 'DISABLED', 'category' => 'ESTABLISHMENT']);
        if (!$status->exists) {
            $status->save();
        }
    }
}
