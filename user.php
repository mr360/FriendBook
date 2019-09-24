<?php
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

        private $lFriendList = array();

        public function __construct($aName, $aEmail, $aPassword)
        {
            $this->lName = $aName;
            $this->lEmail = $aEmail;
            $this->lPassword = $aPassword;
        }

        public function GetFriendList()
        {
            //call db to get this and set the lFriendList array
        }

        public function GetFriendCount()
        {
           return count($this->lFriendList);
        }

        public function IsFriend(User $user)
        {
            foreach($friend as $lFriendList)
            {
                if ($friend === $user) return true;
            }

            return false;
        }

        public function RemoveFriend(User $friend)
        {
            // call is friend 
            // call db->unlinkUser()
     
        }

        public function AddFriend(User $friend)
        {
            // call is friend 
            // add the friend to db  db->linkUser
        }
    }

?>