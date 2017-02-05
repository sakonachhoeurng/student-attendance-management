<?php

namespace AttedanceManagement\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AttedanceManagement\UserBundle\Entity\SubjectGroup;
use Symfony\Component\Form\Form;
use AttedanceManagement\UserBundle\Traits\HasControllerUtils;
use AttedanceManagement\UserBundle\Traits\HasPagination;
use AttedanceManagement\UserBundle\Traits\HasRepositories;

/**
 * @Route("/assign/subject")
 */
class SubjectGroupController extends Controller
{
	use HasControllerUtils;
    use HasPagination;
    use HasRepositories;

    /**
     * @Route("/list", name="list_subject_group")
     * @Template("AttedanceManagementUserBundle:SubjectGroup:list.html.twig")
     */
    public function listAction(Request $request)
    {
        $subjectGroups = $this->getSubjectGroupRepository()
            ->findBy([], ['id' => 'DESC']);

        $subjectGroupsPagination = $this->createPagination(
            $subjectGroups,
            $request
        );

        return ['subjectGroups' => $subjectGroupsPagination];
    }

    /**
     * @Route("/create", name="create_subject_group")
     * @Method({"GET", "POST"})
     * @Template("AttedanceManagementUserBundle:SubjectGroup:create.html.twig")
     *
     * @param Request $request
     *
     * @return array|RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $subjectGroup = new SubjectGroup();
        $form = $this->createForm(
            'AttedanceManagement\UserBundle\Form\SubjectGroupFormType', $subjectGroup
        );

        $form->handleRequest($request);
        if (!$form->isValid()) {
            return ['form' => $form->createView()];
        }


        $this->persistAndFlush($subjectGroup);

        return $this->redirectToRoute(
            'list_subject_group'
        );
    }

    /**
     * @Route("/edit/{subjectGroup}", name="edit_subject_group")
     * @Method({"GET", "POST"})
     * @Template("AttedanceManagementUserBundle:SubjectGroup:edit.html.twig")
     *
     * @param Request  $request
     * @param SubjectGroup $subjectGroup
     */
    public function editAction(Request $request, SubjectGroup $subjectGroup)
    {
        $form = $this->createForm(
            'AttedanceManagement\UserBundle\Form\SubjectGroupFormType', $subjectGroup
        );

        $form->handleRequest($request);
        if (!$form->isValid()) {
            return ['form' => $form->createView()];
        }


        $this->persistAndFlush($subjectGroup);

        return $this->redirectToRoute(
            'list_subject_group'
        );
    }

    /**
     * @Route("/delete/{subjectGroup}", name="delete_subject_group")
     * @Template("AttedanceManagementUserBundle:SubjectGroup:delete.html.twig")
     *
     * @param SubjectGroup $subjectGroup
     */
    public function deleteAction(SubjectGroup $subjectGroup)
    {
        $this->removeAndFlush($subjectGroup);

        return $this->redirectToRoute(
            'list_subject_group'
        );
    }
}
