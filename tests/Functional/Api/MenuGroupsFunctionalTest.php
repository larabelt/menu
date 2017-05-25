<?php

use Belt\Core\Testing;

class MenuGroupsFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/menu-groups');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/menu-groups', [
            'name' => 'test',
            'body' => 'test',
        ]);
        $response->assertStatus(201);
        $menuGroupID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/menu-groups/$menuGroupID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/menu-groups/$menuGroupID", ['name' => 'updated']);
        $response = $this->json('GET', "/api/v1/menu-groups/$menuGroupID");
        $response->assertJson(['name' => 'updated']);

        # delete
        $response = $this->json('DELETE', "/api/v1/menu-groups/$menuGroupID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/menu-groups/$menuGroupID");
        $response->assertStatus(404);
    }

}