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
        // PdoGsb::getPdo()->exec("SET AUTOCOMMIT OFF ;");
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
    
    public function testgetLesMoisNonValides(){
        $lesMoisNonValides=array(
            0=>array(
                "mois"=>"201704",
                0=>"201704"
            ),
            1=>array(
                "mois"=>"201705",
                0=>"201705"
            )
        );
        $this->assertEquals($lesMoisNonValides, $this->monPdotest->getLesMoisNonValides());
    
        
    }
    
   public function testgetVisiteursParDate(){
       
    $lesVisiteursParDate=[];
    $lesVisiteursParDate[] = ['id' => 'a93', 'nom' => 'Tusseau', 'prenom' => 'Louis'];// Indice 0
    $lesVisiteursParDate[] = ['id' => 'b34', 'nom' => 'Cadic', 'prenom' => 'Eric']; // Indice 1
        $tabObjetsTypeVisiteur=[];
      
        foreach ($lesVisiteursParDate as $unVisiteur){
            $objet=new stdClass();
            $objet->id=$unVisiteur['id'];
            $objet->nom=$unVisiteur['nom'];
            $objet->prenom=$unVisiteur['prenom'];
            $tabObjetsTypeVisiteur[]=$objet;
        }
        $this->assertEquals($tabObjetsTypeVisiteur,$this->monPdotest->getVisiteursParDate("201704"));
        }
       

 
    
    public function testgetLesInfosFicheFrais(){
        $fiche=array(
            "idVisiteur"=>"a131",
            0=>"a131",
            "mois"=>"201705",
            1=>"201705",
            "idEtat"=>"VA",
            2=>"VA",
            "dateModif"=>"2017-05-14",
             3=>"2017-05-14",
            "nbJustificatifs"=>"0",
            4=>"0",
            "montantValide"=>"0.00",
            5=>"0.00",
            "libEtat"=>"Validée et mise en paiement",
            6=>"Validée et mise en paiement"
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
    
    public function testEstPremierFraisMois(){
        $idVisiteur1="a55";
        $idVisiteur2="b13";
        $mois="201705";
        $this->assertFalse($this->monPdotest->estPremierFraisMois($idVisiteur1,$mois));
        $this->assertTrue($this->monPdotest->estPremierFraisMois($idVisiteur2,$mois));
    }
     
    
}
