<?php

namespace AttedanceManagement\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AttedanceManagement\UserBundle\Entity\Subject;
use Symfony\Component\Form\Form;
use AttedanceManagement\UserBundle\Traits\HasControllerUtils;
use AttedanceManagement\UserBundle\Traits\HasPagination;
use AttedanceManagement\UserBundle\Traits\HasRepositories;

/**
 * @Route("/subect")
 */
class SubjectController extends Controller
{
	use HasControllerUtils;
    use HasPagination;
    use HasRepositories;

    /**
     * @Route("/list", name="list_subject")
     * @Template("AttedanceManagementUserBundle:Subject:list.html.twig")
     */
    public function listAction(Request $request)
    {
        $subjects = $this->getSubjectRepository()
            ->findBy([], ['id' => 'DESC']);

        $subjectsPagination = $this->createPagination(
            $subjects,
            $request
        );

        return ['subjects' => $subjectsPagination];
    }

    /**
     * @Route("/create", name="create_subject")
     * @Method({"GET", "POST"})
     * @Template("AttedanceManagementUserBundle:Subject:create.html.twig")
     *
     * @param Request $request
     *
     * @return array|RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $subject = new Subject();
        $form = $this->createForm(
            'AttedanceManagement\UserBundle\Form\SubjectFormType', $subject
        );

        $form->handleRequest($request);
        if (!$form->isValid()) {
            return ['form' => $form->createView()];
        }

        $subjectName = $form->get('name')->getData();

        $subjectExit = $this->getSubjectRepository()
            ->findByName($subjectName);

        if (!empty($subjectExit)) {
            $request->getSession()
                ->getFlashBag()
                ->add('success', 'This subject already have. Please try a new subject!')
            ;

            return ['form' => $form->createView()];
        }

        $this->persistAndFlush($subject);

        return $this->redirectToRoute(
            'list_subject'
        );
    }

    /**
     * @Route("/edit/{subject}", name="edit_subject")
     * @Method({"GET", "POST"})
     * @Template("AttedanceManagementUserBundle:Subject:edit.html.twig")
     *
     * @param Request  $request
     * @param Subject $subject
     */
    public function editAction(Request $request, Subject $subject)
    {
        $form = $this->createForm(
            'AttedanceManagement\UserBundle\Form\SubjectFormType', $subject
        );

        $form->handleRequest($request);
        if (!$form->isValid()) {
            return ['form' => $form->createView()];
        }

        $subjectName = $form->get('name')->getData();

        $subjectExit = $this->getSubjectRepository()
            ->findByName($subjectName);

        if (!empty($subjectExit)) {
            $request->getSession()
                ->getFlashBag()
                ->add('success', 'This subject already have. Please try a new subject!')
            ;

            return ['form' => $form->createView()];
        }

        $this->persistAndFlush($subject);

        return $this->redirectToRoute(
            'list_subject'
        );
    }

    /**
     * @Route("/delete/{subject}", name="delete_subject")
     * @Template("AttedanceManagementUserBundle:Subject:delete.html.twig")
     *
     * @param Subject $subject
     */
    public function deleteAction(Subject $subject)
    {
        // $student = $this->getStudentRepository()
        //     ->findBySubject($subject);

        // if (empty($student)) {
            $this->removeAndFlush($subject);
        // } else {
        //     $this->addFlash(
        //         'notice',
        //         'Can not delete because student is belong to it!'
        //     );
        // }

        return $this->redirectToRoute(
            'list_subject'
        );
    }
}
