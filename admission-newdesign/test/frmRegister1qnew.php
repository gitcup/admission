<?php
//เก็บค่าเก่าที่ได้กรอกเอาไว้
session_start();
$prename = $_SESSION["prefixid_sess"];
$sess_schoolid = $_SESSION["schoolid_sess"];
$sess_schoolname = $_SESSION["schoolname_sess"];
$sess_name = $_SESSION['name_sess'];
$sess_surname = $_SESSION['surname_sess'];
$sess_citizenid = $_SESSION["citizenid_sess"];
$sess_address = $_SESSION["address_sess"];
$sess_address2 = $_SESSION["address2_sess"];
$sess_address3 = $_SESSION["address3_sess"];
$province = $_SESSION["province_sess"];
$sess_zipcode = $_SESSION["zipcode_sess"];
$sess_mobile = $_SESSION["mobile_sess"];
$entrydegree = $_SESSION["programtype_sess"];
$sess_gpax = $_SESSION["gpax_sess"];
$sess_email = $_SESSION["email_sess"];
$sess_qcode1 = $_SESSION["qcode1_sess"];
$sess_qcode2 = $_SESSION["qcode2_sess"];
$sess_qcode3 = $_SESSION["qcode3_sess"];
$sess_qcode4 = $_SESSION["qcode4_sess"];
$sess_ccode1 = $_SESSION["ccode1_sess"];
$sess_ccode2 = $_SESSION["ccode2_sess"];
$sess_ccode3 = $_SESSION["ccode3_sess"];
$sess_ccode4 = $_SESSION["ccode4_sess"];
$sess_qname1 = $_SESSION["qname1_sess"];
$sess_qname2 = $_SESSION["qname2_sess"];
$sess_qname3 = $_SESSION["qname3_sess"];
$sess_qname4 = $_SESSION["qname4_sess"];
$sess_labb1 = $_SESSION["labb1_sess"];
$sess_labb2 = $_SESSION["labb2_sess"];
$sess_labb3 = $_SESSION["labb3_sess"];
$sess_labb4 = $_SESSION["labb4_sess"];
?>

<?php
include("config/connect.php");
// include("config/config_school.php");
//include("menuType.php");
?>

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

