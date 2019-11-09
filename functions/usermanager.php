<?php
require_once("user.php");
require_once("frienddb.php");

/*
* UserManager : This module get the raw data from the FriendDb and processes it so that it can be used within the app.
*/
class UserManager
{
    private $fDb;

    public  function __construct()
    {
        $host = "xxxxxxxxx";
        $user = "xxxxxxxxx";
        $pwd = "xxxxxxxxx";
        $sql_db = "xxxxxxxxx"; 
         $this->fDb = new FriendDb($host,$user,$pwd,$sql_db,"friends","myfriends");
    }

    public  function GetAllNonFriends(User $aUser)
    {
        // get all the users that are currently not friends with me
        // return an array of Users
        $lData = $this->fDb->GetAllNonFriends($aUser);
        if ($lData != false)
        {
            $lAllNonFriends = array();
            
            foreach($lData as $lUsr)
            {
                $lUser = new User($lUsr[0],$lUsr[1],"","");
                array_push($lAllNonFriends,$lUser);
            }
            
            return $lAllNonFriends;
        }

        return $lData;
    }

    public function GetAllNonFriendsMutualConnections(User $aUser)
    {
        $lData = $this->GetAllNonFriends($aUser);
        for ($i = 0; $i < count($lData)-1; $i++)
        {
            // Call GetAllNonFriendsMutualConnections and get the # of mutual connections  
            // Add mutual connection value to User->SetMutualFriends()
            $lMConn = $this->fDb->GetAllNonFriendsMutualConnections($aUser,$lData[$i]);
            $xUser = $lData[$i];
            $xUser->SetMutualKnowns($lMConn[0][0]);
            $lData[$i] = $xUser; 
        }
        
        return $lData;
    }
    
    public  function GetCurrentUserFriends(User $aUser)
    {
        // get all the users who are friends with me 
        // return an array of Users
        $lData = $this->fDb->GetAllFriends($aUser);
        if ($lData != false)
        {
            $lCurrentUserFriend = array();
            foreach($lData as $lUsr)
            {
                $lUser = new User($lUsr[0],$lUsr[1],"","");
                array_push($lCurrentUserFriend,$lUser);
            }
            
            return $lCurrentUserFriend;
        }

        return $lData;
    }

    // new section
    public  function AddUser(User $aUser)
    {
        return $this->fDb->AddUser($aUser);
    }

    public  function GetUser(User $aUser)
    {
        $lData = $this->fDb->GetUser($aUser);
        // convert the ldata to User $xx and return User
        if (!empty($lData))
        {
            $lUser = new User($lData[0][3],$lData[0][1],$lData[0][2],"");
            return $lUser;
        }

        return false;
    }

    public  function LinkUser(User $aAccountHolder, User $aUser)
    {
        return $this->fDb->LinkUser($aAccountHolder,$aUser);
    }

    public  function UnlinkUser(User $aAccountHolder, User $aUser)
    {
        return $this->fDb->UnlinkUser($aAccountHolder,$aUser);
    }
}
?>