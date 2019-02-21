<?php namespace Tests\Belt\Menu\Feature\Web;

use Belt\Core\Tests;

class WebMenusTest extends Tests\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # show
        $response = $this->json('GET', "/menus/1");
        $response->assertStatus(200);

    }

}