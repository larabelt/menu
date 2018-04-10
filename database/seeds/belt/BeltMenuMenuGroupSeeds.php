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
        factory(MenuGroup::class, 3)
            ->create()
            ->each(function ($menu) {
                factory(MenuItem::class, 3)->create(['menu_group_id' => $menu->id])
                    ->each(function ($item) {
                        factory(MenuItem::class, 3)->create(['menu_group_id' => $item->menu_group_id, 'parent_id' => $item->id]);
                    });
            });
    }
}