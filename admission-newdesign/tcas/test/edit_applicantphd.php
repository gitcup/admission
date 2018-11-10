<?php	session_start();?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <?php
        include './header.php';
        ?>
</head>
<body>
<?php
include("config/connect.php");
include("sysconfigphd.php");
include("sysmailphd.php"); 
	include ("users/gmail/class.phpmailer.php");
$applicantid	=	$_SESSION["applicantid_sess"];
$quotastatusid1	=	$_SESSION["quotastatus_sess1"];
$prefixid 	= $_POST["prename"];
$schoolbclid	= $_POST["txtSCHOOLID_1"]; //สถาบันที่จบ ป.ตรี
$schoolmasid	= $_POST["txt2SCHOOLID_1"]; //สถาบันที่จบ ป.โท
//$programtype = $_POST["entrydegree"];
$applicantname 	= $_POST["name"];
$applicantsurname	= $_POST["surname"];
$applicantnameeng 	= $_POST["nameeng"];
$applicantsurnameeng	= $_POST["surnameeng"];
$citizenid	= $_POST["citizen"];
$bdate	= $_POST["bdate"];	
//$delivDate = date('d-m-Y', strtotime($_POST['$bdate']));  
$fstatus	= $_POST["fstatus"];	
$address = $_POST["address"];
$address2 = $_POST["address2"];
$address3 = $_POST["address3"];
$province = $_POST["province"];
$zipcode = $_POST["zipcode"];
$homephoneno = $_POST["mobile"];
//$gpax = $_POST["gpa"];
$email = $_POST["email"];

$programbcl = $_POST["programbcl"];
$programbcl_cv = iconv( "UTF-8","TIS-620","$programbcl");
$degreebcl = $_POST["degreebcl"];
$degreebcl_cv = iconv( "UTF-8","TIS-620","$degreebcl");
$yearbcl = $_POST["yearbcl"];
$gpabcl = $_POST["gpabcl"];
$programmas = $_POST["programmas"];
$programmas_cv = iconv( "UTF-8","TIS-620","$programmas");
$degreemas = $_POST["degreemas"];
$degreemas_cv = iconv( "UTF-8","TIS-620","$degreemas");
$yearmas = $_POST["yearmas"];
$gpamas = $_POST["gpamas"];

$cjob = $_POST["cjob"];
$atjob = $_POST["atjob"];
$atjob_cv = iconv( "UTF-8","TIS-620","$atjob");
$atwork = $_POST["atwork"];
$atwork_cv = iconv( "UTF-8","TIS-620","$atwork");
$workposition = $_POST["workposition"];
$workposition_cv = iconv( "UTF-8","TIS-620","$workposition");
$salary = $_POST["salary"];
$jobphone = $_POST["jobphone"];
$jobphone2 = $_POST["jobphone2"];

