<?php
//header("Content-type: application/vnd.ms-word");
//header("Content-Disposition: attachment; filename=PrintEntry.doc");
?>
<?php	session_start();
	$applicantid = $_SESSION['applicantid_sess'];	
?>

<?php include("../../config/connect.php");  ?>
<?php include("../../sysconfigmas.php");  ?>
<?php $strSQL = "SELECT PREFIX.PREFIXNAME, PREFIX.PREFIXNAMEENG, APPLICANT.APPLICANTCODE, APPLICANT.APPLYFROM, APPLICANT.ACADYEAR, APPLICANT.SEMESTER, APPLICANT.ROUND, APPLICANT.BIRTHDATE, APPLICANT.CITIZENID, APPLICANT.APPLICANTNAME, APPLICANT.APPLICANTNAMEENG, APPLICANT.APPLICANTSURNAME, APPLICANT.APPLICANTSURNAMEENG, APPLICANT.APPLICANTMAIL, APPLICANT.APPLICANTTYPE,APPLICANT.HOMEADDRESS1,APPLICANT.HOMEADDRESS2,APPLICANT.HOMEDISTRICT,APPLICANT.HOMEZIPCODE, APPLICANT.HOMEPHONENO, APPLICANT.GPAX,  ENTRYDEGREE.ENTRYDEGREENAME, PROVINCE.PROVINCENAME, APPLICANT.APPLICANTID, APPLICANT.APPLICANTDATE, APPLICANT.OFFICENAME, APPLICANT.OFFICEADDRESS1, APPLICANT.WORKINGSTATUS, APPLICANT.WORKINGPOSITION, APPLICANT.WORKINGSALARY, APPLICANT.OFFICEPHONENO, APPLICANT.OFFICEFAXNO, avsreg.APPLICANTPHD.* FROM (((avsreg.APPLICANT LEFT JOIN avsreg.PREFIX ON APPLICANT.PREFIXID = PREFIX.PREFIXID) LEFT JOIN avsreg.ENTRYDEGREE ON APPLICANT.PROGRAMTYPE = ENTRYDEGREE.ENTRYDEGREECODE) LEFT JOIN avsreg.PROVINCE ON APPLICANT.HOMEPROVINCEID = PROVINCE.PROVINCEID) LEFT JOIN avsreg.APPLICANTPHD ON APPLICANT.APPLICANTID = APPLICANTPHD.APPLICANTID WHERE (((APPLICANT.APPLICANTID)='$applicantid'))";
$result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
while($objResult = odbc_fetch_row($result))
	{
		$applicantcode= odbc_result($result,"applicantcode");	
		$citizen= odbc_result($result,"citizenid");	
		$fstatus= odbc_result($result,"applyfrom");	
		$bdate= odbc_result($result,"birthdate");	
		$prefixnameeng= odbc_result($result,"prefixnameeng");
		$applicantnameeng= odbc_result($result,"applicantnameeng");
		$applicantsurnameeng= odbc_result($result,"applicantsurnameeng");
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
		$applicantmail= odbc_result($result,"applicantmail");		
		$gpax= odbc_result($result,"gpax");			
		$entrydegreename= iconv("TIS-620","UTF-8",odbc_result($result,"entrydegreename"));	
		$provincename= iconv("TIS-620","UTF-8",odbc_result($result,"provincename"));
		
		$cjob = odbc_result($result,"workingstatus");
		$atjob = odbc_result($result,"officename");
		$atjob_cv = iconv( "TIS-620","UTF-8","$atjob");
		$atwork = odbc_result($result,"officeaddress1");
		$atwork_cv = iconv( "TIS-620","UTF-8","$atwork");
		$workposition = odbc_result($result,"workingposition");
		$workposition_cv = iconv( "TIS-620","UTF-8","$workposition");
		$salary = odbc_result($result,"workingsalary");
		$phone1 = odbc_result($result,"officephoneno");
		$phone2 = odbc_result($result,"officefaxno");
		//$schoolname= iconv("TIS-620","UTF-8",odbc_result($result,"schoolname"));
		$schoolbclid = odbc_result($result,"schoolbclid");
		$schoolmasid = odbc_result($result,"schoolmasid");
		$programbcl = odbc_result($result,"programbcl");
		$programbcl_cv = iconv( "TIS-620","UTF-8","$programbcl");
		$degreebcl = odbc_result($result,"degreebcl");
		$degreebcl_cv = iconv( "TIS-620","UTF-8","$degreebcl");
		$yearbcl = odbc_result($result,"graduateyearbcl");
		$gpabcl = odbc_result($result,"gpabcl");
		$programmas = odbc_result($result,"programmas");
		$programmas_cv = iconv( "TIS-620","UTF-8","$programmas");
		$degreemas = odbc_result($result,"degreemas");
		$degreemas_cv = iconv( "TIS-620","UTF-8","$degreemas");
		$yearmas = odbc_result($result,"graduateyearmas");
		$gpamas = odbc_result($result,"gpamas");
		$acadyearin = odbc_result($result,"ACADYEAR");
	      $semesterin = odbc_result($result,"SEMESTER");
		  $roundin = odbc_result($result,"ROUND");
	}
				
