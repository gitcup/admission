<?php session_start(); ?>
<script language="javascript">
    function OpenPopup(intLine, degree)
    {
        window.open('getDataqnew.php?Line=' + intLine, 'myPopup', 'width=650,height=450,toolbar=0, menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
    }

    function OpenPopupSchool(intLine)
    {
        window.open('getDataSchool.php?Line=' + intLine, 'myPopup', 'width=650,height=500,toolbar=0, menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
    }

    function ClearForm(intLine) {
        document.getElementById("txtQUOTASTATUSID_" + intLine).value = "";
        document.getElementById("txtQUOTANAME_" + intLine).value = "";
        document.getElementById("txtLEVELABB_" + intLine).value = "";
        document.getElementById("txtQUOTACODE_" + intLine).value = "";
        document.getElementById("txtMINGPAX_" + intLine).value = "";
        document.getElementById("txtLEVELID_" + intLine).value = "";
    }
</script>
<?php
include("config/connect.php");
// include("config/config_school.php");
include("menuType.php");
$frommail = $_GET[m];
if ($frommail == 'true') {
    $$applicantid = $_GET[appid];
} else {
    $applicantid = $_SESSION['applicantid_sess'];
}
// $applicantid = $_SESSION['applicantid_sess'];	
?>

<?php
$strSEL = "SELECT APPLICANT.APPLICANTID, APPLICANT.PREFIXID, APPLICANT.SCHOOLID, APPLICANT.PROGRAMTYPE, APPLICANT.APPLICANTNAME, APPLICANT.APPLICANTSURNAME, APPLICANT.GPAX,APPLICANT.APPLICANTMAIL, APPLICANT.CITIZENID, APPLICANT.HOMEADDRESS1, APPLICANT.HOMEADDRESS2, APPLICANT.HOMEDISTRICT, APPLICANT.HOMEZIPCODE, APPLICANT.HOMEPHONENO, APPLICANT.HOMEPROVINCEID, APPLICANT.EDITSEQ, APPLICANT.APPLICANTSTATUS FROM AVSREG.APPLICANT WHERE (((APPLICANT.APPLICANTID)='$applicantid'))";
$resultSEL = odbc_exec($objConnect, $strSEL) or die("Error Execute [" . $strSEL . "]");
while ($objSEL = odbc_fetch_row($resultSEL)) {
    //$applicantcode = odbc_result($resultSEL,"applicantcode");	
    $applicantname = odbc_result($resultSEL, "applicantname");
    $prename = odbc_result($resultSEL, "prefixid");
    $schoolid = odbc_result($resultSEL, "schoolid");
    $programtype = odbc_result($resultSEL, "programtype");
    $gpax = odbc_result($resultSEL, "gpax");
    $email = odbc_result($resultSEL, "applicantmail");
    $citizenid = odbc_result($resultSEL, "citizenid");
    $applicantstatus = odbc_result($resultSEL, "applicantstatus");
    $applicantsurname = odbc_result($resultSEL, "applicantsurname");
    $applicantname_cv = iconv("TIS-620", "UTF-8", "$applicantname");
    $applicantsurname_cv = iconv("TIS-620", "UTF-8", "$applicantsurname");
    $address1 = odbc_result($resultSEL, "homeaddress1");
    $address2 = odbc_result($resultSEL, "homeaddress2");
    $address3 = odbc_result($resultSEL, "homedistrict");
    $address1_cv = iconv("TIS-620", "UTF-8", "$address1");
    $address2_cv = iconv("TIS-620", "UTF-8", "$address2");
    $address3_cv = iconv("TIS-620", "UTF-8", "$address3");
    $zipcode = odbc_result($resultSEL, "homezipcode");
    $phoneno = odbc_result($resultSEL, "homephoneno");
    $province = odbc_result($resultSEL, "homeprovinceid");
    //$editseq = odbc_result($resultSEL,"editseq");
}
?>
<style type="text/css">
    <!--
    .style2 {color: #339933}
    -->
</style>



<strong>แก้ไขข้อมูลผู้รับสมัคร </strong>
<hr>
<div id="form-regis">
    <form action="edit_applicantqnew.php" method="post" enctype="multipart/form-data" name="register" class="cmxform" id="register" onsubmit="return check()">
        <strong>ข้อมูลส่วนตัว</strong>
        <div class="mr20" >
            <label>คำนำหน้า : 
                <select name="prename" id="prename" validate="required:true" class="required error">
                    <option value="">--- กรุณาเลือก ---</option>
<?php
$strSQL = "SELECT PREFIX.PREFIXNAME, PREFIX.PREFIXID FROM avsreg.PREFIX where (PREFIX.PREFIXID > 1 AND PREFIX.PREFIXID < 5) ORDER BY PREFIX.PREFIXID ASC";
$result = odbc_exec($objConnect, $strSQL) or die("Error Execute [" . $strSQL . "]");
while (odbc_fetch_row($result)) {
    $prefixid = odbc_result($result, "prefixid");
    $prefixname = odbc_result($result, "prefixname");
    $prefixname_cv = iconv("TIS-620", "UTF-8", "$prefixname");
    $selected = "";
    if ($prename == $prefixid) {
        $selected = "selected=\"selected\"";
    }

    echo "<option value=\"$prefixid\" $selected>$prefixname_cv</option>";
}
?>            
                </select>
            </label>
            <table width="100%" border="0">
                <tr>
                    <td>
                        <label>ชื่อ :  
                            <input type="text" name="name" id="name" value="<?php echo $applicantname_cv; ?>"class="required error"  /></label>
                    </td><td><label>
                            สกุล : <input name="surname" type="text"  class="required error" id="surname" value="<?php echo $applicantsurname_cv; ?>">
                        </label></td></tr></table>
            <label>รหัสบัตรประจำตัวประชาชน : <input name="citizen" type="text" class="required number" id="citizen" value="<?php echo $citizenid; ?>" maxlength="13" validate="required:true">
            </label>
            <label>ที่อยู่ : <input name="address" type="text" id="address" value="<?php echo $address1_cv; ?>" size="60" maxlength="100" ></label>
            <table>
                <tr><td>
                        <label>
                            ตำบล :  <input name="address2" type="text" id="address2" value="<?php echo $address2_cv; ?>" maxlength="30"></label>
                    </td>
                    <td>
                        <label>
                            อำเภอ :  <input name="address3" type="text" id="address3" value="<?php echo $address3_cv; ?>" maxlength="30"> </label>
                    </td></tr></table>

            <table><tr><td>
                        <label>
                            จังหวัด :
                            <select name="province" id="select" validate="required:true" class="required error">

<?php
$strSQL = "SELECT PROVINCE.PROVINCEID, PROVINCE.PROVINCENAME FROM AVSREG.PROVINCE ORDER BY PROVINCE.PROVINCENAME";
$result = odbc_exec($objConnect, $strSQL) or die("Error Execute [" . $strSQL . "]");
while (odbc_fetch_row($result)) {
    $provinceid = odbc_result($result, "provinceid");
    $provincename = odbc_result($result, "provincename");
    $provincename_cv = iconv("TIS-620", "UTF-8", "$provincename");
    $selected = "";
    if ($province == $provinceid) {
        $selected = "selected=\"selected\"";
    }
    echo "<option value=\"$provinceid\" $selected>$provincename_cv</option>";
}
?>
                            </select> </label> </td>
                    <td> <label> รหัสไปรษณีย์ : <input name="zipcode" type="text" class="number" id="textfield" value="<?php echo $zipcode; ?>" size="10" maxlength="5" validate="required:true">  </label>   </td>  
                </tr></table>

            <table>
                <tr><td>
                        <label>มือถือ : <input name="mobile" type="text" class="number" id="textfield" value="<?php echo $phoneno; ?>" maxlength="13" validate="required:true">     </label> </td>

                    <td> <label> e-mail : <input name="email" type="text"  id="textfield" value="<?php echo $email; ?>" size="35"  validate="required:true">    
                        </label>
                    </td></tr></table>
        </div>

        <h3>ข้อมูลการศึกษา</h3>
        <div class="mr20" >
            <label></label>
            <table>
                <tr><td>
                        <label>วุฒิการศึกษาเดิม :
                            <select name="entrydegree" id="entrydegree" validate="required:true" class="required error">
                                <option value="">--- กรุณาเลือก ---</option>
<?php
$strSQL = "SELECT ENTRYDEGREE.ENTRYDEGREECODE, ENTRYDEGREE.ENTRYDEGREENAME, ENTRYDEGREE.ENTRYDEGREEABB, ENTRYDEGREE.WEBENTRY
									FROM avsreg.ENTRYDEGREE WHERE (((ENTRYDEGREE.WEBENTRY)= 1))";
$result = odbc_exec($objConnect, $strSQL) or die("Error Execute [" . $strSQL . "]");
while (odbc_fetch_row($result)) {
    $degreeid = odbc_result($result, "entrydegreecode");
    $degreename = odbc_result($result, "entrydegreename");
    $degreeabb = odbc_result($result, "entrydegreeabb");
    $degreename_cv = iconv("TIS-620", "UTF-8", "$degreename");
    $degreeabb_cv = iconv("TIS-620", "UTF-8", "$degreeabb");
    $selected = "";
    if ($programtype == $degreeid) {
        $selected = "selected=\"selected\"";
    }
    echo "<option value=\"$degreeid\" $selected>$degreeabb_cv : $degreename_cv</option>";
}
?>
                            </select></label></td>
                    <td> <label>&nbsp;เกรดเฉลี่ยสะสม :
                            <input name="gpa" type="text" class="required error" id="gpa" value="<?php echo $gpax; ?>" size="10" maxlength="4" validate="required:true" />
                        </label>
                    </td></tr></table>
                                <?php
                                $strSQL = "SELECT SCHOOL.SCHOOLID, SCHOOL.SCHOOLNAME FROM avsreg.SCHOOL WHERE (((SCHOOL.SCHOOLID)='$schoolid'))";
                                $result = odbc_exec($objConnect, $strSQL) or die("Error Execute [" . $strSQL . "]");
                                while (odbc_fetch_row($result)) {
                                    $schoolid = odbc_result($result, "schoolid");
                                    $schoolname = odbc_result($result, "schoolname");
                                    $schoolname_cv = iconv("TIS-620", "UTF-8", "$schoolname");
                                }
                                ?>
            <label class="label2">สถาบันเดิมที่จบ
                <input name="txtSCHOOLID_1" type="hidden" id="txtSCHOOLID_1" value="<?php echo $schoolid ?>"/>
                :
                <input name="txtSCHOOLNAME_1" type="text" id="txtSCHOOLNAME_1" size="50" value="<?php echo $schoolname_cv ?>"readonly="readonly" validate="required:true" class="required error"/>
                <input type="button" name="btnPopup_12"  id="btnPopup_12" value="...คลิก..." onclick="OpenPopupSchool(1)" />
            </label>
        </div>
        <h3>สาขาวิชาที่เลือก</h3>
        <div class="mr20" >
            <label>
                <table>
                    <tr>
                        <td><div align="center">ลำดับ</div></td>
                        <td><div align="center">รหัสสาขา </div></td>
                        <td><div align="center">สาขาวิชาที่เลือก</div></td>
                        <td><div align="center">ระดับ</div></td>
                        <td><div align="center"></div></td>
                    </tr>
<?php
$strSQL = "SELECT APPLICANTSELECTION.APPLICANTID, QUOTA.QUOTACODE, QUOTA.LEVELID, QUOTASTATUS.MINGPAX, QUOTA.QUOTANAME, LEVELID.LEVELABB, APPLICANTSELECTION.SEQUENCE, APPLICANTSELECTION.QUOTASTATUSID FROM ((avsreg.APPLICANTSELECTION INNER JOIN avsreg.QUOTASTATUS ON APPLICANTSELECTION.QUOTASTATUSID = QUOTASTATUS.QUOTASTATUSID) INNER JOIN avsreg.QUOTA ON QUOTASTATUS.QUOTAID = QUOTA.QUOTAID) INNER JOIN avsreg.LEVELID ON QUOTA.LEVELID = LEVELID.LEVELID WHERE (((APPLICANTSELECTION.APPLICANTID)='$applicantid') and ((APPLICANTSELECTION.SEQUENCE)='1')) ORDER BY APPLICANTSELECTION.SEQUENCE";
$result = odbc_exec($objConnect, $strSQL) or die("Error Execute [" . $strSQL . "]");
while (odbc_fetch_row($result)) {
    $quotastatusid1 = odbc_result($result, "quotastatusid");
    $quotacode1 = odbc_result($result, "quotacode");
    $quotaname1 = odbc_result($result, "quotaname");
    $levelabb1 = odbc_result($result, "levelabb");
    $sequence = odbc_result($result, "sequence");
    $mingpa = odbc_result($result, "MINGPAX");
    $levelid = odbc_result($result, "levelid");
    $quotaname1_cv = iconv("TIS-620", "UTF-8", "$quotaname1");
    $levelabb1_cv = iconv("TIS-620", "UTF-8", "$levelabb1");

    $_SESSION["quotastatus_sess1"] = $quotastatusid1;
    $quotastatusid1 = $_SESSION["quotastatus_sess1"];
}
?>
                    <!-- Rows 1 -->
                    <tr>
                        <td><div align="center">1
                                <input name="txtQUOTASTATUSID_1" type="hidden" id="txtQUOTASTATUSID_1" value="<?php echo $quotastatusid1; ?>" />
                                <input name="txtMINGPAX_1" type="hidden" id="txtMINGPAX_1" value="<?php echo $mingpa; ?>" />
                            </div></td>
                        <td><div align="center">
                                <input name="txtLEVELID_1" type="hidden" id="txtLEVELID_1" value="<?php echo $levelid; ?>" />
                                <input type="text" size="3" name="txtQUOTACODE_1"  id="txtQUOTACODE_1" value="<?php echo $quotacode1; ?>"  readonly />

                            </div></td>
                        <td><div align="center">
                                <center>
                                    <input type="text" size="40" name="txtQUOTANAME_1"  id="txtQUOTANAME_1" value="<?php echo $quotaname1_cv; ?>" class="required error" readonly/>
                                </center>
                            </div></td>
                        <td><div align="center">
                                <center>
                                    <input type="text" size="15" name="txtLEVELABB_1" id="txtLEVELABB_1"  value="<?php echo $levelabb1_cv; ?>"   readonly />
                                </center>
                            </div></td>
                        <td><div align="center">
                                <center>
                                    <input type="button" name="btnPopup_1"  id="btnPopup_1" value="+" onclick="OpenPopup(1)" />
                                    <input type="button" name="btnPopup_1"  id="btnPopup_1" value="-" onclick="ClearForm(1)" />
                                </center>
                            </div></td>
                    </tr>

                    <!-- Rows 2 -->
<?php
$strSQL = "SELECT APPLICANTSELECTION.APPLICANTID, QUOTA.QUOTACODE, QUOTA.QUOTANAME, LEVELID.LEVELABB, APPLICANTSELECTION.SEQUENCE, APPLICANTSELECTION.QUOTASTATUSID FROM ((avsreg.APPLICANTSELECTION INNER JOIN avsreg.QUOTASTATUS ON APPLICANTSELECTION.QUOTASTATUSID = QUOTASTATUS.QUOTASTATUSID) INNER JOIN avsreg.QUOTA ON QUOTASTATUS.QUOTAID = QUOTA.QUOTAID) INNER JOIN avsreg.LEVELID ON QUOTA.LEVELID = LEVELID.LEVELID WHERE (((APPLICANTSELECTION.APPLICANTID)='$applicantid') and ((APPLICANTSELECTION.SEQUENCE)='2')) ORDER BY APPLICANTSELECTION.SEQUENCE";
$result = odbc_exec($objConnect, $strSQL) or die("Error Execute [" . $strSQL . "]");
while (odbc_fetch_row($result)) {
    $quotastatusid2 = odbc_result($result, "quotastatusid");
    $quotacode2 = odbc_result($result, "quotacode");
    $quotaname2 = odbc_result($result, "quotaname");
    $levelabb2 = odbc_result($result, "levelabb");
    $sequence = odbc_result($result, "sequence");

    $quotaname2_cv = iconv("TIS-620", "UTF-8", "$quotaname2");
    $levelabb2_cv = iconv("TIS-620", "UTF-8", "$levelabb2");
}
?>
                     <!-- <tr>
                        <td><div align="center">2
                          <input name="txtQUOTASTATUSID_2" type="hidden" id="txtQUOTASTATUSID_2" value="<? echo $quotastatusid2; ?>" />
                          <input name="txtMINGPAX_2" type="hidden" id="txtMINGPAX_2" />
                        </div></td>
                        <td><div align="center">
                          <center>
                            <input name="txtLEVELID_2" type="hidden" id="txtLEVELID_2" />
                            <input type="text" size="3" name="txtQUOTACODE_2"  id="txtQUOTACODE_2" value="<? echo $quotacode2; ?>"  readonly/>
                          </center>
                        </div></td>
                        <td><div align="center">
                          <center>
                            <input type="text" size="40" name="txtQUOTANAME_2"  id="txtQUOTANAME_2" value="<? echo $quotaname2_cv; ?>"  readonly/>
                          </center>
                        </div></td>
                        <td><div align="center">
                          <center>
                            <input type="text" size="15" name="txtLEVELABB_2" id="txtLEVELABB_2"  value="<? echo $levelabb2_cv; ?>"  readonly/>
                          </center>
                        </div></td>
                        <td><div align="center">
                          <center>
                            <input type="button" name="btnPopup_2"  id="btnPopup_2" value="+" onclick="OpenPopup(2)" />
                            <input type="button" name="btnPopup_2"  id="btnPopup_2" value="-" onclick="ClearForm(2)" />
                          </center>
                        </div></td>
                      </tr> -->
                </table>
            </label>
            <input type="hidden" name="hdnMaxLine" value="4">
            <input name="txtstatus" type="hidden" id="txtstatus" value="<? echo $applicantstatus; ?>" />
        </div>
        <!--
        <h3>แนบไฟล์รูปภาพ</h3>
        <div class="mr20" >
                <label>
            <input name="" type="file"  class="email error"/> ขนาดรูปภาพต้องไม่เกิน 80 KB
                </label>
        </div>
        -->
        <div class="center">
            <label class="label2">
                <input type="submit" name="submit" id="bt" value="ตกลง"/>
            </label>
            <label  class="label2">
                <input type="reset" name="reset" id="bt" value="ยกเลิก" />
            </label>
            <br />
            <span class="style2">(คลิก &quot;ตกลง&quot; แล้วรอสักครู่ระบบกำลังสร้างรหัสผู้สมัคร)</span></div>
    </form>



    <div class="alert alert-dismissible alert-primary">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>** หมายเหตุ **</strong> <a href="#" class="alert-link"></a>
        <br>
        1. ผู้ที่มีคุณสมบัติไม่ครบถ้วนหรือไม่ถูกต้องตามประกาศจะไม่มีสิทธิ์ได้รับการพิจำรณาคัดเลือกเข้าสอบและเข้าศึกษาต่อ<br>
        2. กรณีที่ชำระเงินค่าธรรมเนียมสมัครแล้วจะไม่คืนเงินค่าสมัครให้ไม่ว่ากรณีใดๆ ทั้งสิ้น<br>
        3. การสมัครจะสมบูรณ์เมื่อผู้สมัครได้ชำระเงินภายในระยะเวลาที่มหาวิทยาลัยกำหนดเท่านั้น<br>
        4. หลักฐานอื่นๆ นำมาแสดงในวันรายงานตัว<br>

    </div>

   




</div>