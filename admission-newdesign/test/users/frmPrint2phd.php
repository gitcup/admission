<?
//header("Content-type: application/vnd.ms-word");
//header("Content-Disposition: attachment; filename=PrintEntry.doc");
?>
<?	session_start();
include "check_session.php";
include("../config/connect.php"); ?>
<? include("../sysconfigphd.php"); 
$applicantid = $_GET[appid];
 ?>

<? $strSQL = "SELECT PREFIX.PREFIXNAME, PREFIX.PREFIXNAMEENG, APPLICANT.APPLICANTCODE, APPLICANT.APPLYFROM, APPLICANT.ACADYEAR, APPLICANT.SEMESTER, APPLICANT.BIRTHDATE, APPLICANT.CITIZENID, APPLICANT.APPLICANTNAME, APPLICANT.APPLICANTNAMEENG, APPLICANT.APPLICANTSURNAME, APPLICANT.APPLICANTSURNAMEENG, APPLICANT.APPLICANTMAIL, APPLICANT.APPLICANTTYPE,APPLICANT.HOMEADDRESS1,APPLICANT.HOMEADDRESS2,APPLICANT.HOMEDISTRICT,APPLICANT.HOMEZIPCODE, APPLICANT.HOMEPHONENO, APPLICANT.GPAX,  ENTRYDEGREE.ENTRYDEGREENAME, PROVINCE.PROVINCENAME, APPLICANT.APPLICANTID, APPLICANT.APPLICANTDATE, APPLICANT.OFFICENAME, APPLICANT.OFFICEADDRESS1, APPLICANT.WORKINGSTATUS, APPLICANT.WORKINGPOSITION, APPLICANT.WORKINGSALARY, APPLICANT.OFFICEPHONENO, APPLICANT.OFFICEFAXNO,  VOUCHER.VOUCHERTYPECODE, VOUCHER.ACCOUNTYEAR, VOUCHER.BOOKNUMBER, VOUCHER.RUNNINGNUMBER, avsreg.APPLICANTPHD.* FROM ((((avsreg.APPLICANT INNER JOIN avsreg.PREFIX ON APPLICANT.PREFIXID = PREFIX.PREFIXID) LEFT JOIN avsreg.ENTRYDEGREE ON APPLICANT.PROGRAMTYPE = ENTRYDEGREE.ENTRYDEGREECODE) INNER JOIN avsreg.PROVINCE ON APPLICANT.HOMEPROVINCEID = PROVINCE.PROVINCEID) LEFT JOIN avsreg.APPLICANTPHD ON APPLICANT.APPLICANTID = APPLICANTPHD.APPLICANTID) LEFT JOIN avsreg.VOUCHER ON VOUCHER.APPLICANTID = APPLICANT.APPLICANTID WHERE (((APPLICANT.APPLICANTID)='$applicantid') and ((voucher.voucherstatus)<>'V'))";
$result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
while($objResult = odbc_fetch_row($result))
	{
	$acadyear= odbc_result($result,"acadyear");	
		$semester= odbc_result($result,"semester");	
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
		
		$vtypecode= odbc_result($result,"vouchertypecode");	
		$accountyear= odbc_result($result,"accountyear");	
		$booknumber= odbc_result($result,"booknumber");	
		$running= odbc_result($result,"runningnumber");	
		
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
	}
				
?>
          <? $strSQL1 = "SELECT APPLICANTSELECTION.SEQUENCE, QUOTA.QUOTANAME, QUOTA.QUOTANAMEENG, QUOTA.LEVELID, QUOTASTATUS.STUDYPERIOD 
