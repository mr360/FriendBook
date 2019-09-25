<?php
require_once("userlist.php");
/*
User
    GetFriendList : List<User>
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
        private $lDateStarted;
        private $lNumOfFriends;

        private $lFriendList = array();

        public function __construct($aName, $aEmail, $aPassword)
        {
            $this->lName = $aName;
            $this->lEmail = $aEmail;
            $this->lPassword = $aPassword;
            $this->lDateStarted = date("d/m/Y");
            $this->lNumOfFriends = 0; 
        }

        public function __construct1($aId, $aName, $aEmail, $aPassword, $aDateStarted, $aNumOfFriends)
        {
            $this->__construct($aName, $aEmail, $aPassword);
            $this->lDateStarted = $aDateStarted;
            $this->lNumOfFriends = $aNumOfFriends;
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

        public function GetFriendCount()
        {
           $this->GetFriendList();
           return $this->lNumOfFriends;
        }

        public function GetFriendList()
        {
            // Plan 2
            // call userlist and call function GetFriendList($this)
            $this->lFriendList = UserList::GetCurrentUserFriends($this);
            $this->lNumOfFriends = count($this->lFriendList);

            return $this->lFriendList;  // return an array of Users
        }

        public function IsFriend(User $aUser)
        {
            foreach($this->lFriendList as $lFriend)
            {
                if ($lFriend->GetEmail() === $aUser->GetEmail()) return true;
            }

            return false;
        }

        public function RemoveFriend(User $aFriend)
        {
            if ($this->IsFriend($aFriend))
            {
                $lResult = (Database::UnlinkUser($this,$aFriend));
                $this->GetFriendList();
                return $lResult;
            }
            
            return false;
        }

        public function AddFriend(User $aFriend)
        {
            if (!$this->IsFriend($aFriend))
            {
                $lResult = Database::LinkUser($this,$aFriend);
                $this->GetFriendList();
                return $lResult;
            }
            
            return false;
        }
    }

?>