<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Division::create([
            'name' => 'Divisi 1'
        ]);

        Division::create([
            'name' => 'Divisi 2'
        ]);

        Division::create([
            'name' => 'Divisi 3'
        ]);
    }
}
