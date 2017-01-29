<?php

namespace AttedanceManagement\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AttedanceManagementUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
