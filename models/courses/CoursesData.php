<?php

/**
 * 
 * Data do dashboard
 * 
 * @author Emprezaz
 * 
 **/

class CoursesData
{

    private $pdoQuery;
    private $userSession;

    public function __construct()
    {

        $this->pdoQuery = new PDOQuery;
        $this->userSession = new UserSession;
    }

    public function getAllCourses()
    {
        $courses = $this->pdoQuery->fetchAll("SELECT * FROM courses");

        return $courses;
    }

    public function getScore($id)
    {
        $score = $this->pdoQuery->fetch("SELECT score FROM courses WHERE id = :id", array(
            ':id' => $id,
        ));
      
        return $score;
    }

    public function getLevel($id)
    {
        $score = $this->pdoQuery->fetch("SELECT level FROM courses WHERE id = :id", array(
            ':id' => $id,
        ));
      
        return $score;
    }


}
