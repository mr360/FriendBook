<?php
require_once("user.php");

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

        private $lTableA;  // Friend
        private $lTableB; // Friendlist
        
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

            if (!$this->TableExist($aTableA))
            {
                $this->CreateTable($aTableA) ? : die("Table creation error!");
            }

            if (!$this->TableExist($aTableB))
            {
                $this->CreateTable($aTableB) ? : die("Table creation error!");
            }
        }

        // If the aData variable contains a true then a result array will be 
        // delivered via aData
        // if not true then no data will be retrieved
        private function DbQuery($aQuery,&$aData)
        {
            $lConn = @mysqli_connect($this->lHost,$this->lUser,$this->lPwd,$this->lSqlDb);
                    
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

        public function TableExist($aTable) {
            $lData = false;
            $lQuery = "DESCRIBE `$aTable`";
            return $this->DbQuery($lQuery,$lData); 
        }    

        private function CreateTable($aTable)
        {
            $lData = false;
            $lQuery = "create table $aTable (
                friend_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                friend_email varchar(10) NOT NULL,
                password varchar(10) NOT NULL,
                profile_name varchar(10) NOT NULL,
                date_started date NOT NULL,
                num_of_friends int(11) NOT NULL
                )";

            return $this->DbQuery($lQuery,$lData);
        }

        public function AddUser(User $aUser)
        {
            $lData = false;
            $lQuery = "INSERT INTO $this->lTableA (friend_email, password, profile_name,date_started,num_of_friends)
                                           VALUES ('$aUser->GetEmail()', '$aUser->GetPassword()', '$aUser->GetProfileName()',$aUser->GetCreationDate(),$aUser->GetFriendCount()";
            return $this->DbQuery($lQuery,$lData);
        }

        public function GetUser(User $aUser)
        {
            $lData = true;
            $lQuery = "SELECT friend_email, password, profile_name,date_started,num_of_friends FROM $this->lTableA WHERE friend_email=$aUser->GetEmail()";
            return $this->DbQuery($lQuery,$lData);
        }

        public function LinkUser(User $aAccountHolder, User $aUser)
        {
            $lData = false;
            // set two established users as friends
            $lQuery = "";
            return $this->DbQuery($lQuery,$lData);
        }

        public function UnlinkUser(User $aAccountHolder, User $aUser)
        {
            $lData = false;
            // unfriend two established users
            $lQuery = "";
            return $this->DbQuery($lQuery,$lData);
        }

        public function GetAllNonFriends(User $aUser)
        {
            $lData = true;
            $lQuery = " ";
            return $this->DbQuery($lQuery,$lData);
        }

        public function GetAllNonFriendsMutualConnections(User $aUser)
        {
            $lData = true;
            // unsure about this function
            $lQuery = "";
            return $this->DbQuery($lQuery,$lData);
        }

        public function GetAllFriends(User $aUser)
        {
            $lData = true;
            $lQuery = "";
            return $this->DbQuery($lQuery,$lData);
        }
    }
?>