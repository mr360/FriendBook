<?php
/*
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

    /*
    Database 
    CreateTable : bool
    
    AddUser(User) : bool
    GetUser(User) : User
    
    LinkUsers(User,User) : bool
    UnlinkUsers(User,User) : bool

    GetAllNonFriends(User) : List<User>
    GetAllNonFriendsMutualConnections
     */
    final class Database
    {
        private $lHost;
        private $lUser;
        private $lPwd;
        private $lSqlDb;

        private $lTableA;
        private $lTableB;
        
        public function __construct($aHost,$aUser,$aPwd,$aSqlDb, $aTableA,$aTableB)
        {
            $this->lHost = $aHost;
            $this->lUser = $aUser;
            $this->lPwd = $aPwd;
            $this->lSqlDb = $aSqlDb;
            $this->Initialise($aTableA,$aTableB);
        }

        private function Initialise($aTableA,$aTableB)
        {
            $this->lTableA = $aTableA;
            $this->lTableB = $aTableB;

            if (!TableExist($aTableA))
            {
                CreateTable($aTableA) ? : die("Table creation error!");
            }

            if (!TableExist($aTableB))
            {
                CreateTable($aTableB) ? : die("Table creation error!");
            }
        }

        // If the aData variable contains a true then a result array will be 
        // delivered via aData
        // if not true then no data will be retrieved
        private function DbQuery($aQuery,&$aData)
        {
            $lConn = @mysqli_connect($host,$user,$pwd,$sql_db);
                    
            if ($lConn) {		
                $lResult = mysqli_query($lConn, $aQuery);
                if ($lResult) {
                    if ($aData)
                    {
                        $aData = mysqli_fetch_array($lResult);
                    } 
                    mysqli_close($lConn);
                    return true;
                } 
                else {
                    mysqli_close($lConn);
                    return false;
                }
            }
            return false;	
        }

        private function TableExist($aTable) {
            $lQuery = "DESCRIBE `$aTable`";
            $this->DbQuery($lQuery,false); 
        }    

        private function CreateTable($aTable)
        {
            $lQuery = "create table $aTable (
                friend_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                friend_email varchar(10) NOT NULL,
                password varchar(10) NOT NULL,
                profile_name varchar(10) NOT NULL,
                date_started date NOT NULL,
                num_of_friends int(11) NOT NULL
                )";

            $this->DbQuery($lQuery,false);
        }

        public function AddUser(User $user)
        {
            $lQuery = "";
            $this->DbQuery($lQuery,false);
        }

        public function GetUser(User $user)
        {
            $lQuery = "";
            $this->DbQuery($lQuery,true);
        }

        public function LinkUser(User $accountHolder, User $user)
        {
            // set two established users as friends
            $lQuery = "";
            $this->DbQuery($lQuery,false);
        }

        public function UnlinkUser(User $accountHolder, User $user)
        {
            // unfriend two established users
            $lQuery = "";
            $this->DbQuery($lQuery,false);
        }

        public function GetAllNonFriends(User $user)
        {
            $lQuery = "";
            $this->DbQuery($lQuery,true);
        }

        public function GetAllNonFriendsMutualConnections(User $user)
        {
            // unsure about this function
            $lQuery = "";
            $this->DbQuery($lQuery,true);
        }

        public function GetAllFriends(User $user)
        {
            $lQuery = "";
            $this->DbQuery($lQuery,true);
        }
    }

?>

/*
Authenticate
    Login(User) : bool
    Register(User) : bool
    Logout() : bool
    SetSession 
    KillSession

Database 
    CreateTable : bool
    
    AddUser(User) : bool
    GetUser(User) : User
    
    LinkUsers(User,User) : bool
    UnlinkUsers(User,User) : bool

    GetAllNonFriends(User) : List<User>
    GetAllNonFriendsMutualConnections

UserList
    AvailableFriend(User) : List<User>

User
    GetFriendList : List<User>
    GetFriendCount : int
    IsFriend(User) : bool
    RemoveFriend(User) : bool
    AddFriend(User) : bool

IO 
    Validate
    Redirect??

*/