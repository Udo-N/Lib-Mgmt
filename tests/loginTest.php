<?php

namespace App;
include('Testclasses.php');


class TestClassesTest extends \PHPUnit\Framework\TestCase{
    /**
     * @covers App\LoginTestClass
     */
    public function testLogin(){
        $loginObj = new LoginTestClass;
        $uname = "AName";
        $pwd = "password3";

        $loginObj->loginUser($uname, $pwd);
        $this->assertEquals(true, $loginObj->loginSuccess);        
    }

    /**
     * @covers App\SignUpTestClass
     */
    public function testSignUp(){
        $listAlpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $signupObj = new SignUpTestClass;
        $uname = substr(str_shuffle($listAlpha), 0, 45);
        $pwd = substr(str_shuffle($listAlpha), 0, 45);
        $pwd2 = $pwd;

        $signupObj->signupUser($uname, $pwd, $pwd2);
        $this->assertEquals(true, $signupObj->signupSuccess);        
    }

}