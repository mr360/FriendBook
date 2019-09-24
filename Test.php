<?php

// backward compatibility
if (!class_exists('\PHPUnit\Framework\TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
}

include 'index.php';

Class Test extends PHPUnit_Framework_TestCase{
	public function test_check_random_number_function(){
		$home = new Home();
		$random = $home->get_random_number();
		$check = ($random <= 10 && $random >=5) ? true : false;
		$this->assertEquals($check, true);
	}
}