<?	session_start();

include "check_session.php";
include("../config/connect.php");
include("../sysconfigusers.php"); 
$applicantid = $_GET[appid];
 ?>

<? //include("config/connect.php");  ?>
<? //include("sysconfig.php");  ?>
<? $a2 = "200.00";	$a3 = "300.00";  $b2 = "สองร้อยบาทถ้วน";	$b3 = "สามร้อยบาทถ้วน"; ?>
<? $strSQL = "SELECT PREFIX.PREFIXNAME, APPLICANT.APPLICANTCODE, APPLICANT.ACADYEAR, APPLICANT.SEMESTER, APPLICANT.ROUND, APPLICANT.APPLICANTNAME, APPLICANT.APPLICANTSURNAME, APPLICANT.HOMEPHONENO, APPLICANT.GPAX, SCHOOL.SCHOOLNAME, ENTRYDEGREE.ENTRYDEGREENAME, APPLICANT.APPLICANTID, APPLICANT.APPLICANTTYPE FROM ((avsreg.APPLICANT LEFT JOIN avsreg.PREFIX ON APPLICANT.PREFIXID = PREFIX.PREFIXID) LEFT JOIN avsreg.SCHOOL ON APPLICANT.SCHOOLID = SCHOOL.SCHOOLID) LEFT JOIN avsreg.ENTRYDEGREE ON APPLICANT.PROGRAMTYPE = ENTRYDEGREE.ENTRYDEGREECODE WHERE (((APPLICANT.APPLICANTID)='$applicantid') and ((APPLICANT.APPLICANTSTATUS)>='10'))";
$result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
while($objResult = odbc_fetch_row($result))
	{
		$acadyear= odbc_result($result,"acadyear");	
		$semester= odbc_result($result,"semester");	
		$round= odbc_result($result,"round");	
		$applicantcode= odbc_result($result,"applicantcode");	
		$prefixname= iconv("TIS-620","UTF-8",odbc_result($result,"prefixname"));	
		$applicantname= iconv("TIS-620","UTF-8",odbc_result($result,"applicantname"));	
		$applicantsurname= iconv("TIS-620","UTF-8",odbc_result($result,"applicantsurname"));	
		$homephoneno= odbc_result($result,"homephoneno");	
		$gpax= odbc_result($result,"gpax");	
		$schoolname= iconv("TIS-620","UTF-8",odbc_result($result,"schoolname"));	
		$entrydegreename= iconv("TIS-620","UTF-8",odbc_result($result,"entrydegreename"));	
		$a_type= odbc_result($result,"applicanttype");
		
	}
	$_SESSION["applicantcode_sess"] = $applicantcode;
	$sess_appcode	=	$_SESSION["applicantcode_sess"];		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
<!--
.style1 {font-size: 14px}
.style2 {font-size: 12px}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style3 {
	font-family: "Cordia New";
	font-size: 14px;
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
.style4 {font-size: 14px}
.style5 {font-family: "Cordia New"; font-weight: bold; }
.style7 {font-size: 14px; font-weight: bold; }
-->
</style>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 5mm;  /* this affects the margin in the printer settings */
    }
