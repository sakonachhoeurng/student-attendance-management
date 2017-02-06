<?php

namespace AttedanceManagement\UserBundle\Repository;

use AttedanceManagement\UserBundle\Entity\Student;

/**
 * AttendanceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AttendanceRepository extends \Doctrine\ORM\EntityRepository
{
	/**
     * Count all absent.
     *
     * @param Student $student
     * @param SubjectGroup $group
     *
     * @return array
     */
    public function countAbsentByStudentAction(Student $student, $subjectGroup)
    {
        $qb = $this->createQueryBuilder('a')
            ->select('COUNT(a.id) as totalAbsent')
            ->where('a.student = :student')
            ->setParameter('student', $student);

        if (!empty($subjectGroup)) {
        	$qb->andWhere('a.subjectGroup = :subjectGroup')
        		->setParameter('subjectGroup', $subjectGroup);
        }

        return $qb->getQuery()
            ->getArrayResult();
    }
}
