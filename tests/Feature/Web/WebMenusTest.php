<?php namespace Tests\Belt\Menu\Feature\Web;

use Tests\Belt\Core;

class WebMenusTest extends \Tests\Belt\Core\BeltTestCase
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