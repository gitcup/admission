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
<style type="text/css">
    <!--
    .style1 {color: #FF0000}
    .style2 {color: #33CC33}
    .style4 {
        color: #FF0000;
        font-size: 16px;
    }
    .style6 {color: #33CC33; font-size: 18px; }
    -->
</style>
<h2>ข้อมูลผู้สมัคร <?php echo"$txt"; ?></h2>
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
            <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr>
                    <td colspan="2" class="style1"><div align="center">*จดบันทึกรหัสผู้สมัครไว้อ้างอิงการใช้งาน*<br />
                        </div></td>
                </tr>
                <tr>
                    <td colspan="2" class="style1">&nbsp;</td>
                </tr>
                <tr>
                    <td width="18%">รหัสผู้สมัคร</td>
                    <td width="82%"><strong>&nbsp;<? echo $applicantcode; ?></strong></td>
                </tr>
                <tr>
                    <td>ชื่อผู้สมัคร</td>
                    <td><strong>&nbsp;<?php echo $prefixname_cv.$applicantname_cv."  ".$applicantsurname_cv; ?></strong></td>
                </tr>
                <tr>
                    <td valign="top">สาขาวิชาที่เลือก</td>
                    <td>

                        <table width="100%" border="0" cellspacing="0" cellpadding="3">
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
                                <tr>
                                    <td width="29%"><strong>&nbsp;ลำดับที่ <? echo $seq; ?></strong></td>
                                    <td width="71%"><strong><? echo $quotaname_cv; ?></strong></td>
                                    <?php
                                    //สถานะผผู้สมนัคร
                                    $strSELSYS1 = "SELECT SYSBYTEDES.BYTECODE, SYSBYTEDES.BYTEDES FROM AVSREG.SYSBYTEDES WHERE (((SYSBYTEDES.TABLENAME)='APPLICANTSELECTION') AND ((SYSBYTEDES.COLUMNNAME)='SELECTIONSTATUS') AND ((SYSBYTEDES.BYTECODE)='$sestatus'))";
                                    $resultSELSYS1 = odbc_exec($objConnect, $strSELSYS1) or die("Error Execute [" . $strSELSYS1 . "]");
                                    while ($objSELSYS1 = odbc_fetch_row($resultSELSYS1)) {

                                        $tstatus = odbc_result($resultSELSYS1, "bytedes");
                                        $tstatus_cv = iconv("TIS-620", "UTF-8", "$tstatus");
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <td> &nbsp;<strong>สถานะการสมัคร : </strong></td>
                                    <td><strong><? echo $tstatus_cv; ?></strong></td>
                                </tr>	
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php $s = $s + 1;
                            }
                            ?>
                        </table></td>
                </tr>
                <tr>
                    <td>จบจาก</td>
                    <td>&nbsp;<?php echo $schoolname_cv; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เกรดเฉลี่ย &nbsp;<?php echo $gpax; ?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <?php
                        // $s = 0;
                        //$strSEL = "SELECT APPLICANTSELECTION.APPLICANTID, QUOTASTATUS.QUOTAID, QUOTASTATUS.APPLICANTTYPE FROM (AVSREG.APPLICANTSELECTION INNER JOIN AVSREG.QUOTASTATUS ON APPLICANTSELECTION.QUOTASTATUSID = QUOTASTATUS.QUOTASTATUSID) WHERE (((APPLICANTSELECTION.APPLICANTID)='$sess_appid') and ((APPLICANTSELECTION.SEQUENCE)='1')) ORDER BY APPLICANTSELECTION.SEQUENCE";
                        //$resultSEL = odbc_exec($objConnect, $strSEL) or die ("Error Execute [".$strSEL."]");
                        //while($objSEL = odbc_fetch_row($resultSEL))
                        //{
                        //	$quotaid = odbc_result($resultSEL,"quotaid");	
                        //	$type = odbc_result($resultSEL,"applicanttype");
                        //}
                        ?>
                        <?php
                        //if(($type == 'Q') and (($quotaid == '2') or ($quotaid == '47') or ($quotaid == '50') or ($quotaid == '322') or ($quotaid == '323'))) 
                        // { 
                        // 	$tea = "select APPLICANT.TCASTEA, APPLICANT.GPAX from AVSREG.APPLICANT where APPLICANT.APPLICANTID = '$sess_appid'";
                        //	$result1 = odbc_exec($objConnect, $tea) or die ("Error Execute [".$tea."]");
                        //	while($tea = odbc_fetch_row($result1))
                        //{
                        //	$tcastea = odbc_result($result1,"tcastea");	
                        //	$gpax = odbc_result($result1,"gpax");	
                        //}
                        //echo $tcastea;
                        //if(($tcastea == "") and ($gpax >= 3))  {
                        ?>
                  <!--  <table width="100%" border="0" cellspacing="1" cellpadding="1">
                      <tr>
                        <td colspan="2" bgcolor="#66CCFF"><table width="100%" border="0" cellpadding="5" cellspacing="5" bgcolor="#FFFFFF">
                          <tr>
                            <td colspan="2"><div align="center">ผู้สมัครมีสิทธิ์เข้าร่วม <strong>โครงการผลิตครูเพื่อพัฒนาท้องถิ่น</strong> ท่านสนใจเข้าร่วมโครงการดังกล่าว หรือไม่</div></td>
                            </tr>
                          <tr>
                            <td><div align="center">
                              <input type="radio" name="tcas" id="radio" value="1" />
                             สนใจเข้าร่วม</div></td>
                            <td><div align="center">
                              <input type="radio" name="tcas" id="radio2" value="0" />
                             ไม่สนใจเข้าร่วม</div></td>
                          </tr>
                          <tr>
                            <td colspan="2"><div align="center">
                              <input type="submit" name="button" id="button" value="  บันทึก  " />
                            </div></td>
                            </tr>
                        </table></td>
                        </tr>
                      
                    </table>      --> 
<?php // } else if ($tcastea == '1') { echo "<b>ผู้สมัครสนใจเข้าร่วมโครงการ ผลิตครูเพื่อพัฒนาท้องถิ่น</b>";} }    ?>   
                        <label></label></td>
                </tr>
                <tr>
               <!--   <td>สถานะผู้สมัคร</td> 
                       
                        <?     //สถานะผผู้สมนัคร
                     $strSELSYS = "SELECT SYSBYTEDES.BYTECODE, SYSBYTEDES.BYTEDES FROM AVSREG.SYSBYTEDES WHERE (((SYSBYTEDES.TABLENAME)='APPLICANT') AND ((SYSBYTEDES.COLUMNNAME)='APPLICANTSTATUS') AND ((SYSBYTEDES.BYTECODE)='$applicantstatus'))";
                     $resultSELSYS = odbc_exec($objConnect, $strSELSYS) or die ("Error Execute [".$strSELSYS."]");
                     while($objSELSYS = odbc_fetch_row($resultSELSYS))
                     {
                             
                             $appstatus = odbc_result($resultSELSYS,"bytedes");	
                             $appstatus_cv = iconv( "TIS-620","UTF-8","$appstatus");
                             
                     }
               ?>
                   <td><span class="style1">&nbsp;<? if(($s == '2') and ($sestatus == '26')) { echo "ผู้สมัครที่มีสิทธิ์สอบสัมภาษณ์ในสาขาวิชาสำรอง"; } else { echo $appstatus_cv; } ?></td>	-->
                </tr> 

                <?php if ($applicantstatus == '9') { ?>

                <?php } ?>
<?php if ($method == 'W') { ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><br>
                        <?php if ($applicantstatus < 10) {?>
                        <div id="menutype" class="flr"><span>ยังไม่สามารถพิมพ์ใบชำระเงินได้</span></div>
                        <?php } else { if($period == '1') { if(($applicanttype == 'A') or ($applicanttype == 'C')  or ($applicanttype == 'T')) { ?>
                        <div id="menutype2" class="flr"><span><a href="pay_entry.php" target="_blank">พิมพ์ใบชำระเงิน</a></span></div> <?php } if($applicanttype == 'B') { ?>
                        <div id="menutype2" class="flr"><span><a href="pay_entryquota.php" target="_blank">พิมพ์ใบชำระเงิน</a></span></div> <?php } if($applicanttype == 'Q') {?>
                        <div id="menutype2" class="flr"><span><a href="pay_entryqnew.php" target="_blank">พิมพ์ใบชำระเงิน</a></span></div><?php } ?>
                        <?php } else { ?> 	  <div id="menutype2" class="flr"><span><a href="pay_entryexce.php" target="_blank">พิมพ์ใบชำระเงิน</a></span></div> <?php } }  ?>
                        <BR><BR><BR>
                        <?php if($finance == 'N') { if ($period == '1') { ?>
                        <div id="menutype2" class="flr"><span><a href="frmPrint2.php" target="_blank">พิมพ์เอกสารหลักฐานการสมัคร</a></span></div>
                        <?php } else { ?> 	  <div id="menutype2" class="flr"><span><a href="frmPrint2exce.php" target="_blank">พิมพ์เอกสารหลักฐานการสมัคร</a></span></div> <?php }} else { ?>
                        <div id="menutype" class="flr"><span>ยังไม่สามารถพิมพ์เอกสารหลักฐานการสมัครได้</span></div>
                        <?php  } ?>	  </td>
                </tr>
                <tr>
                    <td colspan="2"><div align="center"><a href="https://goo.gl/forms/IGWcfgAQDiRY7Wyn2"><span class="style6"></span></a><span class="style2"><br />
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