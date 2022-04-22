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
            'code'          => 'Kode1',
            'department_id' => '1',
            'name'          => 'Room 1',
            'floor'         => '3',
        ]);
        Room::create([
            'code'          => 'Kode2',
            'department_id' => '2',
            'name'          => 'Room 2',
            'floor'         => '1',
        ]);
        Room::create([
            'code'          => 'Kode3',
            'department_id' => '3',
            'name'          => 'Room 3',
            'floor'         => '3',
        ]);
    }
}
