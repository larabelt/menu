<?php

use Belt\Core\Testing;

class WebMenusFunctionalTest extends Testing\BeltTestCase
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