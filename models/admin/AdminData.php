<?php

/**
 * 
 * Data do dashboard
 * 
 * @author Emprezaz
 * 
 **/

class AdminData
{

    private $pdoQuery;
    private $pdoCrud;

    public function __construct()
    {

        $this->pdoQuery = new PDOQuery;
        $this->pdoCrud = new PDOCrud;
    }

    // Buscando nome de usuário no banco
    public function checkLoginAdm($login)
    {

        return $this->pdoQuery->fetch("SELECT * FROM admin WHERE login = :login AND (status IS NULL OR status = 1)", array(
            ':login' => $login,
        ));
    }
    // Buscando email do admin no banco
    public function checkEmailAdm($email)
    {

        return $this->pdoQuery->fetch("SELECT id FROM admin WHERE email = :email ", array(
            ':email' => $email,
        ));
    }
    // Buscando nome de usuário no banco
    public function checkIdAdm($email)
    {
        $id = $this->pdoQuery->fetch("SELECT id,email FROM admin WHERE email = :email ", array(
            ':email' => $email,
        ));
        return $id;
    }
    // Buscando nome de usuário no banco
    public function checkRecoverValidateAdm($id, $code)
    {

        $id = $this->pdoQuery->fetch("SELECT id,email,recoverpass FROM admin WHERE id = :id AND recoverpass = :recoverpasscode", array(
            ':id' => $id,
            ':recoverpasscode' => $code,
        ));
        return $id;
    }

    // Buscando a senha do usuário no banco
    public function checkPasswordAdm($username, $password)
    {

        $password = SHA1($password);

        return $this->pdoQuery->fetch("SELECT * FROM admin WHERE login = :username AND password = :password ", array(
            ':username' => $username,
            ':password' => $password,
        ));
    }

    // Buscando os dados da sessão
    public function getData($username)
    {

        return $this->pdoQuery->fetch("SELECT * FROM admin WHERE login = :username ", array(
            ':username' => $username,
        ));
    }

    public function getDataById($id)
    {
        return $this->pdoQuery->fetch("SELECT * FROM admin WHERE id = :id ", array(
            ':id' => $id,
        ));
    }

    public function getAdminByMenu($id)
    {
        return $this->pdoQuery->fetch("SELECT id FROM menu_admin WHERE admin_id = :id", array(
            ':id'   =>  $id,
        ));
    }
}