$applicanttype = $_POST["txtapplicanttype"];
$applicantstatus = $_POST["txtstatus"];
$editseq = $_POST["txteditseq"];
$qcode1 = $_POST["txtQUOTASTATUSID_1"];
$qcode2 = $_POST["txtQUOTASTATUSID_2"];
$qcode3 = $_POST["txtQUOTASTATUSID_3"];
$qcode4 = $_POST["txtQUOTASTATUSID_4"];
$applicantname_cv = iconv( "UTF-8","TIS-620","$applicantname");
$applicantsurname_cv = iconv( "UTF-8","TIS-620","$applicantsurname");
$address_cv = iconv( "UTF-8","TIS-620","$address");
$address2_cv = iconv( "UTF-8","TIS-620","$address2");
$address3_cv = iconv( "UTF-8","TIS-620","$address3");

   if($qcode1 <> "")  {
   
		if($qcode1 <> $quotastatusid1) { //ถ้าสาขาที่เลือกใหม่ไม่ใช่สาขาเดิม ต้องเปลี่ยนรหัสผู้สมัคร

		/*$strSQLDel = "DELETE FROM avsreg.APPLICANTSELECTION \n";
		$strSQLDel .= "WHERE applicantid = $applicantid ";
		$resultdel = odbc_exec($objConnect, $strSQLDel) or die ("Error Execute [".$strSQLDel."]");*/
		
		// ไปอัปเดรตสถาตัส ให้เป็นเปลี่ยนสาขาอันดับที่ 1
		
		$strSQLDel = "UPDATE avsreg.APPLICANTSELECTION SET APPLICANTSELECTION.SELECTIONSTATUS = '5' \n";
		$strSQLDel .= "WHERE applicantid = $applicantid ";
		$resultdel = odbc_exec($objConnect, $strSQLDel) or die ("Error Execute [".$strSQLDel."]");
		
		///////////////////////////////////หารหัสผู้สมัครใหม่
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
		
		$strSQLdata = "INSERT INTO avsreg.applicant(
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
			'$schoolmasid',
			'$programtype',
			'$applicantname_cv',
			'$applicantnameeng',
			'$applicantsurname_cv',
			'$applicantsurnameeng',
			'$acadyear',
			'$semester',
			'10',
			'$gpax',
			'$email',
			'$applicanttype',
			'$citizenid',
			to_date('$bdate','dd/mm/yyyy'),
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
		$resultdata = odbc_exec($objConnect, $strSQLdata) or die ("Error Execute [".$strSQLdata."]");	
		
		// Insert applicantid ไปที่ตาราง ApplicantSELECTION สาขาที่เด็กสมัครลำดับที่ 1 2 3 4
	$strSEL = "SELECT APPLICANT.APPLICANTID FROM avsreg.APPLICANT WHERE (((APPLICANT.APPLICANTCODE)='$applicantcode'))";
	$resultSEL = odbc_exec($objConnect, $strSEL) or die ("Error Execute [".$strSEL."]");
	while($objSEL = odbc_fetch_row($resultSEL))
	{
		$applicantid = odbc_result($resultSEL,"applicantid");	
	}
	
	$_SESSION["applicantid_sess"] = $applicantid;
	$sess_appid	=	$_SESSION["applicantid_sess"];
	
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
 				} }
