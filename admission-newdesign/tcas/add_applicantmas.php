<?php	session_start();?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
include("config/connect.php");
include("sysconfigmas.php");
include("sysmailphd.php"); 
	include ("users/gmail/class.phpmailer.php");
//capcha
$captcha = $_POST["captcha"];
$txtcaptcha = $_POST["txtcaptcha"];
//-------------

$prefixid 	= $_POST["prename"];	$_SESSION["prefixid_sess"] = $prefixid;		
$schoolid	= $_POST["txtSCHOOLID_1"];	$_SESSION["schoolid_sess"] = $schoolid;		
$schoolname	= $_POST["txtSCHOOLNAME_1"];	$_SESSION["schoolname_sess"] = $schoolname;		
$programtype = $_POST["entrydegree"];	$_SESSION["programtype_sess"] = $programtype;		
$applicantname 	= $_POST["name"];	$_SESSION["name_sess"] = $applicantname;		
$applicantnameeng 	= $_POST["nameeng"];	$_SESSION["nameeng_sess"] = $applicantnameeng;		
$applicantsurname	= $_POST["surname"];	$_SESSION["surname_sess"] = $applicantsurname;		
$applicantsurnameeng	= $_POST["surnameeng"];	$_SESSION["surnameeng_sess"] = $applicantsurnameeng;		
$citizenid	= $_POST["citizen"];	$_SESSION["citizenid_sess"] = $citizenid;
	
$fstatus	= $_POST["fstatus"];	$_SESSION["fstatus_sess"] = $fstatus;
$bdate	= $_POST["bdate"];	$_SESSION["bdate_sess"] = $bdate;
$delivDate = date('d-m-Y', strtotime($_POST['bdate']));  
$programbcl	= $_POST["programbcl"];	$_SESSION["programbcl_sess"] = $programbcl;	
$degreebcl	= $_POST["degreebcl"];	$_SESSION["degreebcl_sess"] = $degreebcl;
$yearbcl	= $_POST["yearbcl"];	$_SESSION["yearbcl_sess"] = $yearbcl;	
$gpabcl	= $_POST["gpabcl"];	$_SESSION["gpabcl_sess"] = $gpabcl;	
$schoolidbcl	= $_POST["txtSCHOOLID_1"];	$_SESSION["schoolidbcl_sess"] = $schoolidbcl;		
$schoolnamebcl	= $_POST["txtSCHOOLNAME_1"];	$_SESSION["schoolnamebcl_sess"] = $schoolnamebcl;		

$programmas	= $_POST["programmas"];	$_SESSION["programmas_sess"] = $programmas;	
$degreemas	= $_POST["degreemas"];	$_SESSION["degreemas_sess"] = $degreemas;
$yearmas	= $_POST["yearmas"];	$_SESSION["yearmas_sess"] = $yearmas;	
$gpamas	= $_POST["gpamas"];	$_SESSION["gpamas_sess"] = $gpamas;	
$schoolidmas	= $_POST["txt2SCHOOLID_1"];	$_SESSION["schoolidmas_sess"] = $schoolidmas;		
$schoolnamemas	= $_POST["txt2SCHOOLNAME_1"];	$_SESSION["schoolnamemas_sess"] = $schoolnamemas;		

$fstatus	= $_POST["fstatus"];	$_SESSION["fstatus_sess"] = $fstatus;
$cjob	= $_POST["cjob"];	$_SESSION["cjob_sess"] = $cjob;	
$atjob	= $_POST["atjob"];	$_SESSION["atjob_sess"] = $atjob;
$atwork	= $_POST["atwork"];	$_SESSION["atwork_sess"] = $atwork;
$workposition	= $_POST["workposition"];	$_SESSION["workposition_sess"] = $workposition;
$salary	= $_POST["salary"];	$_SESSION["salary_sess"] = $salary;
$jobphone	= $_POST["jobphone"];	$_SESSION["jobphone_sess"] = $jobphone;
$jobphone2	= $_POST["jobphone2"];	$_SESSION["jobphone2_sess"] = $jobphone2;

$address = $_POST["address"];	$_SESSION["address_sess"] = $address;		
$address2 = $_POST["address2"];	$_SESSION["address2_sess"] = $address2;		
$address3 = $_POST["address3"];	$_SESSION["address3_sess"] = $address3;		
$province = $_POST["province"];	$_SESSION["province_sess"] = $province;		
$zipcode = $_POST["zipcode"];	$_SESSION["zipcode_sess"] = $zipcode;		
$homephoneno = $_POST["mobile"];	$_SESSION["mobile_sess"] = $mobile;		
$gpax = $_POST["gpa"];	$_SESSION["gpax_sess"] = $gpax;		
$email = $_POST["email"];	$_SESSION["email_sess"] = $email;		
$qcode1 = $_POST["txtQUOTASTATUSID_1"];	$_SESSION["qcode1_sess"] = $qcode1;
$ccode1 = $_POST["txtQUOTACODE_1"];	$_SESSION["ccode1_sess"] = $ccode1;
$qname1 = $_POST["txtQUOTANAME_1"];	$_SESSION["qname1_sess"] = $qname1;
$labb1 = $_POST["txtLEVELABB_1"];	$_SESSION["labb1_sess"] = $labb1;

