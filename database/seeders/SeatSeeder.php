<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Seat;
use Carbon\Carbon;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing seats
        Seat::truncate();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $seats = [];
        $timestamp = Carbon::now();

        // Define the actual hall structure based on user specifications
        // 4 floors with 2 blocks each (Back and Front)
        $floorStructure = [
            1 => [ // Floor 1
                'Back' => [102, 103, 104, 106, 107, 108, 109, 110, 112, 113, 114],
                'Front' => [505, 507, 508, 509, 510, 511, 512],
            ],
            2 => [ // Floor 2
                'Back' => [201, 202, 203, 205, 206, 207, 208, 209, 211, 212, 213, 214],
                'Front' => [601, 602, 603, 604, 605, 607, 608, 609, 610, 611, 612],
            ],
            3 => [ // Floor 3
                'Back' => [301, 302, 303, 305, 306, 307, 308, 309, 311, 312, 313, 314],
                'Front' => [701, 702, 703, 704, 705, 707, 708, 709, 710, 711, 712],
            ],
            4 => [ // Floor 4
                'Back' => [401, 402, 403, 405, 406, 407, 408, 409, 411, 412, 413, 414],
                'Front' => [801, 802, 803, 804, 805, 807, 808, 810, 811, 812],
            ],
        ];

        // Create seats for each floor and block
        foreach ($floorStructure as $floorNumber => $blocks) {
            foreach ($blocks as $blockName => $rooms) {
                foreach ($rooms as $roomNumber) {
                    // Each room has 5 seats (A, B, C, D, Fifth)
                    for ($seatInRoom = 1; $seatInRoom <= 5; $seatInRoom++) {
                        // All seats will be vacant (available) by default
                        $status = 'vacant';
                        
                        // Convert seat number to letter (1=A, 2=B, 3=C, 4=D, 5=Fifth)
                        if ($seatInRoom == 5) {
                            $bedLetter = 'Fifth';
                        } else {
                            $bedLetter = chr(64 + $seatInRoom); // A, B, C, D
                        }
                        
                        $seats[] = [
                            'floor' => $floorNumber,
                            'block' => $blockName,
                            'seat_number' => $roomNumber . '-' . $bedLetter,
                            'room_number' => (string)$roomNumber,
                            'bed_number' => $bedLetter,
                            'status' => $status,
                            'last_updated' => $timestamp,
                            'created_at' => $timestamp,
                            'updated_at' => $timestamp,
                        ];
                    }
                }
            }
        }

        // Insert all seats in chunks for better performance
        collect($seats)->chunk(100)->each(function ($chunk) {
            Seat::insert($chunk->toArray());
        });

        $this->command->info('Created ' . count($seats) . ' seats across 4 floors and 2 blocks (Back and Front) with 5 seats per room - All seats are Available by default');
    }
}
