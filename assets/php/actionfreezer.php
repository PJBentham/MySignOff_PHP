<?php
header("Access-Control-Allow-Origin: *");
header("Location: http://www.mysignoff.co.uk/TSF/freezer/upload.php?sub=1");
//If this code is used please leave this header in place
//Written by Paul Bentham, pjbentham@gmail.com
set_time_limit(0);
ignore_user_abort(1);
ini_set('memory_limit','512M');
error_reporting(E_ALL); 
ini_set('display_errors', 1);

require_once('fpdf/fpdf.php');
require_once('phpmailer/PHPMailer-master/class.phpmailer.php');
include("../includes/data.php");

//$ProjectName = "Project name:  ".$_POST["ProjectName"]."\n";
$Date1 = "Date:  ".$_POST["Date1"]."\n";
//$StoreName = "Store name:  ".$_POST["StoreName"]."\n";
$StoreNumber = "Store number:  ".$_POST["StoreNumber"]."\n";
$Fittercom = "State how many shelves only recieved T-Rails:\n".$_POST["FitterComments"]."\n";
$revisit = "A re-visit is required to resolve outstanding issues (If a Revisit is required Scorecard automatic Red):\n".$_POST["revisit"]."\n";
$reviscom = "Comments:\n".$_POST["reviscom"]."\n\n";
$fittrade = "Store handed back fit for trade, with no snags reported (If False, please record snags in comments), i.e. all waste/materials cleared from site, fixtures clean and ready for merchandising, the area is fit for trade:\n".$_POST["fittrade"]."\n";
$fitcom = "Comments:\n".$_POST["fitcom"]."\n\n";
$kitleft = "Confirm that the 'equipment left behind' checklist has been completed (take a photo of the kit in its left location. Email the photo to markrobinson@tsf.uk.com):\n".$_POST["eqlb"]."\n";
$kitleftcom = "Equipment comments:\n".$_POST["eqlbcom"]."\n\n";
$permit = "The Permit To Work and Visitor Sign-In Book has been completed?:\n".$_POST["permit"]."\n";
$permitcom = "Comments:\n".$_POST["permitcom"]."\n\n";
$dressed = "The supplier / fitter was suitablly dressed, polite, worked professionally at all times and there was no unplanned disruption to the store.\n".$_POST["dressed"]."\n";
$dressedcom = "Comments:\n".$_POST["dressedcom"]."\n\n";
$disruption = "Disruption signage displayed on hoarding (if not applicable, mark as True):\n".$_POST["disruption"]."\n";
$disruptioncom = "Comments:\n".$_POST["disruptioncom"]."\n";
$called = "The supplier contacted the store to arrange a time and the fitter arrived at the agreed time:\n".$_POST["called"]."\n";
$calledcom = "Comments:\n".$_POST["calledcom"]."\n\n";
$wgll = "The completed work reflects the 'What Good Looks Like' photograph? (if WGLL photograph not available, you agreed the work has been delivered to an acceptable standard):\n".$_POST["wgll"]."\n";
$wgllcom = "Comments:\n".$_POST["wgllcom"]."\n\n";
$workplan = "The store received a Workplan prior to installation about this project. Or, you were visited to inform you of the works and given accurate information:\n".$_POST["workplan"]."\n";
$workplancom = "Comments:\n".$_POST["workplancom"]."\n\n";
$complete = "Any outstanding next steps from the pre-visit were completed. (If no tasks required, then mark True):\n".$_POST["complete"]."\n";
$completecom = "Comments:\n".$_POST["completecom"]."\n\n";
$spares = "The store recieved and is in possesion of the spares Frozen Pushers kit parts, provided by the installer:\n".$_POST["spares"]."\n";
$sparescom = "Comments:\n".$_POST["sparescom"]."\n\n";
$champion = "Please confirm you are the Store Champion for this project:\n".$_POST["champion"]."\n";
$championcom = "Comments:\n".$_POST["championcom"]."\n\n";
$trails = "Every shelf has had T-rails installed, including discretionary and clearance mods:\n".$_POST["trails"]."\n";
$trailscom = "Comments:\n".$_POST["trailscom"]."\n\n";
$generalcom = "Comments:\n".$_POST["GeneralComments"]."\n\n";
$Name = "Print Name:\t".$_POST["Name"]."\n";
$JobTitle = "Job Title:\t".$_POST["JobTitle"]."\n\n";
$Date2 = "Date of Signature:\t".$_POST["Date2"]."\n\n";
$Trafficlight = "Job Score:\n".$_POST["Trafficlight"]."\n";
$allinfo = $Date1.$StoreNumber.$Fittercom."\n".$revisit.$reviscom.$fittrade.$fitcom.$kitleft.$kitleftcom.$permit.$permitcom.$dressed.$dressedcom.$disruption.$disruptioncom.$called.$calledcom.
$wgll.$wgllcom.$workplan.$workplancom.$complete.$completecom.$spares.$sparescom.$champion.$championcom.$trails.$trailscom.$generalcom."\n".$Name.$JobTitle.$Date2.$Trafficlight."\n";

