<?php

namespace Database\Seeders;

use App\Models\Rent;
use Illuminate\Database\Seeder;

class RentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rent::create([
            'room_id'       => '1',
            'division_id'   => '2',
            'borrower_name' => 'Borrow 1',
            'phone'         => '0851',
            'from_date'     => '2021-12-30 15:57:16.000000',
            'until_date'    => '2021-12-31 15:57:16.000000',
            'description'   => 'Pinjam desc',
            'note'          => 'pinjam note'
        ]);
    }
}
