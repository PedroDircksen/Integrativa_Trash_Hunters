<?php

/**
 * 
 * Data do dashboard
 * 
 * @author Emprezaz
 * 
 **/

class UserData
{

    private $pdoQuery;
    private $userSession;

    public function __construct()
    {

        $this->pdoQuery = new PDOQuery;
        $this->userSession = new UserSession;
    }

    public function getAllUsers()
    {
        $USERS = $this->pdoQuery->fetchAll("SELECT u.*, s.score as score FROM users u
        left outer join score s on s.users_id = u.id
        ORDER BY u.id
        ");

        return $USERS;
    }


    public function getDataById($id)
    {
        $sql = $this->pdoQuery->fetch("SELECT u FROM users
        WHERE id = :id", array(
            ':id' => $id
        ));
        
        return $sql;
    }

    public function getData($name)
    {
        $data = $this->pdoQuery->fetch("SELECT * FROM users WHERE name = :name", array(
            ':name' => mb_strtolower($name),
        ));

        return $data;
    }

    public function checkName($name)
    {
        $sql = $this->pdoQuery->fetch("SELECT id FROM users WHERE name = :name", array(
            ':name'  =>  mb_strtolower($name),
        ));
        return $sql;
    }

    public function checkEmail($email)
    {
        $sql = $this->pdoQuery->fetch("SELECT id FROM users WHERE email = :email", array(
            ':email'    => mb_strtolower($email)
        ));

        return $sql;
    }

    public function checkLogin($name, $password)
    {   
        $sql = $this->pdoQuery->fetch("SELECT * FROM users WHERE name = :name AND password = :password", array(
            ':name'   => mb_strtolower($name),
            ':password' => $password
        ));
        return $sql;
    }

    private function saveData(array $data)
    {
        $pdo = array(
            'id'             => $data['id'],
            'name'           => $data['name'],
            'email'          => $data['email'],
        );
        $this->userSession->saveUser($pdo);
    }


    private function setLogin($name, $password)
    {
        $data     = $this->getData(mb_strtolower($name));
        $dataUser = $this->checkLogin(mb_strtolower($name), $password);

        if ($data and $dataUser) {
            $this->saveData($data);
            return true;
        }

        return false;
    }

    public function loginUser($name, $password)
    {

        if ($this->setLogin(mb_strtolower($name), hash('sha1', $password))) {

            return true;
        }

        return false;
    }


}
