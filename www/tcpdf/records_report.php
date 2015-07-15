<?php
/**
 */
// Set up the appropriate CMS framework
define( '_JEXEC', 1 );
define( 'JPATH_BASE', '/home/a7870400/public_html');

//if (!isset($_SERVER["HTTP_REFERER"])) exit("Direct access not allowed.");
$mosConfig_absolute_path = '/home/a7870400/public_html'; //w:/Work/Site/WebServer/websites';
define( 'DS', DIRECTORY_SEPARATOR );
// Load the framework
require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
//require_once ( JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'methods.php');
//require_once ( JPATH_BASE .DS.'configuration.php' );
require_once ( JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'base'.DS.'object.php');
require_once ( JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'database'.DS.'database.php');
require_once ( JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'database'.DS.'database'.DS.'mysql.php');
require_once ( JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'filesystem'.DS.'folder.php');  
require_once ( JPATH_BASE.'/tcpdf/rus.php');
require_once ( JPATH_BASE.'/tcpdf/tcpdf.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF {

    var $fromEmail, $fromName, $subject;

    function getBookingConfig($nl2br = false) {
  		static $config ;
  		if (!$config) {
  			$db = & JFactory::getDBO();
  			$config = new stdClass ;
  			$sql = 'SELECT * FROM #__eb_configs';
  			$db->setQuery($sql);
  			$rows = $db->loadObjectList();
  			for ($i = 0 , $n = count($rows); $i < $n; $i++) {
  				$row = $rows[$i];
  				$key = $row->config_key;
  				$value = stripslashes($row->config_value);
  				if ($nl2br)
  					$value = nl2br($value); 
  				$config->$key = $value;	
  			}
  		}		
  		return $config;
	  }

    
    function sendReminder() {	
  		/*$sql = 'SELECT a.id, a.first_name, a.last_name, a.email, a.register_date, a.transaction_id, b.id as event_id, b.title AS event_title, b.event_date '
  			.' FROM #__eb_registrants AS a INNER JOIN #__eb_events AS b '
  			.' ON a.event_id = b.id '
  			.' WHERE a.published=1 AND a.is_reminder_sent = 0 AND b.enable_auto_reminder=0 AND (DATEDIFF(b.event_date, NOW()) <= b.remind_before_x_days) AND (DATEDIFF(b.event_date, NOW()) >=0) ORDER BY b.id'
  			.' LIMIT '.$numberEmailSendEachTime
  		;       */
							
	 }
   
   function getEvents() {
      $jconfig = new JConfig();  
      $econfig = $this->getBookingConfig();
      $this->subject = $econfig->reminder_email_subject;
      $this->fromEmail = $jconfig->mailfrom ;
      $this->fromName = $jconfig->fromname ;	
      $db = & JFactory::getDBO();			
      $sql = ' SELECT b.id, b.title FROM #__eb_events AS b '
        .' WHERE b.enable_auto_reminder=0 AND (DATEDIFF(b.event_date, NOW()) <= b.remind_before_x_days) AND (DATEDIFF(b.event_date, NOW()) >=0) ORDER BY b.id'
      ;
    	$db->setQuery($sql) ;		
  		$rows_events = $db->loadObjectList();
      return $rows_events;
   }
   
   function getRegisters($p_data=null) {
        $jconfig = new JConfig();				
        $db = & JFactory::getDBO();			
     		$econfig = $this->getBookingConfig();
        $sql = 'SELECT a.id, a.first_name, a.last_name, a.email, a.register_date, a.transaction_id '
    			.' FROM #__eb_registrants AS a '
          .' WHERE a.event_id = '.$p_data->id
          ; 
    		$db->setQuery($sql) ;		
    		$rows = $db->loadObjectList() ;		

    		$ids = array() ;
    		$replaces = array();
    		for ($i = 0 , $n = count($rows) ; $i < $n ; $i++) {
    			$row = $rows[$i] ;
    			$ids[] = $row->id ;
    			$emailBody = $body ;
     			$replaces[] = array($i+1, $row->first_name, $row->last_name, JHTML::_('date', $row->event_date, $econfig->event_date_format, $param));
    		}
  		return $replaces;	

   }	
  
  // Load table data from file
/*	public function LoadData($file) {
		// Read file lines
		$lines = file($file);
		$data = array();
		foreach($lines as $line) {
			$data[] = explode(';', chop($line));
		}
		return $data; 
	}               */

	// Colored table
	public function ColoredTable($header,$data) {
		// Colors, line width and bold font
		$this->SetFillColor(240, 240, 240);
		$this->SetTextColor(0);
		$this->SetDrawColor(0, 0, 0);
		$this->SetLineWidth(0.2);
		$this->SetFont('', 'B');
		// Header
		$w = array(10, 40, 50, 45);
		$num_headers = count($header);
		for($i = 0; $i < $num_headers; ++$i) {
			$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
		}
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(240, 240, 240);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = 0;
		foreach($data as $row) {
      //print_r($row);
			$this->Cell($w[0], 6, number_format($row[0]), 'LR', 0, 'L', $fill);
      $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
			$this->Cell($w[2], 6, $row[2], 'LR', 0, 'L', $fill);
			$this->Cell($w[3], 6, date_format($dateTime = new DateTime($row[3]),"d.m.Y"), 'LR', 0, 'R', $fill);
			$this->Ln();
			$fill=!$fill;
		}
		$this->Cell(array_sum($w), 0, '', 'T');
	}  
}

  // create new PDF document
  $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  // set default header data
  $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
  
  // set document information
  $pdf->SetCreator(PDF_CREATOR);
  $pdf->SetAuthor('Спортивный Квартал');
  /*$pdf->SetSubject('TCPDF Tutorial');
  $pdf->SetKeywords('TCPDF, PDF, example, test, guide'); */
  

  // set header and footer fonts
  $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
  
  // set default monospaced font
  $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
  //set margins
  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
  
  //set auto page breaks
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
  //set image scale factor
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
  
  //set some language-dependent strings
  $pdf->setLanguageArray($l);

  // set font
  $pdf->SetFont('freeserif', '', 10);

