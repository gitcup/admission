<?php
session_start();
include("config/connect.php");
$frommail = $_GET[m];
if ($frommail == 'true') {
    $sess_appid = $_GET[appid];
} else {
    $sess_appid = $_SESSION['applicantid_sess'];
}
?>
<?php
unset($_SESSION["prefixid_sess"]);
unset($_SESSION["citizenid_sess"]);
unset($_SESSION["schoolid_sess"]);
unset($_SESSION["address_sess"]);
unset($_SESSION["schoolname_sess"]);
unset($_SESSION["address2_sess"]);
unset($_SESSION["programtype_sess"]);
unset($_SESSION["address3_sess"]);
unset($_SESSION["name_sess"]);
unset($_SESSION["province_sess"]);
unset($_SESSION["surname_sess"]);
unset($_SESSION["zipcode_sess"]);
unset($_SESSION["mobile_sess"]);
unset($_SESSION["gpax_sess"]);
unset($_SESSION["email_sess"]);
unset($_SESSION["qcode1_sess"]);
unset($_SESSION["qcode2_sess"]);
unset($_SESSION["qcode3_sess"]);
unset($_SESSION["qcode4_sess"]);
unset($_SESSION["ccode1_sess"]);
unset($_SESSION["ccode2_sess"]);
unset($_SESSION["ccode3_sess"]);
unset($_SESSION["ccode4_sess"]);
unset($_SESSION["qname1_sess"]);
unset($_SESSION["qname2_sess"]);
unset($_SESSION["qname3_sess"]);
unset($_SESSION["qname4_sess"]);
unset($_SESSION["labb1_sess"]);
unset($_SESSION["labb2_sess"]);
unset($_SESSION["labb3_sess"]);
unset($_SESSION["labb4_sess"]);
?>
<?php
$tcas = $_POST["tcas"];
$strSQLtcas = "UPDATE avsreg.APPLICANT SET APPLICANT.TCASTEA = '$tcas' \n";
$strSQLtcas .= "WHERE applicantid = $sess_appid";
$resulttcas = odbc_exec($objConnect, $strSQLtcas) or die("Error Execute [" . $strSQLtcas . "]");
?>

<h2>ข้อมูลผู้สมัคร <?php echo"$txt"; ?></h2>

