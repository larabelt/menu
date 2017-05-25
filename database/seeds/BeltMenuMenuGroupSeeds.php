<?php

use Illuminate\Database\Seeder;

use Belt\Menu\MenuGroup;
use Belt\Menu\MenuItem;

class BeltMenuMenuGroupSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(MenuGroup::class, 5)
            ->create()
            ->each(function ($menu) {
                factory(MenuItem::class, 10)->create(['menu_group_id' => $menu->id]);
            });;
    }
}