// แทรกลงในตางราง APPLICANTPHD
		
		$sqlInsertphd = "INSERT INTO avsreg.applicantphd(
			applicantid, schoolbclid, programbcl, degreebcl, graduateyearbcl, gpabcl, schoolmasid, programmas, degreemas, graduateyearmas, gpamas)
			VALUES('$applicantid', '$schoolbclid', '$programbcl_cv', '$degreebcl_cv', '$yearbcl', '$gpabcl','$schoolmasid', '$programmas_cv', '$degreemas_cv', '$yearmas', '$gpamas')";	
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
				
 		} else {  // กรณีไม่เปลี่ยนสาขา
				
			$strSQLDel2 = "DELETE FROM avsreg.APPLICANTSELECTION \n";
			$strSQLDel2 .= "WHERE applicantid = $applicantid AND sequence <> '1' ";
			$resultdel2 = odbc_exec($objConnect, $strSQLDel2) or die ("Error Execute [".$strSQLDel2."]");
			
		$seq = 1;
		$save = array($qcode2,$qcode3,$qcode4);
		foreach ($save as $savenow)		
		{
			if($savenow <> "")
				{
					$seq++;
					//echo $savenow."<br>";
				
		$sqlInsertSEL2 = "INSERT INTO avsreg.applicantselection(
			applicantid,
			quotastatusid,
			sequence)
		VALUES(
			'$applicantid',
			'$savenow',
			'$seq')";		
 $objInsertSEL2 = odbc_exec($objConnect, $sqlInsertSEL2) or die ("Error Execute [".$sqlInsertSEL2."]");	
 				}
 		}
										
										
		$strSQLdata = "UPDATE avsreg.APPLICANT \n";	
		$strSQLdata .= "set applyfrom = '$fstatus', \n";	
		$strSQLdata .= "prefixid = '$prefixid', \n";	
		$strSQLdata .= "schoolid = '$schoolmasid', \n";
		$strSQLdata .= "programtype = '$programtype', \n";
		$strSQLdata .= "applicantname = '$applicantname_cv', \n";
		$strSQLdata .= "applicantnameeng = '$applicantnameeng', \n";
		$strSQLdata .= "applicantsurname = '$applicantsurname_cv', \n";	
		$strSQLdata .= "applicantsurnameeng = '$applicantsurnameeng', \n";		
		$strSQLdata .= "applicantstatus = '10', \n";
		$strSQLdata .= "gpax = '$gpamas', \n";
		$strSQLdata .= "applicantmail = '$email', \n";
		$strSQLdata .= "applicanttype = '$applicanttype', \n";
		$strSQLdata .= "citizenid = '$citizenid', \n";
		$strSQLdata .= "birthdate = to_date('$bdate','dd/mm/yyyy'), \n";
		$strSQLdata .= "homeaddress1 = '$address_cv', \n";
		$strSQLdata .= "homeaddress2 = '$address2_cv', \n";
		$strSQLdata .= "homedistrict = '$address3_cv', \n";
		$strSQLdata .= "homezipcode = '$zipcode', \n";
		$strSQLdata .= "homeprovinceid = '$province', \n";
		$strSQLdata .= "homephoneno = '$homephoneno', \n";	
		$strSQLdata .= "workingstatus = '$cjob', \n";
		$strSQLdata .= "officename = '$atjob_cv', \n";	
		$strSQLdata .= "officeaddress1 = '$atwork_cv', \n";			
		$strSQLdata .= "workingposition = '$workposition_cv', \n";	
		$strSQLdata .= "workingsalary = '$salary', \n";	
		$strSQLdata .= "officephoneno = '$jobphone', \n";
		$strSQLdata .= "officefaxno = '$jobphone2', \n";		
		$strSQLdata .= "applicantsex = '$applicantsex', \n";
		$strSQLdata .= "applicantmethod = 'W', \n";
		$strSQLdata .= "applicantsequence = '1', \n";
		$strSQLdata .= "round = '$round' \n";		
		$strSQLdata .= "WHERE applicant.applicantid = '$applicantid'";
		$resultdata = odbc_exec($objConnect, $strSQLdata) or die ("Error Execute [".$strSQLdata."]");
		
		// แทรกลงในตางราง APPLICANTPHD
		$strSQLdata1 = "UPDATE avsreg.APPLICANTPHD \n";	
		$strSQLdata1 .= "set schoolbclid = '$schoolbclid', \n";	
		$strSQLdata1 .= "programbcl = '$programbcl_cv', \n";	
		$strSQLdata1 .= "degreebcl = '$degreebcl_cv', \n";	
		$strSQLdata1 .= "graduateyearbcl = '$yearbcl', \n";
		$strSQLdata1 .= "gpabcl = '$gpabcl', \n";
		$strSQLdata1 .= "schoolmasid = '$schoolmasid', \n";
		$strSQLdata1 .= "programmas = '$programmas_cv', \n";
		$strSQLdata1 .= "degreemas = '$degreemas_cv', \n";
		$strSQLdata1 .= "graduateyearmas = '$yearmas', \n";
		$strSQLdata1 .= "gpamas = '$gpamas' \n";
		$strSQLdata1 .= " WHERE applicantphd.applicantid = '$applicantid'";
		$resultdata1 = odbc_exec($objConnect, $strSQLdata1) or die ("Error Execute [".$strSQLdata1."]");
		
		
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

                              echo '<script type="text/javascript" >';

                echo 'swal({
                     title: "แก้ไขข้อมูลเรียบร้อย!",
                        icon: "success",
  
                        timer: 2000
                        });';
                header("refresh:3;url=indexphd.php?p=frmApplicant_detailphd");

                echo '</script>';
                         
//				echo "<meta http-equiv=\"refresh\"content=\"0;url=indexphd.php?p=frmApplicant_detailphd\">";
								
				}
			
			} else { echo "ยังไม่ได้ทำการเลือกสาขาวิชา"; }
			
	
?>

</body>
</html>
