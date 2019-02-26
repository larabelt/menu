<?php namespace Tests\Belt\Menu\Unit\Policies;

use Tests\Belt\Core;
use Belt\Menu\Policies\MenuGroupPolicy;

class MenuGroupPolicyTest extends \Tests\Belt\Core\BeltTestCase
{

    use \Tests\Belt\Core\Base\CommonMocks;

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