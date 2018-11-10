<?php
session_start();
$frommail = $_GET['m'];
if ($frommail == 'true') {
    $applicantid = $_GET['appid'];
} else {
    $applicantid = $_SESSION['applicantid_sess'];
}
?>

<?php include("../config/connect.php"); ?>
<?php include("../sysconfigexce.php"); ?>
<?php $a2 = "300.00";	$a3 = "300.00";  $b2 = "สามร้อยบาทถ้วน";	$b3 = "สามร้อยบาทถ้วน"; ?>
<?php $strSQL = "SELECT PREFIX.PREFIXNAME, APPLICANT.APPLICANTCODE, APPLICANT.APPLICANTNAME, APPLICANT.ACADYEAR, APPLICANT.SEMESTER, APPLICANT.ROUND, APPLICANT.APPLICANTSURNAME, APPLICANT.HOMEPHONENO, APPLICANT.GPAX, SCHOOL.SCHOOLNAME, ENTRYDEGREE.ENTRYDEGREENAME, APPLICANT.APPLICANTID FROM ((avsreg.APPLICANT LEFT JOIN avsreg.PREFIX ON APPLICANT.PREFIXID = PREFIX.PREFIXID) LEFT JOIN avsreg.SCHOOL ON APPLICANT.SCHOOLID = SCHOOL.SCHOOLID) LEFT JOIN avsreg.ENTRYDEGREE ON APPLICANT.PROGRAMTYPE = ENTRYDEGREE.ENTRYDEGREECODE WHERE (((APPLICANT.APPLICANTID)='$applicantid') and ((APPLICANT.APPLICANTSTATUS)>='10'))";
$result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
while($objResult = odbc_fetch_row($result))
	{
		$applicantcode= odbc_result($result,"applicantcode");	
		$prefixname= iconv("TIS-620","UTF-8",odbc_result($result,"prefixname"));	
		$applicantname= iconv("TIS-620","UTF-8",odbc_result($result,"applicantname"));	
		$applicantsurname= iconv("TIS-620","UTF-8",odbc_result($result,"applicantsurname"));	
		$homephoneno= odbc_result($result,"homephoneno");	
		$gpax= odbc_result($result,"gpax");	
		$schoolname= iconv("TIS-620","UTF-8",odbc_result($result,"schoolname"));	
		$entrydegreename= iconv("TIS-620","UTF-8",odbc_result($result,"entrydegreename"));	
		$acadyearin = odbc_result($result,"ACADYEAR");
	      $semesterin = odbc_result($result,"SEMESTER");
		  $roundin = odbc_result($result,"ROUND");
		
	}
	$_SESSION["applicantcode_sess"] = $applicantcode;
	$sess_appcode	=	$_SESSION["applicantcode_sess"];		
?>


<!--ดึงข้อมูล สาขาวิชา-->
<?php
$strSQL1 = "SELECT APPLICANTSELECTION.SEQUENCE, QUOTA.QUOTANAME
FROM ((avsreg.APPLICANTSELECTION INNER JOIN avsreg.QUOTASTATUS ON APPLICANTSELECTION.QUOTASTATUSID = QUOTASTATUS.QUOTASTATUSID) INNER JOIN avsreg.QUOTA ON QUOTASTATUS.QUOTAID = QUOTA.QUOTAID) WHERE (((APPLICANTSELECTION.APPLICANTID)='$applicantid')) ORDER BY APPLICANTSELECTION.SEQUENCE";
$result1 = odbc_exec($objConnect, $strSQL1) or die("Error Execute [" . $strSQL1 . "]");
$result2 = odbc_exec($objConnect, $strSQL1) or die("Error Execute [" . $strSQL1 . "]");
$Num_Rows = 0;
?>
<?php
while ($objResult1 = odbc_fetch_row($result1)) {

    $sequence = odbc_result($result1, "sequence");
    $quotaname = iconv("TIS-620", "UTF-8", odbc_result($result1, "quotaname"));
    //$degreename= iconv("TIS-620","UTF-8",odbc_result($result1,"degreename"));	
    //$facultyname= iconv("TIS-620","UTF-8",odbc_result($result1,"facultyname"));	
    if ($sequence == 1) {
        $q1 = $quotaname;
        $d1 = $degreename;
        $f1 = $facultyname;
    }
    if ($sequence == 2) {
        $q2 = $quotaname;
        $d2 = $degreename;
        $f2 = $facultyname;
    }
    if ($sequence == 3) {
        $q3 = $quotaname;
        $d3 = $degreename;
        $f3 = $facultyname;
    }
    if ($sequence == 4) {
        $q4 = $quotaname;
        $d4 = $degreename;
        $f4 = $facultyname;
    }
}
while (odbc_fetch_row($result2))
    $Num_Rows++; // Count Record
    