<!DOCTYPE HTML>
<html>
    <head>
        <title>ระบบนักศึกษา Online ปีการศึกษา 2561</title>
    </head>


    
    <body>
        <div class="jumbotron">

            <strong >กรอกใบสมัครสอบออนไลน์</strong > <br><span>กรอกข้อมูลการรับสมัครปริญญาตรี ภาคปกติ ประเภทโควตา ปี 2562 รอบที่ 3</span>
            <hr>
            <form action="add_applicantqnew.php" method="post" enctype="multipart/form-data" name="register" class="cmxform" id="register" onsubmit="return check()">
                <h3>ข้อมูลส่วนตัว</h3>
                <div class="col-12" >
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
                    <table width="25%" border="0">
                        <tr>
                        <label>ชื่อ-สกุล :  
                            <input type="text" name="name" id="name" class="required error" value="<?php echo $sess_name; ?>" /></label></td>
                        <label>สกุล : <input type="text" name="surname" id="surname"  class="required error" value="<?php echo $sess_surname; ?>"></label></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td> <label>รหัสบัตรประจำตัวประชาชน : <input name="citizen" value="<?php echo $sess_citizenid; ?>" type="text" id="citizen" maxlength="13" validate="required:true" class="required number"></label></td>    
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>  <label>ที่อยู่ : <input name="address" type="text" id="address" value="<?php echo $sess_address;?>" size="40" maxlength="100" ></label> </td>    
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>  <label>
                                    ตำบล :  <input name="address2" type="text" id="address2" maxlength="30" value="<?php echo $sess_address2;?>"></label></td>
                            <td><label>อำเภอ :  <input name="address3" type="text" id="address3" maxlength="30" value="<?php echo $sess_address3;?>"></label></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>   <label>
                                    จังหวัด :
                                    <select name="province" id="select">

                                        <?php
                                        $strSQL = "SELECT PROVINCE.PROVINCEID, PROVINCE.PROVINCENAME FROM AVSREG.PROVINCE ORDER BY PROVINCE.PROVINCENAME";
                                        $result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
                                        while(odbc_fetch_row($result))
                                        {
                                        $provinceid= odbc_result($result,"provinceid");	
                                        $provincename= odbc_result($result,"provincename");	
                                        $provincename_cv = iconv("TIS-620", "UTF-8", "$provincename");
                                        $selected = "";
                                        if($province == $provinceid)
                                        {
                                        $selected = "selected=\"selected\"";
                                        }
                                        echo "<option value=\"$provinceid\" $selected>$provincename_cv</option>";
                                        }
                                        ?>
                                    </select></label></td>
                            <td><label> รหัสไปรษณีย์ : <input name="zipcode" type="text" value="<?php echo $sess_zipcode;?>" class="number" id="textfield" size="10" maxlength="5" validate="required:true">  </label> </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>  <label>
                                    มือถือ : <input name="mobile" type="text" value="<?php echo $sess_mobile;?>" class="number" id="textfield" maxlength="13" validate="required:true"> </label></td>
                            <td><label>e-mail : <input name="email" type="text"  id="textfield" value="<?php echo $sess_email;?>" size="30"  validate="required:true"> </label></td>
                        </tr>  
                    </table>

                </div>

                <strong >ข้อมูลการศึกษา</strong >
                <div class="mr20" >
                    <label></label>
                    <table>
                        <tr>
                            <td>
                                <label>วุฒิการศึกษาเดิม :
                                    <select name="entrydegree" id="entrydegree" validate="required:true" class="required error">
                                        <option value="">--- กรุณาเลือก ---</option>
                                        <?php
                                        $strSQL = "SELECT ENTRYDEGREE.ENTRYDEGREECODE, ENTRYDEGREE.ENTRYDEGREENAME, ENTRYDEGREE.ENTRYDEGREEABB, ENTRYDEGREE.WEBENTRY
                                        FROM avsreg.ENTRYDEGREE WHERE (((ENTRYDEGREE.WEBENTRY)= 1))";
                                        $result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
                                        while(odbc_fetch_row($result))
                                        {
                                        $degreeid= odbc_result($result,"entrydegreecode");	
                                        $degreename= odbc_result($result,"entrydegreename");	
                                        $degreeabb= odbc_result($result,"entrydegreeabb");	
                                        $degreename_cv = iconv("TIS-620", "UTF-8", "$degreename");
                                        $degreeabb_cv = iconv("TIS-620", "UTF-8", "$degreeabb");
                                        $selected = "";
                                        if($entrydegree == $degreeid)
                                        {
                                        $selected = "selected=\"selected\"";
                                        }
                                        echo "<option value=\"$degreeid\" $selected>$degreeabb_cv : $degreename_cv</option>";
                                        }
                                        ?>
                                    </select></label>
                            </td>
                            <td><label>
                                    &nbsp;เกรดเฉลี่ยสะสม :
                                    <input name="gpa" type="text" id="gpa" value="<?php echo $sess_gpax; ?>" size="10" maxlength="4" validate="required:true" class="required error" />
                                </label>
                            </td></tr></table>
                    <label class="label2">สถาบันเดิมที่จบ
                        <input name="txtSCHOOLID_1" type="hidden" id="txtSCHOOLID_1" value="<?php echo $sess_schoolid; ?>" />
                        :
                        <input name="txtSCHOOLNAME_1"  value="<?php echo $sess_schoolname;?>"type="text" id="txtSCHOOLNAME_1" size="50" readonly="readonly" validate="required:true" class="required error"/>
                        <input type="button" name="btnPopup_12"  id="btnPopup_12" value="... คลิก ..." onclick="OpenPopupSchool(1)" />
                    </label>
                    <label></label>
                </div>
                <strong >สาขาวิชาที่เลือก (เลือกได้ 1 สาขาวิชา)</strong >
                <div class="mr20" >
                    <label>
                        <table>
                            <tr>
                                <td><div align="center">ลำดับ</div></td>
                                <td><div align="center">รหัสสาขา </div></td>
                                <td><div align="center">สาขาวิชาที่เลือก
                                        <input name="txtLEVELID_2" type="hidden" id="txtLEVELID_2" />
                                        <input name="txtMINGPAX_2" type="hidden" id="txtMINGPAX_2" />
                                    </div></td>
                                <td><div align="center">ระดับ</div></td>
                                <td><div align="center">เลือก..</div></td>
                            </tr>
                            <!-- Rows 1 -->
                            <tr>
                                <td><div align="center">1<span class="style1">*</span>
                                        <input name="txtQUOTASTATUSID_1" type="hidden" id="txtQUOTASTATUSID_1" value="<?php echo $sess_qcode1; ?>" />
                                        <input name="txtMINGPAX_1" type="hidden" id="txtMINGPAX_1" />
                                    </div></td>
                                <td><div align="center">
                                        <input name="txtLEVELID_1" type="hidden" id="txtLEVELID_1" />
                                        <input type="text" size="3" name="txtQUOTACODE_1"  value="<?php echo $sess_ccode1; ?>" id="txtQUOTACODE_1"  readonly />

                                    </div></td>
                                <td><div align="center">
                                        <center>
                                            <input type="text" size="40" name="txtQUOTANAME_1"  id="txtQUOTANAME_1" value="<?php echo $sess_qname1; ?>" class="required error" readonly/>
                                        </center>
                                    </div></td>
                                <td><div align="center">
                                        <center>
                                            <input type="text" size="15" name="txtLEVELABB_1" id="txtLEVELABB_1"  value="<?php echo $sess_labb1; ?>"   readonly />
                                        </center>
                                    </div></td>
                                <td><div align="center">
                                        <center>
                                            <input type="button" name="btnPopup_1"  id="btnPopup_1" value="+" onclick="OpenPopup(1)" />
                                            <input type="button" name="btnPopup_1"  id="btnPopup_1" value="-" onclick="ClearForm(1)" />
                                        </center>
                                    </div></td>
                            </tr>

                        </table>
                    </label>
                    <input type="hidden" name="hdnMaxLine" value="4">
                    <span class="style1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>


                <table width="90%" border="0" cellspacing="0" cellpadding="1">
                    <tr>
                        <td width="2%">&nbsp;&nbsp;&nbsp;&nbsp;</br><?php include("captcha/index.php"); ?></td>
                        <td width="98%"><label><strong>&nbsp;&nbsp;&nbsp;&nbsp;กรุณาใส่ข้อความที่ท่านเห็น</strong><br/>
                                &nbsp;&nbsp;&nbsp;
                                <input type="text" name="txtcaptcha" id = "txtcaptcha" maxlength="16" class="required" /> </label>
                            <!--
                            <h3>แนบไฟล์รูปภาพ</h3>
                            <div class="mr20" >
                                    <label>
                                <input name="" type="file"  class="email error"/> ขนาดรูปภาพต้องไม่เกิน 80 KB
                                    </label>
                            </div>
                            -->
                            <input name="captcha" type="hidden" id="captcha" value="<?php echo $_SESSION['captcha']['code']; ?>" /></td>
                    </tr>
                </table> 
                    
                <div class="center">
                    <label class="label2">
                        <input class="btn btn-primary" type="submit" name="submit" id="bt" value="ตกลง"/>
                    </label>
                    <label  class="label2">
                        <input class="btn-light" type="reset" name="reset" id="bt" value="ยกเลิก" />
                    </label>
                    <br />
                    <span class="style2">(คลิก &quot;ตกลง&quot; แล้วรอสักครู่ระบบกำลังสร้างรหัสผู้สมัคร)</span></div>
            </form>
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

    </body>
<?php
include './footer.html';
?>
</html>