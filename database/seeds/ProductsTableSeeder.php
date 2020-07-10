<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::firstOrNew(['code' => 'JRCP']);
        if (!$product->exists) {
            $product->fill([
                'name' => 'Jeera Crisps',
                'tax_rate' => 18
            ])->save();
            $product->variations()->createMany([
                [
                    'weight' => 30,
                    'unit_price' => [
                        'partner' => 8,
                        'retailer' => 8.80,
                        'customer' => 10
                    ],
                    'box_price' => [
                        'partner' => 160,
                        'retailer' => 176,
                        'customer' => 200
                    ],
                    'box_quantity' => 20
                ],
                [
                    'weight' => 100,
                    'unit_price' => [
                        'partner' => 23.80,
                        'retailer' => 27,
                        'customer' => 30
                    ],
                    'box_price' => [
                        'partner' => 476,
                        'retailer' => 540,
                        'customer' => 600
                    ],
                    'box_quantity' => 20
                ]
            ]);
        }

        $product = Product::firstOrNew(['code' => 'NTLT']);
        if (!$product->exists) {
            $product->fill([
                'name' => 'Nut Lite',
                'tax_rate' => 12
            ])->save();
            $product->variations()->createMany([
                [
                    'weight' => 25,
                    'unit_price' => [
                        'partner' => 8,
                        'retailer' => 8.80,
                        'customer' => 10
                    ],
                    'box_price' => [
                        'partner' => 160,
                        'retailer' => 176,
                        'customer' => 200
                    ],
                    'box_quantity' => 20
                ],
                [
                    'weight' => 80,
                    'unit_price' => [
                        'partner' => 23.80,
                        'retailer' => 27,
                        'customer' => 30
                    ],
                    'box_price' => [
                        'partner' => 476,
                        'retailer' => 540,
                        'customer' => 600
                    ],
                    'box_quantity' => 20
                ]
            ]);
        }

        $product = Product::firstOrNew(['code' => 'CHMF']);
        if (!$product->exists) {
            $product->fill([
                'name' => 'Chocochip Muffin',
                'tax_rate' => 18
            ])->save();
            $product->variations()->createMany([
                [
                    'weight' => 25,
                    'unit_price' => [
                        'partner' => 3.80,
                        'retailer' => 4.25,
                        'customer' => 5
                    ],
                    'box_price' => [
                        'partner' => 76,
                        'retailer' => 85,
                        'customer' => 100
                    ],
                    'box_quantity' => 20
                ],
                [
                    'weight' => 35,
                    'unit_price' => [
                        'partner' => 7.65,
                        'retailer' => 8.50,
                        'customer' => 10
                    ],
                    'box_price' => [
                        'partner' => 153,
                        'retailer' => 170,
                        'customer' => 200
                    ],
                    'box_quantity' => 20
                ]
            ]);
        }

        $product = Product::firstOrNew(['code' => 'CCEB']);
        if (!$product->exists) {
            $product->fill([
                'name' => 'Choco Energy Bites',
                'tax_rate' => 18
            ])->save();
            $product->variations()->createMany([
                [
                    'weight' => 15,
                    'unit_price' => [
                        'partner' => 7.65,
                        'retailer' => 8.60,
                        'customer' => 10
                    ],
                    'box_price' => [
                        'partner' => 153,
                        'retailer' => 172,
                        'customer' => 200
                    ],
                    'box_quantity' => 20
                ]
            ]);
        }

        $product = Product::firstOrNew(['code' => 'CLEB']);
        if (!$product->exists) {
            $product->fill([
                'name' => 'Classic Energy Bites',
                'code' => 'CLEB',
                'tax_rate' => 18
            ])->save();
            $product->variations()->createMany([
                [
                    'weight' => 15,
                    'unit_price' => [
                        'partner' => 3.90,
                        'retailer' => 4.30,
                        'customer' => 5
                    ],
                    'box_price' => [
                        'partner' => 78,
                        'retailer' => 86,
                        'customer' => 100
                    ],
                    'box_quantity' => 20
                ],
            ]);
        }
    }
}
