<?php

use App\Designation;
use Illuminate\Database\Seeder;

class DesignationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $designation = Designation::firstOrNew(['name' => 'ceo']);
        if (!$designation->exists) {
            $designation->fill([
                'display_name' => 'CEO',
            ])->save();
        }

        $designation = Designation::firstOrNew(['name' => 'coo']);
        if (!$designation->exists) {
            $designation->fill([
                'display_name' => 'COO',
            ])->save();
        }

        $designation = Designation::firstOrNew(['name' => 'asm']);
        if (!$designation->exists) {
            $designation->fill([
                'display_name' => 'Area Sales Manager',
            ])->save();
        }

        $designation = Designation::firstOrNew(['name' => 'sse']);
        if (!$designation->exists) {
            $designation->fill([
                'display_name' => 'Senior Sales Executive',
            ])->save();
        }

        $designation = Designation::firstOrNew(['name' => 'se']);
        if (!$designation->exists) {
            $designation->fill([
                'display_name' => 'Sales Executive',
            ])->save();
        }

        $designation = Designation::firstOrNew(['name' => 'so']);
        if (!$designation->exists) {
            $designation->fill([
                'display_name' => 'Sales Officer',
            ])->save();
        }
    }
}