<hr>
<div id="form-regis">
    <form action="index.php?p=frmApplicant_detail" method="post" name="form1" id="form1">
        <h3>&nbsp;</h3>
        <div class="mr20" >
            <label class="label2"></label>
            <label class="label2"></label><label class="label2"></label>
            <span class="center">
                <label  class="label2"></label>
            </span>
            <?php
            $strSEL = "SELECT APPLICANT.APPLICANTID,APPLICANT.APPLICANTSTATUS, APPLICANT.APPLICANTCODE, APPLICANT.APPLICANTTYPE, APPLICANT.APPLICANTNAME, APPLICANT.APPLICANTSURNAME, APPLICANT.FINANCESTATUS, APPLICANT.APPLICANTMETHOD, APPLICANT.GPAX, SCHOOL.SCHOOLNAME, PREFIX.PREFIXNAME FROM (avsreg.APPLICANT INNER JOIN AVSREG.PREFIX ON APPLICANT.PREFIXID = PREFIX.PREFIXID) LEFT JOIN AVSREG.SCHOOL ON APPLICANT.SCHOOLID = SCHOOL.SCHOOLID WHERE(((APPLICANT.APPLICANTID)='$sess_appid'))";
            $resultSEL = odbc_exec($objConnect, $strSEL) or die("Error Execute [" . $strSEL . "]");
            while ($objSEL = odbc_fetch_row($resultSEL)) {
                $applicantcode = odbc_result($resultSEL, "applicantcode");
                $applicantname = odbc_result($resultSEL, "applicantname");
                $prefixname = odbc_result($resultSEL, "prefixname");
                $schoolname = odbc_result($resultSEL, "schoolname");
                $finance = odbc_result($resultSEL, "financestatus");
                $gpax = odbc_result($resultSEL, "gpax");
                $method = odbc_result($resultSEL, "applicantmethod");
                $applicantstatus = odbc_result($resultSEL, "applicantstatus");
                $applicanttype = odbc_result($resultSEL, "applicanttype");
                $prefixname_cv = iconv("TIS-620", "UTF-8", "$prefixname");
                $applicantsurname = odbc_result($resultSEL, "applicantsurname");
                $applicantname_cv = iconv("TIS-620", "UTF-8", "$applicantname");
                $applicantsurname_cv = iconv("TIS-620", "UTF-8", "$applicantsurname");
                $schoolname_cv = iconv("TIS-620", "UTF-8", "$schoolname");
            }
            ?>








            <div class="row">
                <div class="col-sm-6" style="width:350px;" >
                    <ul class="list-group">

                        <li class="list-group-item"  ><strong >รหัสผู้สมัคร</strong> <br><?php echo $applicantcode; ?></a></li>
                        <li class="list-group-item"><strong> ชื่อผู้สมัคร</strong><br><?php echo $prefixname_cv . $applicantname_cv . "  " . $applicantsurname_cv; ?></a></li>



                        <?php
                        $s = 0;
                        $strSEL = "SELECT APPLICANTSELECTION.APPLICANTID, APPLICANTSELECTION.SEQUENCE, APPLICANTSELECTION.SELECTIONSTATUS, QUOTA.QUOTANAME, QUOTASTATUS.STUDYPERIOD FROM (AVSREG.APPLICANTSELECTION INNER JOIN AVSREG.QUOTASTATUS ON APPLICANTSELECTION.QUOTASTATUSID = QUOTASTATUS.QUOTASTATUSID) INNER JOIN AVSREG.QUOTA ON QUOTASTATUS.QUOTAID = QUOTA.QUOTAID WHERE (((APPLICANTSELECTION.APPLICANTID)='$sess_appid')) ORDER BY APPLICANTSELECTION.SEQUENCE";
                        $resultSEL = odbc_exec($objConnect, $strSEL) or die("Error Execute [" . $strSEL . "]");
                        while ($objSEL = odbc_fetch_row($resultSEL)) {

                            $quotaname = odbc_result($resultSEL, "quotaname");
                            $seq = odbc_result($resultSEL, "sequence");
                            $sestatus = odbc_result($resultSEL, "selectionstatus");
                            $period = odbc_result($resultSEL, "studyperiod");
                            $quotaname_cv = iconv("TIS-620", "UTF-8", "$quotaname");
                            ?>

                            <?php
                            //สถานะผผู้สมนัคร
                            $strSELSYS1 = "SELECT SYSBYTEDES.BYTECODE, SYSBYTEDES.BYTEDES FROM AVSREG.SYSBYTEDES WHERE (((SYSBYTEDES.TABLENAME)='APPLICANTSELECTION') AND ((SYSBYTEDES.COLUMNNAME)='SELECTIONSTATUS') AND ((SYSBYTEDES.BYTECODE)='$sestatus'))";
                            $resultSELSYS1 = odbc_exec($objConnect, $strSELSYS1) or die("Error Execute [" . $strSELSYS1 . "]");
                            while ($objSELSYS1 = odbc_fetch_row($resultSELSYS1)) {

                                $tstatus = odbc_result($resultSELSYS1, "bytedes");
                                $tstatus_cv = iconv("TIS-620", "UTF-8", "$tstatus");
                            }
                            ?>

                            <li class="list-group-item"> <strong> สาขาวิชาที่เลือก</strong> <br>
                                ลำดับที่  <?php echo $seq; ?><br>
                                สถานะการสมัคร<?php echo $quotaname_cv; ?></a></li>



                            <?php
                            $s = $s + 1;
                        }
                        ?>


                        <li class="list-group-item"><strong>   จบจาก</strong> <br><?php echo $schoolname_cv; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เกรดเฉลี่ย &nbsp;<?php echo $gpax; ?></a></li>
                    </ul>
                </div>


                <!--                หน้าทางขวา-->
                <div class="col-sm-6" style="width:350px;" >
                    <?php if ($applicantstatus == '9') { ?>

                    <?php } ?>
                    <?php if ($method == 'W') { ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td><br>
                                <?php if ($applicantstatus < 10) { ?>
                                    <div id="menutype" class="flr"><span>ยังไม่สามารถพิมพ์ใบชำระเงินได้</span></div>
                                    <?php
                                } else {
                                    if ($period == '1') {
                                        if (($applicanttype == 'A') or ( $applicanttype == 'C') or ( $applicanttype == 'T')) {
                                            ?>

                                            <a class="btn btn-success" href="pay_entry.php" role="button" target="_blank"><span class="glyphicon glyphicon-print"></span>พิมพ์ใบชำระเงิน</a><?php } if ($applicanttype == 'B') { ?>
                                            <a class="btn btn-success" href="pay_entryquota.php" role="button" target="_blank"><span class="glyphicon glyphicon-print"></span>พิมพ์ใบชำระเงิน</a><?php } if ($applicanttype == 'Q') { ?>
                                            <a class="btn btn-success" href="pay_entryqnew.php" role="button" target="_blank"><span class="glyphicon glyphicon-print"></span>พิมพ์ใบชำระเงิน</a><?php } ?>
                                    <?php } else { ?> <a class="btn btn-success" href="pay_entryexce.php" role="button" target="_blank"><span class="glyphicon glyphicon-print"></span>พิมพ์ใบชำระเงิน</a> <?php
                                    }
                                }
                                ?>
                                <BR><BR><BR>
                                <?php
                                if ($finance == 'N') {
                                    if ($period == '1') {
                                        ?>
                                        <a class="btn btn-success" href="frmPrint2.php" role="button" target="_blank"><span class="glyphicon glyphicon-print"></span>พิมพ์เอกสารหลักฐานการสมัคร</a>


                                    <?php } else { ?> 	    <a class="btn btn-success" href="frmPrint2exce.php" role="button" target="_blank"><span class="glyphicon glyphicon-print"></span>พิมพ์เอกสารหลักฐานการสมัคร</a><?php
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-dismissible alert-secondary"><span>ยังไม่สามารถพิมพ์เอกสารหลักฐานการสมัครได้</span></div>
                                <?php } ?>	  </td>



                        <div class="alert alert-dismissible alert-warning"> กรุณาชำระเงินภายใน 3 วันทำการ หลังจากที่ยืนยันการสมัคร และภายในช่วงกำหนดวันชำระเงิน<br>
                            (เมื่อชำระเงินที่ธนาคารเรียบร้อยแล้ว ผู้สมัครจะสามารถพิมพ์เอกสารหลักฐานการสมัครได้ ในวันถัดไป)</div>




                    <?php } ?>
                </div>


            </div>


            <br>
            <br>
            <div class="alert alert-dismissible alert-primary">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong style="text-align: center;">*จดบันทึกรหัสผู้สมัครไว้อ้างอิงการใช้งาน*</strong> 
            </div>

            <div class="alert alert-dismissible alert-primary">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>** หมายเหตุ **</strong> <a href="#" class="alert-link"></a>
                <br>
                1. มหาวิทยาลัยจะพิจารณาตัดสินการสอบคัดเลือกให้เฉพาะผู้ที่มีคุณสมบัติทั่วไป และคุณสมบัติเฉพาะสาขาตามที่สาขาวิชากำหนด<br>
                2. กรณีที่ชำระเงินค่าธรรมเนียมสมัครแล้วจะไม่คืนเงินค่าสมัครให้ไม่ว่ากรณีใดๆ ทั้งสิ้น<br>
                3. การสมัครจะสมบูรณ์เมื่อผู้สมัครได้ชำระเงินภายในระยะเวลาที่มหาวิทยาลัยกำหนดเท่านั้น <br>
                4. การแก้ไขข้อมูลการสมัคร จะกระทำได้เมื่อผู้สมัครยังมิได้ชำระเงิน <br>
                5. ในวันสอบสัมภาษณ์  มหาวิทยาลัยจะตรวจสอบคุณสมบัติ หากตรวจพบว่าคุณสมบัติของผู้สมัครไม่เป็นไปตามที่มหาวิทยาลัยกำหนดหรือข้อมูลการสมัครเป็นเท็จ  มหาวิทยาลัยจะตัดสิทธิ์ในการรับเข้าเป็นนิสิต
            </div>








