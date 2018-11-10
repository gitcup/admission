<?php

//µÑé§¤èÒÃÍº·Õèà»Ô´ÃÑºÊÁÑ¤Ã ãªéªÑèÇ¤ÃÒÇ 2557 à·ÍÁ 1 ÃÍº 3
/*$acadyear = 2553;
$semester = 1;
$round = 2;
$applicanttype = 'A';
$studyperiod = '1';

*/
include("config/connect.php");
  		
		$datenow = date('Y-m-d');
		$studyperiod = '1';
		$strSQL2 =  "SELECT * FROM AVSREG.APPLICANTCALENDAR where openstatus='1' and period = '1' and applicanttype = 'B' and (TO_CHAR(DATEOPENFROM,'YYYY-MM-DD') <= '$datenow' and TO_CHAR(DATEOPENTO,'YYYY-MM-DD') >= '$datenow')";
		
		$objExec2 = odbc_exec($objConnect, $strSQL2) or die ("Error Execute [".$strSQL2."]");
		$objExecNum = odbc_exec($objConnect, $strSQL2) or die ("Error Execute [".$strSQL2."]");
		$rows = odbc_fetch_row($objExecNum);
		
		if($rows > 0)
		{
			 while(odbc_fetch_row($objExec2))
				{
	      //$id = odbc_result($objExec2,"ID");	
	 	  $acadyear = odbc_result($objExec2,"ACADYEAR");
	      $semester = odbc_result($objExec2,"SEMESTER");
		  $round = odbc_result($objExec2,"ROUND");
	      $applicanttype = odbc_result($objExec2,"APPLICANTTYPE");	
		 // $openstatus = odbc_result($objExec2,"OPENSTATUS");
	     // $dateopenfrom = explode(" ",odbc_result($objExec2,"DATEOPENFROM"));	
		 // $dateopento = explode(" ",odbc_result($objExec2,"DATEOPENTO"));	
		  $datemoneyfrom = odbc_result($objExec2,"DATEMONEYFROM");	
		  $datemoneyto = odbc_result($objExec2,"DATEMONEYTO");	
			   }
		 }
		
	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}

	//$strDate = "2008-08-14 13:42:44";
	//echo "ThaiCreate.Com Time now : ".DateThai($strDate);
function admitrbru_sendmail($to_name,$to_email,$from_name,$email_user_send,$email_pass_send,$subject,$body_html,$body_text) {

$mail = new PHPMailer();
$mail -> From     = $email_user_send;
$mail -> FromName = $from_name;

$mail -> AddAddress($to_email,$to_name);
$mail -> Subject	= $subject;
$mail -> Body		= $body_html;
$mail -> AltBody	= $body_text;
$mail -> IsHTML (true);

$mail->IsSMTP();
$mail->Host = 'ssl://smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPAuth		= true;
//$mail->SMTPDebug	= true;
$mail->Username = $email_user_send;
$mail->Password = $email_pass_send;

$mail->Send();
$mail->ClearAddresses();


}
?>
