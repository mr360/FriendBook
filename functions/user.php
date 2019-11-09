<?php
require_once("usermanager.php");
require_once("io.php");

/*
User : Stores the user details and allows for easy interfacing between modules.
        GetFriendList : Array<User>
        GetFriendCount : int
        IsFriend(User) : bool
        RemoveFriend(User) : bool
        AddFriend(User) : bool
*/
    class User
    {
        private $lName;
        private $lEmail;
        
        private $lPassword;
        private $lPasswordConfirm;

        private $lDateStarted;
        private $lNumOfFriends;

        private $lFriendList;
        private $lUserManager;
        
        private $lMutualKnowns;

        public function __construct($aName, $aEmail, $aPassword,  $aPassworConfirm)
        {
            $this->lName = IO::Sanitize($aName);
            $this->lEmail = IO::Sanitize($aEmail);
            $this->lPassword = IO::Sanitize($aPassword);
            $this->lDateStarted = date("Y-m-d");
            $this->lNumOfFriends = 0; 

            $this->lUserManager = new UserManager();
            $this->lFriendList = array();

            $this->lPasswordConfirm = IO::Sanitize($aPassworConfirm);
            
            $this->lMutualKnowns = 0;
        }

        public function GetProfileName()
        {
            return $this->lName;
        }

        public function GetCreationDate()
        {
            return $this->lDateStarted;
        }

        public function GetEmail()
        {
            return $this->lEmail;
        }

        public function GetPassword()
        {
            return $this->lPassword;
        }

        public function GetPasswordConfirm()
        {
            return $this->lPasswordConfirm;
        }

        public function GetFriendCount()
        {
           $this->GetFriendList();
           
           return $this->lNumOfFriends;
        }

        public function GetFriendList()
        {
            $this->lFriendList = $this->lUserManager->GetCurrentUserFriends($this);          
            $this->lNumOfFriends = count($this->lFriendList);
            
            return $this->lFriendList;  
        }

        public function RemoveFriend(User $aFriend)
        {
            $lResult = ($this->lUserManager->UnlinkUser($this,$aFriend));
            $this->GetFriendList();
            return $lResult;
        }

        public function AddFriend(User $aFriend)
        {
            $lResult = $this->lUserManager->LinkUser($this,$aFriend);
            $this->GetFriendList();
            return $lResult;

        }
        
        public function SetMutualKnowns($num)
        {
            $this->lMutualKnowns = $num;   
        }
        
        public function GetMutualKnowns()
        {
            return $this->lMutualKnowns;
        }
    }

?>