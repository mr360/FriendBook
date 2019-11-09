<?php
require_once("user.php");
require_once("database.php");

/*
* FriendDb : Extends Database and provides methods (database interactions) that pertain to the FriendBook features.
             Queries are are custom built and sent to Database->DbQuery to be executed.
*/
class FriendDb extends Database
{
    private $lTableA;  // Friend
    private $lTableB; // Friendlist

    public function __construct($aHost,$aUser,$aPwd,$aSqlDb, $aTableA,$aTableB)
    {
        parent::__construct($aHost,$aUser,$aPwd,$aSqlDb);

        $this->lTableA = $aTableA;
        $this->lTableB = $aTableB;

        if (!parent::TableExist($aTableA))
        {
            $this->CreateTable($aTableA) ? : die("Table creation error!");
            // Create dummy data for friends table
            $this->CreateDummyData(); 
        }

        if (!parent::TableExist($aTableB))
        {
            $this->CreateTable($aTableB) ? : die("Table creation error!");
        }
    }
    
    private function CreateTable($aTable)
    {
        $lData = false;

        // if tableA or table B then change the lQuery
        $lQuery = "";
        if ($aTable === "friends") 
        {
            $lQuery = "create table $aTable (
                friend_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                friend_email varchar(50) UNIQUE KEY NOT NULL,
                password varchar(20) NOT NULL,
                profile_name varchar(20) NOT NULL,
                date_started date NOT NULL,
                num_of_friends int unsigned
                )";
        }
        else if ($aTable === "myfriends")
        {
            $lQuery = "create table $aTable (
                friend_id1 int NOT NULL,
                friend_id2 int NOT NULL
                )";
        }
 
        return parent::DbQuery($lQuery,$lData);
    }

    private function CreateDummyData()
    {
        // only for assignment purposes (not secure and will cause a crash if called without creating required db)
        $lQuery = "INSERT INTO `friends` (`friend_id`, `friend_email`, `password`, `profile_name`, `date_started`, `num_of_friends`) VALUES
        (1, 'jsnow@gmail.com', '123456789', 'JackSnow', '2019-05-24', '0'),
        (2, 'jallo@yahoo.com', '123456789', 'JimAllen', '2019-05-24', '0'),
        (3, 'bgate@gmail.com', '123456789', 'BillGates', '2019-05-24', '0'),
        (4, 'sbalm@yahoo.com', '123456789', 'SteveBalmer', '2019-05-24', '0'),
        (5, 'jobse@gmail.com', '123456789', 'SteveJobs', '2019-05-24', '0'),
        (6, 'talle@yahoo.com', '123456789', 'TimAllen', '2019-05-24', '0'),
        (7, 'roody@gmail.com', '123456789', 'RoodyMcDoody', '2019-05-24', '0'),
        (8, 'jackb@yahoo.com', '123456789', 'JackBlack', '2019-05-24', '0'),
        (9, 'tmona@gmail.com', '123456789', 'TonyMontana', '2019-05-24', '0'),
        (10, 'ryzs@yahoo.com', '123456789', 'RyanSeeya', '2019-05-24', '0'),
        (11, 'jiwa@gmail.com', '123456789', 'JiWaZi', '2019-05-24', '0'),
        (12, 'sqad@yahoo.com', '123456789', 'Squad', '2019-05-24', '0'),
        (13, 'zali@gmail.com', '123456789', 'ZaraAli', '2019-05-24', '0'),
        (14, 'bonos@yahoo.com', '123456789', 'BonoSugar', '2019-05-24', '0'),
        (15, 'carlh@gmail.com', '123456789', 'CarlJr', '2019-05-24', '0'),
        (16, 'lgalg@yahoo.com', '123456789', 'LiamGalager', '2019-05-24', '0'),
        (17, 'szill@gmail.com', '123456789', 'SamZilla', '2019-05-24', '0'),
        (18, 'jwill@yahoo.com', '123456789', 'JoshWillow', '2019-05-24', '0'),
        (19, 'tstin@gmail.com', '123456789', 'TomStine', '2019-05-24', '0'),
        (20, 'yang1@yahoo.com', '123456789', 'AndrewYang', '2019-05-24', '0'),
        (21, 'bsand@gmail.com', '123456789', 'BernieSanders', '2019-05-24', '0'),
        (22, 'dtrum@yahoo.com', '123456789', 'DonaldTrump', '2019-05-24', '0'),
        (23, 'bobam@gmail.com', '123456789', 'BObama', '2019-05-24', '0'),
        (24, 'jcar1@yahoo.com', '123456789', 'JimmyCarter', '2019-05-24', '0')";

        $lData = false;
        return parent::DbQuery($lQuery,$lData);
    }

    public function AddUser(User $aUser)
    {
        $lData = false;
        $lQuery = "INSERT INTO `$this->lTableA` (`friend_email`, `password`, `profile_name`,`date_started`, `num_of_friends`)
                                        VALUES ('".$aUser->GetEmail()."','". $aUser->GetPassword()."','". $aUser->GetProfileName()."','".$aUser->GetCreationDate()."','". $aUser->GetFriendCount()."')";
        return parent::DbQuery($lQuery,$lData);
    }

    public function GetUser(User $aUser)
    {
        $lData = true;
        $lQuery = "SELECT * FROM `$this->lTableA` WHERE `friend_email` = '".$aUser->GetEmail()."'";
        return (parent::DbQuery($lQuery,$lData) == true) ? $lData : false;
    }

    private function GetUserId(User $aUser)
    {
        $lData = true;
        $lQuery = "SELECT `friend_id` FROM `$this->lTableA` WHERE `friend_email` = '".$aUser->GetEmail()."'";
        return (parent::DbQuery($lQuery,$lData) == true) ? $lData : false;
    }

    private function UpdateFriendCount($aAccountHolderId,$aUserId, $aMode)
    {
        $lAction  = "`num_of_friends`"; 
        
        if ($aMode === "++")
        {
            $lAction = "`num_of_friends`+1";
        }
        elseif ($aMode === "--")
        {
            $lAction = "`num_of_friends` - 1";
        }

         $lResult = 1;
         $lData = false;
         $lQuery1 = "UPDATE `friends` SET `num_of_friends`= $lAction WHERE `friend_id` = '".$aUserId."'";
         $lQuery2 = "UPDATE `friends` SET `num_of_friends`= $lAction WHERE `friend_id` = '".$aAccountHolderId."'";
         
         $lResult *= parent::DbQuery($lQuery1,$lData);
         $lResult *= parent::DbQuery($lQuery2,$lData);
    }

    public function LinkUser(User $aAccountHolder, User $aUser)
    {
        $lData = false;
        
        $lAccountHolderId = $this->GetUserId($aAccountHolder);
        $lUserId = $this->GetUserId($aUser);

        if ($lAccountHolderId != false and $lUserId != false)
        {
            // Set two established users as friends
            $lQuery = "INSERT INTO `$this->lTableB` (`friend_id1`, `friend_id2`) VALUES
                                                    ('".$lUserId[0][0]."','".$lAccountHolderId[0][0]."'),
                                                    ('".$lAccountHolderId[0][0]."','".$lUserId[0][0]."')";
            if (parent::DbQuery($lQuery,$lData) != false)
            {
                return $this->UpdateFriendCount($lAccountHolderId[0][0],$lUserId[0][0],"++");
            }
        }
           
        return false;
    }

    public function UnlinkUser(User $aAccountHolder, User $aUser)
    {
        $lData = false;
        
        $lAccountHolderId = $this->GetUserId($aAccountHolder);
        $lUserId = $this->GetUserId($aUser);

        if ($lAccountHolderId != false and $lUserId != false)
        {
            // Unfriend two established users
            $lQuery = "DELETE FROM `$this->lTableB` WHERE (`friend_id1` = '".$lUserId[0][0]."' AND `friend_id2` = '".$lAccountHolderId[0][0]."') OR (`friend_id1` = '".$lAccountHolderId[0][0]."' AND `friend_id2` = '".$lUserId[0][0]."')";
            if (parent::DbQuery($lQuery,$lData) != false)
            {
                return $this->UpdateFriendCount($lAccountHolderId[0][0],$lUserId[0][0],"--");
            }
        }
           
        return false;
    }

    public function GetAllNonFriends(User $aUser)
    {
        $lData = true;
        $lUserId = $this->GetUserId($aUser);
        $lQuery = "SELECT u2.`profile_name`, u2.`friend_email`
                   FROM `friends` u1,`friends` u2
                   WHERE NOT EXISTS(SELECT '".$lUserId[0][0]."'
                         FROM `myfriends` f
                         WHERE f.friend_id1 = u1.friend_id AND
                               f.friend_id2 = u2.friend_id)
                   AND NOT EXISTS(SELECT '".$lUserId[0][0]."'
                         FROM `myfriends` f
                         WHERE f.friend_id1 = u2.friend_id AND
                               f.friend_id2 = u1.friend_id)
                   AND u1.friend_id != u2.friend_id
                   AND u1.friend_id = '".$lUserId[0][0]."'
                   GROUP BY u2.`profile_name`";
        return (parent::DbQuery($lQuery,$lData) == true) ? $lData : false;
    }

    public function GetAllNonFriendsMutualConnections(User $aUser, User $aUserNonFriend)
    {
        $lData = true;
        $lUserNonFriendId = $this->GetUserId($aUserNonFriend);
        $lUserId = $this->GetUserId($aUser);
        
        $lQuery = "SELECT COUNT(*) FROM `myfriends` f1 INNER JOIN `myfriends` f2 ON f1.friend_id2 = f2.friend_id2
                   WHERE f1.friend_id1 = '".$lUserId[0][0]."' AND f2.friend_id1 = '".$lUserNonFriendId[0][0]."'";
        return (parent::DbQuery($lQuery,$lData) == true) ? $lData : false;
    }
    
    public function GetAllFriends(User $aUser)
    {
        $lData = true;
        $lUserId = $this->GetUserId($aUser);
        $lQuery = "SELECT `profile_name`, `friend_email` FROM `friends` f1 INNER JOIN `myfriends` f2 ON f1.`friend_id` = f2.`friend_id2` WHERE f2.`friend_id1` = '".$lUserId[0][0]."' GROUP BY `profile_name`";
        return (parent::DbQuery($lQuery,$lData) == true) ? $lData : false;
    }
}
?>