?>
    

<!--ประเภทการสมัคร-->
<?php if($levelid == '42') { $text_type = "โท"; } else { $text_type = "เอก"; } ?> <?php if($period == '1') { $text_type2 = "(ภาคปกติ)"; } else { $text_type2 = "(ภาคพิเศษ)"; } ?>


<!--สถานภาพสมรสผู้สมัคร-->
<?php if($fstatus==1){ $checkstatus="checked='checked'"; } if($fstatus==2){ $checkstatus2="checked='checked'"; } if($fstatus==3){ $checkstatus3="checked='checked'"; } if($fstatus==4){ $checkstatus4="checked='checked'"; }?> 


<!--สถานภาพการทำงานสผู้สมัคร-->
<?php  if($cjob==1){ $checkstatus_job="checked='checked'"; } if($cjob==0){ $checkstatus_job2="checked='checked'"; } ?> 

<!--ประวัติการศึกษาระดับปริญญาตรี-->
	 <?php
                        $strSQL = "SELECT SCHOOL.SCHOOLID, SCHOOL.SCHOOLNAME FROM avsreg.SCHOOL WHERE (((SCHOOL.SCHOOLID)='$schoolbclid'))";
                        $result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
                  		while(odbc_fetch_row($result))
							{
								$schoolbclid= odbc_result($result,"schoolid");	
								$schoolname= odbc_result($result,"schoolname");	
								$schoolnamebcl_cv = iconv("TIS-620", "UTF-8", "$schoolname");
                                                                
                            }
      			 ?>


<!--ประวัติการศึกษาระดับปริญญาโท-->
		<?php
                        $strSQL = "SELECT SCHOOL.SCHOOLID, SCHOOL.SCHOOLNAME FROM avsreg.SCHOOL WHERE (((SCHOOL.SCHOOLID)='$schoolmasid'))";
                        $result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
                  		while(odbc_fetch_row($result))
							{
								$schoolmasid= odbc_result($result,"schoolid");	
								$schoolname= odbc_result($result,"schoolname");	
								$schoolnamemas_cv = iconv("TIS-620", "UTF-8", "$schoolname");
                                                                
                            }
      			 ?>



<!--สาขาวิชา-->
        <?php $strSQL1 = "SELECT APPLICANTSELECTION.SEQUENCE, QUOTA.QUOTANAME,QUOTA.QUOTANAMEENG, QUOTA.LEVELID, QUOTASTATUS.STUDYPERIOD 
