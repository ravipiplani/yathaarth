<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = Department::firstOrNew(['name' => 'sales']);
        if (!$department->exists) {
            $department->fill([
                'display_name' => 'Sales',
            ])->save();
        }
    }
}
