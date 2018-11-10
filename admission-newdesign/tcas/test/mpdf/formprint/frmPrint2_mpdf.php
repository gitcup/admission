<?php
//header("Content-type: application/vnd.ms-word");
//header("Content-Disposition: attachment; filename=PrintEntry.doc");
?>
<?php	session_start();
$applicantid = $_SESSION['applicantid_sess'];	
?>

<?php include("../../config/connect.php");  ?>
<?php include("../../sysconfig.php");  ?>
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

<!--ประเภทการสมัคร-->
<?php if ($a_type == 'A') { $text_type = "สอบคัดเลือก "; } 
			if ($a_type == 'B') { $text_type =  "portfolio "; } 
			if ($a_type == 'C') { $text_type =  "รับตรง "; }
			if ($a_type == 'Q') { $text_type =  "โควตา "; }
			if ($a_type == 'T') { $text_type =  "รับตรง และโครงการผลิตครูฯ "; }
			?>

<!--สาขาวิชา-->
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
<?php
require_once __DIR__ . '../../../vendor/autoload.php';



//เพิ่มฟ้อน
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '../custom/font/directory',
    ]),
    'fontdata' => $fontData + [
'cordianew' => [
    'R' => 'CORDIA.ttf',
    'I' => 'cordiai.ttf',
    'BI' => "Cordia New Bold Italic.ttf",
]
    ],
    'default_font' => 'frutiger'
        ]);






