<?php

namespace AttedanceManagement\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AttedanceManagement\UserBundle\Entity\ClassGroup;
use Symfony\Component\Form\Form;
use AttedanceManagement\UserBundle\Traits\HasControllerUtils;
use AttedanceManagement\UserBundle\Traits\HasPagination;
use AttedanceManagement\UserBundle\Traits\HasRepositories;

/**
 * @Route("/group")
 */
class GroupController extends Controller
{
	use HasControllerUtils;
    use HasPagination;
    use HasRepositories;

    /**
     * @Route("/list", name="list_group")
     * @Template("AttedanceManagementUserBundle:Group:list.html.twig")
     */
    public function listAction(Request $request)
    {
        $classGroups = $this->getGroupRepository()
            ->findBy([], ['id' => 'ASC']);

        $classGroupsPagination = $this->createPagination(
            $classGroups,
            $request
        );

        return ['classGroups' => $classGroupsPagination];
    }

    /**
     * @Route("/create", name="create_group")
     * @Method({"GET", "POST"})
     * @Template("AttedanceManagementUserBundle:Group:create.html.twig")
     *
     * @param Request $request
     *
     * @return array|RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $classGroup = new ClassGroup();
        $form = $this->createForm(
            'AttedanceManagement\UserBundle\Form\GroupFormType', $classGroup
        );

        $form->handleRequest($request);
        if (!$form->isValid()) {
            return ['form' => $form->createView()];
        }

        $classGroupName = $form->get('name')->getData();

        $classGroupExit = $this->getGroupRepository()
            ->findByName($classGroupName);

        if (!empty($classGroupExit)) {
            $request->getSession()
                ->getFlashBag()
                ->add('success', 'This name already have. Please try a new name!')
            ;

            return ['form' => $form->createView()];
        }

        $this->persistAndFlush($classGroup);

        return $this->redirectToRoute(
            'list_group'
        );
    }

    /**
     * @Route("/edit/{classGroup}", name="edit_group")
     * @Method({"GET", "POST"})
     * @Template("AttedanceManagementUserBundle:Group:edit.html.twig")
     *
     * @param Request  $request
     * @param ClassGroup $classGroup
     */
    public function editAction(Request $request, ClassGroup $classGroup)
    {
        $form = $this->createForm(
            'AttedanceManagement\UserBundle\Form\GroupFormType', $classGroup
        );

        $form->handleRequest($request);
        if (!$form->isValid()) {
            return ['form' => $form->createView()];
        }

        $classGroupName = $form->get('name')->getData();

        $classGroupExit = $this->getGroupRepository()
            ->findByName($classGroupName);

        if (!empty($classGroupExit)) {
            $request->getSession()
                ->getFlashBag()
                ->add('success', 'This name already have. Please try a new name!')
            ;

            return ['form' => $form->createView()];
        }

        $this->persistAndFlush($classGroup);

        return $this->redirectToRoute(
            'list_group'
        );
    }

    /**
     * @Route("/delete/{classGroup}", name="delete_group")
     * @Template("AttedanceManagementUserBundle:Group:delete.html.twig")
     *
     * @param ClassGroup $classGroup
     */
    public function deleteAction(ClassGroup $classGroup)
    {
        $student = $this->getStudentRepository()
            ->findByClassGroup($classGroup);

        if (empty($student)) {
            $this->removeAndFlush($classGroup);
        } else {
            $this->addFlash(
                'notice',
                'Can not delete because student is belong to it!'
            );
        }

        return $this->redirectToRoute(
            'list_group'
        );
    }
}
