<?php

namespace AttedanceManagement\UserBundle\Traits;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Persistence\ObjectRepository;

trait HasRepositories
{
    /**
     * @return ClassGroupRepository|ObjectRepository
     */
    public function getGroupRepository()
    {
        return $this->getDoctrine()->getRepository('AttedanceManagementUserBundle:ClassGroup');
    }

    /**
     * @return StudentRepository|ObjectRepository
     */
    public function getStudentRepository()
    {
        return $this->getDoctrine()->getRepository('AttedanceManagementUserBundle:Student');
    }

    /**
     * @return Registry
     */
    abstract public function getDoctrine();
}
