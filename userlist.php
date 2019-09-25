UserList
    AvailableFriend(User) : List<User>
    AllUser() : List<User>
*/

<?php
require_once("user.php");

class UserList
{
    public function GetAvailableFriend(User $aUser)
    {
        //GetAllFriends()
    }

    public function GetAllUser()
    {
        //Db::GetAllNonFriends()
        //Db:GetAllNonFriendsWithMutalConnections()
    }
}
?>