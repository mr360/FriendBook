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
        private $lDateStarted;
        private $lNumOfFriends;
        private $lId;

        private $lFriendList = array();

        public function __construct($aName, $aEmail, $aPassword,$aDateStarted,$aNumOfFriends, $aId)
        {
            $this->lName = $aName;
            $this->lEmail = $aEmail;
            $this->lPassword = $aPassword;
            //date started = use timestamp 
            //number of friends set as zero
            // store the id
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
           return $this->lNumOfFriends;
        }

        public function GetFriendList()
        {
            //call db to get this and set the lFriendList array
            //count the array size and store it in lNumOfFriends
        }

        public function IsFriend(User $user)
        {
            //????
        }

        public function RemoveFriend(User $friend)
        {
            // call $this->IsFriend 
            // call db->unlinkUser()
     
        }

        public function AddFriend(User $friend)
        {
            // call $this->IsFriend
            // add the friend to db  db->linkUser
        }
    }

?>