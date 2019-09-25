/*
Authenticate
    Login(User) : bool
    Register(User) : bool
    Logout() : bool
    SetSession 
    KillSession
*/

<?php
class Authenticate
{
    public function Login(User $aUser)
    {
        // if login success call SetSession()
        // return true/false
    }

    public function Register(User $aUser)
    {
        // return true/false
    }

    public function Logout()
    {
        // return true/false
    }

    private function SetSession()
    {
        // no return
    }

    private function KillSession()
    {
        // no return
    }
}

?>