<?php
require_once('..\include\class.pdogsb.inc.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of testsUnit
 *
 * @author admin
 */
class testsUnit extends PHPUnit_Framework_TestCase{
    
    /**
     * @var PdoGsb2
     */
    protected $monPdotest;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     * 
     * Constructeur du test
     */
    protected function setUp()
    {
	$this->monPdotest = PdoGsb::getPdoGsb() ;
    //    PdoGsb::getPdo()->exec("SET AUTOCOMMIT OFF ;");
        PdoGsb::getPdo()->beginTransaction();
    }
    

    public function testgetNbjustificatifs() {
        $this->assertEquals(0, $this->monPdotest->getNbjustificatifs('a131', '201409'));
    }
    
    public function TestGetLesIdFrais(){
        $lesId = array(
            0 => array (
                'idfrais' =>  'ETP',
                0 => 'ETP'),
            1 => array (
                'idfrais' =>  'KM',
                0 => 'KM'),
            2 => array (
                'idfrais' => 'NUI',
                0 => 'NUI'),
            3 => array (
                'idfrais' => 'REP',
                0 => 'REP'));
        $this->assertEquals($lesId, $this->monPdotest->GetLesIdFrais());
    }
    
     
    
}