FROM (avsreg.APPLICANTSELECTION INNER JOIN avsreg.QUOTASTATUS ON APPLICANTSELECTION.QUOTASTATUSID = QUOTASTATUS.QUOTASTATUSID) INNER JOIN avsreg.QUOTA ON QUOTASTATUS.QUOTAID = QUOTA.QUOTAID WHERE (((APPLICANTSELECTION.APPLICANTID)='$applicantid')) ORDER BY APPLICANTSELECTION.SEQUENCE";
$result1 = odbc_exec($objConnect, $strSQL1) or die ("Error Execute [".$strSQL1."]");

		?>
          <? 
		  while($objResult1 = odbc_fetch_row($result1))
		{
		$sequence= odbc_result($result1,"sequence");
		$levelid = odbc_result($result1,"levelid");	
		$period = odbc_result($result1,"studyperiod");	
		//$degreecer = odbc_result($result1,"degreecertificate");
		$degreecer_cv = iconv("TIS-620", "UTF-8", "$degreecer");
		$quotaname= iconv("TIS-620","UTF-8",odbc_result($result1,"quotaname"));	
		$quotanameeng= iconv("TIS-620","UTF-8",odbc_result($result1,"quotanameeng"));	
		//$degreename= iconv("TIS-620","UTF-8",odbc_result($result1,"degreename"));	
		//$facultyname= iconv("TIS-620","UTF-8",odbc_result($result1,"facultyname"));	
		if($sequence == 1) { $q1 = $quotaname; $d1 = $degreename; $f1 = $facultyname; }
		if($sequence == 2) { $q2 = $quotaname; $d2 = $degreename; $f2 = $facultyname;}
		if($sequence == 3) { $q3 = $quotaname; $d3 = $degreename; $f3 = $facultyname;}
		if($sequence == 4) { $q4 = $quotaname; $d4 = $degreename; $f4 = $facultyname;}
		}
		   ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
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
.style4 {font-size: 15}
.style7 {font-size: 20px; font-family: "CordiaUPC"; }

-->
</style>
<body onload=window.print()>
<table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <th class="style7" scope="col">สมัครผ่านระบบ Online </th>
        <th scope="col">&nbsp;</th>
        <th class="style7" scope="col">รหัสผู้สมัคร &nbsp;<? echo $applicantcode; ?></th>
      </tr>
      <tr>
        <th width="25%" scope="col">&nbsp;</th>
        <th width="50%" scope="col"><div align="left" class="style7">
          <div align="center"><span class="style1"><img src="http://assess.rbru.ac.th/admission/images/logo3.png" width="77" height="99"><br>
            บัณฑิตวิทยาลัย มหาวิทยาลัยราชภัฏรำไพพรรณี<br />
            <span class="style1">ใบสมัครเพื่อเข้าศึกษาต่อในระดับ<? if($levelid == '42') { echo "ปริญญาโท"; } 
														if($levelid == '50') { echo "ปริญญาเอก"; } ?>
                                                        <? if($period == '1') { echo " (ภาคปกติ)"; } 
														if($period == '2') { echo " (ภาคพิเศษ)"; }
														 ?>
                                                        <br />
              ประจำปีการศึกษา <? echo $semester."/". $acadyear; ?> </span></span></div>
        </div></th>
        <th width="25%" scope="col">&nbsp;</th>
      </tr>
      <tr>
        <th class="style7" scope="col"><? echo "หลักสูตร".$quotanameeng ?>       </th>
        <th class="style2" scope="col"><div align="left" class="style7"> - สาขาวิชา <? echo $quotaname; ?></div></th>
        <th scope="col">&nbsp;</th>
      </tr>
    </table></th>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th scope="col"><table width="100%" border="1" cellspacing="0" cellpadding="5">
          <tr>
            <td class="style4" scope="col"><div align="left">ข้อมูลส่วนบุคคล</div></td>
          </tr>
          <tr>
            <td scope="col"><div align="left" class="style7">1. เลขประจำตัวประชาชน &nbsp;&nbsp; : &nbsp;<? echo $citizen; ?></div></td>
          </tr>
          <tr>
            <td><div align="left" class="style7">2. ชื่อ - สกุล (ภาษาไทย) &nbsp;&nbsp;: &nbsp;<? echo $prefixname.$applicantname."  ".$applicantsurname; ?><br>
