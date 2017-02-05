<?php

namespace AttedanceManagement\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AttedanceManagement\UserBundle\Entity\Subject;
use AttedanceManagement\UserBundle\Entity\User;
use AttedanceManagement\UserBundle\Entity\ClassGroup;

/**
 * SubjectGroup
 *
 * @ORM\Table(name="subject_group")
 * @ORM\Entity(repositoryClass="AttedanceManagement\UserBundle\Repository\SubjectGroupRepository")
 */
class SubjectGroup
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
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime")
     */
    private $endDate;

    /**
     * The subject that assign to group
     *
     * @var Subject
     *
     * @ORM\JoinColumn(nullable=true)
     * @ORM\ManyToOne(
     *      targetEntity="AttedanceManagement\UserBundle\Entity\Subject",
     *      inversedBy="subjectGroups",
     *      fetch="EAGER"
     * )
     */
    private $subject;

    /**
     * The subject that assign to teacher
     *
     * @var User
     *
     * @ORM\JoinColumn(nullable=true)
     * @ORM\ManyToOne(
     *      targetEntity="AttedanceManagement\UserBundle\Entity\User",
     *      inversedBy="subjectGroups",
     *      fetch="EAGER"
     * )
     */
    private $user;

    /**
     * The subject that assign to group
     *
     * @var ClassGroup
     *
     * @ORM\JoinColumn(nullable=true)
     * @ORM\ManyToOne(
     *      targetEntity="AttedanceManagement\UserBundle\Entity\ClassGroup",
     *      inversedBy="subjectGroups",
     *      fetch="EAGER"
     * )
     */
    private $classGroup;


     /**
     * @var Attendance[]
     *
     * @ORM\OneToMany(
     *     targetEntity="AttedanceManagement\UserBundle\Entity\Attendance",
     *     mappedBy="subjectGroup"
     * )
     */
    private $attendances;

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
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return SubjectGroup
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return SubjectGroup
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

     /**
     * @return subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param Subject $subject
     *
     * @return SubjectGroup
     */
    public function setSubject(Subject $subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return SubjectGroup
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return ClassGroup
     */
    public function getClassGroup()
    {
        return $this->classGroup;
    }

    /**
     * @param ClassGroup $classGroup
     *
     * @return SubjectGroup
     */
    public function setClassGroup(ClassGroup $classGroup)
    {
        $this->classGroup = $classGroup;

        return $this;
    }
}

