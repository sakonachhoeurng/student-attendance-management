<?php

namespace AttedanceManagement\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AttedanceManagement\UserBundle\Entity\Student;
use Symfony\Component\Form\Form;
use AttedanceManagement\UserBundle\Traits\HasControllerUtils;
use AttedanceManagement\UserBundle\Traits\HasPagination;
use AttedanceManagement\UserBundle\Traits\HasRepositories;

/**
 * @Route("/attendance")
 */
class AttendanceController extends Controller
{
	use HasControllerUtils;
    use HasPagination;
    use HasRepositories;

    /**
     * @Route("/list", name="list_attendance")
     * @Template("AttedanceManagementUserBundle:Attendance:list.html.twig")
     */
    public function listAction(Request $request)
    {
        $students = $this->getStudentRepository()
            ->findBy([], ['id' => 'DESC']);

        $studentsPagination = $this->createPagination(
            $students,
            $request
        );

        return ['students' => $studentsPagination];
    }
}
