<?php	session_start();
include("config/connect.php");
$frommail = $_GET[m];
if($frommail == 'true') 
	{
		 $sess_appid = $_GET[appid];
	} else {
		$sess_appid = $_SESSION['applicantid_sess'];
		   }
 ?>
 <?php
 	unset ($_SESSION["prefixid_sess"]);		unset ($_SESSION["citizenid_sess"]);
	unset ($_SESSION["schoolid_sess"]);		unset ($_SESSION["address_sess"]);
	unset ($_SESSION["schoolname_sess"]);		unset ($_SESSION["address2_sess"]);
	unset ($_SESSION["programtype_sess"]);		unset ($_SESSION["address3_sess"]);
	unset ($_SESSION["name_sess"]);		unset ($_SESSION["province_sess"]);
	unset ($_SESSION["surname_sess"]);		unset ($_SESSION["zipcode_sess"]);
	unset ($_SESSION["mobile_sess"]);		unset ($_SESSION["gpax_sess"]);
	unset ($_SESSION["email_sess"]);		unset ($_SESSION["qcode1_sess"]);
	unset ($_SESSION["qcode2_sess"]);		unset ($_SESSION["qcode3_sess"]);
	unset ($_SESSION["qcode4_sess"]);		unset ($_SESSION["ccode1_sess"]);
	unset ($_SESSION["ccode2_sess"]);		unset ($_SESSION["ccode3_sess"]);
	unset ($_SESSION["ccode4_sess"]);		unset ($_SESSION["qname1_sess"]);
	unset ($_SESSION["qname2_sess"]);		unset ($_SESSION["qname3_sess"]);
	unset ($_SESSION["qname4_sess"]);		unset ($_SESSION["labb1_sess"]);
	unset ($_SESSION["labb2_sess"]);		unset ($_SESSION["labb3_sess"]);
	unset ($_SESSION["labb4_sess"]);
 ?>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {color: #33CC33}
-->
</style>
<h2>ข้อมูลผู้สมัคร <?php echo"$txt"; ?></h2>
<div id="form-regis">
<form action="find_applicant.php" method="post" name="form1" id="form1">
<h3>&nbsp;</h3>
<div class="mr20" >
  <label class="label2"></label>
  <label class="label2"></label><label class="label2"></label>
  <span class="center">
  <label  class="label2"></label>
  </span>
  <?php    
	$strSEL = "SELECT APPLICANT.APPLICANTID,APPLICANT.APPLICANTSTATUS, APPLICANT.APPLICANTCODE, APPLICANT.APPLICANTNAME, APPLICANT.APPLICANTSURNAME, APPLICANT.FINANCESTATUS, APPLICANT.GPAX, SCHOOL.SCHOOLNAME, APPLICANT.APPLICANTMETHOD, PREFIX.PREFIXNAME FROM (avsreg.APPLICANT INNER JOIN AVSREG.PREFIX ON APPLICANT.PREFIXID = PREFIX.PREFIXID) LEFT JOIN AVSREG.SCHOOL ON APPLICANT.SCHOOLID = SCHOOL.SCHOOLID WHERE(((APPLICANT.APPLICANTID)='$sess_appid'))";
	$resultSEL = odbc_exec($objConnect, $strSEL) or die ("Error Execute [".$strSEL."]");
	while($objSEL = odbc_fetch_row($resultSEL))
	{
		$applicantcode = odbc_result($resultSEL,"applicantcode");	
		$applicantname = odbc_result($resultSEL,"applicantname");	
		$prefixname = odbc_result($resultSEL,"prefixname");
		$schoolname = odbc_result($resultSEL,"schoolname");
		$finance = odbc_result($resultSEL,"financestatus");
		$gpax = odbc_result($resultSEL,"gpax");
		$method = odbc_result($resultSEL,"applicantmethod");
		$applicantstatus = odbc_result($resultSEL,"applicantstatus");
		$prefixname_cv = iconv( "TIS-620","UTF-8","$prefixname");
		$applicantsurname = odbc_result($resultSEL,"applicantsurname");	
		$applicantname_cv = iconv( "TIS-620","UTF-8","$applicantname");
		$applicantsurname_cv = iconv( "TIS-620","UTF-8","$applicantsurname");		
		$schoolname_cv = iconv( "TIS-620","UTF-8","$schoolname");
	}
  ?>
  <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
    <tr>
      <td colspan="2" class="style1"><div align="center">*จดบันทึกรหัสผู้สมัครไว้อ้างอิงการใช้งาน*<br />
      </div></td>
      </tr>
    <tr>
      <td colspan="2" class="style1">&nbsp;</td>
    </tr>
    <tr>
      <td width="27%">รหัสผู้สมัคร</td>
      <td width="73%"><strong>&nbsp;<? echo $applicantcode; ?></strong></td>
    </tr>
    <tr>
      <td>ชื่อผู้สมัคร</td>
      <td><strong>&nbsp;<? echo $prefixname_cv.$applicantname_cv."  ".$applicantsurname_cv; ?></strong></td>
    </tr>
    <tr>
      <td valign="top">หลักสูตร</td>
      <td>
	   
	  <table width="90%" border="0" cellspacing="0" cellpadding="3">
	   <?php    
	$strSEL = "SELECT APPLICANTSELECTION.APPLICANTID, APPLICANTSELECTION.SEQUENCE, QUOTA.QUOTANAME, QUOTA.LEVELID, QUOTASTATUS.STUDYPERIOD FROM (AVSREG.APPLICANTSELECTION INNER JOIN AVSREG.QUOTASTATUS ON APPLICANTSELECTION.QUOTASTATUSID = QUOTASTATUS.QUOTASTATUSID) INNER JOIN AVSREG.QUOTA ON QUOTASTATUS.QUOTAID = QUOTA.QUOTAID WHERE (((APPLICANTSELECTION.APPLICANTID)='$sess_appid')) ORDER BY APPLICANTSELECTION.SEQUENCE";
	$resultSEL = odbc_exec($objConnect, $strSEL) or die ("Error Execute [".$strSEL."]");
	while($objSEL = odbc_fetch_row($resultSEL))
	{
		
		$quotaname = odbc_result($resultSEL,"quotaname");	
		$seq = odbc_result($resultSEL,"sequence");	
		$period = odbc_result($resultSEL,"studyperiod");
		$levelid = odbc_result($resultSEL,"levelid");
		$quotaname_cv = iconv( "TIS-620","UTF-8","$quotaname");
	
  ?>
        <tr>
          <td width="27%"><strong>&nbsp;สาขาวิชา 
            <? // echo $seq; ?></strong></td>
          <td width="73%"><strong>&nbsp;<? echo $quotaname_cv; ?></strong></td>
        </tr>
	<?   }  ?>
      </table></td>
    </tr>
    <tr>
     <td>สถานะผู้สมัคร</td> 
	  
	   <?php     //สถานะผผู้สมนัคร
	$strSELSYS = "SELECT SYSBYTEDES.BYTECODE, SYSBYTEDES.BYTEDES FROM AVSREG.SYSBYTEDES WHERE (((SYSBYTEDES.TABLENAME)='APPLICANT') AND ((SYSBYTEDES.COLUMNNAME)='APPLICANTSTATUS') AND ((SYSBYTEDES.BYTECODE)='$applicantstatus'))";
	$resultSELSYS = odbc_exec($objConnect, $strSELSYS) or die ("Error Execute [".$strSELSYS."]");
	while($objSELSYS = odbc_fetch_row($resultSELSYS))
	{
		
		$appstatus = odbc_result($resultSELSYS,"bytedes");	
		$appstatus_cv = iconv( "TIS-620","UTF-8","$appstatus");
		
	}
  ?>
      <td><span class="style1">&nbsp;<? echo $appstatus_cv; ?></td>
    </tr>
   
   <?php if($applicantstatus == '9') {  ?>
	
	<?php  }  ?>
	<?php if($method == 'W') { ?>
    <tr>
      <td>&nbsp;</td>
      <td><br>
	  <?php if ($applicantstatus < 10) {?>
	  <div id="menutype" class="flr"><span>ยังไม่สามารถพิมพ์ใบชำระเงินได้</span></div>
	  <? php} else { if($levelid == '42') { ?>
	  <div id="menutype2" class="flr"><span><a href="pay_entrymas.php?levelid=<? echo $levelid; ?>&period=<? echo $period; ?>" target="_blank">พิมพ์ใบชำระเงิน</a></span></div>
	  <?php } else { ?> 	  <div id="menutype2" class="flr"><span><a href="pay_entryphd.php?levelid=<? echo $levelid; ?>&period=<? echo $period; ?>" target="_blank">พิมพ์ใบชำระเงิน</a></span></div> <?php } }  ?>
	  <BR><BR><BR>
	 <?php if(($finance == 'D') or ($finance == 'N')) { if ($levelid == '42') { ?>
	  <div id="menutype2" class="flr"><span><a href="frmPrint2mas.php" target="_blank">พิมพ์เอกสารหลักฐานการสมัคร</a></span></div>
	  <?php } else { ?> 	  <div id="menutype2" class="flr"><span><a href="frmPrint2phd.php" target="_blank">พิมพ์เอกสารหลักฐานการสมัคร</a></span></div> <?php }} else { ?>
	  <div id="menutype" class="flr"><span>ยังไม่สามารถพิมพ์เอกสารหลักฐานการสมัครได้</span></div>
	  <?php  } ?>	  </td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><span class="style2"><br />
        กรุณาชำระเงินภายใน 3 วันทำการ หลังจากที่ยืนยันการสมัคร และภายในช่วงกำหนดวันชำระเงิน<br />
        (เมื่อชำระเงินที่ธนาคารเรียบร้อยแล้ว ผู้สมัครจะสามารถพิมพ์เอกสารหลักฐานการสมัครได้ ในวันถัดไป)</span></div></td>
      </tr>
       <?php } ?>
  </table>
  <label class="label2"></label>
  <label class="label2"></label>
  <label class="label2"></label>
</div>
  
<table width="90%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

 </form>
<div id="comment">
<h2>** หมายเหตุ **</h2>
1. 
มหาวิทยาลัยจะพิจารณาตัดสินการสอบคัดเลือกให้เฉพาะผู้ที่มีคุณสมบัติทั่วไป <strong>และ</strong>คุณสมบัติเฉพาะสาขาตามที่สาขาวิชากำหนด<br/>
2. กรณีที่ชำระเงินค่าธรรมเนียมสมัครแล้วจะไม่คืนเงินค่าสมัครให้ไม่ว่ากรณีใดๆ ทั้งสิ้น<br/>
3. การสมัครจะสมบูรณ์เมื่อผู้สมัครได้ชำระเงินภายในระยะเวลาที่มหาวิทยาลัยกำหนดเท่านั้น <br />
4. การแก้ไขข้อมูลการสมัคร จะกระทำได้เมื่อผู้สมัครยังมิได้ชำระเงิน <br />
5. 
ในวันสอบสัมภาษณ์  มหาวิทยาลัยจะตรวจสอบคุณสมบัติ หากตรวจพบว่าคุณสมบัติของผู้สมัครไม่เป็นไปตามที่มหาวิทยาลัยกำหนดหรือข้อมูลการสมัครเป็นเท็จ  มหาวิทยาลัยจะตัดสิทธิ์ในการรับเข้าเป็นนิสิต<br/>
<br/>

</div>
</div>