</style>
<title>:: ระบบรับสมัครนักศึกษา Online</title>
<style type="text/css">
<!--
.style6 {font-size: 12px}
.style8 {font-size: 12px}
-->
</style>
<body onload=window.print()>
<table width="650" border="0" align="center" cellpadding="3" cellspacing="0" >
  <tr>
    <th scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <th width="17%" scope="col"><img src="../images/logo3.png" width="77" height="100"></th>
        <th width="58%" scope="col"><div align="left" class="style3"><span class="style1">มหาวิทยาลัยราชภัฏรำไพพรรณี<br />
            <span class="style2">ใบสมัครบุคคลเข้าศึกษาต่อ ประเภท<? if ($a_type == 'A') { echo "สอบคัดเลือก "; } 
			if ($a_type == 'Q') { echo "โควตา "; } 
			if ($a_type == 'B') { echo "portfolio "; } 
			if ($a_type == 'C') { echo "รับตรง "; }
			?> หลักสูตรปริญญาตรี <br />
          ประจำปีการศึกษา <? echo $semester."/".$acadyear; ?> รอบที่ <? echo $round; ?> </span></span>Online</div></th>
        <td width="25%" scope="col"><div align="right"><span class="style3">(ส่วนที่ 1 สำหรับผู้สมัคร)<br>
          Ref.No. <? echo $filled_int = sprintf("%09d", $applicantid); ?><br>
        <br>
        </span></div></td>
      </tr>
    </table></th>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="76%"><div align="left" class="style3">รหัสผู้สมัคร   &nbsp;&nbsp;<span class="text16 style2">&nbsp;<span class="style4">&nbsp;<? echo $applicantcode; ?>&nbsp;</span>&nbsp;</span>&nbsp;&nbsp;&nbsp;ชื่อผู้สมัคร&nbsp;&nbsp;&nbsp;<span class="style4">&nbsp;&nbsp;<? echo $prefixname.$applicantname; ?> &nbsp;<? echo $applicantsurname; ?>&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สขาวิชาที่เลือก.....</div></td>
            <td width="24%"><div align="right"><span class="style3">&nbsp;วันที่พิมพ์ <? echo date('d/m/Y H:i');?></span></div></td>
          </tr>
        </table></td>
      </tr>
		<? $strSQL1 = "SELECT APPLICANTSELECTION.SEQUENCE, QUOTA.QUOTANAME, DEGREE.DEGREENAME, FACULTY.FACULTYNAME
