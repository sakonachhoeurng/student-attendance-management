<?php

namespace AttedanceManagement\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AttedanceManagement\UserBundle\Entity\Student;
use AttedanceManagement\UserBundle\Entity\SubjectGroup;

/**
 * Attendance
 *
 * @ORM\Table(name="attendance")
 * @ORM\Entity(repositoryClass="AttedanceManagement\UserBundle\Repository\AttendanceRepository")
 */
class Attendance
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="absentDate", type="datetime")
     */
    private $absentDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="sessionOne", type="boolean")
     */
    private $sessionOne;

    /**
     * @var bool
     *
     * @ORM\Column(name="sessionTwo", type="boolean")
     */
    private $sessionTwo;

    /**
     * @var Student
     *
     * @ORM\JoinColumn(nullable=true)
     * @ORM\ManyToOne(
     *      targetEntity="AttedanceManagement\UserBundle\Entity\Student",
     *      inversedBy="attendances",
     *      fetch="EAGER"
     * )
     */
    private $student;

    /**
     * @var SubjectGroup
     *
     * @ORM\JoinColumn(nullable=true)
     * @ORM\ManyToOne(
     *      targetEntity="AttedanceManagement\UserBundle\Entity\SubjectGroup",
     *      inversedBy="attendances",
     *      fetch="EAGER"
     * )
     */
    private $subjectGroup;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set absentDate
     *
     * @param \DateTime $absentDate
     *
     * @return Attendance
     */
    public function setAbsentDate($absentDate)
    {
        $this->absentDate = $absentDate;

        return $this;
    }

    /**
     * Get absentDate
     *
     * @return \DateTime
     */
    public function getAbsentDate()
    {
        return $this->absentDate;
    }

    /**
     * Set sessionOne
     *
     * @param boolean $sessionOne
     *
     * @return Attendance
     */
    public function setSessionOne($sessionOne)
    {
        $this->sessionOne = $sessionOne;

        return $this;
    }

    /**
     * Get sessionOne
     *
     * @return bool
     */
    public function isAbsentSessionOne()
    {
        return $this->sessionOne;
    }

    /**
     * Set sessionTwo
     *
     * @param boolean $sessionTwo
     *
     * @return Attendance
     */
    public function setSessionTwo($sessionTwo)
    {
        $this->sessionTwo = $sessionTwo;

        return $this;
    }

    /**
     * Get sessionTwo
     *
     * @return bool
     */
    public function isAbsentSessionTwo()
    {
        return $this->sessionTwo;
    }

    /**
     * Set Student.
     *
     * @param Student $student
     *
     * @return Attendance
     */
    public function setStudent(Student $student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student.
     *
     * @return Student
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Get course.
     *
     * @return SubjectGroup
     */
    public function getSubjectGroup()
    {
        return $this->subjectGroup;
    }

    /**
     * Set SubjectGroup.
     *
     * @param SubjectGroup $SubjectGroup
     *
     * @return Attendance
     */
    public function setSubjectGroup(SubjectGroup $subjectGroup)
    {
        $this->subjectGroup = $subjectGroup;

        return $this;
    }
}

