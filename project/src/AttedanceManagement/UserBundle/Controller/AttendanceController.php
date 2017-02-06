<?php

namespace AttedanceManagement\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AttedanceManagement\UserBundle\Entity\Attendance;
use AttedanceManagement\UserBundle\Entity\Student;
use Symfony\Component\Form\Form;
use AttedanceManagement\UserBundle\Traits\HasControllerUtils;
use AttedanceManagement\UserBundle\Traits\HasPagination;
use AttedanceManagement\UserBundle\Traits\HasRepositories;
use Symfony\Component\HttpFoundation\JsonResponse;
use DateTime;

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

        $teacher = $this->getUser();
        $form = $this->createForm(
            'AttedanceManagement\UserBundle\Form\AttendanceFilterFormType',
            null,
            ['user' => $teacher]
        );

        $classGroup = null;
        $subject = null;

        $form->handleRequest($request);
        $data = $form->getData();
        if ($form->isValid()) {
            $classGroup = $data['classGroup'];
            $subject = $data['subject'];
        }

        $students = $this->getStudentRepository()->findByFilter(
            $teacher,
            $subject,
            $classGroup
        );

        $studentsPagination = $this->createPagination(
            $students,
            $request
        );

        return [
            'form' => $form->createView(),
            'students' => $studentsPagination
        ];
    }

    /**
     * @Route("/save", name="save_attendance")
     *
     * @return JsonResponse
     */
    public function saveAttendance(Request $request)
    {
        $absentDate = new DateTime($request->request->get('date'));
        $subjectId = $request->request->get('subject');
        $groupId = $request->request->get('class_group');
        $studentId = $request->request->get('student');
        $isSessionOne = $request->request->get('session_one') == 1 ? true : false;
        $isSessionTwo = $request->request->get('session_two')  == 1 ? true : false;
        $subject = $this->getSubjectRepository()->find($subjectId);
        $group = $this->getGroupRepository()->find($groupId);
        $student = $this->getStudentRepository()->find($studentId);

        $subjectGroup = $this->getSubjectGroupRepository()->findBySubjectTeacherAndGroup(
            $this->getUser(),
            $subject,
            $group
        );

        $attendance = new Attendance();
        $attendance->setSubjectGroup($subjectGroup);
        $attendance->setStudent($student);
        $attendance->setSessionOne($isSessionOne);
        $attendance->setSessionTwo($isSessionTwo);
        $attendance->setAbsentDate($absentDate);

        $this->persistAndFlush($attendance);

        return new JsonResponse([
            'msg' => 'ok',
        ]);
    }

     /**
      * Get count absent
      *
      * @Template("AttedanceManagementUserBundle:Attendance:count_absent.html.twig")
      *
      */
    public function countAbsentByStudentAction(
        Student $student,
        $subject,
        $group
    ) {
        $subjectGroup = null;
        if (!empty($subject) && !empty($group)) {
            $subjectGroup = $this->getSubjectGroupRepository()
                ->findBy([
                    'subject' => $this->getSubjectRepository()->find($subject),
                    'classGroup' => $this->getGroupRepository()->find($group),
                    'user' => $this->getUser(),
                ]);
        }

        $absents = $this->getAttendanceRepository()->countAbsentByStudentAction(
            $student,
            $subjectGroup
        );

        return [
            'absents' => $absents
        ];
    }
}
