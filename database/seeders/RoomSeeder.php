<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create([
            'code'          => 'RM-001',
            'department_id' => '1',
            'name'          => 'Bait Ammi',
            'floor'         => '1',
        ]);

        Room::create([
            'code'          => 'RM-002',
            'department_id' => '4',
            'name'          => 'Perpustakaan',
            'floor'         => '2',
        ]);
        
        Room::create([
            'code'          => 'RM-003',
            'department_id' => '4',
            'name'          => 'Ruang Komputer',
            'floor'         => '3',
        ]);
        
        Room::create([
            'code'          => 'RM-004',
            'department_id' => '2',
            'name'          => 'Studio Musik',
            'floor'         => '4',
        ]);
        
        Room::create([
            'code'          => 'RM-005',
            'department_id' => '2',
            'name'          => 'Studio Multimedia',
            'floor'         => '4',
        ]);
    }
}
