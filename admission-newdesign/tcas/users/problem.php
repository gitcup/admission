<?php
    session_start();
	include "../config/connect.php";
	include("../sysconfig.php");  
	include("../sysmail.php"); 
	include ("gmail/class.phpmailer.php");
	
	$checkdate = date('j/n/Y H:i:s'); //วันที่ปัจจุบัน  format  21/3/2011 เวลา
	$applicantid = $_GET[appid];
	$check = $_GET[check];
	$comment = $_POST[comment];
	$comment_cv = iconv( "UTF-8","TIS-620","$comment");
	//$tqfcheckdate = date('j/n/Y H:i:s'); //วันที่ปัจจุบัน  format  21/3/2011 เวลา
	
	$strSQL = "SELECT * FROM AVSREG.APPLICANTDOC WHERE APPLICANTID ='$applicantid'";
	$objExec = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
	$problem = odbc_result($objExec,"PROBLEM");	
	$problem_cv = iconv( "TIS-620","UTF-8","$problem");
	?>
<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>




<form id="form1" name="form1" method="post" action="problem.php?<?php echo"check=No&appid=$applicantid"; ?>">
<br/>
<table>
  <tr>
    <td width="55"><span class="style1">สถานะ : </span></td>
    <td width="497"> <strong>(หลักฐาน หรือคุณสมบัติไม่ผ่าน)</strong></td>
  </tr>
  <tr>
      <td><span class="style1">สาเหตุ  : </span></td>
      <td><span class="style1">
        <label>
        <textarea name="comment" cols="80" rows="15" id="comment"><? echo"$problem_cv"; ?></textarea>
        </label>
      </span></td>
  </tr>
  <tr>
      <td></td>
      <td><label>
        <input type="submit" name="button" id="button" value="ตกลง" />
      &nbsp;
      <input type="reset" name="button2" id="button2" value="ยกเลิก" />
      </label></td>
  </tr>
</table>
</form>
<?php
    if(!empty($applicantid))
	{
    	if($check=='No')
		{
		    $sqlUpN = "UPDATE AVSREG.APPLICANTDOC SET PROBLEM  = '$comment_cv',CHKDATE = to_date('$checkdate','dd/mm/yyyy HH24:MI:SS')  WHERE APPLICANTID = '$applicantid'";
		    $objUpN = odbc_exec($objConnect, $sqlUpN) or die ("Error Execute [".$sqlUpN."]");
			
			$sqlUpN1 = "UPDATE AVSREG.APPLICANT SET APPLICANTSTATUS  = '9'  WHERE APPLICANTID = '$applicantid'";
		    $objUpN1 = odbc_exec($objConnect, $sqlUpN1) or die ("Error Execute [".$sqlUpN1."]");
									
			echo "<div>บันทึกข้อมูลเรียบร้อยแล้ว</div>";	
			
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
		$body_html = "รหัสผู้สมัคร ".$applicantcode."<br> ชื่อผู้สมัคร  ".$applicantname_cv."  ".$applicantsurname_cv."<br> คุณสมบัติหรือหลักฐานการสมัคร  <font color=\"red\">  ไม่ผ่าน !! </font> การตรวจสอบจากเจ้าหน้าที่สามารถดูสาเหตุได้ตาม Link ด้านล่างนี้<br>"." <a href=\"http://assess.rbru.ac.th/admitrbru/index.php?p=frmApplicant_detail&m=true&appid=$applicantid\" target='_blank'>http://assess.rbru.ac.th/admitrbru/index.php?p=frmApplicant_detail&m=true&appid=$applicantid</a> "."<br><br><br><br><h3>ติดต่อสอบถาม กองบริการการศึกษา</h3><br>โทร. 0-3931-9111 ต่อ 8401-2<br>";
		
			 admitrbru_sendmail($to_name,$to_email,$from_name,$email_user_send,$email_pass_send,$subject,$body_html,$body_text);
			//echo "<div class='center'>ปิดหน้าต่างนี้ แล้วทำการ Refesh 1 เพื่ออัพเดรตข้อมูลหน้าจอ</div>";	
	      //  echo "<meta http-equiv='refresh' content='2;URL=chkStatusTqf34.php?classid=$classid&officerid=$officerid&tqfid=$tqfid' />";	
		}	
	}	
?>