//echo $Num_Rows;
?>	



<?php
//<!--//เช็คเงื่อนไข ประเภทการสมัคร-->


if ($a_type == 'A') {
    echo "สอบคัดเลือก ";
}
if ($a_type == 'B') {
    $text_type = "โควตา ";
}
if ($a_type == 'C') {
    $text_type = "รับตรง ";
}
if ($a_type == 'T') {
    $text_type = "รับตรง และโครงการผลิตครูฯ ";
}


//<!--//เช็คเงื่อนไข สาขาวิชา 2-->              
if ($q2 <> "") {
    echo $text_q2;
} else {
    $text_q2 = " - ";
}
//<!--//เช็คเงื่อนไข สาขาวิชา 3 -->  
if ($q3 <> "") {
    echo $text_q3;
} else {
    $text_q3 = " - ";
}

//<!--//เช็คเงื่อนไข สาขาวิชา 4 -->
if ($q3 <> "") {
    echo $text_q4;
} else {
    $text_q4 = " - ";
}

//<!--เงื่อนไขเงิน-->
if ($Num_Rows > 1) {
    $pa = $a3;
    $pb = $b3;
    $pc = 30000;
} else {
    $pa = $a2;
    $pb = $b2;
    $pc = 20000;
}

//  เงื่อนไขการชำระเงิน
                                 if ($datemoneyfrom <> "") {  $pay_text =  datethai($datemoneyfrom); echo " ถึง ".datethai($datemoneyto); } else {   $pay_text =  "หมดเขตชำระเงิน"; } ?>
?>

<?php
require_once __DIR__ . '../../vendor/autoload.php';



