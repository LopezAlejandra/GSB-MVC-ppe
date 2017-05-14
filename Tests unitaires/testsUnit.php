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
//        PdoGsb::getPdo()->exec("SET AUTOCOMMIT OFF ;");
        // PdoGsb::getPdo()->beginTransaction();
    }
    public function testgetInfosVisiteur(){
        $visiteur = array (
            "id" => "a131",
            "nom" => "Villechalane",
            "prenom" => "Louis",
            "profil" => "Visiteur",
            "0" => "a131",
            "1" => "Villechalane",
            "2" => "Louis",
            "3" => "Visiteur"
            );
        $this->assertEquals($visiteur, $this->monPdotest->getInfosVisiteur('lvillachane', 'jux7g'));
    }
    
   public function testgetVisiteursParDate(){
        $lesVisiteursParDate=array(
                                    0 =>array(
                                        "id"=>"a131",
                                        "nom"=>"Villechalane",
                                        "prenom"=>"Louis",
                                       ) ,
                                    1=>array(
                                        "id"=>"a55",
                                       "nom"=>"Bedos",
                                       "prenom"=>"Christian",
                                       ));
        $this->assertEquals($lesVisiteursParDate, $this->monPdotest->getVisiteursParDate("201705"));
    }
    

   /** public function testgetNbjustificatifs() {
        $this->assertEquals(0, $this->monPdotest->getNbjustificatifs('a131', '201409'));
    }**/

 
    
    public function testgetLesInfosFicheFrais(){
        $fiche=array(
            "idVisiteur"=>"a131",
            "mois"=>"201705",
            "idEtat"=>"CR",
            "dateModif"=>"2017-05-14",
            "nbJustificatifs"=>"0",
            "montantValide"=>"0.00",
            "libEtat"=>"Fiche créée, saisie en cours",
            0=>"a131",
            1=>"201705",
            2=>"CR",
            3=>"2017-05-14",
            4=>"0",
            5=>"0.00",
            6=>"Fiche créée, saisie en cours"
          );
        $this->assertEquals($fiche, $this->monPdotest->getLesInfosFicheFrais("a131",'201705'));
        
        
    }
    
    public function testgetLesIdFrais(){
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
        $this->assertEquals($lesId, $this->monPdotest->getLesIdFrais());
    }
    
    
     
    
}
