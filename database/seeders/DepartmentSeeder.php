<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name' => 'Gedung Gereja'
        ]);

        Department::create([
            'name' => 'Sekretariat'
        ]);

        Department::create([
            'name' => 'Mitra Graha'
        ]);

        
        Department::create([
            'name' => 'STEP'
        ]);

    }
}
