<?php

namespace App;
include('testclasses/Testclasses.php');


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
        
        $loginObj->loginUser($uname, 'False Password');
        $this->assertEquals(false, $loginObj->loginSuccess); 

        $loginObj->loginUser('False User', $pwd);
        $this->assertEquals(false, $loginObj->loginSuccess); 
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
        
        $signupObj->signupUser($uname, $pwd, 'random text');
        $this->assertEquals(false, $signupObj->signupSuccess); 
    }

    /**
     * @covers App\SearchTestClass
     */
    public function testSearch(){
        $searchObj = new SearchTestClass;
        $rand_length = rand(1, 12);
        $searchText = substr('The facility', 0, $rand_length);

        $searchObj->searchBook($searchText);
        $this->assertEquals(true, $searchObj->searchSuccess);
        
        $searchText = "Random String";
        $searchObj->searchBook($searchText);
        $this->assertEquals(false, $searchObj->searchSuccess);
    }

}