FROM ((((avsreg.APPLICANTSELECTION INNER JOIN avsreg.QUOTASTATUS ON APPLICANTSELECTION.QUOTASTATUSID = QUOTASTATUS.QUOTASTATUSID) INNER JOIN avsreg.QUOTA ON QUOTASTATUS.QUOTAID = QUOTA.QUOTAID) INNER JOIN avsreg.PROGRAM ON QUOTASTATUS.PROGRAMID = PROGRAM.PROGRAMID) INNER JOIN avsreg.DEGREE ON PROGRAM.DEGREEID = DEGREE.DEGREEID) INNER JOIN avsreg.FACULTY ON PROGRAM.FACULTYID = FACULTY.FACULTYID WHERE (((APPLICANTSELECTION.APPLICANTID)='$applicantid')) ORDER BY APPLICANTSELECTION.SEQUENCE";
$result1 = odbc_exec($objConnect, $strSQL1) or die ("Error Execute [".$strSQL1."]");
$result2 = odbc_exec($objConnect, $strSQL1) or die ("Error Execute [".$strSQL1."]");
	$Num_Rows = 0;
			
		?>
		 <? 
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
		while(odbc_fetch_row($result2)) $Num_Rows++; // Count Record
		//echo $Num_Rows;
		   ?>	
      <tr>
        <td><div align="center" class="style3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="DataTable">
                <tr>
                  <td width="23%" bgcolor="#FFFFFF" class="style3"><div align="center">ลำดับที่ 1 : </div></td>
                  <td width="77%" bgcolor="#FFFFFF" class="style3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;สาขาวิชา : <? echo $q1; ?></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF" class="style3"><div align="center">ลำดับที่ 2 : </div></td>
                  <td bgcolor="#FFFFFF" class="style3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;สาขาวิชา :  <? if($q2 <> "") { echo $q2; } else { echo " - "; } ?></td>
                      </tr>
                  </table></td>
                </tr>

              </table></td>
              <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="DataTable">

                <tr>
                  <td bgcolor="#FFFFFF" class="style3"><div align="center">ลำดับที่ 3 : </div></td>
                  <td bgcolor="#FFFFFF" class="style3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;สาขาวิชา : <? if($q3 <> "") { echo $q3; } else { echo " - "; } ?></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="23%" bgcolor="#FFFFFF" class="style3"><div align="center">ลำดับที่ 4 : </div></td>
                  <td width="77%" bgcolor="#FFFFFF" class="style3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;สาขาวิชา :  <? if($q4 <> "") { echo $q4; } else { echo " - "; } ?></td>
                      </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
          </table>
        </div></td>
      </tr>
      <tr>
        <td><table width="100%" border="1" cellspacing="0" cellpadding="3">
          <tr>
            <td width="12%"><div align="center" class="style3">ที่<br>
            No.</div></td>
            <td width="55%"><div align="center" class="style3">รายการ</div></td>
            <td width="33%"><div align="center" class="style3">จำนวนเงิน<br>
            Amount(Baht)</div></td>
          </tr>
          <tr>
            <td valign="top"><div align="center" class="style3">1</div></td>
            <td><span class="style3">&nbsp;
              ค่ารับสมัครบุคคลเข้าศึกษา<br>
              <br>
              <br>
            </span>
			<? if($Num_Rows > 1) { $pa = $a3; $pb = $b3; $pc = 30000; } else { $pa = $a2; $pb = $b2; $pc = 20000;} ?>
              <p class="style3">&nbsp;</p>
                <p class="style3"><br>
                </p>
                <p align="center" class="style3">* วันเวลาสอบ ห้องสอบ ตรวจสอบได้ตามกำหนดการของมหาวิทยาลัย * </p></td>
            <td valign="top"><? echo "<div align='center' class='style3'>$pa</div>"; ?></td>
          </tr>
          <tr>
            <td colspan="2"><? echo "<div align='center' class='style5'>$pb</div>"; ?></td>
            <td><? echo "<div align='center' class='style5'>$pa</div>";  ?></td>
          </tr>
        </table>
          <table width="100%" border="1" cellspacing="0" cellpadding="3">
            <tr>
              <td width="53%"><span class="style3"><strong>กำหนดชำระเงิน ระหว่างวันที่ <? echo datethai($datemoneyfrom); echo " ถึง ".datethai($datemoneyto); ?></strong><br>
                  <span class="style6">หมายเหตุ : การสมัครจะสมบูรณ์เมื่อผู้สมัครได้ชำระเงินค่าสมัครเข้าศึกษาต่อภายในระยะเวลาที่มหาวิทยาลัย
                กำหนดเท่านั้น</span></span></td>
              <td width="22%"><div align="center" class="style3">สำหรับเจ้าหน้าที่ มรรพ. <br>
                ผู้รับเงิน..............................<br>
                วันที่ ...............................<br>
                ลงลายมือชื่อ<br>
              </div></td>
              <td width="25%"><div align="center" class="style3">สำหรับเจ้าหน้าที่ธนาคาร<br>
                ผู้รับเงิน....................................<br>
                วันที่ .......................................<br>
                ลงลายมือชื่อและประทับตรา</div></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><span class="style3">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ __ _ _ _ _ _ _ _ _ __ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ __ _ _ _ _ _ _ _ __ _ _ _ _ _ _ _ _</span><span class="style3">_ _ _ _ _ _ _ _ _</span><span class="style3"> _ _</span><span class="style3"> _ _</span><span class="style3"> _ _</span></td>
  </tr>
  <tr>
    <td><div align="right" class="style3">(ส่วนที่ 2 สำหรับธนาคาร)</div></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="1">
      <tr>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%"><span class="style3"><img src="../images/logo3.png" width="40" height="50" align="left"><span class="style7"> &nbsp;มหาวิทยาลัยราชภัฏรำไพพรรณี<br>
