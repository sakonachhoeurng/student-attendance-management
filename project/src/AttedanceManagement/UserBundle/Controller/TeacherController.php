<?php

namespace AttedanceManagement\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AttedanceManagement\UserBundle\Entity\User;
use Symfony\Component\Form\Form;
use AttedanceManagement\UserBundle\Traits\HasControllerUtils;
use AttedanceManagement\UserBundle\Traits\HasPagination;
use AttedanceManagement\UserBundle\Traits\HasRepositories;

/**
 * @Route("/teacher")
 */
class TeacherController extends Controller
{
	use HasControllerUtils;
    use HasPagination;
    use HasRepositories;

    /**
     * @Route("/list", name="list_teacher")
     * @Template("AttedanceManagementUserBundle:Teacher:list.html.twig")
     */
    public function listAction(Request $request)
    {
        $teachers = $this->getUserRepository()
            ->findAllTeacher();

        $teachersPagination = $this->createPagination(
            $teachers,
            $request
        );

        return ['teachers' => $teachersPagination];
    }

    /**
     * @Route("/create", name="create_teacher")
     * @Method({"GET", "POST"})
     * @Template("AttedanceManagementUserBundle:Teacher:create.html.twig")
     *
     * @param Request $request
     *
     * @return array|RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $teacher = new User();
        $form = $this->createForm(
            'AttedanceManagement\UserBundle\Form\TeacherFormType', $teacher
        );

        $form->handleRequest($request);
        if (!$form->isValid()) {
            return ['form' => $form->createView()];
        }

        $teacher->setRoles(['ROLE_TEACHER']);
        $teacher->setEnabled(true);
        $this->persistAndFlush($teacher);

        return $this->redirectToRoute(
            'list_teacher'
        );
    }

    /**
     * @Route("/edit/{teacher}", name="edit_teacher")
     * @Method({"GET", "POST"})
     * @Template("AttedanceManagementUserBundle:Teacher:edit.html.twig")
     *
     * @param Request  $request
     * @param User $teacher
     */
    public function editAction(Request $request, User $teacher)
    {
        $form = $this->createForm(
            'AttedanceManagement\UserBundle\Form\TeacherFormType', $teacher
        );

        $form->handleRequest($request);
        if (!$form->isValid()) {
            return ['form' => $form->createView()];
        }

        $teacher->setRoles(['ROLE_TEACHER']);
        $teacher->setEnabled(true);

        $this->persistAndFlush($teacher);

        return $this->redirectToRoute(
            'list_teacher'
        );
    }

    /**
     * @Route("/delete/{teacher}", name="delete_teacher")
     * @Template("AttedanceManagementUserBundle:Teacher:delete.html.twig")
     *
     * @param User $teacher
     */
    public function deleteAction(User $teacher)
    {
        $subjectGroup = $this->getSubjectGroupRepository()
            ->findByUser($teacher);

        if (empty($subjectGroup)) {
            $this->removeAndFlush($classGroup);
        } else {
            $this->addFlash(
                'notice',
                'Can not delete because course is belong to it!'
            );
        }

        return $this->redirectToRoute(
            'list_teacher'
        );
    }
}
