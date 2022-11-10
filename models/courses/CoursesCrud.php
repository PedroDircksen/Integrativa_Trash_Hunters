<?php

/**
 * 
 * Data do dashboard
 * 
 * @author Emprezaz
 * 
 **/

class CoursesCrud
{

    private $pdoQuery;
    private $pdoCrud;
    private $userSession;

    public function __construct()
    {
        $this->environment      = (ENV == 'dev') ? 'sandbox.' : '';
        $this->pdoQuery = new PDOQuery;
        $this->pdoCrud = new PDOCrud;
        $this->userSession = new UserSession;
    }

    public function saveCourse($id = null, $name = null)
    {
        if (!$id) {
            $pdo = array(
                ':name'              => $name,
            );
            $columns = 'name';
            $value    = ':name';

            $course = $this->pdoCrud->insert('courses', $columns, $value, $pdo);

        } else {
            $pdo = array(
                ':id'                => $id,
                ':name'              => $name,
            );
            $values = "name = :name";
            $clausule = "WHERE id = :id";

            $course = $this->pdoCrud->update('courses', $values, $clausule, $pdo);
        }

        return $course;
    }

    public function addPoints($id, $score)
    {       
        $pdo = array(
            ':id'                => $id,
            ':score'            => $score,
        );
        $values = "score = :score";
        $clausule = "WHERE id = :id";

        $course = $this->pdoCrud->update('courses', $values, $clausule, $pdo);
    

        return $course;
    }

    public function passLevel($id, $level)
    {       
        $pdo = array(
            ':id'               => $id,
            ':levelnumber'            => $level,
        );
        $values = "level = :levelnumber";
        $clausule = "WHERE id = :id";

        $course = $this->pdoCrud->update('courses', $values, $clausule, $pdo);
    

        return $course;
    }

    public function deleteCourse($id)
    {      
        $course = $this->pdoCrud->delete('courses', $id);

        return $course;
    }

    
}
