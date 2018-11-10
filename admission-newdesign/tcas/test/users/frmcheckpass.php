<?	session_start();
include "check_session.php";
include("../config/connect.php"); ?>
<? include("../sysconfig.php");  
	include("../sysmail.php"); 
	include ("gmail/class.phpmailer.php");
	
?>

<? //
	  $checkdate = date('j/n/Y H:i:s'); //วันที่ปัจจุบัน  format  21/3/2011 เวลา
	  $applicantid = $_POST[applicantid];	
	  $check = $_POST[check];
	  $checkback = $_POST[chk];
	  $re_acadyear = $_POST[lstacadyear];	
	  $re_semester = $_POST[lstsemester];
	  $re_type = $_POST[lsttype];
	  $re_round = $_POST[txt_round];
	  $npage = $_GET[npage];	
?>
<?		if($check=="yes") {
        if(!empty($applicantid))
        		{
     		 $sqlUpY = "UPDATE AVSREG.APPLICANT SET APPLICANTSTATUS = '10' WHERE APPLICANTID = '$applicantid'";
		     $objUpY = odbc_exec($objConnect, $sqlUpY) or die ("Error Execute [".$sqlUpY."]");
			 
			$sqlUpdate = "UPDATE AVSREG.APPLICANTDOC SET CHKDATE = to_date('$checkdate','dd/mm/yyyy HH24:MI:SS') WHERE APPLICANTID = '$applicantid'";
		    $objUpdate = odbc_exec($objConnect, $sqlUpdate) or die ("Error Execute [".$sqlUpdate."]");
			 
			 $strSEL = "SELECT APPLICANT.APPLICANTID, APPLICANT.APPLICANTCODE, APPLICANT.APPLICANTNAME, APPLICANT.APPLICANTSURNAME, APPLICANT.APPLICANTMAIL FROM AVSREG.APPLICANT WHERE (((APPLICANT.APPLICANTID)='$applicantid'))";
	$resultSEL = odbc_exec($objConnect, $strSEL) or die ("Error Execute [".$strSEL."]");
	while($objSEL = odbc_fetch_row($resultSEL))
	{
		$applicantcode = odbc_result($resultSEL,"applicantcode");	
		$applicantname = odbc_result($resultSEL,"applicantname");			
		$to_email = odbc_result($resultSEL,"applicantmail");		
		$applicantsurname = odbc_result($resultSEL,"applicantsurname");	
		$applicantname_cv = iconv( "TIS-620","UTF-8","$applicantname");
		$applicantsurname_cv = iconv( "TIS-620","UTF-8","$applicantsurname");		
		
	}
		$to_name = $applicantname_cv."  ".$applicantsurname_cv;
		$body_html = "รหัสผู้สมัคร ".$applicantcode."<br> ชื่อผู้สมัคร  ".$applicantname_cv."  ".$applicantsurname_cv."<br><br> เจ้าหน้าที่รับสมัครได้ตรวจสอบหลักฐานเป็น<font color=\"green\">  ++ ผ่าน ++ </font> เรียบร้อยแล้ว สามารถพิมพ์แบบฟอร์มการชำระเงินได้ตาม Link ด้านล่างนี้<br>"." <a href= \"http://assess.rbru.ac.th/admitrbru/pay_entry.php?m=true&appid=$applicantid\" target='_blank'> http://assess.rbru.ac.th/admitrbru/pay_entry.php?m=true&appid=$applicantid </a> <br><br> หรือตรวจสอบสถานะผู้สมัครได้ตาม Link นี้<br>"."<a href=\"http://assess.rbru.ac.th/admitrbru/index.php?p=frmApplicant_detail&m=true&appid=$applicantid\" target='_blank'>http://assess.rbru.ac.th/admitrbru/index.php?p=frmApplicant_detail&m=true&appid=$applicantid</a>"."<br><br><br><br><h3>ติดต่อสอบถาม กองบริการการศึกษา</h3><br>โทร. 0-3931-9111 ต่อ 8401-2<br>";
		
			 admitrbru_sendmail($to_name,$to_email,$from_name,$email_user_send,$email_pass_send,$subject,$body_html,$body_text);
			 
             echo "<div align='center'><strong>ปรับสถานะผู้สมัครเป็น ผ่าน เรียบร้อยแล้ว</strong></div>";
             if($checkback <> '1') {
			 echo "<meta http-equiv='refresh' content='2;URL=index.php?p=frmApplicant_check&lstacadyear=$re_acadyear&lstsemester=$re_semester&lsttype=$re_type&txt_round=$re_round' />";
			 							} else {
						 echo "<meta http-equiv='refresh' content='2;URL=index.php?p=frmApplicant_checkunPass&lstacadyear=$re_acadyear&lstsemester=$re_semester&lsttype=$re_type&txt_round=$re_round' />";
										
										}
       			}  
		} 		

	?>