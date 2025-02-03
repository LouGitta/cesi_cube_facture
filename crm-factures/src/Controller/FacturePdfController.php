<?php

namespace App\Controller;

use App\Entity\Facture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use TCPDF;

#[Route('/facture/pdf')]
class FacturePdfController extends AbstractController
{
    #[Route('/{id}', name: 'app_facture_pdf', methods: ['GET'])]
    public function generatePdf(Facture $facture): Response
    {
        // Création du PDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Votre Entreprise');
        $pdf->SetTitle('Facture ' . $facture->getNum());
        $pdf->SetSubject('Facture');
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();

        // Titre
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'Facture ' . $facture->getNum(), 0, 1, 'C');

        // Infos client
        $client = $facture->getClient();
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, 'Client : ' . $client->getCompany(), 0, 1);
        $pdf->Cell(0, 10, 'Nom : ' . $client->getName(), 0, 1);
        $pdf->Cell(0, 10, 'Email : ' . $client->getEmail(), 0, 1);

        // Ligne séparation
        $pdf->Ln(5);
        $pdf->Cell(0, 10, 'Détails de la facture:', 0, 1, 'L');
        $pdf->Ln(5);

        // Tableau
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(60, 10, 'Description', 1);
        $pdf->Cell(40, 10, 'Prix Unitaire', 1);
        $pdf->Cell(20, 10, 'Quantité', 1);
        $pdf->Cell(30, 10, 'Total', 1);
        $pdf->Ln();

        foreach ($facture->getLignes() as $ligne) {
            $pdf->Cell(60, 10, $ligne->getInfo1(), 1);
            $pdf->Cell(40, 10, number_format($ligne->getPrix(), 2, ',', ' ') . ' €', 1);
            $pdf->Cell(20, 10, $ligne->getQuantite(), 1);
            $pdf->Cell(30, 10, number_format($ligne->getTotal(), 2, ',', ' ') . ' €', 1);
            $pdf->Ln();
        }

        // Totaux
        $pdf->Ln(5);
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 10, 'Total HT : ' . number_format($facture->getHt(), 2, ',', ' ') . ' €', 0, 1, 'R');
        $pdf->Cell(0, 10, 'TVA : ' . number_format($facture->getTva(), 2, ',', ' ') . ' €', 0, 1, 'R');
        $pdf->Cell(0, 10, 'Total TTC : ' . number_format($facture->getTtc(), 2, ',', ' ') . ' €', 0, 1, 'R');

        // Génération du PDF
        $pdfContent = $pdf->Output('', 'S');

        // Retourner le fichier PDF
        return new Response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="facture_' . $facture->getNum() . '.pdf"',
        ]);
    }
}