//เพิ่มฟ้อน
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/custom/font/directory',
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
table {
    border-collapse: collapse;
}

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
        <th width="17%" scope="col"><img src="http://assess.rbru.ac.th/admission/images/logo3.png" width="67" height="87"></th>
        <th width="58%" scope="col" class="style3"  style="text-align:left"><span class="style1">มหาวิทยาลัยราชภัฏรำไพพรรณี<br />
            <span class="style2">ใบสมัครบุคคลเข้าศึกษาต่อ ประเภท ' . $text_type . '
            

			
			
			 หลักสูตรปริญญาตรี ภาคปกติ<br />
          ประจำปีการศึกษา ' . $acadyearin . ' รอบที่  ' . $roundin . ' </span></span>Online</div></th>
        <td width="25%" scope="col"><div align="right"><span class="style3">(ส่วนที่ 1 สำหรับผู้สมัคร)<br>
          Ref.No. ' . $filled_int = sprintf("%09d", $applicantid) . '<br>
        <br>
        </span></td>
      </tr>
    </table></th>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="76%"><div align="left" class="style3">รหัสผู้สมัคร   &nbsp;&nbsp;<span class="text16 style2">&nbsp;<span class="style4">&nbsp;' . $applicantcode . '&nbsp;</span>&nbsp;</span>&nbsp;&nbsp;&nbsp;ชื่อผู้สมัคร&nbsp;&nbsp;&nbsp;<span class="style4">&nbsp;&nbsp;' . $prefixname . $applicantname . ' &nbsp;' . $applicantsurname . ' &nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สาขาวิชาที่เลือก.....</div></td>
            <td width="24%"><div align="right"><span class="style3">&nbsp;วันที่พิมพ์ ' . date('d/m/Y H:i') . '</span></div></td>
          </tr>
        </table></td>
      </tr>
		
      <tr>
        <td><div align="center" class="style3">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="DataTable">
                <tr>
                  <td width="23%" bgcolor="#FFFFFF" class="style3"><div align="center">ลำดับที่ 1 : </div></td>
                  <td width="77%" bgcolor="#FFFFFF" class="style3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;สาขาวิชา : ' . $q1 . ' </td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF" class="style3"><div align="center">ลำดับที่ 2 : </div></td>
                  <td bgcolor="#FFFFFF" class="style3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;สาขาวิชา : ' . $text_q2 . ' </td>
                      </tr>
                  </table></td>
                </tr>

              </table></td>
              <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="DataTable">

                <tr>
                  <td bgcolor="#FFFFFF" class="style3"><div align="center">ลำดับที่ 3 : </div></td>
                  <td bgcolor="#FFFFFF" class="style3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;สาขาวิชา : ' . $text_q3 . '</td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="23%" bgcolor="#FFFFFF" class="style3"><div align="center">ลำดับที่ 4 : </div></td>
                  <td width="77%" bgcolor="#FFFFFF" class="style3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td bgcolor="#FFFFFF" class="style3">&nbsp;&nbsp;สาขาวิชา : ' . $text_q4 . '</td>
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
            <td width="12%" class="style3" style="text-align:center">ที่<br>
            No.</td>
            <td width="59%" class="style3" style="text-align:center" >รายการ</td>
            <td width="29%" class="style3" style="text-align:center" >จำนวนเงิน<br>
            Amount(Baht)</td>
          </tr>
          <tr>
            <td valign="top" class="style3" style="text-align:center" >1</td>
            <td><span class="style3">&nbsp;
              ค่ารับสมัครบุคคลเข้าศึกษา<br>
              <br>
              <br>
            </span>
		
              <p class="style3">* เก็บส่วนนี้ไว้เป็นหลักฐานการชำระเงิน * <br>
                (กรุณาชำระเงินภายใน 3 วันทำการ 
                  หลังจากที่ยืนยันการสมัครเรียบร้อยแล้ว)<br>
                (ภายในระยะเวลาการชำระเงิน)</p>
                </td>
            <td valign="top" class="style3" style="text-align:center" > ' . $pa . ' </td>
          </tr>
          <tr>
            <td colspan="2" class="style5"  style="text-align:center"> ' . $pb . '</td>
            <td class="style5"  style="text-align:center">' . $pa . '</div>  </td>
          </tr>
        </table>
          <table width="100%" border="1" cellspacing="0" cellpadding="3">
            <tr>
              <td width="60%" class="style3"><strong>กำหนดชำระเงิน ระหว่างวันที่ 
			 ' . $pay_text . '
                             <br>
                  <p class="style6">หมายเหตุ : การสมัครจะสมบูรณ์เมื่อผู้สมัครได้ชำระเงินค่าสมัครเข้าศึกษาต่อภายในระยะเวลาที่มหาวิทยาลัย
                กำหนดเท่านั้น</p></td>
              <td width="22%" style="text-align:center" class="style3" >สำหรับเจ้าหน้าที่ มรรพ. <br>
                ผู้รับเงิน..............................<br>
                วันที่ ...............................<br>
                ลงลายมือชื่อ<br>
             </td>
              <td width="25%" style="text-align:center" class="style3" >สำหรับเจ้าหน้าที่ธนาคาร<br>
                ผู้รับเงิน....................................<br>
                วันที่ .......................................<br>
                ลงลายมือชื่อและประทับตรา</td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><span class="style3">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ __ _ _ _ _ _ _ _ _ __ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ __ _ _ _ _ _ _ _ __ _ _ _ _ _ _ _ _</span><span class="style3">_ _ _ _ _ _ _ _ _</span><span class="style3"> _ _</span><span class="style3"> _ _</span><span class="style3"> _ _</span></td>
  </tr>
  <tr>
    <td style="text-align:right;" class="style3">(ส่วนที่ 2 สำหรับธนาคาร)</td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="1">
      <tr>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
 <th width="17%" scope="col"><img src="http://assess.rbru.ac.th/admission/images/logo3.png" width="40" height"auto" ></th>
            <th width="58%" scope="col" class="style3"  style="text-align:left"><span class="style1">มหาวิทยาลัยราชภัฏรำไพพรรณี<br />
            <span class="style2">Rambhai Barni Rajabhat University              <td width="50%" style="text-align:right"  class="style3"><span class="style7">ใบแจ้งการชำระเงินค่าสมัครเข้าศึกษาต่อ</span><br>
              กำหนดชำระเงินวันที่ ' . $pay_text . '  </td>
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
            <td class="style3 style8" ><img src="../images/k2.jpg" width="20" height="18" align="absmiddle"> ธนาคารกรุงเทพ จำกัด (มหาชน) ServiceCode RAMBHAI Comp.Code. 00102</td>
          </tr>
        <!--  <tr>
            <td class="style3 style8">&nbsp;<img src="../images/k4.jpg" width="20" height="18" align="absmiddle"> ธนาคารไทยพาณิชย์ จำกัด (มหาชน) เลขที่บัญชี 514-3-03722-5</td>
          </tr>	-->
        </table>
          <p style="text-align:center" class= "style3 style8"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
          &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(รับเฉพาะเงินสดเท่านั้น ไม่รวมค่าธรรมเนียม 10 บาท)</p></td>
        
        <td width="38%"><table width="100%" cellspacing="0" cellpadding="1">
          <tr>
            <td><span class="style3 style6">ชื่อ / NAME : &nbsp;&nbsp;&nbsp;&nbsp;' . $prefixname . $applicantname . ' &nbsp;' . $applicantsurname . ' &nbsp;&nbsp;&nbsp;</span></td>
          </tr>
          <tr>
            <td class="style3 style6">รหัสผู้สมัคร/ REGIS NO. (Ref1) : ' . $applicantcode . ' </td>
          </tr>
          <tr>
            <td class="style3 style6">เลขที่อ้างอิง/ REF. NO. (Ref2) : ' . $filled_int = sprintf("%09d", $applicantid) . '</td>
          </tr>
          <tr>
            <td  bgcolor="#CCCCCC" class="style3 style6" style="text-align:center" height="3">สำหรับเจ้าหน้าที่ธนาคาร/ Bank Use Only </td>
          </tr>
        </table></td>
      </tr>
      
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
          
            <td width="35%" class="style7"><p class="style5 style2"><br>จำนวนเงินทั้งหมด</p>           </td>
            <br>
            <td width="65%" class="style7"><span class="style2">
               ' . $pa . '
            </span></td>
          </tr>
          <tr>
            <td class="style5 style2">จำนวนเงินตัวอักษร</td>
            <td class="style7"><span class="style5"> ' . $pb . '</span></td>
          </tr>
        </table></td>
        <td>
        <table width="100%" border="1" cellspacing="0" cellpadding="0">
          <tr>
            <td class="style3 style6" style="border-color: coral;">ผู้รับเงิน<br>
              Received By </td>
          </tr>
          <tr>
            <td class="style3 style6" style="border-color: coral;" >ผู้รับมอบอำนาจ<br>
Received By </td>
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
        <td style ="font-size: 9px;" width="62%" valign="top"><img src="../barcode1d/test_1d.php?t=' . "|426100054000" . 'appcode=' . $sess_appcode . '&ref2=' . $filled_int . '&pc=' . $pc . '">' . "|426100054000" . $sess_appcode . $filled_int . $pc . ' </td>
        <td width="38%" valign="top" style="text-align:right;font-size: 9px;"><img src="../barcode1d/test_2d.php?text=' . $sess_appcode . '"><br>
          ' . $sess_appcode . ' </td>      </tr>

    </table></td>
  </tr>
</table>');
$mpdf->Output();



