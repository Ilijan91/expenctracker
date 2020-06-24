<?php

use App\User;
use App\Category;
use App\Transaction;
use App\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Transaction::truncate();
        Vendor::truncate();
        DB::table('category_vendor')->truncate();
        DB::table('category_user')->truncate();

        $userQuantity= 1000;
        $categoryQuantity= 30;
        $transactionsQuantity= 1000;
        $vendorQuantity= 1000;

        User::flushEventListeners();// do not use event to send email

        factory(Category::class, $categoryQuantity)->create();
        factory(User::class, $userQuantity)->create()->each(
            function($user){
                $categories= Category::all()->random(mt_rand(1, 5))->pluck('id');

                $user->categories()->attach($categories);
            });
        factory(Vendor::class, $vendorQuantity)->create()->each(
            function($vendor){
                $categories= Category::all()->random(mt_rand(1, 5))->pluck('id');

                $vendor->categories()->attach($categories);
            });

        factory(Transaction::class, $transactionsQuantity)->create();
    }
}
