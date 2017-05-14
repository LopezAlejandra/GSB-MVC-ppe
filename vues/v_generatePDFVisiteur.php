<?php
function creerPDFFiche($lesFraisHorsForfait,$lesFraisForfaits){
    $listeMois = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre','Décembre'];
    $mois = $_REQUEST['leMois'];
    $nom=$_SESSION['nom'];
    $prenom=$_SESSION['prenom'];
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . "fpdf" . DIRECTORY_SEPARATOR . "fpdf.php";
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->Image("images/logo.jpg", 77, 10, 50, 36);
    $pdf->SetFont('Arial', 'B', 24);
    $pdf->Cell(0, 100, utf8_decode("Remboursement de frais engages"), 0, 0, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(60);
    //Fiche Visiteur
    $pdf->Cell(50, 10, "Visiteur", 0, 0, 'L');
    $pdf->Cell(50, 10, utf8_decode(($nom . ' ' . $prenom)));
    $pdf->Ln(10);
    $pdf->Cell(50, 10, "Mois", 0, 0, 'L');
    $pdf->Cell(50, 10, $listeMois[date('n', strtotime("01-" . substr($mois, 4, 2) . '-' . substr($mois, 0, 4))) - 1 ] . ' ' . substr($mois, 0, 4), 0, 0, 'C');
    $pdf->Ln(20);
    // Frais forfaitaires
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(45, 10, "Frais Forfaitaires", 1, 0, 'C');
    $pdf->Cell(45, 10, utf8_decode("Quantité"), 1, 0, 'C');
    $pdf->Cell(45, 10, "Montant Unitaire", 1, 0, 'C');
    $pdf->Cell(45, 10, "Total", 1, 0, 'C');
    $pdf->Ln(10);
    $totalFraisForfaits=0;
    foreach ($lesFraisForfaits as $fraisF){
        $pdf->Cell(45,10,$fraisF['libelle'],1,0,'C');
        $pdf->Cell(45,10,$fraisF['quantite'],1,0,'C');
        $pdf->Cell(45,10,$fraisF['montant'],1,0,'C');
        $pdf->Cell(45,10,$totalFraisForfaits+=$fraisF['quantite']*$fraisF['montant']."€",1,0,'C');
        $pdf->Ln(10);
    }
    $totalFraisHorsForfait = 0;
    $pdf->Ln(20);
    // Position en x avec 3 colonnes
    $pdf->Cell(180,10,"Autres Frais",1,0,'C');
    $pdf->Ln(10);
    $pdf->Cell(60, 10, "Date", 1, 0, 'C');
    $pdf->Cell(60, 10, "Libelle", 1, 0, 'C');
    $pdf->Cell(60, 10, "Montant", 1, 0, 'C');
    $pdf->Ln(10);
    foreach($lesFraisHorsForfait as $fraisHF){
        $pdf->Cell(60, 10, $fraisHF['date'], 1, 0, 'C');
        $pdf->Cell(60, 10, utf8_decode($fraisHF['libelle']), 1, 0, 'C');
        $pdf->Cell(60, 10, $fraisHF['montant'], 1, 0, 'C');
        $pdf->Ln(10);
        $totalFraisHorsForfait += $fraisHF['montant'];
    }
    $total=$totalFraisForfaits+$totalFraisHorsForfait;
    $pdf->Ln(10);
    $pdf->SetX($pdf->_getpageformat('A4')[0] -120);
    $pdf->Cell(50, 10, 'Total', 1, 0, 'C');
    $pdf->Cell(50, 10, $total, 1, 0, 'C');
    //Signature
    $pdf->Ln(20);
    $pdf->SetX($pdf->_getpageformat('A4')[0] - 70);
    $pdf->Cell(50, 10, utf8_decode('Fait à Paris le ' . date('j') . ' ' . $listeMois[date('n') - 1] . ' ' . date('Y')));
    $pdf->Ln(10);
    $pdf->SetX($pdf->_getpageformat('A4')[0] - 70);
    $pdf->Cell(50, 10, utf8_decode('Vu l\'agent comptable'));
    $pdf->Ln(10);
    $pdf->SetX($pdf->_getpageformat('A4')[0] - 70);
    $pdf->Cell(50, 10, utf8_decode(strtoupper('signature')));
    $pdf->Ln(5);
   //$pdf->Image("images/signature.jpg",40,40,40,36);
    $pdf->Image('images/signature.jpg',30); 
    ob_end_clean();
    $pdf->Output();
}
?>