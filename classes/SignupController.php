<?php

class SignupController extends Signup
{
    private string $uid;
    private string $password;
    private string $passwordRepeat;
    private string $email;

    public function __construct(string $uid, string $password, string $passwordRepeat, string $email)
    {
        $this->uid = $uid;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
        $this->email = $email;
    }

    public function signupUser()
    {
        if($this->emptyInput() === false) {
            // echo 'Empty input!';
            header('location: ../index.php?error=emptyinput');
            exit();
        }

        if($this->invalidUid() === false) {
            // echo 'Invalid username!';
            header('location: ../index.php?error=username');
            exit();
        }

        if($this->invalidEmail() === false) {
            // echo 'Invalid email!';
            header('location: ../index.php?error=email');
            exit();
        }

        if($this->passwordMatch() === false) {
            // echo 'Invalid password!';
            header('location: ../index.php?error=passwordmatch');
            exit();
        }

        if($this->uidTakenCheck() === false) {
            // echo 'Username or e-mail taken!';
            header('location: ../index.php?error=useroremailtaken');
            exit();
        }

        $this->setUser($this->uid, $this->password, $this->email);
    }

    private function emptyInput(): bool
    {
        if(empty($this->uid) || empty($this->password) || empty($this->passwordRepeat) || empty($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidUid(): bool
    {
        if(!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail(): bool
    {
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function passwordMatch(): bool
    {
        if($this->password !== $this->passwordRepeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck(): bool
    {
        if(!$this->checkUser($this->uid, $this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

}