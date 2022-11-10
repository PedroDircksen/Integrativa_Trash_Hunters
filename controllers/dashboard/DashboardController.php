<?php

/**
 * 
 * Controller do dashboard
 * 
 * @author Emprezaz
 * 
 **/

class DashboardController extends Controller
{
    public function home()
    {
        if ($this->helpers['AdmSession']->has()) {
            $this->setLayout(
                'dashboard/shared/layout.php',
                'Dashboard - Trash Hunters',
                array(
                    'assets/libs/bootstrap/css/bootstrap.min.css',
                    'assets/libs/fontawesome-6.0/css/all.min.css',
                    'assets/css/fonts.css',
                    'assets/css/dashboard/template.css',
                    'assets/css/dashboard/style.css',
                ),
                array(
                    'assets/libs/jquery/jquery.min.js',
                    'assets/libs/jquery/jquery.mask.min.js',
                    'assets/libs/jquery/jquery.maskMoney.min.js',
                    'assets/libs/sweetalert/dist/sweetalert2.all.min.js',
                    'assets/js/helpers/helpers.js',
                )
            );
            $this->view('dashboard/home/index.php');
        } else {
            header('LOCATION: ' . $this->helpers['URLHelper']->getURL() . '/dashboard/login');
        }
    }

    public function courses()
    {
        if ($this->helpers['AdmSession']->has()) {
            $coursesData = new CoursesData;
            $courses = $coursesData->getAllCourses();
            $this->setLayout(
                'dashboard/shared/layout.php',
                'Cursos - Trash Hunters',
                array(
                    'assets/libs/bootstrap/css/bootstrap.min.css',
                    'assets/libs/fontawesome-6.0/css/all.min.css',
                    'assets/css/fonts.css',
                    'assets/css/dashboard/template.css',
                    'assets/css/dashboard/style.css',
                ),
                array(
                    'assets/libs/jquery/jquery.min.js',
                    'assets/libs/sweetalert2/dist/sweetalert2.all.min.js',
                    'assets/js/helpers/helpers.js',
                    'assets/js/dashboard/courses.js',
                )
            );
            $this->view('dashboard/courses/index.php',array(
                'courses' => $courses,
            ));
        } else {
            header('LOCATION: ' . $this->helpers['URLHelper']->getURL() . '/dashboard/login');
        }
    }

    public function users()
    {
        if ($this->helpers['AdmSession']->has()) {
            $coursesData = new CoursesData;
            $userData = new UserData;
            $courses = $coursesData->getAllCourses();
            $users = $userData->getAllUsers();

            $this->setLayout(
                'dashboard/shared/layout.php',
                'Cursos - Trash Hunters',
                array(
                    'assets/libs/bootstrap/css/bootstrap.min.css',
                    'assets/libs/fontawesome-6.0/css/all.min.css',
                    'assets/css/fonts.css',
                    'assets/css/dashboard/template.css',
                    'assets/css/dashboard/style.css',
                ),
                array(
                    'assets/libs/jquery/jquery.min.js',
                    'assets/libs/sweetalert2/dist/sweetalert2.all.min.js',
                    'assets/js/helpers/helpers.js',
                    'assets/js/dashboard/courses.js',
                )
            );
            $this->view('dashboard/users/index.php',array(
                'courses' => $courses,
                'users'   => $users,
            ));
        } else {
            header('LOCATION: ' . $this->helpers['URLHelper']->getURL() . '/dashboard/login');
        }
    }


    
    public function saveCourse()
    {
        if ($this->helpers['AdmSession']->has()) {
            $id             = isset($_POST['id']) ? addslashes($_POST['id']) : NULL;
            $name           = isset($_POST['name']) ? addslashes($_POST['name']) : NULL;
            $name = strtolower(strtr(utf8_decode($name), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'));
            $coursesCrud = new CoursesCrud;
            $result = $coursesCrud->saveCourse($id ,$name);
            $error = "";

            echo json_encode(array(
                'result' => $result,
                'error'  => $error,
            ));
        } else {
            echo json_encode(array(
                'result' => "",
                'error'  => "unlogged"
            ));
            header('LOCATION: ' . $this->helpers['URLHelper']->getURL() . '/login');

        }
    }

    public function addPoints()
    {
        if ($this->helpers['AdmSession']->has()) {
            $id             = isset($_POST['id']) ? addslashes($_POST['id']) : NULL;
            $points         = isset($_POST['points']) ? $_POST['points'] : NULL;

            $coursesData = new CoursesData;
            $currentScore = $coursesData->getScore($id);
            $score = $currentScore['score'] + $points;
            $coursesCrud = new CoursesCrud;
            $result = $coursesCrud->addPoints($id , $score);
            $error = "";

            echo json_encode(array(
                'result' => $result,
                'error'  => $error,
            ));
        } else {
            echo json_encode(array(
                'result' => "",
                'error'  => "unlogged"
            ));
            header('LOCATION: ' . $this->helpers['URLHelper']->getURL() . '/login');

        }
    }

    public function passLevel()
    {
        if ($this->helpers['AdmSession']->has()) {
            $id             = isset($_POST['id']) ? addslashes($_POST['id']) : NULL;

            $coursesData = new CoursesData;
            $currentLevel = $coursesData->getLevel($id);
            $level = $currentLevel['level'] + 1;
            $coursesCrud = new CoursesCrud;
            $result = $coursesCrud->passLevel($id , $level);
            $error = "";

            echo json_encode(array(
                'result' => $result,
                'error'  => $error,
            ));
        } else {
            echo json_encode(array(
                'result' => "",
                'error'  => "unlogged"
            ));
            header('LOCATION: ' . $this->helpers['URLHelper']->getURL() . '/login');

        }
    }

    public function deleteCourse()
    {
        if ($this->helpers['AdmSession']->has()) {
            $id             = isset($_POST['id']) ? $_POST['id'] : NULL;
            $coursesCrud = new CoursesCrud;
            $result = $coursesCrud->deleteCourse($id);
            $error = "";

            echo json_encode(array(
                'result' => $result,
                'error'  => $error,
            ));
        } else {
            echo json_encode(array(
                'result' => "",
                'error'  => "unlogged"
            ));
        }
    }

   
}
