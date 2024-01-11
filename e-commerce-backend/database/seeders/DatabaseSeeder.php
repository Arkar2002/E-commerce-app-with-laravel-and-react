<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{

    protected $categories = [
        ["title" => "phone", "image" => "category.jpeg",],
        ["title" => "laptop", "image" => "category.jpeg",],
        ["title" => "tv", "image" => "category.jpeg",],
        ["title" => "speaker", "image" => "category.jpeg",],
        ["title" => "powerbank", "image" => "category.jpeg",],
    ];

    protected $brands = [
        ["title" => "Apple", "image" => "brand.png",],
        ["title" => "Asus", "image" => "brand.png",],
        ["title" => "Samsung", "image" => "brand.png",],
        ["title" => "Mi", "image" => "brand.png",],
        ["title" => "Huawei", "image" => "brand.png",],
        ["title" => "Dell", "image" => "brand.png",],
        ["title" => "Acer", "image" => "brand.png",],
        ["title" => "Lenovo", "image" => "brand.png",],
    ];

    protected $colors = [
        ["title" => "Black",],
        ["title" => "White",],
        ["title" => "Grey",],
        ["title" => "Silver",],
        ["title" => "Pink",],
    ];

    protected $suppliers = [
        ["name" => "John Doe",],
        ["name" => "Jonas",],
        ["name" => "Emma",],
        ["name" => "Leon",],
        ["name" => "Jill",],
    ];

    protected $permissions = [
        ["name" => "view", "guard_name" => "web"],
        ["name" => "create", "guard_name" => "web"],
        ["name" => "update", "guard_name" => "web"],
        ["name" => "delete", "guard_name" => "web"],
        ["name" => "view_role", "guard_name" => "web"],
        ["name" => "create_role", "guard_name" => "web"],
        ["name" => "update_role", "guard_name" => "web"],
        ["name" => "delete_role", "guard_name" => "web"],
        ["name" => "view_employee", "guard_name" => "web"],
        ["name" => "create_employee", "guard_name" => "web"],
        ["name" => "update_employee", "guard_name" => "web"],
        ["name" => "delete_employee", "guard_name" => "web"],
        ["name" => "view_permission", "guard_name" => "web"],
        ["name" => "create_permission", "guard_name" => "web"],
        ["name" => "update_permission", "guard_name" => "web"],
        ["name" => "delete_permission", "guard_name" => "web"],
    ];

    protected $roles = [
        ["name" => "HR", "guard_name" => "web"],
        ["name" => "Manager", "guard_name" => "web"],
        ["name" => "Employee", "guard_name" => "web"],
    ];

    protected $product_color = [1, 2, 3, 4, 5];
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $products = [
            ["name" => "Iphone-14", "image" => "iphone.jpg", "category_id" => 1, "brand_id" => 1, "supplier_id" => 1, "qty" => 30, "buy_price" => 3000000, "sale_price" => 4000000, "discount_price" => 50000, "description" => "iphone 14 pro", "created_at" => Carbon::parse("Now -1 days")],

            ["name" => "ASUS Laptop Zenbook 14 OLED UX3402VA 14.0\" 2.8K 90Hz Touchscreen OLED Laptop (Intel i5-1340P, 16GB RAM, 512GB SSD, Windows 11) Intel EVO Certified", "image" => "asus.jpg", "category_id" => 2, "brand_id" => 2, "supplier_id" => 2, "qty" => 10, "buy_price" => 2100000, "sale_price" => 2500000, "discount_price" => 0, "description" => "Powered by Intel's latest 13th Generation i5-1340P 12 core/16 thread Processor (4.6GHz) 14.0-inch 2.8K OLED 90Hz 400nits Touchscreen 16GB DDR5 RAM paired with 512GB PCIe SSD Intel EVO Certified, for ultra-reliable,super speedy performance Intel EVO laptops are built for multitasking, these powerful laptops feature high performing Intel Core processors - delivering superior performance where you need it most", "created_at" => Carbon::parse("Now -2 days")],

            ["name" => "Samsung 55″ Smart Curved 4K Q-LED TV QA55Q7CAMK", "image" => "samsung.jpeg", "category_id" => 3, "brand_id" => 3, "supplier_id" => 3, "qty" => 20, "buy_price" => 2000000, "sale_price" => 2400000, "discount_price" => 10000, "description" => "<i>Samsung Tv</i>", "created_at" => Carbon::parse("Now -3 days")],

            ["name" => "Xiaomi Smart Speaker", "image" => "mi.jpg", "category_id" => 4, "brand_id" => 4, "supplier_id" => 4, "qty" => 50, "buy_price" => 80000, "sale_price" => 155000, "discount_price" => 5000, "description" => "Loud and clear & enjoy the best beep with xiaomi smart speaker", "created_at" => Carbon::parse("Now -4 days")],
        ];

        Permission::insert($this->permissions);

        Role::insert($this->roles);

        Role::find(1)->givePermissionTo([
            "view", "create", "update", "delete", "view_role", "create_role", "update_role", "delete_role", "view_permission", "create_permission", "update_permission", "delete_permission", "view_employee", "create_employee", "update_employee", "delete_employee",
        ]);

        Role::find(2)->givePermissionTo([
            "view", "create", "update", "delete", "view_employee",
        ]);

        Role::find(3)->givePermissionTo([
            "view"
        ]);

        Category::insert($this->categories);

        Brand::insert($this->brands);

        Color::insert($this->colors);

        Supplier::insert($this->suppliers);

        foreach ($products as $p) {
            Product::create($p)->color()->sync($this->product_color);
        }

        $user = \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            "password" => Hash::make("admin123@"),
            "phone" => "09771077347",
            "address" => "US",
            "image" => "admin.jpg",
        ]);

        $user->syncRoles(["HR"]);
    }
}
