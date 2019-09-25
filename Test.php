<?php

// backward compatibility
if (!class_exists('\PHPUnit\Framework\TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
}

include 'database.php';

Class DatabaseTest extends PHPUnit_Framework_TestCase{
	
	// Test create tables
	// Test get user
	// Test add user
	// Test link two users
	// Test unklink two users
	// Test get user friend list
	// Test get user list

	public function TestCreateTable(){
		$db = new Database("127.0.0.1","root","","fbook","friends","myfriends");
		$exist = $db->TableExist("friends") and $db->TableExist("myfriends");
        $this->assertEquals($exist, true);
	}

	public function TestAddAndGetUser()
	{
		// TOODO add two constuctors , one with name,email,pass another with full listing
		$lUser = new User("Jack","jkak@gmail.com","12345678","10/07/2010",0,"ignoreID");
		$db = new Database("127.0.0.1","root","","fbook","friends","myfriends");
		$lResult = $db->AddUser($lUser);

		print_r($db->GetUser($lUser));
		
		$this->assertEquals($lResult,true);
	}

	public function TestGetUser()
	{
		$this->assertEquals(true,false);
	}

	public function TestLinkUser()
	{
		$this->assertEquals(true,false);
	}

	public function TestUnlinkUser()
	{
		$this->assertEquals(true,false);
	}

	public function TestGetFriendList()
	{
		$this->assertEquals(true,false);
	}

	public function TestGetUserList()
	{
		$this->assertEquals(true,false);
	}

}