&nbsp;&nbsp;&nbsp;&nbsp;ชื่อ - สกุล (ภาษาอังกฤษ) &nbsp;: &nbsp;&nbsp;<? echo $prefixnameeng.$applicantnameeng."  ".$applicantsurnameeng; ?></div></td>
          </tr>
          <tr>
            <td><div align="left" class="style7">3. วัน/เดือน/ปี เกิด &nbsp;: &nbsp;<span class="style7"><? echo datethai($bdate); ?></span></div></td>
          </tr>
          <tr>
            <td><div align="left" class="style7">4. สถานภาพสมรส &nbsp;&nbsp;: &nbsp;
              <input type="checkbox" name="checkbox3" value="checkbox" <? if($fstatus==1){ echo"checked='checked'"; } ?>>
             โสด &nbsp;&nbsp;&nbsp;&nbsp;
             <input type="checkbox" name="checkbox32" value="checkbox" <? if($fstatus==2){ echo"checked='checked'"; } ?>>
             สมรส
             &nbsp;&nbsp;&nbsp;&nbsp;
             <input type="checkbox" name="checkbox33" value="checkbox" <? if($fstatus==3){ echo"checked='checked'"; } ?>>
             หม้าย
             &nbsp;&nbsp;&nbsp;&nbsp;
             <input type="checkbox" name="checkbox34" value="checkbox" <? if($fstatus==4){ echo"checked='checked'"; } ?>>
             หย่าร้าง
             &nbsp;&nbsp;&nbsp;&nbsp;</div></td>
          </tr>

          <tr>
            <td><div align="left" class="style7">5. ที่อยู่ปัจจุบันที่สามารถติดต่อได้<br>
&nbsp;&nbsp;&nbsp;&nbsp;เลขที่ &nbsp; <? echo $address; ?>&nbsp;&nbsp;&nbsp;&nbsp;ตำบล/แขวง &nbsp;&nbsp;<? echo $address2; ?>&nbsp;&nbsp;&nbsp;อำเภอ/เขต&nbsp;&nbsp; <? echo $address3; ?>&nbsp;&nbsp;&nbsp;&nbsp;จังหวัด  &nbsp; <span class="style7"><? echo $provincename; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;รหัสไปรษณีย์ &nbsp;: <span class="style7"><? echo $zipcode; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;โทร : <span class="style7"><? echo $homephoneno; ?></span> &nbsp;E - mail : <span class="style7"><? echo $applicantmail; ?></span><br>
            </div></td>
          </tr>
          <tr>
            <td><div align="left"><span class="style7">6. ประวัติการศึกษาระดับปริญญาตรี</span><br>
              <table width="100%" border="1" cellspacing="0" cellpadding="3">
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
				 <?
                        $strSQL = "SELECT SCHOOL.SCHOOLID, SCHOOL.SCHOOLNAME FROM avsreg.SCHOOL WHERE (((SCHOOL.SCHOOLID)='$schoolbclid'))";
                        $result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
                  		while(odbc_fetch_row($result))
							{
								$schoolbclid= odbc_result($result,"schoolid");	
								$schoolname= odbc_result($result,"schoolname");	
								$schoolnamebcl_cv = iconv("TIS-620", "UTF-8", "$schoolname");
                                                                
                            }
      			 ?>
                  <td><span class="style7"><? echo $schoolnamebcl_cv; ?></span></td>
                  <td><span class="style7"> <? echo $programbcl_cv; ?></span></td>
                  <td><span class="style7"><? echo $degreebcl_cv; ?></span></td>
                  <td><span class="style7"><? echo $yearbcl; ?></span></td>
                  <td><span class="style7"><? echo $gpabcl; ?></span></td>
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
            <td><div align="left"><span class="style7">7. ประวัติการศึกษาระดับปริญญาโท</span> <br>
              <table width="100%" border="1" cellspacing="0" cellpadding="3">
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
				<?
                        $strSQL = "SELECT SCHOOL.SCHOOLID, SCHOOL.SCHOOLNAME FROM avsreg.SCHOOL WHERE (((SCHOOL.SCHOOLID)='$schoolmasid'))";
                        $result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
                  		while(odbc_fetch_row($result))
							{
								$schoolmasid= odbc_result($result,"schoolid");	
								$schoolname= odbc_result($result,"schoolname");	
								$schoolnamemas_cv = iconv("TIS-620", "UTF-8", "$schoolname");
                                                                
                            }
      			 ?>
                  <td><span class="style7"><? echo $schoolnamemas_cv; ?></span></td>
                  <td><span class="style7"><? echo $programmas_cv; ?></span></td>
                  <td><span class="style7"><? echo $degreemas_cv; ?></span></td>
                  <td><span class="style7"><? echo $yearmas; ?></span></td>
                  <td><span class="style7"><? echo $gpamas; ?></span></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td><div align="left" class="style7">8. การทดสอบภาษาอังกฤษ ที่เคยสอบมาแล้วไม่เกิน 2 ปี<br>
