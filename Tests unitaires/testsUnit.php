<?php
require_once('..\include\class.pdogsb.inc.php');
require_once('..\include\fct.inc.php');
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
             0 => "a131",
            "nom" => "Villechalane",
             1 => "Villechalane",
            "prenom" => "Louis",
             2 => "Louis",
            "profil" => "Visiteur",
            3 => "Visiteur"
            );
        $this->assertEquals($visiteur, $this->monPdotest->getInfosVisiteur('lvillachane', 'jux7g'));
    }
    
   public function testgetVisiteursParDate(){
        $object=new stdClass();
    $lesVisiteursParDate= array(
        0=>array(
            "id" => 'a131',
            0=>"a131",
            "nom"=>'Villechalane',
            1=>"Villechalane",
            "prenom"=>'Louis',
            2=>"Louis"
        ),
        1=>  array(
            "id" => 'a55',
            0=>"a55",
            "nom"=>'Bedos',
            1=>"Bedos",
            "prenom"=>'Christian',
            2=>"Christian"
        )
        );

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
    
    public function testgetLesFraisHorsForfaits(){
 
        $lesFraisHorsForfait=array(
            0=>array(
            "id"=>"13",
                0=>"13",
            "idVisiteur"=>"a55",
                1=>"a55",
            "mois"=>"201705",
                2=>"201705",
            "libelle"=>"Invitation collaboration",
                3=>"Invitation collaboration",
            "date"=>"15/05/2017",
                4=>"2017-05-15",
            "montant"=>"60.00",
                5=>"60.00"
            ));
        $this->assertEquals($lesFraisHorsForfait, $this->monPdotest->getLesFraisHorsForfait("a55","201705"));
    
        }
    public function  testgetLesFraisForfaits(){
        $lesFraisForfait=array(
            0=>array(
                "idfrais"=>"ETP",
                0=>"ETP",
                "libelle"=>"Forfait Etape",
                1=>"Forfait Etape",
                "montant"=>"110.00",
                2=>"110.00",
                "quantite"=>"1",
                3=>"1"  
            ),
            1=>array(
                "idfrais"=>"KM",
                0=>"KM",
                "libelle"=>"Frais Kilométrique",
                1=>"Frais Kilométrique",
                "montant"=>"0.62",
                2=>"0.62",
                "quantite"=>"20",
                3=>"20" 
            ),
            2=>array(
                "idfrais"=>"NUI",
                0=>"NUI",
                "libelle"=>"Nuitée Hôtel",
                1=>"Nuitée Hôtel",
                "montant"=>"80.00",
                2=>"80.00",
                "quantite"=>"1",
                3=>"1" 
            ),
            3=>array(
                "idfrais"=>"REP",
                0=>"REP",
                "libelle"=>"Repas Restaurant",
                1=>"Repas Restaurant",
                "montant"=>"25.00",
                2=>"25.00",
                "quantite"=>"3",
                3=>"3" 
            )
        );
         $this->assertEquals($lesFraisForfait, $this->monPdotest->getLesFraisForfait("a55","201705"));
    
        
        
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
