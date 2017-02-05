<?php

namespace AttedanceManagement\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class
 *
 * @ORM\Table(name="class")
 * @ORM\Entity(repositoryClass="AttedanceManagement\UserBundle\Repository\ClassGroupRepository")
 */
class ClassGroup
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

     /**
     * @var Student[]
     *
     * @ORM\OneToMany(
     *     targetEntity="AttedanceManagement\UserBundle\Entity\Student",
     *     mappedBy="classGroup"
     * )
     */
    private $students;

    /**
     * @var SubjectGroup[]
     *
     * @ORM\OneToMany(
     *     targetEntity="AttedanceManagement\UserBundle\Entity\SubjectGroup",
     *     mappedBy="classGroup"
     * )
     */
    private $subjectGroups;



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
     * Set name
     *
     * @param string $name
     *
     * @return Class
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

