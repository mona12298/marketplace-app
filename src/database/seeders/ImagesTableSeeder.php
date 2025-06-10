<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImagesTableSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('images')->insert([
            [
                'item_listing_id' => 1,
                'image_url'       => 'items/armani_mens_clock.jpg',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'item_listing_id' => 2,
                'image_url'       => 'items/hdd_hard_disk.jpg',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'item_listing_id' => 3,
                'image_url'       => 'items/onion_bundle_3.jpg',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'item_listing_id' => 4,
                'image_url'       => 'items/leather_shoes.jpg',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'item_listing_id' => 5,
                'image_url'       => 'items/notebook_pc.jpg',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'item_listing_id' => 6,
                'image_url'       => 'items/microphone.jpg',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'item_listing_id' => 7,
                'image_url'       => 'items/shoulder_bag.jpg',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'item_listing_id' => 8,
                'image_url'       => 'items/tumbler.jpg',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'item_listing_id' => 9,
                'image_url'       => 'items/coffee_mill.jpg',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'item_listing_id' => 10,
                'image_url'       => 'items/makeup_set.jpg',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
        ]);
    }
}
