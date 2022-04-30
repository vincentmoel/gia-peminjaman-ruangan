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
            'name' => 'Seksi Multimedia'
        ]);

        Division::create([
            'name' => 'Seksi Musik'
        ]);

        Division::create([
            'name' => 'Seksi Wanita'
        ]);
        
        Division::create([
            'name' => 'KAA'
        ]);

        Division::create([
            'name' => 'PRBK'
        ]);
    }
}