FROM (avsreg.APPLICANTSELECTION INNER JOIN avsreg.QUOTASTATUS ON APPLICANTSELECTION.QUOTASTATUSID = QUOTASTATUS.QUOTASTATUSID) INNER JOIN avsreg.QUOTA ON QUOTASTATUS.QUOTAID = QUOTA.QUOTAID WHERE (((APPLICANTSELECTION.APPLICANTID)='$applicantid')) ORDER BY APPLICANTSELECTION.SEQUENCE";
$result1 = odbc_exec($objConnect, $strSQL1) or die ("Error Execute [".$strSQL1."]");

		?>
          <?php 
		  while($objResult1 = odbc_fetch_row($result1))
		{
		$sequence= odbc_result($result1,"sequence");	
		$levelid= odbc_result($result1,"levelid");
		$period= odbc_result($result1,"studyperiod");
		$quotaname= iconv("TIS-620","UTF-8",odbc_result($result1,"quotaname"));	
		$acad= iconv("TIS-620","UTF-8",odbc_result($result1,"quotanameeng"));	
		//$degreename= iconv("TIS-620","UTF-8",odbc_result($result1,"degreename"));	
		//$facultyname= iconv("TIS-620","UTF-8",odbc_result($result1,"facultyname"));	
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






$mpdf->WriteHTML('<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
<!--
.style1 {font-size: 24px}
.style2 {font-size: 15px}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
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
.style4 {font-size: 15; font-family: "Cordia New";}
.style7 { font-size: 16;font-family: "Cordia New";  }
.style8 {font-size: 28px; font-family: "Cordia New"; }
.style3 {	font-family: "Cordia New";
	font-size: 15px;
}
.style9 {font-size: 16px; font-family: "Cordia New"; font-weight: bold; }

-->
</style>
<body>
<table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <th class="style7" >สมัครผ่านระบบ Online </th>
        <th scope="col">&nbsp;</th>
        <th class="style7" >รหัสผู้สมัคร '. $applicantcode.'</th>
      </tr>
      <tr>
        <th width="25%" scope="col">&nbsp;</th>
        <th width="50%" scope="col"><div align="left" class="style7">
          <div align="center"><img src="http://assess.rbru.ac.th/admission/images/logo3.png" width="77" height="99"><br>
              ใบสมัครเพื่อเข้าศึกษาในระดับปริญญา'.$text_type.''.$text_type2.'<br> บัณฑิตวิทยาลัย มหาวิทยาลัยราชภัฏรำไพพรรณี 
     
             ประจำปีการศึกษา  '.$semesterin."/".$acadyearin.' <br>
            <br>
          </div>
        </div></th>
        <th width="25%" scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td width="29%">&nbsp;</td>
            <td width="71%"><table width="70%" height="16%" border="1" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><div align="center"><span class="style3">รูปถ่าย 1 นิ้ว <br>
                          <br>
                          <br>
                          <br>
                          <br>
                          <br>
                </span></div></td>
              </tr>
            </table></td>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th class="style7" >หลักสูตร'.$acad.'</th>
        <th colspan="2" class="style7"  style="text-align:left;"> - สาขาวิชา '.$quotaname.'</th>
        </tr>
    </table></th>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th scope="col"><table width="100%" border="1" cellspacing="0" cellpadding="5">
          <tr>
            <td class="style4"  style="text-align:left;">ข้อมูลส่วนบุคคล</td>
          </tr>
          <tr>
            <td scope="col" style="text-align:left;" class="style7">1. เลขประจำตัวประชาชน &nbsp;&nbsp; : &nbsp; '.$citizen.'</td>
          </tr>
          <tr>
            <td style="text-align:left;" class="style7">2. ชื่อ - สกุล (ภาษาไทย) &nbsp;&nbsp;: &nbsp;'.$prefixname.$applicantname.'  '.$applicantsurname.'<br>
&nbsp;&nbsp;&nbsp;&nbsp;ชื่อ - สกุล (ภาษาอังกฤษ) &nbsp;: &nbsp;&nbsp; '.$prefixnameeng.$applicantnameeng.'  '.$applicantsurnameeng.'</td>
          </tr>
          <tr>
            <td style="text-align:left;" class="style7" >3. วัน/เดือน/ปี เกิด &nbsp;: &nbsp;<span class="style7">'.datethai($bdate).'</span></td>
          </tr>
          <tr>
            <td style="text-align:left;" class="style7" >4. สถานภาพสมรส &nbsp;&nbsp;: &nbsp;
              <input type="checkbox" name="checkbox3" value="checkbox" '.$checkstatus.'>
             โสด &nbsp;&nbsp;&nbsp;&nbsp;
             <input type="checkbox" name="checkbox32" value="checkbox" '.$checkstatus2.'>
             สมรส
             &nbsp;&nbsp;&nbsp;&nbsp;
             <input type="checkbox" name="checkbox33" value="checkbox" '.$checkstatus3.'>
             หม้าย
             &nbsp;&nbsp;&nbsp;&nbsp;
             <input type="checkbox" name="checkbox34" value="checkbox" '.$checkstatus4.'>
             หย่าร้าง
             &nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr>

          <tr>
            <td style="text-align:left;" class="style7">5. ที่อยู่ปัจจุบันที่สามารถติดต่อได้<br>
&nbsp;&nbsp;&nbsp;&nbsp;เลขที่ &nbsp; '.$address.'&nbsp;&nbsp;&nbsp;&nbsp;ตำบล/แขวง &nbsp;&nbsp;'.$address2.'&nbsp;&nbsp;&nbsp;อำเภอ/เขต&nbsp;&nbsp; '.$address3.'&nbsp;&nbsp;&nbsp;&nbsp;จังหวัด  &nbsp; <span class="style7">'.$provincename.'</span>&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;รหัสไปรษณีย์ &nbsp;: <span class="style7">'.$zipcode.'</span>&nbsp;&nbsp;&nbsp;&nbsp;โทร : <span class="style7">'.$homephoneno.'</span> &nbsp;E - mail : <span class="style7">'.$applicantmail.'</span><br>

            </td>
          </tr>
          <tr>
            <td style="text-align:left;" class="style7">6. ประวัติการศึกษาระดับปริญญาตรี<br>
              <table width="100%" border="1" cellspacing="0" cellpadding="3" style="text-align:center;">
                <tr>
                  <td class="style2"><div align="center" class="style7">สถาบันศึกษา</div></td>
                  <td class="style2"><div align="center" class="style7">สาขาวิชาเอก</div></td>
                  <td class="style2"><div align="center" class="style7">ชื่อปริญญา</div></td>
                  <td class="style2"><div align="center" class="style7">ปีที่สำเร็จ<br>
                  การศึกษา</div></td>
                  <td class="style2"><div align="center" class="style7">เกรด<br>
                  เฉลี่ย</div></td>
                </tr>
                <tr>
	
                  <td><span class="style7">'.$schoolnamebcl_cv.'</span></td>
                  <td><span class="style7"> '.$programbcl_cv.'</span></td>
                  <td><span class="style7">'.$degreebcl_cv.'</span></td>
                  <td><span class="style7">'.$yearbcl.'</span></td>
                  <td><span class="style7">'.$gpabcl.'</span></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
              <br>
            </div></td>
          </tr>
          <tr>
            <td class="style7" style="text-align:left;" ><span >7. ประวัติการศึกษาระดับปริญญาโท</span> <br>
              <table width="100%" border="1" cellspacing="0" cellpadding="3" style="text-align:center;">
                <tr>
                  <td class="style2"><div align="center" class="style7">สถาบันศึกษา</div></td>
                  <td class="style2"><div align="center" class="style7">สาขาวิชาเอก</div></td>
                  <td class="style2"><div align="center" class="style7">ชื่อปริญญา</div></td>
                  <td class="style2"><div align="center" class="style7">ปีที่สำเร็จ<br>
                    การศึกษา</div></td>
                  <td class="style2"><div align="center" class="style7">เกรด<br>
                    เฉลี่ย</div></td>
                </tr>
                <tr>
			
                  <td><span class="style7">'.$schoolnamemas_cv.'</span></td>
                  <td><span class="style7">'.$programmas_cv.'</span></td>
                  <td><span class="style7">'.$degreemas_cv.'</span></td>
                  <td><span class="style7">'.$yearmas.'</span></td>
                  <td><span class="style7">'.$gpamas.'</span></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td class="style7" style="text-align:left;" >8. สถานภาพการทำงาน ปัจจุบัน &nbsp;&nbsp; : &nbsp;
                  <input type="checkbox" name="checkbox4" value="checkbox" '.$checkstatus_job.'>
              ทำงาน &nbsp;&nbsp;&nbsp;
  <input type="checkbox" name="checkbox22" value="checkbox" '.$checkstatus_job2.'>
              ไม่ทำงาน &nbsp;<br>
              สถานที่ทำงาน &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;'. $atjob_cv.'<br>
              ที่ตั้ง &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;'. $atwork_cv.'<br>
              ตำแหน่งงาน &nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;'. $workposition_cv.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายได้ต่อเดือน &nbsp;&nbsp;:&nbsp; &nbsp;'. number_format($salary).' &nbsp;บาท<br>
              โทรศัพท์ &nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;'. $phone1.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โทรสาร &nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;'. $phone2.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
          </tr>
        </table>
          <table width="850" border="0" style="text-align:left;" cellpadding="5" cellspacing="0">
            <tr>
            
              <td ><p  class="style7"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้าขอรับรองว่าข้อความทั้งหมดนี้เป็นความจริงทุกประการ และข้าพเจ้าได้ศึกษาหลักสูตรและเงื่อนไขการศึกษาต่าง ๆ เข้าใจดีแล้วและพร้อมปฏิบัติตาม </p>
              <br>
                  <p class="style7" padding-left:5em >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงชื่อผู้สมัคร ....................................................................<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(.................................................................) <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่สมัคร : ...........'. datethai($applicantdate).'........... </p></td>
            </tr>
          </table></th>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>


<table width="850" border="1" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td><span class="style7"> สำหรับเจ้าหน้าที่ <br>
    .......... สำเนาทะเบียนบ้าน จำนวน 3 ฉบับ <br>
    .......... สำเนาบัตรประชาชน จำนวน 3 ฉบับ<br>
    .......... สำเนาหลักฐานการเปลี่ยนคำนำหน้า - ชื่อ - นามสกุล (ถ้ามี) จำนวน 3 ฉบับ<br>
    .......... สำเนาปริญญาบัตรหรือสำเนาใบรับรองคุณวุฒิที่แสดงว่าจบการศึกษาระดับปริญญาตรี จำนวน 5 ฉบับ<br>
    .......... สำเนาใบรายงานผลการศึกษาระดับปริญญาตรี (Trancript) จำนวน 5 ฉบับ
    <br>
    .......... รูปถ่ายแบบสุภาพ ขนาด 1 นิ้ว จำนวน 3 รูป (ถ่ายไม่เกิน 6 เดือน) <br>
     - <strong>เอกสารเพิ่มเติมสำหรับ หลักสูตรครุศาสตรมหาบัณฑิต สาขาวิชาการบริหารการศึกษา</strong><br>
     .......... สำเนาใบรายงานผลการศึกษาระดับประกาศนียบัตรวิชาชีพครู (Trancript) ที่ออกโดยสถาบันการศึกษา (ถ้ามี) จำนวน 5 ฉบับ <br>
     .......... สำเนาปริญญาบัตรการศึกษาระดับประกาศนียบัตรวิชาชีพครู  ที่ออกโดยสถาบันการศึกษา (ถ้ามี) จำนวน 5 ฉบับ<br>
     .......... สำเนาบัตรประจำตัวใบอนุญาติประกอบวิชาชีพครู  ที่ออกโดยครุสภา (ถ้ามี) จำนวน 5 ฉบับ<br>
     .......... สำเนาใบอนุญาติให้เป็นผู้ประกอบวิชาชีพครู  ที่ออกโดยครุสภา (ถ้ามี) จำนวน 5 ฉบับ<br>

    </span>
      <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td><span class="style7">ตรวจหลักฐานและเอกสารประกอบการสมัครแล้ว<br>
.......... ครบถ้วน &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.......... ยังไม่ครบถ้วน<br>
ขาดหลักฐาน / เอกสาร ...........................................................................<br>
...........................................................................................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงชื่อผู้รับสมัคร ....................................................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่ตรวจหลักฐานการสมัคร .............................................</span></td>
          <td class="style7"><span > ได้รับเงินค่าสมัคร ..........................................................บาทถ้วน<br> 
ตามใบเสร็จรับเงิน  เล่มที่ ........................ เลขที่ ...........................
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(แนบหลักฐานการชำระเงิน เมื่อชำระเงินผ่านธนาคาร)</span><span class="style7"></span></td>
        </tr>
    </table></td>
  </tr>
</table>

<br>
<table width="850" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td><span class="style7"> - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -<br>
        </span>
      <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td width="84%" class="style7"><img src="http://assess.rbru.ac.th/admission/images/logo3.png" width="77" height="99" align="middle"> &nbsp;&nbsp;&nbsp;<strong class="style8">บัณฑิตวิทยาลัย มหาวิทยาลัยราชภัฏรำไพพรรณี </strong></td>
              <td width="16%"><div align="center">
                <table width="70%" height="12%" border="1" align="center" cellpadding="0" cellspacing="0">
                  <tr class="style7">
                    <td><div align="center"><span class="style3">รูปถ่าย 1 นิ้ว <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                    </span></div></td>
                  </tr>
                </table>
              </div></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><p class="style7"> ชื่อผู้สมัคร :&nbsp; '. $prefixname.$applicantname."  ".$applicantsurname.'<br>
            รหัสประจำตัวผู้สมัคร :&nbsp;'. $applicantcode.'<br>
            หลักสูตร :&nbsp;'. $acad.'<br>
          สาขาวิชา :&nbsp;'. $quotaname.'</p>
            <p class="style9">ผลการสอบสัมภาษณ์</p>
        <br>
          <p class="style7">................... ผ่านการสอบสัมภาษณ์ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;................... ไม่ผ่านการสอบสัมภาษณ์ </p>
             <br>
<p class="style7">ความเห็นอื่นๆ : ..................................................................................................................................................................<br>
          .........................................................................................................................................................................................</p>
     <br>
<p  class="style7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงชื่อ .......................................................กรรมการสอบสัมภาษณ์ <br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงชื่อ .......................................................กรรมการสอบสัมภาษณ์<br>
            <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;กรุณานำมาวันสอบสัมภาษณ์</strong></p></td>
             
        </tr>
      </table>
     </td>
  </tr>
</table>');
$mpdf->Output();



