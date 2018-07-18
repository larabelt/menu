<?php

use Belt\Core\Testing;

class MenuItemsFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/menu-groups/1/menu-items');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/menu-groups/1/menu-items', [
            'url' => '/test',
        ]);
        $response->assertStatus(201);
        $menuItemID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/menu-groups/1/menu-items/$menuItemID");
        $response->assertStatus(200);
        $response = $this->json('GET', "/api/v1/menu-groups/2/menu-items/$menuItemID");
        $response->assertStatus(404);

        # update
        $this->json('PUT', "/api/v1/menu-groups/1/menu-items/$menuItemID", ['url' => 'updated']);
        $response = $this->json('GET', "/api/v1/menu-groups/1/menu-items/$menuItemID");
        $response->assertJson(['url' => 'updated']);

        # delete
        $response = $this->json('DELETE', "/api/v1/menu-groups/1/menu-items/$menuItemID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/menu-groups/1/menu-items/$menuItemID");
        $response->assertStatus(404);
    }

}