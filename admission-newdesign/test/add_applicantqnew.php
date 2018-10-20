<?php	session_start();?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
include("config/connect.php");
include("sysconfigqnew.php");
include("sysmail.php"); 
	include ("users/gmail/class.phpmailer.php");
	
function checkPID($pid) {
   if(strlen($pid) != 13) return false;
      for($i=0, $sum=0; $i<12;$i++)
      $sum += (int)($pid{$i})*(13-$i);
      if((11-($sum%11))%10 == (int)($pid{12}))
      return true;
   return false;
}

//capcha
$captcha = $_POST["captcha"];
$txtcaptcha = $_POST["txtcaptcha"];
//-------------

$prefixid 	= $_POST["prename"];	$_SESSION["prefixid_sess"] = $prefixid;		
$schoolid	= $_POST["txtSCHOOLID_1"];	$_SESSION["schoolid_sess"] = $schoolid;		
$schoolname	= $_POST["txtSCHOOLNAME_1"];	$_SESSION["schoolname_sess"] = $schoolname;		
$programtype = $_POST["entrydegree"];	$_SESSION["programtype_sess"] = $programtype;		
$applicantname 	= $_POST["name"];	$_SESSION["name_sess"] = $applicantname;		
$applicantsurname	= $_POST["surname"];	$_SESSION["surname_sess"] = $applicantsurname;		
$citizenid	= $_POST["citizen"];	$_SESSION["citizenid_sess"] = $citizenid;		
$address = $_POST["address"];	$_SESSION["address_sess"] = $address;		
$address2 = $_POST["address2"];	$_SESSION["address2_sess"] = $address2;		
$address3 = $_POST["address3"];	$_SESSION["address3_sess"] = $address3;		
$province = $_POST["province"];	$_SESSION["province_sess"] = $province;		
$zipcode = $_POST["zipcode"];	$_SESSION["zipcode_sess"] = $zipcode;		
$homephoneno = $_POST["mobile"];	$_SESSION["mobile_sess"] = $mobile;		
$gpax = $_POST["gpa"];	$_SESSION["gpax_sess"] = $gpax;		
$email = $_POST["email"];	$_SESSION["email_sess"] = $email;		
$qcode1 = $_POST["txtQUOTASTATUSID_1"];	$_SESSION["qcode1_sess"] = $qcode1;
$qcode2 = $_POST["txtQUOTASTATUSID_2"];	$_SESSION["qcode2_sess"] = $qcode2;
$qcode3 = $_POST["txtQUOTASTATUSID_3"];	$_SESSION["qcode3_sess"] = $qcode3;
$qcode4 = $_POST["txtQUOTASTATUSID_4"];	$_SESSION["qcode4_sess"] = $qcode4;
$ccode1 = $_POST["txtQUOTACODE_1"];	$_SESSION["ccode1_sess"] = $ccode1;
$ccode2 = $_POST["txtQUOTACODE_2"];	$_SESSION["ccode2_sess"] = $ccode2;
$ccode3 = $_POST["txtQUOTACODE_3"];	$_SESSION["ccode3_sess"] = $ccode3;
$ccode4 = $_POST["txtQUOTACODE_4"];	$_SESSION["ccode4_sess"] = $ccode4;
$qname1 = $_POST["txtQUOTANAME_1"];	$_SESSION["qname1_sess"] = $qname1;
$qname2 = $_POST["txtQUOTANAME_2"];	$_SESSION["qname2_sess"] = $qname2;
$qname3 = $_POST["txtQUOTANAME_3"];	$_SESSION["qname3_sess"] = $qname3;
$qname4 = $_POST["txtQUOTANAME_4"];	$_SESSION["qname4_sess"] = $qname4;
$labb1 = $_POST["txtLEVELABB_1"];	$_SESSION["labb1_sess"] = $labb1;
$labb2 = $_POST["txtLEVELABB_2"];	$_SESSION["labb2_sess"] = $labb2;
$labb3 = $_POST["txtLEVELABB_3"];	$_SESSION["labb3_sess"] = $labb3;
$labb4 = $_POST["txtLEVELABB_4"];	$_SESSION["labb4_sess"] = $labb4;
$applicantname_cv = iconv( "UTF-8","TIS-620","$applicantname");
$applicantsurname_cv = iconv( "UTF-8","TIS-620","$applicantsurname");
$address_cv = iconv( "UTF-8","TIS-620","$address");
$address2_cv = iconv( "UTF-8","TIS-620","$address2");
$address3_cv = iconv( "UTF-8","TIS-620","$address3");
   
