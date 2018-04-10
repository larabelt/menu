<?php

use Illuminate\Database\Seeder;

class BeltMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BeltMenuMenuGroupSeeds::class);
        $this->call(BeltMenuPermissbleSeeds::class);
    }
}
