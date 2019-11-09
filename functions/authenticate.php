<?php
require_once("usermanager.php");
require_once("io.php");

/*
* Authentication : This module allows for logging in and out (also handles redirects).
*                  This module should be declared at the top of every page that is authentication protected.
*/
class Authenticate
{
    private $lUserManager;

    public function __construct()
    {
        session_start();
        $this->lUserManager = new UserManager();
    }

    public function Login(User $aUser)
    {
        $lResult = IO::Validation($aUser,"LOGIN");
        if ( $lResult != VALID)
        {
            return $lResult;
        }

        $lUser = $this->lUserManager->GetUser($aUser);
        if ($lUser != false and $lUser->GetPassword() == $aUser->GetPassword()) 
        {
            $this->SetSession($lUser);
            header("Location: friendlist.php");
            return SUCCESS;
        }
        
        return LOGIN_FAILED;
    }

    public function Register(User $aUser)
    {
        $lResult = IO::Validation($aUser,"REGISTER");
        if ( $lResult!= VALID)
        {
            return $lResult;
        }
        
        $lUser = $this->lUserManager->GetUser($aUser);
        if ($lUser === false)
        {
            $this->lUserManager->AddUser($aUser);
            $this->SetSession($aUser);
            header("Location: friendadd.php");
            return SUCCESS;
        } 
        else
        {
            return EMAIL_EXIST_ALREADY;
        }
    }

    public function Logout()
    {
        $this->KillSession();
        return SUCCESS;
    }

    public function RedirectCheckAuth()
    {
        if (!isset($_SESSION["user"]))  header("Location: index.php");
    }

    public function GetUser()
    {
        return $_SESSION["user"];
    }

    private function SetSession(User $aUser)
    {
        $lResult = false;
        if (!isset($_SESSION["user"])) { 
            $_SESSION["user"] = $aUser;
            $lResult =  true; 
        }
        return $lResult;
    }

    private function KillSession()
    {
        session_unset();
        if(session_destroy()) 
        {
            header("Location: index.php");
        }
    }
}

?>