&nbsp;&nbsp;&nbsp;&nbsp;- TOEFL ได้คะแนน ................<span class="style7">................</span> ปีที่ได้ <span class="style7">................</span>................... &nbsp;&nbsp;&nbsp;- TU-Get  &nbsp;ได้คะแนน ...<span class="style7">................</span>............. ปีที่ได้ ..<span class="style7">................</span>.................<br>
            &nbsp;&nbsp;&nbsp;&nbsp;- IELTS &nbsp;&nbsp;ได้คะแนน ................<span class="style7">................</span> ปีที่ได้ ................<span class="style7">................</span>... &nbsp;&nbsp;&nbsp;- CU-Tep  ได้คะแนน ....<span class="style7">................</span>............ ปีที่ได้ ...<span class="style7">................</span>................<br>
            <br>
            </div></td>
          </tr>
          <tr>
            <td><div align="left" class="style7">9. รางวัลและทุนการศึกษาที่เคยได้รับ (ถ้ามี) <br>
                <span class="style7">.......................................................................................................................................................................................................................................................................<br>
            .......................................................................................................................................................................................................................................................................</span></div>
             
              <span class="style7">.......................................................................................................................................................................................................................................................................<br>
              .......................................................................................................................................................................................................................................................................<br>
              .......................................................................................................................................................................................................................................................................</span></td>
          </tr>
        </table></th>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="550" border="1" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td scope="col"><div align="left" class="style7">10. สถานภาพการทำงาน ปัจจุบัน &nbsp;&nbsp; : &nbsp;
      <input type="checkbox" name="checkbox" value="checkbox" <? if($cjob==1){ echo"checked='checked'"; } ?>>
      ทำงาน &nbsp;&nbsp;&nbsp;
      <input type="checkbox" name="checkbox2" value="checkbox" <? if($cjob==0){ echo"checked='checked'"; } ?>>
