UserList
    AvailableFriend(User) : List<User>
    AllUser() : List<User>
*/

<?php
require_once("user.php");

class UserList
{
    public static function GetAvailableFriends(User $aUser)
    {
        // get all the users that are currently not friends with me
        // return an array of Users
    }

    public static function GetCurrentUserFriends(User $aUser)
    {
        // get all the users who are friends with me 

        // return an array of Users
    }

    public static function GetAllUser()
    {
        // Get all the users in the sysetm (including me)
        // return an array of Users
    }
}
?>