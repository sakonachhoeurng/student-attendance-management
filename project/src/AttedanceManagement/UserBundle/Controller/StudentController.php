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
 * @Route("/student")
 */
class StudentController extends Controller
{
	use HasControllerUtils;
    use HasPagination;
    use HasRepositories;

    /**
     * @Route("/list", name="list_student")
     * @Template("AttedanceManagementUserBundle:Student:list.html.twig")
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

    /**
     * @Route("/create", name="create_student")
     * @Method({"GET", "POST"})
     * @Template("AttedanceManagementUserBundle:Student:create.html.twig")
     *
     * @param Request $request
     *
     * @return array|RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $student = new Student();
        $form = $this->createForm(
            'AttedanceManagement\UserBundle\Form\StudentFormType', $student
        );

        $form->handleRequest($request);
        if (!$form->isValid()) {
            return ['form' => $form->createView()];
        }


        $this->persistAndFlush($student);

        return $this->redirectToRoute(
            'list_student'
        );
    }

    /**
     * @Route("/edit/{student}", name="edit_student")
     * @Method({"GET", "POST"})
     * @Template("AttedanceManagementUserBundle:Student:edit.html.twig")
     *
     * @param Request  $request
     * @param Student $student
     */
    public function editAction(Request $request, Student $student)
    {
        $form = $this->createForm(
            'AttedanceManagement\UserBundle\Form\StudentFormType', $student
        );

        $form->handleRequest($request);
        if (!$form->isValid()) {
            return ['form' => $form->createView()];
        }


        $this->persistAndFlush($student);

        return $this->redirectToRoute(
            'list_student'
        );
    }

    /**
     * @Route("/delete/{student}", name="delete_student")
     * @Template("AttedanceManagementUserBundle:student:delete.html.twig")
     *
     * @param Student $student
     */
    public function deleteAction(Student $student)
    {
        $this->removeAndFlush($student);

        return $this->redirectToRoute(
            'list_student'
        );
    }
}