&nbsp;Rambhai Barni Rajabhat University</span></span></td>
            <td width="50%"><div align="right" class="style3"><span class="style7">ใบแจ้งการชำระเงินค่าสมัครเข้าศึกษาต่อ</span><br>
              กำหนดชำระเงินวันที่&nbsp; <? echo datethai($datemoneyfrom); echo " ถึง ".datethai($datemoneyto); ?></div></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td width="62%"><table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr>
            <td class="style3 style8">&nbsp;<img src="../images/k1.jpg" width="20" height="18" align="absmiddle"> ธนาคารกรุงศรีอยุธยา จำกัด (มหาชน) เลขที่บัญชี 178-0-00495-9</td>
          </tr>
          <tr>
            <td class="style3 style8">&nbsp;<img src="../images/k3.jpg" width="20" height="18" align="absmiddle"> ธนาคารกรุงไทย จำกัด (มหาชน) (Comp.Code.) 80223 </td>
          </tr>
          <tr>
            <td class="style3 style8"><img src="../images/k2.jpg" width="20" height="18" align="absmiddle"> ธนาคารกรุงเทพ จำกัด (มหาชน) ServiceCode RAMBHAI Comp.Code. 00102</td>
          </tr>
          <tr>
            <td class="style3 style8">&nbsp;<img src="../images/k4.jpg" width="20" height="18" align="absmiddle"> ธนาคารไทยพาณิชย์ จำกัด (มหาชน) เลขที่บัญชี 514-3-03722-5</td>
          </tr>
        </table>
          <div align="center"><span class="style3 style8">(รับเฉพาะเงินสดเท่านั้น ไม่รวมค่าธรรมเนียม 10 บาท)</span></div></td>
        <td width="38%"><table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr>
            <td><span class="style3 style6">ชื่อ / NAME : &nbsp;&nbsp;&nbsp;&nbsp;<? echo $prefixname.$applicantname; ?> &nbsp;<? echo $applicantsurname; ?>&nbsp;&nbsp;&nbsp;</span></td>
          </tr>
          <tr>
            <td class="style3 style6">รหัสผู้สมัคร/ REGIS NO. (Ref1) : <? echo $applicantcode; ?></td>
          </tr>
          <tr>
            <td class="style3 style6">เลขที่อ้างอิง/ REF. NO. (Ref2) : <? echo $filled_int = sprintf("%09d", $applicantid); ?></td>
          </tr>
          <tr>
            <td bgcolor="#CCCCCC" class="style3"><div align="center" class="style6">สำหรับเจ้าหน้าที่ธนาคาร/ Bank Use Only </div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="35%" class="style7"><p class="style5 style2"><strong>จำนวนเงินทั้งหมด</strong></p>              </td>
            <td width="65%" class="style7"><span class="style2">
              <?  echo $pa;  ?>
            </span></td>
          </tr>
          <tr>
            <td class="style5 style2">จำนวนเงินตัวอักษร</td>
            <td class="style7"><span class="style2"><? echo $pb;  ?></span></td>
          </tr>
        </table>          </td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="style3 style6">ผู้รับเงิน<br>
              Received By </td>
          </tr>
          <tr>
            <td><span class="style3 style6">ผู้รับมอบอำนาจ<br>
Received By </span></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2" class="style3 style6">คำชี้แจง &nbsp;1. หากชำระเงินเกินวันที่กำหนดหรือไม่ตรงกับยอดหนี้ที่ระบุ ธนาคารจะไม่รับ ผู้สมัครต้องมาชำระเงินที่มหาวิทยาลัยเท่านั้น<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;โปรดชำระเงินภายในวันที่กำหนด มิฉะนั้นการสมัครเข้าศึกษาต่อถือเป็นโมฆะ<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. ในการชำระเงินผ่านเคาร์เตอร์ธนาคาร นักศึกษาจะต้องนำเอกสารฉบับนี้ยื่นต่อเจ้าหน้าที่ธนาคารด้วย และขอรับใบเสร็จที่มีลายเซ็นเจ้าหน้าที่พร้อมประทับตราธนาคารจากเจ้าหน้าที่ธนาคารด้วยทุกครั้ง</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" class="style3"><table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>	  
        <td width="62%" valign="top"><img src="../barcode1d/test_1d.php?t=<? echo "|426100054000";?>&appcode=<? echo $sess_appcode;?>&ref2=<? echo $filled_int;?>&pc=<? echo $pc;?>"><? echo "|426100054000".$sess_appcode.$filled_int.$pc;?> </td>
        <td width="38%" valign="top"><div align="right"><img src="../barcode1d/test_2d.php?text=<? echo $sess_appcode; ?>"><br>
          <? echo $sess_appcode; ?> </div></td>      </tr>

    </table></td>
  </tr>
</table>
