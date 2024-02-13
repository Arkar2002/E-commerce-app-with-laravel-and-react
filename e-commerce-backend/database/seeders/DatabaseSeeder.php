<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Customer;
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
        ["title" => "Phone", "image" => "category.png",],
        ["title" => "Laptop", "image" => "category.png",],
        ["title" => "Tv", "image" => "category.png",],
        ["title" => "Speaker", "image" => "category.png",],
        ["title" => "Powerbank", "image" => "category.png",],
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
            ["name" => "Iphone-14", "slug" => "iphone", "image" => "testImage.jpg", "category_id" => 1, "brand_id" => 1, "supplier_id" => 1, "qty" => 30, "buy_price" => 3000000, "sale_price" => 4000000, "discount_price" => 50000, "description" => "iphone 14 pro", "created_at" => Carbon::parse("Now -4 days")],

            ["name" => "ASUS Laptop Zenbook 14 OLED", "slug" => "asus laptop", "image" => "testImage.jpg", "category_id" => 2, "brand_id" => 2, "supplier_id" => 2, "qty" => 10, "buy_price" => 2100000, "sale_price" => 2500000, "discount_price" => 0, "description" => "Powered by Intel's latest 13th Generation i5-1340P 12 core/16 thread Processor (4.6GHz) 14.0-inch 2.8K OLED 90Hz 400nits Touchscreen 16GB DDR5 RAM paired with 512GB PCIe SSD Intel EVO Certified, for ultra-reliable,super speedy performance Intel EVO laptops are built for multitasking, these powerful laptops feature high performing Intel Core processors - delivering superior performance where you need it most", "created_at" => Carbon::parse("Now -3 days")],

            ["name" => "Samsung 55″ Smart Curved 4K Q-LED TV", "slug" => "samsung tv", "image" => "testImage.jpg", "category_id" => 3, "brand_id" => 3, "supplier_id" => 3, "qty" => 20, "buy_price" => 2000000, "sale_price" => 2400000, "discount_price" => 10000, "description" => "<i>Samsung Tv</i>", "created_at" => Carbon::parse("Now -2 days")],

            ["name" => "Xiaomi Smart Speaker", "slug" => "xiaomi speaker", "image" => "testImage.jpg", "category_id" => 4, "brand_id" => 4, "supplier_id" => 4, "qty" => 50, "buy_price" => 80000, "sale_price" => 155000, "discount_price" => 5000, "description" => "Loud and clear & enjoy the best beep with xiaomi smart speaker", "created_at" => Carbon::parse("Now -1 days")],

            ["name" => "dummydata", "slug" => "dummy1", "image" => "testImage.jpg", "category_id" => 5, "brand_id" => 5, "supplier_id" => 3, "qty" => 50, "buy_price" => 80000, "sale_price" => 155000, "discount_price" => 5000, "description" => "Loud and clear & enjoy the best beep with xiaomi smart speaker", "created_at" => Carbon::parse("Now")],

            ["name" => "dummydata2", "slug" => "dummy2", "image" => "testImage.jpg", "category_id" => 1, "brand_id" => 1, "supplier_id" => 1, "qty" => 50, "buy_price" => 80000, "sale_price" => 155000, "discount_price" => 5000, "description" => "test", "created_at" => Carbon::parse("Now +1 days")],

            ["name" => "dummydata3", "slug" => "dummy3", "image" => "testImage.jpg", "category_id" => 3, "brand_id" => 3, "supplier_id" => 2, "qty" => 50, "buy_price" => 80000, "sale_price" => 155000, "discount_price" => 5000, "description" => "test", "created_at" => Carbon::parse("Now +2 days")],

            ["name" => "dummydata4", "slug" => "dummy4", "image" => "testImage.jpg", "category_id" => 3, "brand_id" => 3, "supplier_id" => 2, "qty" => 50, "buy_price" => 80000, "sale_price" => 155000, "discount_price" => 5000, "description" => "test", "created_at" => Carbon::parse("Now +3 days")],

            ["name" => "dummydata5", "slug" => "dummy5", "image" => "testImage.jpg", "category_id" => 3, "brand_id" => 3, "supplier_id" => 2, "qty" => 50, "buy_price" => 80000, "sale_price" => 155000, "discount_price" => 5000, "description" => "test", "created_at" => Carbon::parse("Now +5 days")],

            ["name" => "dummydata6", "slug" => "dummy6", "image" => "testImage.jpg", "category_id" => 3, "brand_id" => 3, "supplier_id" => 2, "qty" => 50, "buy_price" => 80000, "sale_price" => 155000, "discount_price" => 5000, "description" => "test", "created_at" => Carbon::parse("Now +6 days")],

            ["name" => "dummydata7", "slug" => "dummy7", "image" => "testImage.jpg", "category_id" => 3, "brand_id" => 3, "supplier_id" => 2, "qty" => 50, "buy_price" => 80000, "sale_price" => 155000, "discount_price" => 5000, "description" => "test", "created_at" => Carbon::parse("Now +7 days")],

            ["name" => "dummydata8", "slug" => "dummy8", "image" => "testImage.jpg", "category_id" => 3, "brand_id" => 3, "supplier_id" => 2, "qty" => 50, "buy_price" => 80000, "sale_price" => 155000, "discount_price" => 5000, "description" => "test", "created_at" => Carbon::parse("Now +8 days")],

            ["name" => "dummydata9", "slug" => "dummy9", "image" => "testImage.jpg", "category_id" => 3, "brand_id" => 3, "supplier_id" => 2, "qty" => 50, "buy_price" => 80000, "sale_price" => 155000, "discount_price" => 5000, "description" => "test", "created_at" => Carbon::parse("Now +9 days")],

            ["name" => "dummydata10", "slug" => "dummy10", "image" => "testImage.jpg", "category_id" => 3, "brand_id" => 3, "supplier_id" => 2, "qty" => 50, "buy_price" => 80000, "sale_price" => 155000, "discount_price" => 5000, "description" => "test", "created_at" => Carbon::parse("Now +10 days")],
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
            "phone" => "0912345678",
            "address" => "US",
            "image" => "admin.jpg",
        ]);

        Customer::create([
            'name' => 'User',
            'email' => 'user@example.com',
            "password" => Hash::make("user123@"),
            "phone" => "09771077347",
            "address" => "US",
            "image" => "admin.jpg",
        ]);

        $user->syncRoles(["HR"]);
    }
}
