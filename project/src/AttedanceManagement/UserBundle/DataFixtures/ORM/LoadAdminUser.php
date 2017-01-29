<?php

namespace AttedanceManagement\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AttedanceManagement\UserBundle\Entity\User;

class LoadAdminUser implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $objectManager
     */
    public function load(ObjectManager $objectManager)
    {
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setEmail('admin@localhost.com');
        $admin->setName('Administrator');
        $admin->setPhoneNumber('0101010101');
        $admin->setPlainPassword('admin');
        $admin->setRoles(array('ROLE_ADMIN'));
        $admin->setEnabled(true);

        $objectManager->persist($admin);
        $objectManager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
