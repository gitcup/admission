<?php
session_start();
include("config/connect.php");
$frommail = $_GET['m'];
if ($frommail == 'true') {
    $sess_appid = $_GET['appid'];
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

<div class="jumbotron">
    <h2>ข้อมูลผู้สมัคร <?php echo"$txt"; ?></h2>

    <hr>
    <div id="form-regis">
        <form action="find_applicant.php" method="post" name="form1" id="form1"> 


            <?php
            $strSEL = "SELECT APPLICANT.APPLICANTID,APPLICANT.APPLICANTSTATUS, APPLICANT.APPLICANTCODE, APPLICANT.APPLICANTNAME, APPLICANT.APPLICANTSURNAME, APPLICANT.FINANCESTATUS, APPLICANT.GPAX, SCHOOL.SCHOOLNAME, APPLICANT.APPLICANTMETHOD, PREFIX.PREFIXNAME FROM (avsreg.APPLICANT INNER JOIN AVSREG.PREFIX ON APPLICANT.PREFIXID = PREFIX.PREFIXID) LEFT JOIN AVSREG.SCHOOL ON APPLICANT.SCHOOLID = SCHOOL.SCHOOLID WHERE(((APPLICANT.APPLICANTID)='$sess_appid'))";
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





                        <li class="list-group-item"> <strong>หลักสูตร</strong> <br>

                            <?php
                            $strSEL = "SELECT APPLICANTSELECTION.APPLICANTID, APPLICANTSELECTION.SEQUENCE, QUOTA.QUOTANAME, QUOTA.LEVELID, QUOTASTATUS.STUDYPERIOD FROM (AVSREG.APPLICANTSELECTION INNER JOIN AVSREG.QUOTASTATUS ON APPLICANTSELECTION.QUOTASTATUSID = QUOTASTATUS.QUOTASTATUSID) INNER JOIN AVSREG.QUOTA ON QUOTASTATUS.QUOTAID = QUOTA.QUOTAID WHERE (((APPLICANTSELECTION.APPLICANTID)='$sess_appid')) ORDER BY APPLICANTSELECTION.SEQUENCE";
                            $resultSEL = odbc_exec($objConnect, $strSEL) or die("Error Execute [" . $strSEL . "]");
                            while ($objSEL = odbc_fetch_row($resultSEL)) {

                                $quotaname = odbc_result($resultSEL, "quotaname");
                                $seq = odbc_result($resultSEL, "sequence");
                                $period = odbc_result($resultSEL, "studyperiod");
                                $levelid = odbc_result($resultSEL, "levelid");
                                $quotaname_cv = iconv("TIS-620", "UTF-8", "$quotaname");
                                ?>
                                สาขาวิชา  <?php echo $quotaname_cv; ?>

                            <?php } ?>





                        <li class="list-group-item"><strong>  สถานะผู้สมัคร</strong> <br>
                            <?php
//สถานะผผู้สมนัคร
                            $strSELSYS = "SELECT SYSBYTEDES.BYTECODE, SYSBYTEDES.BYTEDES FROM AVSREG.SYSBYTEDES WHERE (((SYSBYTEDES.TABLENAME)='APPLICANT') AND ((SYSBYTEDES.COLUMNNAME)='APPLICANTSTATUS') AND ((SYSBYTEDES.BYTECODE)='$applicantstatus'))";
                            $resultSELSYS = odbc_exec($objConnect, $strSELSYS) or die("Error Execute [" . $strSELSYS . "]");
                            while ($objSELSYS = odbc_fetch_row($resultSELSYS)) {

                                $appstatus = odbc_result($resultSELSYS, "bytedes");
                                $appstatus_cv = iconv("TIS-620", "UTF-8", "$appstatus");
                            }
                            ?>
                            <?php echo $appstatus_cv; ?></li>


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
                                    if ($levelid == '42') {
                                        ?>
                                       


                                    <a style="font-size: 20px;" class="btn btn-success" a href="mpdf/pay_entrymas_mpdf.php?levelid=<?php echo $levelid; ?>&period=<?php echo $period; ?>"  role="button" target="_blank"><i class="fa fa-print"></i>  พิมพ์ใบชำระเงิน</a>
                                    <?php } else { ?> 	           <a style="font-size: 20px;" class="btn btn-success" href="mpdf/pay_entryphd_mpdf.php?levelid=<?php echo $levelid; ?>&period=<?php echo $period; ?>" role="button" target="_blank"><i class="fa fa-print"></i> พิมพ์ใบชำระเงิน</a>
                                    <?php
                                    }
                                }
                                ?>
                                <br>  <br>              
                                <?php
                                if (($finance == 'D') or ( $finance == 'N')) {
                                    if ($levelid == '42') {
                                        ?><a style="font-size: 20px;"  class="btn btn-primary" href="mpdf/formprint_phd/frmPrint2mas_mpdf.php" role="button" target="_blank"><i class="fa fa-file"></i> พิมพ์เอกสารหลักฐานการสมัคร</a>

                                    <?php } else { ?> 	 <a class="btn btn-primary" href="mpdf/formprint_phd/frmPrint2phd_mpdf.php" role="button" target="_blank"><i class="fa fa-file"></i>พิมพ์เอกสารหลักฐานการสมัคร</a><?php
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-dismissible alert-secondary"><span>ยังไม่สามารถพิมพ์เอกสารหลักฐานการสมัครได้</span></div>
    <?php } ?>	 


                        <br>  <br>  
                        <div class="alert alert-dismissible alert-warning"> กรุณาชำระเงินภายใน 3 วันทำการ หลังจากที่ยืนยันการสมัคร และภายในช่วงกำหนดวันชำระเงิน<br>
                            (เมื่อชำระเงินที่ธนาคารเรียบร้อยแล้ว ผู้สมัครจะสามารถพิมพ์เอกสารหลักฐานการสมัครได้ ในวันถัดไป)</div>




<?php } ?>
                </div>


            </div>

    </div>

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

</div>

</form>



