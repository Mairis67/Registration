<?php

class Login extends Dbh
{
    protected function getUser($uid, $password)
    {
        $statement = $this->connect()->
        prepare('SELECT users_password FROM users WHERE users_uid = ? OR users_email = ?;');

        if(!$statement->execute([$uid, $password])) {
            $statement = null;
            header('location: ../index.php?error=stmtfailed');
            exit();
        }

        if($statement->rowCount() === 0) {
            $statement = null;
            header('location: ../index.php?error=usernotfound');
            exit();
        }

        $passwordHashed = $statement->fetchAll(PDO::FETCH_ASSOC);
        $checkPassword = password_verify($password, $passwordHashed[0]['users_password']);

        if($checkPassword === false) {
            $statement = null;
            header('location: ../index.php?error=wrongpassword');
            exit();
        } elseif ($checkPassword === true) {
            $statement = $this->connect()->
            prepare('SELECT * FROM users WHERE users_uid = ? 
            OR users_email = ? AND users_password = ?;');

            if(!$statement->execute([$uid, $uid, $password])) {
                $statement = null;
                header('location: ../index.php?error=');
                exit();
            }

            $user = $statement->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION['userid'] = $user[0]['users_id'];
            $_SESSION['useruid'] = $user[0]['users_uid'];

            $statement = null;
        }

//        $statement = null;
    }
}

