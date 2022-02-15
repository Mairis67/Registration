<?php

class LoginController extends Login
{
    private string $uid;
    private string $password;

    public function __construct(string $uid, string $password)
    {
        $this->uid = $uid;
        $this->password = $password;
    }

    public function loginUser()
    {
        if ($this->emptyInput() === false) {
            // echo 'Empty input!';
            header('location: ../index.php?error=emptyinput');
            exit();
        }

        $this->getUser($this->uid, $this->password);
    }

    private function emptyInput(): bool
    {
        if (empty($this->uid) || empty($this->password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}