// make sure the image-data exists and is not empty
// php is particularly sensitive to empty image-data 
if ( isset($_POST["signature"]) && !empty($_POST["signature"]) ) {    
    // get the dataURL
    $dataURL = $_POST["signature"];  
    // the dataURL has a prefix (mimetype+datatype) 
    // that we don't want, so strip that prefix off
    $parts = explode(',', $dataURL);  
    $data = $parts[1];  
    // Decode base64 data, resulting in an image
    $data = base64_decode($data);  
    // create a temporary unique file name
    $file = uniqid() . '.png';
    // write the file to the upload directory
    $success = file_put_contents($file, $data);
    // return the temp file name (success)
    // or return an error message just to frustrate the user (kidding!)
    // print $success ? $file."<br>" : 'Unable to save this image.';
};

// //Create First page of PDF:
$pdf = new FPDF();
$pdf->AddPage('P','A4');
$pdf->SetFont('Helvetica','B',10);
$pdf->Image('Tesco_Express.png',10,10,50,30,'png');
$pdf->SetXY(70,28);
$pdf->Cell(0,0,"TSF Retail Solutions",0,0,'C');
$pdf->SetXY(70,40);
$pdf->Cell(0,0,"Tesco Quality Scorecard for Installation Projects",0,0,'C');
$pdf->SetY(60);
$pdf->Write(5,$allinfo);
//Add signature to PDF;
if(! empty($_POST["signature"])){
$pdf->Image($file,null,null,0,0,'png');
};
unlink($file); 
//Delete signature

//Add another page to the PDF and add picture
$pdf->AddPage('P','A4');
$allowedExts = array("gif", "jpeg", "jpg", "JPG", "JPEG", "PNG","png");
$pictures = array("file1");
$counter = 10;
foreach ($pictures as $value)
  {
  $temp = explode(".", $_FILES[$value]["name"]);
  $extension = end($temp);	
  if ( ! empty($_FILES[$value]["tmp_name"])
  && in_array($extension, $allowedExts))
  {
    move_uploaded_file($_FILES[$value]["tmp_name"],$_FILES[$value]["name"]);
    $pdf->Image($_FILES[$value]["name"],25,$counter,80,80);
    unlink($_FILES[$value]["name"]);
    $counter += 90;
  };
};

$pdf->Output("../../TSF/freezer/".$_POST["StoreNumber"].'.pdf', 'F');

//Add the signoff to the database
$signoff = "../../TSF/freezer/".$_POST["StoreNumber"].'.pdf';
addFreezerSignOff($db, $signoff, $_POST["Date1"], $_POST["StoreNumber"], "Freezer Pusher", "fitter 1", $_POST["eqlb"], $_POST["revisit"], $_POST["fittrade"], $_POST["permit"], $_POST["dressed"], $_POST["disruption"], $_POST["called"], $_POST["wgll"], $_POST["workplan"], $_POST["complete"], $_POST["spares"], $_POST["champion"], $_POST["trails"], $_POST["Name"], $_POST["JobTitle"], $_POST["Trafficlight"]);

?>