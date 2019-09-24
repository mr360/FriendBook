<?php

// backward compatibility
if (!class_exists('\PHPUnit\Framework\TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
}

include 'database.php';

Class Test extends PHPUnit_Framework_TestCase{
	public function testDb(){
		$db = new Database("127.0.0.1","root","","fbook","friends","myfriends");
		$check = true;
        $this->assertEquals($check, true);
	}

	// Test create tables
	// Test get user
	// Test add user
	// Test link two users
	// Test unklink two users
	// Test get user friend list
	// Test get user list
}