ไม่ทำงาน &nbsp;<br>
    สถานที่ทำงาน &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;<? echo $atjob_cv; ?><br>
    ที่ตั้ง &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;<? echo $atwork_cv; ?><br>
    ตำแหน่งงาน &nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;<? echo $workposition_cv; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายได้ต่อเดือน &nbsp;&nbsp;:&nbsp; &nbsp;<? echo number_format($salary); ?> &nbsp;บาท<br>
    โทรศัพท์ &nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;<? echo $phone1; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โทรสาร &nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;<? echo $phone2; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="left" class="style7">11. อธิบายลักษณะงานตำแหน่งปัจจุบันของท่าน (เช่น งานบริหารหรือวิชาการ มีหน้าที่รับผิดชอบอะไรบ้าง เป็นต้น) <br>
      .......................................................................................................................................................................................................................................................................<br>
        .......................................................................................................................................................................................................................................................................<br>
        .......................................................................................................................................................................................................................................................................<br>
    </div></td>
  </tr>
  <tr>
    <td><div align="left" class="style7">12. ผลงานทางวิชาการ<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;12.1 .......................................................................................................................................................................................................................................................<br>
    .......................................................................................................................................................................................................................................................................
    <br>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;12.2 .......................................................................................................................................................................................................................................................<br>
    .......................................................................................................................................................................................................................................................................<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;12.3 .......................................................................................................................................................................................................................................................<br>
      .......................................................................................................................................................................................................................................................................</div>
    </div></td>
  </tr>
</table>
<table width="850" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td><p class="style7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้าขอรับรองว่าข้อความทั้งหมดนี้เป็นความจริงทุกประการ และข้าพเจ้าได้ศึกษาหลักสูตรและเงื่อนไขการศึกษาต่าง ๆ เข้าใจดีแล้วและพร้อมปฏิบัติตาม </p>
    <p align="right" class="style7">ลงชื่อผู้สมัคร ....................................................................<br>
      (.................................................................)
        <br>
    วันที่สมัคร : ...........<span class="style7"><? echo datethai($applicantdate); ?></span>........... </p></td>
  </tr>
</table>
<table width="850" border="1" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td><span class="style7"> สำหรับเจ้าหน้าที่ <br>
    .......... สำเนาทะเบียนบ้าน จำนวน 3 ฉบับ <br>
    .......... สำเนาบัตรประชาชน จำนวน 3 ฉบับ<br>
    .......... สำเนาหลักฐานการเปลี่ยนคำนำหน้า - ชื่อ - นามสกุล (ถ้ามี) จำนวน 3 ฉบับ<br>
    .......... สำเนาปริญญาบัตรหรือสำเนาใบรับรองคุณวุฒิที่แสดงว่าจบการศึกษาระดับปริญญาโท จำนวน 5 ฉบับ<br>
    .......... สำเนาใบรายงานผลการศึกษาระดับปริญญาโท (Trancript) จำนวน 5 ฉบับ<br>
    .......... สำเนาเอกสารแสดงผลคะแนนการทดสอบภาษาอังกฤษ (ถ้ามี) จำนวน 5 ฉบับ<br>
    .......... รูปถ่ายแบบสุภาพ ขนาด 1 นิ้ว จำนวน 3 รูป<br>
    .......... เอกสารเพิ่มเติมสำหรับหลักสูตรปรัชญาดุษฎีบัณฑิต สาขาวิชาการบริหารการศึกษา<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- หนังสือรับรองการปฏิบัติงานจากผู้บังคับบัญชา (ฉบับจริง) จำนวน 1 ฉบับ<br>

    </span>
      <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td><span class="style7">ตรวจหลักฐานและเอกสารประกอบการสมัครแล้ว<br>
.......... ครบถ้วน &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.......... ยังไม่ครบถ้วน<br>
ขาดหลักฐาน / เอกสาร ...........................................................................<br>
...........................................................................................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงชื่อผู้รับสมัคร ....................................................................<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่ตรวจหลักฐานการสมัคร .............................................</span></td>
          <td><span class="style7"> ได้รับเงินค่าสมัคร ................<? if($levelid == '50') { echo "เจ็ดร้อยบาทถ้วน"; } else { echo "สามร้อยบาทถ้วน";}?>.............<br> 
ตามใบเสร็จรับเงิน   เลขที่ ............<? echo $vtypecode."-".$accountyear.":".$booknumber.$running; ?>.............<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(แนบหลักฐานการชำระเงิน เมื่อชำระเงินผ่านธนาคาร)</span><span class="style7"></span></td>
        </tr>
      </table></td>
  </tr>
</table>

