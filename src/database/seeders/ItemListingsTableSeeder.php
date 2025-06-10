<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ItemListing;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ItemListingsTableSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('item_listings')->insert([
            [
                'user_id'       => 1,
                'condition'  => 0,
                'item_name'     => '腕時計',
                'brand_name'    => null,
                'description'   => 'スタイリッシュなデザインのメンズ腕時計',
                'price'         => 15000,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'user_id'       => 1,
                'condition'  => 1,
                'item_name'     => 'HDD',
                'brand_name'    => null,
                'description'   => '高速で信頼性の高いハードディスク',
                'price'         => 5000,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'user_id'       => 1,
                'condition'  => 2,
                'item_name'     => '玉ねぎ3束',
                'brand_name'    => null,
                'description'   => '新鮮な玉ねぎ3束のセット',
                'price'         => 300,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'user_id'       => 1,
                'condition'  => 3,
                'item_name'     => '革靴',
                'brand_name'    => null,
                'description'   => 'クラシックなデザインの革靴',
                'price'         => 4000,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'user_id'       => 1,
                'condition'  => 0,
                'item_name'     => 'ノートPC',
                'brand_name'    => null,
                'description'   => '高性能なノートパソコン',
                'price'         => 45000,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'user_id'       => 1,
                'condition'  => 1,
                'item_name'     => 'マイク',
                'brand_name'    => null,
                'description'   => '高音質のレコーディング用マイク',
                'price'         => 8000,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'user_id'       => 1,
                'condition'  => 2,
                'item_name'     => 'ショルダーバッグ',
                'brand_name'    => null,
                'description'   => 'おしゃれなショルダーバッグ',
                'price'         => 3500,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'user_id'       => 1,
                'condition'  => 3,
                'item_name'     => 'タンブラー',
                'brand_name'    => null,
                'description'   => '使いやすいタンブラー',
                'price'         => 500,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'user_id'       => 1,
                'condition'  => 0,
                'item_name'     => 'コーヒーミル',
                'brand_name'    => null,
                'description'   => '手動のコーヒーミル',
                'price'         => 4000,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'user_id'       => 1,
                'condition'  => 1,
                'item_name'     => 'メイクセット',
                'brand_name'    => null,
                'description'   => '便利なメイクアップセット',
                'price'         => 2500,
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
        ]);

        DB::table('category_item_listing')->insert([
            ['item_listing_id' => 1, 'category_id' => 1],
            ['item_listing_id' => 1, 'category_id' => 5],

            ['item_listing_id' => 2, 'category_id' => 2],

            ['item_listing_id' => 3, 'category_id' => 10],

            ['item_listing_id' => 4, 'category_id' => 1],
            ['item_listing_id' => 4, 'category_id' => 5],

            ['item_listing_id' => 5, 'category_id' => 2],

            ['item_listing_id' => 6, 'category_id' => 2],
            ['item_listing_id' => 6, 'category_id' => 8],

            ['item_listing_id' => 7, 'category_id' => 1],
            ['item_listing_id' => 7, 'category_id' => 4],

            ['item_listing_id' => 8, 'category_id' => 10],
            ['item_listing_id' => 8, 'category_id' => 3],

            ['item_listing_id' => 9, 'category_id' => 10],
            ['item_listing_id' => 9, 'category_id' => 3],

            ['item_listing_id' => 10, 'category_id' => 6],
            ['item_listing_id' => 10, 'category_id' => 4],
        ]);
    }
}