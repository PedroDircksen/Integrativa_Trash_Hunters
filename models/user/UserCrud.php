<?php

/**
 * 
 * Data do dashboard
 * 
 * @author Emprezaz
 * 
 **/

class UserCrud
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

    public function register($name, $email, $courses_id, $password)
    {
        $pdo = array(
            ':name'       => mb_strtolower($name),
            ':email'      => mb_strtolower($email),
            ':courses_id' => isset($courses_id) && $courses_id != '' ? $courses_id : NULL,
            ':password'   => sha1($password),
        );


        $colums = "name, email, courses_id, password";
        $values = ":name, :email, :courses_id, :password";


        $id = (int) $this->pdoCrud->insert('users', $colums, $values, $pdo);


        $this->userSession->saveUser(array(
            'id'             => $id,
            'name'       => $name,
        ));

        return $id;
    }
    public function registerScore($user_id){
        $pdo = array(
            ':score'     => 0,
            ':levelnumber'     => 1,
            ':users_id'  => $user_id,
        );


        $colums = "score, level, users_id";
        $values = ":score, :levelnumber, :users_id";


        $id = (int) $this->pdoCrud->insert('score', $colums, $values, $pdo);


        return $id;
    }
    public function updatePassword($id, $password)
    {
        $pdo = array(
            ':id'       => $id,
            ':password' => sha1($password)
        );

        $values   = "password = :password";
        $clausule = "WHERE id = :id";

        return $this->pdoCrud->update("users", $values, $clausule, $pdo);
    }

   

    public function updateUser(array $data, $validation)
    {
        $pdo = array(
            ':id'                    => $data['id'],
            ':name'              => $data['name'],
            ':email'                 => mb_strtolower($data['email']),
        );

        $values   = "name = :name,email = :email";
        $clausule = "WHERE id = :id";

        return $this->pdoCrud->update("users", $values, $clausule, $pdo);
    }

      // public function recoverPassword($code, $id)
    // {
    //     $pdo = array(
    //         ':id'         => $id,
    //         ':codeNumber' => $code
    //     );

    //     $values   = "code = :codeNumber, recovering = 1";
    //     $clausule = "WHERE id = :id";

    //     $update = $this->pdoCrud->update("users", $values, $clausule, $pdo);

    //     if ($update) {
    //         $eventName = 'recoverPassword' . $id;
    //         $this->pdoQuery->executeQuery("DROP EVENT IF EXISTS $eventName");
    //         $this->pdoQuery->executeQuery("CREATE EVENT $eventName ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 1 DAY DO UPDATE users SET recovering = 0 WHERE id = '$id' AND recovering = 1");
    //     }

    //     return $update;
    // }

    // public function deleteAccount($id)
    // {
    //     $pdo = array(
    //         ":id"         => $id,
    //     );

    //     $values   = "status = :status";
    //     $clausule = "WHERE id = :id";

    //     $result = $this->pdoCrud->update("users", $values, $clausule, $pdo);

    //     return $result;
    // }
}