if(isset($_POST['citizen'])) {
   if(checkPID($_POST['citizen'])) {
   //echo "รหัสถูกต้องครับ";
   //exit();
   } else {
   echo "<script language='javascript'>";
	echo "alert('หมายเลขบัตรประจำตัวประชาชน ไม่ถูกต้อง')";
	echo "</script>";
	echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmRegister1qnew\">";
	exit();
}
}

if($captcha != $txtcaptcha)
{
    
	echo "<script language='javascript'>";
	echo "alert('ตัวอักษรที่คุณใส่ไม่ถูกต้อง กรุณาใส่อีกครั้ง')";
	echo "</script>";
	echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmRegister1qnew\">";
	exit();
}

$strSQLci = "SELECT APPLICANT.APPLICANTID, APPLICANT.APPLICANTCODE, APPLICANTSELECTION.SEQUENCE FROM AVSREG.APPLICANT INNER JOIN AVSREG.APPLICANTSELECTION ON APPLICANT.APPLICANTID = APPLICANTSELECTION.APPLICANTID WHERE (((APPLICANT.CITIZENID)='$citizenid') and ((APPLICANT.ACADYEAR)='$acadyear') and ((APPLICANT.SEMESTER)='$semester') and ((APPLICANT.APPLICANTTYPE)='$applicanttype') and ((APPLICANT.APPLICANTMETHOD)='W')and ((APPLICANT.ROUND)='$round') and ((APPLICANTSELECTION.QUOTASTATUSID)='$qcode1') and ((APPLICANTSELECTION.SELECTIONSTATUS)='10') and ((APPLICANTSELECTION.SEQUENCE)='1'))";
$resultci1 = odbc_exec($objConnect, $strSQLci) or die ("Error Execute [".$strSQLci."]");
$resultci = odbc_exec($objConnect, $strSQLci) or die ("Error Execute [".$strSQLci."]");
$rows = odbc_fetch_row($resultci1);
if($rows > 0) {
while(odbc_fetch_row($resultci))
	{
		$s_code = odbc_result($resultci,"applicantcode");
	}
	echo "<script language='javascript'>";
	echo "alert('ผู้สมัครทำการสมัครแล้ว โปรดใช้เมนู แก้ไขข้อมูลการสมัคร รหัสผู้สมัครเดิมของท่านคือ $s_code')";
	echo "</script>";
	echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmEditApplicant\">";
	exit();
	}

$strSQL = "SELECT QUOTASTATUS.STARTQUOTACODE, QUOTASTATUS.QUOTASTATUSID FROM avsreg.QUOTASTATUS WHERE (((QUOTASTATUS.QUOTASTATUSID)='$qcode1'))";
$result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
while($objResult = odbc_fetch_row($result))
	{
		$startqacode= odbc_result($result,"startquotacode");	
	}
		$startcode = substr($startqacode,0,-4);  //รหัสผู้สมัคร ชุดเลข ไม่รวม running number นำไปหาเลขที่สุดท้ายในตาราง applicant
		
		$strSQL1 = "SELECT MAX(APPLICANT.APPLICANTCODE) as startmax FROM avsreg.APPLICANT WHERE (((APPLICANT.APPLICANTCODE) Like '$startcode%')) ORDER BY APPLICANTCODE";
		$result1 = odbc_exec($objConnect, $strSQL1) or die ("Error Execute [".$strSQL1."]");

		while($objResult1 = odbc_fetch_row($result1))
			{
				 $startmax= odbc_result($result1,"startmax");	
			}
				if($startmax <> "") 
					{
						$applicantcode = $startmax + 1;
					}
				else
					{
						$applicantcode = $startqacode;
					}
			//echo $applicantcode."<br>";
			
			//เชคชาย หรือ หญิง M  F
			if($prefixid == '2') { $applicantsex = 'M'; } else { $applicantsex = 'F';}
			