$applicantname_cv = iconv( "UTF-8","TIS-620","$applicantname");
$applicantsurname_cv = iconv( "UTF-8","TIS-620","$applicantsurname");
$applicantnameeng_cv = iconv( "UTF-8","TIS-620","$applicantnameeng");
$applicantsurnameeng_cv = iconv( "UTF-8","TIS-620","$applicantsurnameeng");
$address_cv = iconv( "UTF-8","TIS-620","$address");
$address2_cv = iconv( "UTF-8","TIS-620","$address2");
$address3_cv = iconv( "UTF-8","TIS-620","$address3");

$programbcl_cv = iconv( "UTF-8","TIS-620","$programbcl");
$degreebcl_cv = iconv( "UTF-8","TIS-620","$degreebcl");
$programmas_cv = iconv( "UTF-8","TIS-620","$programmas");
$degreemas_cv = iconv( "UTF-8","TIS-620","$degreemas");
$atjob_cv = iconv( "UTF-8","TIS-620","$atjob");
$atwork_cv = iconv( "UTF-8","TIS-620","$atwork");
$workposition_cv = iconv( "UTF-8","TIS-620","$workposition");

if($captcha != $txtcaptcha)
{
    
	echo "<script language='javascript'>";
	echo "alert('ตัวอักษรที่คุณใส่ไม่ถูกต้อง กรุณาใส่อีกครั้ง')";
	echo "</script>";
	echo "<meta http-equiv=\"refresh\"content=\"0;url=indexphd.php?p=frmRegisterMas\">";
        //แก้ไขบรรทัดนี้
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
	echo "<meta http-equiv=\"refresh\"content=\"0;url=indexphd.php?p=frmEditApplicantphd\">"; //สมัครเสร็จมาหน้านี้
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
			applyfrom,
			prefixid,
			schoolid,
			programtype,
			applicantname,
			applicantnameeng,
			applicantsurname,
			applicantsurnameeng,
			acadyear,
			semester,
			applicantstatus,
			gpax,
			applicantmail,
			applicanttype,
			citizenid,
			birthdate,
			homeaddress1,
			homeaddress2,
			homedistrict,
			homezipcode,
			homeprovinceid,
			homephoneno,
			workingstatus,
			officename,
			officeaddress1,
			workingposition,
			workingsalary,
			officephoneno,
			officefaxno,
			applicantsex,
			applicantmethod,
			applicantsequence,			
			round)
		VALUES(
			'$applicantcode',
			'$fstatus',
			'$prefixid',
			'$schoolid',
			'$programtype',
			'$applicantname_cv',
			'$applicantnameeng_cv',
			'$applicantsurname_cv',
			'$applicantsurnameeng_cv',
			'$acadyear',
			'$semester',
			'10',
			'$gpamas',
			'$email',
			'$applicanttype',
			'$citizenid',
			to_date('".$delivDate."','dd-mm-yy'),
			'$address_cv',
			'$address2_cv',
			'$address3_cv',
			'$zipcode',
			'$province',
			'$homephoneno',
			'$cjob',
			'$atjob_cv',
			'$atwork_cv',
			'$workposition_cv',
			'$salary',
			'$jobphone',
			'$jobphone2',
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
		// แทรกลงในตางราง APPLICANTPHD
		
		$sqlInsertphd = "INSERT INTO avsreg.applicantphd(
			applicantid, schoolbclid, programbcl, degreebcl, graduateyearbcl, gpabcl, schoolmasid, programmas, degreemas, graduateyearmas, gpamas)
			VALUES('$applicantid', '$schoolidbcl', '$programbcl_cv', '$degreebcl_cv', '$yearbcl', '$gpabcl','$schoolidmas', '$programmas_cv', '$degreemas_cv', '$yearmas', '$gpamas')";	
			$objInsertphd = odbc_exec($objConnect, $sqlInsertphd) or die ("Error Execute [".$sqlInsertphd."]");
		
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
		$body_html = "รหัสผู้สมัคร ".$applicantcode."<br> ชื่อผู้สมัคร  ".$applicantname_cv."  ".$applicantsurname_cv."<br><br> ได้ดำเนินการสมัครในระบบรับสมัครออนไลน์ ของมหาวิทยาลัยราชภัฏรำไพพรรณี ได้รับรหัสผู้สมัคร คือ  <font color=\"green\">  ++ ".$applicantcode." เรียบร้อยแล้ว สามารถพิมพ์แบบฟอร์มการชำระเงินได้ตาม Link ด้านล่างนี้<br>"." <a href= \"http://assess.rbru.ac.th/admission/pay_entryphd.php?m=true&appid=$applicantid\" target='_blank'> http://assess.rbru.ac.th/admission/pay_entryphd.php?m=true&appid=$applicantid </a> <br><br>"."<br><br><br><br><h3>ติดต่อสอบถาม กองบริการการศึกษา</h3><br>โทร. 0-3931-9111 ต่อ 8401-2<br>";
		
			 admitrbru_sendmail($to_name,$to_email,$from_name,$email_user_send,$email_pass_send,$subject,$body_html,$body_text);
			 
	echo "<meta http-equiv=\"refresh\"content=\"0;url=indexphd.php?p=frmApplicant_detailphd\">";
	
	}
	
	else // ถ้าไม่ได้เลือกสาขา จะบันทึกไม่ได้
	{
		echo "ยังไม่ได้ทำการเลือกสาขาวิชา";
	}
}
 else 
 	{
		echo "<meta http-equiv=\"refresh\"content=\"0;url=indexphd.php?p=frmRegisterMas\">";
	}  
?>

</body>
</html>
