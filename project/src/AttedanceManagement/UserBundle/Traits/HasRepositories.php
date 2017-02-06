<?php

namespace AttedanceManagement\UserBundle\Traits;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Persistence\ObjectRepository;

trait HasRepositories
{
    /**
     * @return ClassUserRepository|ObjectRepository
     */
    public function getUserRepository()
    {
        return $this->getDoctrine()->getRepository('AttedanceManagementUserBundle:User');
    }

    /**
     * @return ClassGroupRepository|ObjectRepository
     */
    public function getGroupRepository()
    {
        return $this->getDoctrine()->getRepository('AttedanceManagementUserBundle:ClassGroup');
    }

    /**
     * @return ClassStudentRepository|ObjectRepository
     */
    public function getStudentRepository()
    {
        return $this->getDoctrine()->getRepository('AttedanceManagementUserBundle:Student');
    }

    /**
     * @return ClassSubjectRepository|ObjectRepository
     */
    public function getSubjectRepository()
    {
        return $this->getDoctrine()->getRepository('AttedanceManagementUserBundle:Subject');
    }

    /**
     * @return ClassSubjectGroupRepository|ObjectRepository
     */
    public function getSubjectGroupRepository()
    {
        return $this->getDoctrine()->getRepository('AttedanceManagementUserBundle:SubjectGroup');
    }

    /**
     * @return ClassAttendanceRepository|ObjectRepository
     */
    public function getAttendanceRepository()
    {
        return $this->getDoctrine()->getRepository('AttedanceManagementUserBundle:Attendance');
    }


    /**
     * @return Registry
     */
    abstract public function getDoctrine();
}
