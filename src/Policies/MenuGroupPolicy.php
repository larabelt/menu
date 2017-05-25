<?php

namespace Belt\Menu\Policies;

use Belt\Core\User;
use Belt\Core\Policies\BaseAdminPolicy;
use Belt\Content\Block;

/**
 * Class MenuGroupPolicy
 * @package Belt\Content\Policies
 */
class MenuGroupPolicy extends BaseAdminPolicy
{
    /**
     * Determine whether the user can view the object.
     *
     * @param  User $auth
     * @param  Block $object
     * @return mixed
     */
    public function view(User $auth, $object)
    {
        return true;
    }
}