$mpdf->WriteHTML('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
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
	font-family: "Cordia New";
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
<title>:: ระบบรับสมัครนักศึกษา Online</title>
<style type="text/css">
<!--
.style6 {font-size: 12px}
.style8 {font-size: 12px}
-->
</style>

<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <th width="14%" scope="col" ><img src="http://assess.rbru.ac.th/admission/images/logo3.png" width="77" height="100"></th>
        <th width="64%" scope="col" class="style3" style="text-align:left">มหาวิทยาลัยราชภัฏรำไพพรรณี<br />
            <span class="style2">ใบสมัครบุคคลเข้าศึกษาต่อ ประเภท '.$text_type.'
			
			 หลักสูตรปริญญาตรี <br />
          ประจำปีการศึกษา '.$acadyearin.' รอบที่  '.$roundin.' </span></span>Online</div></th>
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
        <td scope="col"><div align="left" class="style3">รหัสผู้สมัคร   &nbsp;&nbsp;<span class="text16 style2">&nbsp;<span class="style4">&nbsp;'.$applicantcode.'&nbsp;</span>&nbsp;</span>&nbsp;&nbsp;&nbsp;ชื่อผู้สมัคร&nbsp;&nbsp;&nbsp;<span class="style4">&nbsp;&nbsp;'.$prefixname.$applicantname.'&nbsp;'.$applicantsurname.'&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;ที่อยู่ปัจจุบัน ......... '.$address.' ..........</div></td>
        </tr>
      <tr>
        <td><span class="style3">ตำบล/แขวง..........'.$address2.'.......... อำเภอ/เขต.......... '.$address3.'.......... จังหวัด.......... '.$provincename.'......... รหัสไปรษณีย์.......... '.$zipcode.'.......... โทร.&nbsp;&nbsp;&nbsp;'.$homephoneno.'</span></td>
        </tr>
      <tr>
        <td><span class="style3">วุฒิการศึกษา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$entrydegreename.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อสถานศึกษา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$schoolname.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เกรดเฉลี่ย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$gpax.'</span></td>
      </tr>
      <tr>
        <td><span class="style3">สาขาวิชาที่เลือก.....</span></td>
      </tr>
		
      <tr>
        <td style="text-align:center;" class="style3" >
          <table width="60%" style ="border: 1px solid black;text-align:left"  >
            <tr>
              <td bgcolor="#FFFFFF" class="style3" style ="border: 1px solid black;text-align:center" >ลำดับที่ 1 :</td>
              <td bgcolor="#FFFFFF" class="style3"><table width="100%" style ="border: 1px solid black;" >
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3" >&nbsp;&nbsp;สาขาวิชา : '.$q1.'</td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;หลักสูตร : '.$d1.'</td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;แขนงวิชา : .......................................................................</td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;คณะ : '.$f1.'</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF" class="style3" style ="border: 1px solid black;text-align:center"  > ลำดับที่ 2 : </td>
              <td bgcolor="#FFFFFF" class="style3"><table width="100%"  style ="border: 1px solid black;" >
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;สาขาวิชา : '.$q2.'</td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;หลักสูตร : '.$d2.'</td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;แขนงวิชา : .......................................................................</td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;คณะ : '.$f2.'</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF" class="style3" style ="border: 1px solid black;text-align:center" >ลำดับที่ 3 : </td>
              <td bgcolor="#FFFFFF" class="style3"><table width="100%" style ="border: 1px solid black;" >
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;สาขาวิชา : '.$q3.'</td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;หลักสูตร : '.$d3.'</td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;แขนงวิชา : .......................................................................</td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;คณะ : '.$f3.'</td>
                  </tr>
              </table></td>
            </tr>
		 
            <tr>
              <td width="23%" bgcolor="#FFFFFF" class="style3" style ="border: 1px solid black;text-align:center" ><div align="center">ลำดับที่ 4 : </div></td>
              <td width="77%" bgcolor="#FFFFFF" class="style3"><table width="100%" style ="border: 1px solid black;" >
                <tr>
                  <td bgcolor="#FFFFFF" class="style3"> &nbsp;&nbsp;สาขาวิชา : '. $q4.'</td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;หลักสูตร : '. $d4.'</td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF" class="style3"> &nbsp;&nbsp;แขนงวิชา : .......................................................................</td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF" class="style3"> &nbsp;&nbsp;คณะ : '. $f4.'</td>
                </tr>
              </table> </td>
            </tr>
          </table>
        </div></td>
      </tr>
      <tr>
        <td class="style3" style="text-align:center;" ><div align="center" >สมัครผ่านระบบรับสมัครนักศึกษา Online วันที่ &nbsp;&nbsp;'. datethai($applicantdate).' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงชื่อผู้สมัคร ......................................................</td>
      </tr>
      <tr>
        <td style="text-align:center;"  class="style3">หมายเหตุ : นำเอกสารนี้มาแสดงในวันเข้าสอบ</td>
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
    <td><span class="style3">รายละเอียดผู้สมัคร&nbsp;&nbsp;</span><span class="style4"><span class="style3">&nbsp;&nbsp;'.$prefixname.$applicantname.'&nbsp;'. $applicantsurname.'&nbsp;&nbsp;</span>&nbsp;</span><span class="style3">&nbsp;รหัสผู้สมัคร</span><span class="style4">&nbsp;<span class="style3">&nbsp;'. $applicantcode.'</span></span></td>
  </tr>
  <tr class="style3">
    <td><table width="100%"  class="style3">
      <tr>
        <td><table width="100%" border="0" style ="border: 1px solid black;" class="style3">
          <tr>
            <td width="21%" rowspan="5" >ลำดับที่ 1 </td>
          </tr>
          <tr>
            <td>&nbsp;สาขาวิชา : '.$q1.'</td>
          </tr>
          <tr>
            <td>&nbsp;หลักสูตร : '. $d1.'</td>
          </tr>
          <tr>
            <td> &nbsp;แขนงวิชา : ...............................................</td>
          </tr>
          <tr>
            <td>&nbsp;คณะ : '. $f1.'</td>
          </tr>
        </table></td>
        <td><table width="100%" style ="border: 1px solid black;" class="style3" >
          <tr>
            <td width="21%" rowspan="5"><div align="center">ลำดับที่ 3 </div></td>
          </tr>
          <tr>
            <td>&nbsp;สาขาวิชา : '.$q3.'</td>
          </tr>
          <tr>
            <td>&nbsp;หลักสูตร : '.$d3.'</td>
          </tr>
          <tr>
            <td>&nbsp;แขนงวิชา : ...............................................</td>
          </tr>
          <tr>
            <td>&nbsp;คณะ : '. $f3.'</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" style ="border: 1px solid black;"  class="style3">
          <tr>
            <td width="21%" rowspan="5"><div align="center">ลำดับที่ 2 </div></td>
          </tr>
          <tr>
            <td>&nbsp;สาขาวิชา : '.$q2.'</td>
          </tr>
          <tr>
            <td>&nbsp;หลักสูตร : '.$d2.'</td>
          </tr>
          <tr>
            <td>&nbsp;แขนงวิชา : .............................................</td>
          </tr>
          <tr>
            <td>&nbsp;คณะ : '.$f2.'</td>
          </tr>
        </table></td>
        <td><table width="100%" style ="border: 1px solid black;" class="style3">
          <tr>
            <td width="21%" rowspan="5"><div align="center">ลำดับที่ 4 </div></td>
          </tr>
          <tr>
            <td>&nbsp;สาขาวิชา : '. $q4.'</td>
          </tr>
          <tr>
            <td>&nbsp;หลักสูตร : '.$d4.'</td>
          </tr>
          <tr>
            <td>&nbsp;แขนงวิชา : .............................................</td>
          </tr>
          <tr>
            <td>&nbsp;คณะ : '. $f4.'</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr class="style3">
    <td>&nbsp;</td>
  </tr>
  <tr class="style3">

  </tr>
  <tr >
    <td class="style3" style="text-align:center;"  >ลงชื่อ.............................................ผู้ตรวจบัตรประจำตัวผู้สมัคร</td>
  </tr>
</table>');
$mpdf->Output();



