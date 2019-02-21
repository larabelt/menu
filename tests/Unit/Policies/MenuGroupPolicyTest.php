<?php namespace Tests\Belt\Menu\Unit\Policies;

use Belt\Core\Tests;
use Belt\Menu\Policies\MenuGroupPolicy;

class MenuGroupPolicyTest extends Tests\BeltTestCase
{

    use Tests\CommonMocks;

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