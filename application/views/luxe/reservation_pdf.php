<?php
include(APPPATH.'core/fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
                
    }

    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'',0,0,'C');
    }

    function WordWrap(&$text, $maxwidth)
    {
        $text = trim($text);
        if ($text==='')
            return 0;
        $space = $this->GetStringWidth(' ');
        $lines = explode("\n", $text);
        $text = '';
        $count = 0;

        foreach ($lines as $line)
        {
            $words = preg_split('/ +/', $line);
            $width = 0;

            foreach ($words as $word)
            {
                $wordwidth = $this->GetStringWidth($word);
                if ($wordwidth > $maxwidth)
                {
                    for($i=0; $i<strlen($word); $i++)
                    {
                        $wordwidth = $this->GetStringWidth(substr($word, $i, 1));
                        if($width + $wordwidth <= $maxwidth)
                        {
                            $width += $wordwidth;
                            $text .= substr($word, $i, 1);
                        }
                        else
                        {
                            $width = $wordwidth;
                            $text = rtrim($text)."\n".substr($word, $i, 1);
                            $count++;
                        }
                    }
                }
                elseif($width + $wordwidth <= $maxwidth)
                {
                    $width += $wordwidth + $space;
                    $text .= $word.' ';
                }
                else
                {
                    $width = $wordwidth + $space;
                    $text = rtrim($text)."\n".$word.' ';
                    $count++;
                }
            }
            $text = rtrim($text)."\n";
            $count++;
        }
        $text = rtrim($text);
        return $count;
    }

    function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));
        return $data;
    }
    
    function FancyTable($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Header
        $w = array(40, 35, 40, 45);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row['guest_name'],'LR',0,'L',$fill);
            $this->Cell($w[1],6,$row['checkin'],'LR',0,'L',$fill);
            $this->Cell($w[2],6,$row['total_room'],'LR',0,'L',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }
}


$pdf = new PDF();
$pdf->AddPage();

$pdf->SetFont('Arial','BIU',12);
$pdf->Cell(80);
$pdf->Cell(30,10,'BUKTI RESERVASI',0,0,'C');
$pdf->Ln(0);

$pdf->SetFont('Arial','',12);

$pdf->Cell(65);
$pdf->Cell(60,30,'Tanggal Reservasi: '.indonesian_date(date('Y-m-d', $reservation['created_at'])),0,1,'C');

$pdf->Cell(65);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(60,0,'Kode Reservasi: '.$reservation['reservation_code'],0,1,'C');

$pdf->Ln(12);

// $header = array('Nama Tamu', 'Check In/Out', 'Jumlah dan Tipe Kamar');

// $pdf->SetFont('Arial','',14);
// $pdf->FancyTable($header,$reservation);

$pdf->SetFont('Arial','B',12);

$width_cell=array(70,40,25,30);
$pdf->SetFillColor(193,229,252); // Background color of header 
// Header starts /// 
$pdf->Cell($width_cell[0],10,'Nama Tamu',1,0,'C',true); // First header column 
$pdf->Cell($width_cell[1],10,'Check In/Out',1,0,'C',true); // Second header column
$pdf->Cell($width_cell[2],10,'Jumlah',1,0,'C',true); // Third header column 
$pdf->Cell($width_cell[3],10,'Tipe Kamar',1,1,'C',true); // Fourth header column
//// header is over ///////

$pdf->SetFont('Arial','',10);
// First row of data 
$pdf->Cell($width_cell[0],10,$reservation['guest_name'],1,0,'C',false); // First column of row 1 
$pdf->Cell($width_cell[1],10,indonesian_date(substr_replace(substr_replace($reservation['checkin'], '-', 4, 0), '-', 7, 0)),1,0,'C',false); // Second column of row 1 
$pdf->Cell($width_cell[2],10,$reservation['total_room'].' Kamar',1,0,'C',false); // Third column of row 1 
$pdf->Cell($width_cell[3],10,$reservation['room_name'],1,1,'C',false); // Fourth column of row 1 
//  First row of data is over 
$pdf->Cell($width_cell[0],10,'',1,0,'C',false); // First column of row 1 
$pdf->Cell($width_cell[1],10,indonesian_date(substr_replace(substr_replace($reservation['checkout'], '-', 4, 0), '-', 7, 0)),1,0,'C',false); // Second column of row 1 
$pdf->Cell($width_cell[2],10,'',1,0,'C',false); // Third column of row 1 
$pdf->Cell($width_cell[3],10,'',1,1,'C',false); // Fourth column of row 1 


$pdf->Output();

$pdf->Output();