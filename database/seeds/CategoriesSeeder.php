<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Category::class)->times(10)->create();

        DB::table('categories')->where('id', 1)->update(['is_parent_category' => true]);
            DB::table('categories')->where('id', 2)->update(['parent_category_id' => 1]);

        DB::table('categories')->where('id', 3)->update(['is_parent_category' => true]);
            DB::table('categories')->where('id', 4)->update(['parent_category_id' => 3]);
            DB::table('categories')->where('id', 5)->update(['parent_category_id' => 3]);

        DB::table('categories')->where('id', 6)->update(['is_parent_category' => true]);
            DB::table('categories')->where('id', 7)->update(['is_parent_category' => true,'parent_category_id' => 6]);
                DB::table('categories')->where('id', 8)->update(['is_parent_category' => true,'parent_category_id' => 7]);
                    DB::table('categories')->where('id', 9)->update(['parent_category_id' => 8]);
            DB::table('categories')->where('id', 10)->update(['parent_category_id' => 6]);



    }
}
