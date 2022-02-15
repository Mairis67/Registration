<?php

class Signup extends Dbh
{
    protected function setUser($uid, $password, $email)
    {
        $statement = $this->connect()->
        prepare('INSERT INTO users (users_uid, users_password, users_email) VALUES (?, ?, ?);');

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if(!$statement->execute([$uid, $hashedPassword, $email])) {
            $statement = null;
            header('location: ../index.php?error=stmtfailed');
            exit();
        }

        $statement = null;
    }

    protected function checkUser($uid, $email)
    {
        $statement = $this->connect()->
        prepare('SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?;');

        if(!$statement->execute([$uid, $email])) {
            $statement = null;
            header('location: ../index.php?error=stmtfailed');
            exit();
        }

        if($statement->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }

        return $resultCheck;
    }
}