if($qcode1 <> ""){
	    
		  $sqlInsert = "INSERT INTO avsreg.applicant(
			applicantcode,
			prefixid,
			schoolid,
			programtype,
			applicantname,
			applicantsurname,
			acadyear,
			semester,
			applicantstatus,
			gpax,
			applicantmail,
			applicanttype,
			citizenid,
			homeaddress1,
			homeaddress2,
			homedistrict,
			homezipcode,
			homeprovinceid,
			homephoneno,
			applicantsex,
			applicantmethod,
			applicantsequence,			
			round)
		VALUES(
			'$applicantcode',
			'$prefixid',
			'$schoolid',
			'$programtype',
			'$applicantname_cv',
			'$applicantsurname_cv',
			'$acadyear',
			'$semester',
			'10',
			'$gpax',
			'$email',
			'$applicanttype',
			'$citizenid',
			'$address_cv',
			'$address2_cv',
			'$address3_cv',
			'$zipcode',
			'$province',
			'$homephoneno',
			'$applicantsex',
			'W',
			'1',			
			'$round')";
 $objInsert = odbc_exec($objConnect, $sqlInsert) or die ("Error Execute [".$sqlInsert."]");	
 
?>

<?php    // Insert applicantid ไปที่ตาราง ApplicantSELECTION สาขาที่เด็กสมัครลำดับที่ 1 2 3 4
	$strSEL = "SELECT APPLICANT.APPLICANTID FROM avsreg.APPLICANT WHERE (((APPLICANT.APPLICANTCODE)='$applicantcode'))";
	$resultSEL = odbc_exec($objConnect, $strSEL) or die ("Error Execute [".$strSEL."]");
	while($objSEL = odbc_fetch_row($resultSEL))
	{
		$applicantid = odbc_result($resultSEL,"applicantid");	
	}
	
	$_SESSION["applicantid_sess"] = $applicantid;
	$sess_appid	=	$_SESSION["applicantid_sess"];
	// แทรกลำดับที่เลือกลงตาราง applicantselection
	if($qcode1 <> "") 
	{ 
		$seq = 0;
		$save = array($qcode1,$qcode2,$qcode3,$qcode4);
		foreach ($save as $savenow)		
		{
			if($savenow <> "")
				{
					$seq++;
					//echo $savenow."<br>";
				
		$sqlInsertSEL = "INSERT INTO avsreg.applicantselection(
			applicantid,
			quotastatusid,
			sequence)
		VALUES(
			'$applicantid',
			'$savenow',
			'$seq')";		
 $objInsertSEL = odbc_exec($objConnect, $sqlInsertSEL) or die ("Error Execute [".$sqlInsertSEL."]");	
 				}
 		}
		// แทรกลงในตางราง APPLICANTDOC
		
		/*$sqlInsertdoc = "INSERT INTO avsreg.applicantdoc(
			applicantid)
			VALUES('$applicantid')";	
			$objInsertDOC2 = odbc_exec($objConnect, $sqlInsertdoc) or die ("Error Execute [".$sqlInsertdoc."]");	*/		
		
	// ส่งเมล์ 
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
		$body_html = "รหัสผู้สมัคร ".$applicantcode."<br> ชื่อผู้สมัคร  ".$applicantname_cv."  ".$applicantsurname_cv."<br><br> ได้ดำเนินการสมัครในระบบรับสมัครออนไลน์ ของมหาวิทยาลัยราชภัฏรำไพพรรณี ได้รับรหัสผู้สมัคร คือ  <font color=\"green\">  ++ ".$applicantcode." เรียบร้อยแล้ว สามารถพิมพ์แบบฟอร์มการชำระเงินได้ตาม Link ด้านล่างนี้<br>"." <a href= \"http://assess.rbru.ac.th/admission/pay_entryqnew.php?m=true&appid=$applicantid\" target='_blank'> http://assess.rbru.ac.th/admission/pay_entryqnew.php?m=true&appid=$applicantid </a> <br><br>"."<br><br><br><br><h3>ติดต่อสอบถาม กองบริการการศึกษา</h3><br>โทร. 0-3931-9111 ต่อ 28401-2<br>";
		
			 admitrbru_sendmail($to_name,$to_email,$from_name,$email_user_send,$email_pass_send,$subject,$body_html,$body_text);
			 
	echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmApplicant_detail\">";
	
	}
	
	else // ถ้าไม่ได้เลือกสาขา จะบันทึกไม่ได้
	{
		echo "ยังไม่ได้ทำการเลือกสาขาวิชา";
	}
}
 else 
 	{
		echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmRegister1qnew\">";
	}  
?>

</body>
</html>
