<?php
//header("Content-type: application/vnd.ms-word");
//header("Content-Disposition: attachment; filename=PrintEntry.doc");
?>
<?php	session_start();
$applicantid = $_SESSION['applicantid_sess'];	
?>

<?php include("config/connect.php");  ?>
<?php include("sysconfig.php");  ?>
<?php $strSQL = "SELECT PREFIX.PREFIXNAME, APPLICANT.APPLICANTCODE, APPLICANT.APPLICANTNAME, APPLICANT.APPLICANTSURNAME, APPLICANT.ACADYEAR, APPLICANT.SEMESTER, APPLICANT.ROUND, APPLICANT.APPLICANTTYPE,APPLICANT.HOMEADDRESS1,APPLICANT.HOMEADDRESS2,APPLICANT.HOMEDISTRICT,APPLICANT.HOMEZIPCODE, APPLICANT.HOMEPHONENO, APPLICANT.GPAX, SCHOOL.SCHOOLNAME, ENTRYDEGREE.ENTRYDEGREENAME, PROVINCE.PROVINCENAME, APPLICANT.APPLICANTID, APPLICANT.APPLICANTDATE FROM (((avsreg.APPLICANT LEFT JOIN avsreg.PREFIX ON APPLICANT.PREFIXID = PREFIX.PREFIXID) LEFT JOIN avsreg.SCHOOL ON APPLICANT.SCHOOLID = SCHOOL.SCHOOLID) LEFT JOIN avsreg.ENTRYDEGREE ON APPLICANT.PROGRAMTYPE = ENTRYDEGREE.ENTRYDEGREECODE) LEFT JOIN avsreg.PROVINCE ON APPLICANT.HOMEPROVINCEID = PROVINCE.PROVINCEID WHERE (((APPLICANT.APPLICANTID)='$applicantid'))";
$result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
while($objResult = odbc_fetch_row($result))
	{
		$applicantcode= odbc_result($result,"applicantcode");	
		$prefixname= iconv("TIS-620","UTF-8",odbc_result($result,"prefixname"));	
		$applicantname= iconv("TIS-620","UTF-8",odbc_result($result,"applicantname"));	
		$applicantsurname= iconv("TIS-620","UTF-8",odbc_result($result,"applicantsurname"));
		$address= iconv("TIS-620","UTF-8",odbc_result($result,"homeaddress1"));		
		$address2= iconv("TIS-620","UTF-8",odbc_result($result,"homeaddress2"));
		$address3= iconv("TIS-620","UTF-8",odbc_result($result,"homedistrict"));	
		$zipcode= iconv("TIS-620","UTF-8",odbc_result($result,"homezipcode"));		
		//$province= iconv("TIS-620","UTF-8",odbc_result($result,"homeprovinceid"));					
		$homephoneno= odbc_result($result,"homephoneno");	
		$a_type= odbc_result($result,"applicanttype");	
		$applicantdate= odbc_result($result,"applicantdate");	
		$gpax= odbc_result($result,"gpax");	
		$schoolname= iconv("TIS-620","UTF-8",odbc_result($result,"schoolname"));	
		$entrydegreename= iconv("TIS-620","UTF-8",odbc_result($result,"entrydegreename"));	
		$provincename= iconv("TIS-620","UTF-8",odbc_result($result,"provincename"));
		
		$acadyearin = odbc_result($result,"ACADYEAR");
	      $semesterin = odbc_result($result,"SEMESTER");
		  $roundin = odbc_result($result,"ROUND");
		
	}
				
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
<!--
.style1 {font-size: 17px}
.style2 {font-size: 15px}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style3 {
	font-family: "Angsana New";
	font-size: 15px;
}
#Layer1 {
	position:absolute;
	left:812px;
	top:9px;
	width:89px;
	height:101px;
	z-index:1;
	background-color: #999999;
}
.style4 {font-size: 15}
-->
</style>
<body onload=window.print()>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <th width="14%" scope="col"><img src="http://assess.rbru.ac.th/admission/images/logo3.png" width="77" height="100"></th>
        <th width="64%" scope="col"><div align="left" class="style3"><span class="style1">มหาวิทยาลัยราชภัฏรำไพพรรณี<br />
            <span class="style2">ใบสมัครบุคคลเข้าศึกษาต่อ ประเภท
			<?php if ($a_type == 'A') { echo "สอบคัดเลือก "; } 
			if ($a_type == 'B') { echo "portfolio "; } 
			if ($a_type == 'C') { echo "รับตรง "; }
			if ($a_type == 'Q') { echo "โควตา "; }
			if ($a_type == 'T') { echo "รับตรง และโครงการผลิตครูฯ "; }
			?>
			 หลักสูตรปริญญาตรี <br />
          ประจำปีการศึกษา <?php echo $acadyearin; ?> รอบที่ <?php echo $roundin; ?> </span></span>Online</div></th>
        <th width="11%" bgcolor="#CCCCCC" scope="col"><table width="100%" height="100%" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td><span class="style3">รูปถ่าย 1 นิ้ว <br>
                <br>
                <br>
                <br>
              </span></td>
              </tr>
          </table></th>
        <th width="11%" scope="col">&nbsp;</th>
      </tr>
    </table></th>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td scope="col"><div align="left" class="style3">รหัสผู้สมัคร   &nbsp;&nbsp;<span class="text16 style2">&nbsp;<span class="style4">&nbsp;<?php echo $applicantcode; ?>&nbsp;</span>&nbsp;</span>&nbsp;&nbsp;&nbsp;ชื่อผู้สมัคร&nbsp;&nbsp;&nbsp;<span class="style4">&nbsp;&nbsp;<?php echo $prefixname.$applicantname; ?> &nbsp;<?php echo $applicantsurname; ?>&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;ที่อยู่ปัจจุบัน ......... <?php echo $address; ?> ..........</div></td>
        </tr>
      <tr>
        <td><span class="style3">ตำบล/แขวง..........<?php echo $address2; ?>.......... อำเภอ/เขต..........<?php echo $address3; ?>.......... จังหวัด..........<?php echo $provincename; ?>......... รหัสไปรษณีย์..........<?php echo $zipcode; ?>.......... โทร.&nbsp;&nbsp;&nbsp;<?php echo $homephoneno; ?></span></td>
        </tr>
      <tr>
        <td><span class="style3">วุฒิการศึกษา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $entrydegreename; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อสถานศึกษา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $schoolname; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เกรดเฉลี่ย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $gpax; ?></span></td>
      </tr>
      <tr>
        <td><span class="style3">สขาวิชาที่เลือก.....</span></td>
      </tr>
		<?php /*$strSQL1 = "SELECT APPLICANTSELECTION.SEQUENCE, QUOTA.QUOTANAME, FACULTY.FACULTYNAME, DEGREE.DEGREENAME
FROM (avsreg.APPLICANTSELECTION INNER JOIN avsreg.QUOTASTATUS ON APPLICANTSELECTION.QUOTASTATUSID = QUOTASTATUS.QUOTASTATUSID) INNER JOIN avsreg.QUOTA ON QUOTASTATUS.QUOTAID = QUOTA.QUOTAID WHERE (((APPLICANTSELECTION.APPLICANTID)='$applicantid')) ORDER BY APPLICANTSELECTION.SEQUENCE";*/
$strSQL1 = "SELECT APPLICANTSELECTION.SEQUENCE, QUOTA.QUOTANAME, FACULTY.FACULTYNAME, DEGREE.DEGREENAME
FROM ((((avsreg.APPLICANTSELECTION INNER JOIN avsreg.QUOTASTATUS ON APPLICANTSELECTION.QUOTASTATUSID = QUOTASTATUS.QUOTASTATUSID) INNER JOIN avsreg.QUOTA ON QUOTASTATUS.QUOTAID = QUOTA.QUOTAID) LEFT JOIN avsreg.PROGRAM ON QUOTASTATUS.PROGRAMID = PROGRAM.PROGRAMID) LEFT JOIN avsreg.DEGREE ON PROGRAM.DEGREEID = DEGREE.DEGREEID) INNER JOIN avsreg.FACULTY ON QUOTA.FACULTYID = FACULTY.FACULTYID WHERE (((APPLICANTSELECTION.APPLICANTID)='$applicantid')) ORDER BY APPLICANTSELECTION.SEQUENCE"; 
$result1 = odbc_exec($objConnect, $strSQL1) or die ("Error Execute [".$strSQL1."]");

		?>
		 <?php 
		  while($objResult1 = odbc_fetch_row($result1))
		{
		$sequence= odbc_result($result1,"sequence");	
		$quotaname= iconv("TIS-620","UTF-8",odbc_result($result1,"quotaname"));	
		$degreename= iconv("TIS-620","UTF-8",odbc_result($result1,"degreename"));	
		$facultyname= iconv("TIS-620","UTF-8",odbc_result($result1,"facultyname"));	
		if($sequence == 1) { $q1 = $quotaname; $d1 = $degreename; $f1 = $facultyname; }
		if($sequence == 2) { $q2 = $quotaname; $d2 = $degreename; $f2 = $facultyname;}
		if($sequence == 3) { $q3 = $quotaname; $d3 = $degreename; $f3 = $facultyname;}
		if($sequence == 4) { $q4 = $quotaname; $d4 = $degreename; $f4 = $facultyname;}
		}
		   ?>	
      <tr>
        <td><div align="center" class="style3">
          <table width="60%" border="1" cellpadding="0" cellspacing="0" class="DataTable">
            <tr>
              <td bgcolor="#FFFFFF" class="style3"><div align="center">ลำดับที่ 1 : </div></td>
              <td bgcolor="#FFFFFF" class="style3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;สาขาวิชา : <?php echo $q1; ?></td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;หลักสูตร : <?php echo $d1; ?></td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;แขนงวิชา : .......................................................................</td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;คณะ : <?php echo $f1; ?></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF" class="style3"><div align="center">ลำดับที่ 2 : </div></td>
              <td bgcolor="#FFFFFF" class="style3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;สาขาวิชา : <?php echo $q2; ?></td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;หลักสูตร : <?php echo $d2; ?></td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;แขนงวิชา : .......................................................................</td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;คณะ : <?php echo $f2; ?></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF" class="style3"><div align="center">ลำดับที่ 3 : </div></td>
              <td bgcolor="#FFFFFF" class="style3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;สาขาวิชา : <?php echo $q3; ?></td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;หลักสูตร : <?php echo $d3; ?></td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;แขนงวิชา : .......................................................................</td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;คณะ : <?php echo $f3; ?></td>
                  </tr>
              </table></td>
            </tr>
		 
            <tr>
              <td width="23%" bgcolor="#FFFFFF" class="style3"><div align="center">ลำดับที่ 4 : </div></td>
              <td width="77%" bgcolor="#FFFFFF" class="style3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td bgcolor="#FFFFFF" class="style3"> &nbsp;&nbsp;สาขาวิชา : <?php echo $q4; ?></td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;หลักสูตร : <?php echo $d4; ?></td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF" class="style3"> &nbsp;&nbsp;แขนงวิชา : .......................................................................</td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF" class="style3"> &nbsp;&nbsp;คณะ : <?php echo $f4; ?></td>
                </tr>
              </table>                </td>
            </tr>
          </table>
        </div></td>
      </tr>
      <tr>
        <td><div align="center" class="style3">สมัครผ่านระบบรับสมัครนักศึกษา Online วันที่ &nbsp;&nbsp;<?php echo datethai($applicantdate); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงชื่อผู้สมัคร ......................................................</div></td>
      </tr>
      <tr>
        <td><div align="center" class="style3">หมายเหตุ : นำเอกสารนี้มาแสดงในวันเข้าสอบ</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ __ _ _ _ _ _ _ _ _ __ _ _ _ _ _ _ _ _ __ _ _ _ _ _ _ _ _ __ _ _ _ _ _ _ _ _ _</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="style3">รายละเอียดผู้สมัคร&nbsp;&nbsp;</span><span class="style4"><span class="style3">&nbsp;&nbsp;<?php echo $prefixname.$applicantname; ?> &nbsp;<?php echo $applicantsurname; ?>&nbsp;&nbsp;</span>&nbsp;</span><span class="style3">&nbsp;รหัสผู้สมัคร</span><span class="style4">&nbsp;<span class="style3">&nbsp;<?php echo $applicantcode; ?></span></span></td>
  </tr>
  <tr class="style3">
    <td><table width="100%" border="1" cellpadding="1" cellspacing="0" class="style3">
      <tr>
        <td><table width="100%" border="0" cellpadding="1" cellspacing="0" class="style3">
          <tr>
            <td width="21%" rowspan="5"><div align="center">ลำดับที่ 1 </div></td>
          </tr>
          <tr>
            <td>&nbsp;สาขาวิชา : <?php echo $q1; ?></td>
          </tr>
          <tr>
            <td>&nbsp;หลักสูตร : <?php echo $d1; ?></td>
          </tr>
          <tr>
            <td> &nbsp;แขนงวิชา : ...............................................</td>
          </tr>
          <tr>
            <td>&nbsp;คณะ : <?php echo $f1; ?></td>
          </tr>
        </table></td>
        <td><table width="100%" border="0" cellpadding="1" cellspacing="0" class="style3">
          <tr>
            <td width="21%" rowspan="5"><div align="center">ลำดับที่ 3 </div></td>
          </tr>
          <tr>
            <td>&nbsp;สาขาวิชา : <?php echo $q3; ?></td>
          </tr>
          <tr>
            <td>&nbsp;หลักสูตร : <?php echo $d3; ?></td>
          </tr>
          <tr>
            <td>&nbsp;แขนงวิชา : ...............................................</td>
          </tr>
          <tr>
            <td>&nbsp;คณะ : <?php echo $f3; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="1" cellspacing="0" class="style3">
          <tr>
            <td width="21%" rowspan="5"><div align="center">ลำดับที่ 2 </div></td>
          </tr>
          <tr>
            <td>&nbsp;สาขาวิชา : <?php echo $q2; ?></td>
          </tr>
          <tr>
            <td>&nbsp;หลักสูตร : <?php echo $d2; ?></td>
          </tr>
          <tr>
            <td>&nbsp;แขนงวิชา : .............................................</td>
          </tr>
          <tr>
            <td>&nbsp;คณะ : <?php echo $f2; ?></td>
          </tr>
        </table></td>
        <td><table width="100%" border="0" cellpadding="1" cellspacing="0" class="style3">
          <tr>
            <td width="21%" rowspan="5"><div align="center">ลำดับที่ 4 </div></td>
          </tr>
          <tr>
            <td>&nbsp;สาขาวิชา : <?php echo $q4; ?></td>
          </tr>
          <tr>
            <td>&nbsp;หลักสูตร : <?php echo $d4; ?></td>
          </tr>
          <tr>
            <td>&nbsp;แขนงวิชา : .............................................</td>
          </tr>
          <tr>
            <td>&nbsp;คณะ : <?php echo $f4; ?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr class="style3">
    <td>&nbsp;</td>
  </tr>
  <tr class="style3">
    <td><div align="center"></div></td>
  </tr>
  <tr class="style3">
    <td><div align="center">ลงชื่อ.............................................ผู้ตรวจบัตรประจำตัวผู้สมัคร</div></td>
  </tr>
</table>
