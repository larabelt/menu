<?php

use Belt\Core\Testing;
use Belt\Menu\Policies\MenuGroupPolicy;

class MenuGroupPolicyTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Belt\Menu\Policies\MenuGroupPolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new MenuGroupPolicy();

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}