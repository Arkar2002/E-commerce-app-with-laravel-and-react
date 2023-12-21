<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    protected $categories = [
        ["name" => "phone",],
        ["name" => "laptop",],
        ["name" => "tv",],
        ["name" => "speaker",],
        ["name" => "powerbank",],
    ];

    protected $brands = [
        ["name" => "Apple",],
        ["name" => "Asus",],
        ["name" => "Samsung",],
        ["name" => "Mi",],
        ["name" => "Huawei",],
        ["name" => "Dell",],
        ["name" => "Acer",],
        ["name" => "Lenovo",],
    ];

    protected $colors = [
        ["name" => "Black",],
        ["name" => "White",],
        ["name" => "Grey",],
        ["name" => "Silver",],
        ["name" => "Pink",],
    ];

    protected $suppliers = [
        ["name" => "John Doe",],
        ["name" => "Jonas",],
        ["name" => "Emma",],
        ["name" => "Leon",],
        ["name" => "Jill",],
    ];

    protected $product_color = [1, 2, 3, 4, 5];

    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $products = [
            ["name" => "Iphone-14", "image" => "iphone.jpg", "category_id" => 1, "brand_id" => 1, "supplier_id" => 1, "qty" => 30, "buy_price" => 3000000, "sale_price" => 4000000, "discount_price" => 50000, "description" => "iphone 14 pro", "created_at" => Carbon::parse("Now -1 days")],

            ["name" => "ASUS Laptop Zenbook 14 OLED UX3402VA 14.0\" 2.8K 90Hz Touchscreen OLED Laptop (Intel i5-1340P, 16GB RAM, 512GB SSD, Windows 11) Intel EVO Certified", "image" => "asus.jpg", "category_id" => 2, "brand_id" => 2, "supplier_id" => 2, "qty" => 10, "buy_price" => 2100000, "sale_price" => 2500000, "discount_price" => 0, "description" => "Powered by Intel's latest 13th Generation i5-1340P 12 core/16 thread Processor (4.6GHz) 14.0-inch 2.8K OLED 90Hz 400nits Touchscreen 16GB DDR5 RAM paired with 512GB PCIe SSD Intel EVO Certified, for ultra-reliable,super speedy performance Intel EVO laptops are built for multitasking, these powerful laptops feature high performing Intel Core processors - delivering superior performance where you need it most", "created_at" => Carbon::parse("Now -2 days")],

            ["name" => "Samsung 55″ Smart Curved 4K Q-LED TV QA55Q7CAMK", "image" => "samsung.jpeg", "category_id" => 3, "brand_id" => 3, "supplier_id" => 3, "qty" => 20, "buy_price" => 2000000, "sale_price" => 2400000, "discount_price" => 10000, "description" => "Samsung Tv", "created_at" => Carbon::parse("Now -3 days")],

            ["name" => "Xiaomi Smart Speaker", "image" => "mi.jpg", "category_id" => 4, "brand_id" => 4, "supplier_id" => 4, "qty" => 50, "buy_price" => 80000, "sale_price" => 155000, "discount_price" => 5000, "description" => "Loud and clear & enjoy the best beep with xiaomi smart speaker", "created_at" => Carbon::parse("Now -4 days")],
        ];

        Admin::create([
            "name" => "test",
            "email" => "test@example.com",
            "password" => Hash::make("password"),
            "gender" => "male",
        ]);

        Category::insert($this->categories);

        Brand::insert($this->brands);

        Color::insert($this->colors);

        Supplier::insert($this->suppliers);

        foreach ($products as $p) {
            Product::create($p)->color()->sync($this->product_color);
        }
    }
}
