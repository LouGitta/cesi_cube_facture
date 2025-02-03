<?php
namespace App\Service;

use TCPDF;

class Generateur
{
    public function generateInvoice($invoiceData): string
    {
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Votre Entreprise');
        $pdf->SetTitle('Facture');
        $pdf->SetSubject('Facture client');
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);

        
        $html = '<table width="100%">
                    <tr>
                        <td><img src="logo.png" width="100"></td>
                        <td align="right">
                            <h2>VOTRE ENTREPRISE</h2>
                            <p>Adresse<br>Email: contact@entreprise.com<br>Téléphone: 01 23 45 67 89</p>
                        </td>
                    </tr>
                 </table>
                 <hr>';

       
        $html .= "<h2>Facture #{$invoiceData['id']}</h2>
                  <p><strong>Date:</strong> {$invoiceData['date']}<br>
                  <strong>Client:</strong> {$invoiceData['client']}<br>
                  <strong>Email:</strong> {$invoiceData['email']}</p>
                  <hr>";

       
        $html .= '<table border="1" cellpadding="5" cellspacing="0" width="100%">
                    <tr style="background-color:#f2f2f2;">
                        <th>Description</th>
                        <th>Quantité</th>
                        <th>Prix Unitaire</th>
                        <th>Total</th>
                    </tr>';

        $total = 0;
        foreach ($invoiceData['items'] as $item) {
            $lineTotal = $item['quantity'] * $item['price'];
            $total += $lineTotal;
            $html .= "<tr>
                        <td>{$item['description']}</td>
                        <td align='center'>{$item['quantity']}</td>
                        <td align='right'>{$item['price']}€</td>
                        <td align='right'>{$lineTotal}€</td>
                      </tr>";
        }

        $html .= '</table>';

    
        $html .= "<hr>
                  <table width='100%'>
                    <tr>
                        <td></td>
                        <td align='right'>
                            <h3>Total: {$total}€</h3>
                        </td>
                    </tr>
                  </table>
                  <p>Merci pour votre commande !</p>";

        $pdf->writeHTML($html);
        $pdfPath = 'factures/facture_' . $invoiceData['id'] . '.pdf';
        $pdf->Output($pdfPath, 'F');

        return $pdfPath;
    }
}