//Column titles
$header = array('№п/п', 'Имя', 'Фамилия', 'Дата регистрации');

//Data loading
$data_events = $pdf->getEvents();
$putts = 0;
foreach($data_events as $data_event) {
  $pdf->AddPage();
  $html = '<h1>'.$data_event->title.'</h1>';
  $pdf->writeHTML($html, true, false, true, false, '');
  if($putts) 
    $pdf->subjectEmail = $pdf->subjectEmail.', ';
  else
    $putts = 1;
   
  $pdf->subjectEmail = $pdf->subjectEmail.$data_event->title;
  $data_registers = $pdf->getRegisters($data_event);
  $pdf->ColoredTable($header, $data_registers);
}
 $pdf->subjectEmail = $pdf->subjectEmail.'.';
$body = str_replace('[EVENT_TITLE]', $pdf->subjectEmail , $pdf->subject);
$fromMail = $pdf->fromEmail;
$toMail = $pdf->fromEmail;
$subject = "Список записанных на занятие";

//Close and output PDF document
$pdf->Output('report_today.pdf', 'F');     // I 

//JUtility::sendMail("sportkvartal@mail.ru", "Спортивный Квартал", "sportkvartal@mail.ru", $pdf->subjectEmail, "Спортивный Квартал", 1, null, null, JPATH_ROOT.DS.'tcpdf'.DS.'report_today.pdf');
JUtility::sendMail($fromMail, "Спортивный Квартал", $toMail, $subject, $body, 1, null, null, JPATH_ROOT.DS.'tcpdf'.DS.'report_today.pdf');
//============================================================+
// END OF FILE                                                
//============================================================+
