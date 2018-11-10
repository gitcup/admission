<?php
session_start();
$prename = $_SESSION["prefixid_sess"];
$sess_schoolid = $_SESSION["schoolid_sess"];
$sess_schoolname = $_SESSION["schoolname_sess"];
$sess_name = $_SESSION['name_sess'];
$sess_nameeng = $_SESSION['nameeng_sess'];
$sess_surname = $_SESSION['surname_sess'];
$sess_surnameeng = $_SESSION['surnameeng_sess'];
$sess_fstatus = $_SESSION['fstatus_sess'];
$sess_bdate = $_SESSION['bdate_sess'];

$sess_programbcl = $_SESSION['programbcl_sess'];
$sess_degreebcl = $_SESSION['degreebcl_sess'];
$sess_yearbcl = $_SESSION['yearbcl_sess'];
$sess_gpabcl = $_SESSION['gpabcl_sess'];
$sess_schoolidbcl = $_SESSION["schoolidbcl_sess"];
$sess_schoolnamebcl = $_SESSION["schoolnamebcl_sess"];

$sess_programmas = $_SESSION['programmas_sess'];
$sess_degreemas = $_SESSION['degreemas_sess'];
$sess_yearmas = $_SESSION['yearmas_sess'];
$sess_gpamas = $_SESSION['gpamas_sess'];
$sess_schoolidmas = $_SESSION["schoolidmas_sess"];
$sess_schoolnamemas = $_SESSION["schoolnamemas_sess"];

$sess_cjob = $_SESSION['cjob_sess'];
$sess_atjob = $_SESSION['atjob_sess'];
$sess_atwork = $_SESSION['atwork_sess'];
$sess_workposition = $_SESSION['workposition_sess'];
$sess_salary = $_SESSION['salary_sess'];
$sess_jobphone = $_SESSION['jobphone_sess'];
$sess_jobphone2 = $_SESSION['jobphone2_sess'];

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
$sess_ccode1 = $_SESSION["ccode1_sess"];
$sess_qname1 = $_SESSION["qname1_sess"];
$sess_labb1 = $_SESSION["labb1_sess"];
?>

<?php
include("config/connect.php");
// include("config/config_school.php");
include("menuType.php");
?>
<script language="javascript">
    function OpenPopup(intLine, degree)
    {
        window.open('getDatamas.php?Line=' + intLine, 'myPopup', 'width=650,height=450,toolbar=0, menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
    }

    function OpenPopupSchool(intLine)
    {
        window.open('getDataSchoolphd.php?Line=' + intLine, 'myPopup', 'width=650,height=500,toolbar=0, menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
    }
    function OpenPopupSchool2(intLine)
    {
        window.open('getDataSchoolphd2.php?Line=' + intLine, 'myPopup', 'width=650,height=500,toolbar=0, menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
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
<!-- ---------------ปฏิทิน -------------------- -->

<link rel="stylesheet" type="text/css" href="jss/jquery.datetimepicker.css">
<script type="text/javascript" src="jss/jquery.js"></script>
<script type="text/javascript" src="jss/jquery.datetimepicker.js"></script>

<style type="text/css">
    <!--
    .style1 {
        color: #000000;
        font-size: 12px;
    }
    .style2 {color: #339933}
    -->
</style>








<div class="jumbotron">
    <strong >กรอกใบสมัครสอบออนไลน์</strong > <br><span>กรอกข้อมูลการสมัครเข้าศึกษาระดับบัณฑิตศึกษา   ประจำปีการศึกษา 2/2561</span>
    <hr>

    <form action="add_applicantmas.php" method="post" enctype="multipart/form-data" name="register" class="cmxform" id="register" onsubmit="return check()">
        <strong>ข้อมูลส่วนบุคคล</strong><br>

        <label>คำนำหน้า : 
            <select name="prename" id="prename" validate="required:true" class="form-control" required>
                <option value="">--- กรุณาเลือก ---</option>
                <?php
                $strSQL = "SELECT PREFIX.PREFIXNAME, PREFIX.PREFIXID FROM avsreg.PREFIX ORDER BY PREFIX.PREFIXID ASC";
                //$strSQL = "SELECT PREFIX.PREFIXNAME, PREFIX.PREFIXID FROM avsreg.PREFIX where (PREFIX.PREFIXID > 1 AND PREFIX.PREFIXID < 5) ORDER BY PREFIX.PREFIXID ASC";
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


        <div class="form-row">
            <span style="padding-left:22px"> ชื่อ-สกุล (ภาษาไทย) :</span>
            <div class="form-group col-md-2">
                <input type="text" name="name" id="name" class="form-control" required value="<?php echo $sess_name; ?>" />
            </div>
            <div class="form-group col-md-2">
                <input type="text" name="surname" id="surname"  class="form-control " required value="<?php echo $sess_surname; ?>">
            </div>
        </div>


        <div class="form-row">
            ชื่อ-สกุล (ภาษาอังกฤษ) : 
            <div class="form-group col-md-2">
                <input type="text" name="nameeng" id="nameeng" class="form-control" required value="<?php echo $sess_nameeng; ?>" />
            </div>
            <div class="form-group col-md-2">
                <input type="text" name="surnameeng" id="surnameeng"  class="form-control" required value="<?php echo $sess_surnameeng; ?>">
            </div>
        </div>




        <div class="form-row">
            <div class="form-group col-md-3">
                <label >รหัสบัตรประชาชน</label>
                <input name="citizen" value="<?php echo $sess_citizenid; ?>" type="text" id="citizen" maxlength="13" pattern="[0-9]{13}" title="คุณกรอกรหัสประชาชนไม่ถูกต้อง" class="form-control" required >
            </div>
            <div class="form-group col-md-2">
                <label >ว/ด/ป เกิด</label>  
                <input type="text" name="bdate" id="bdate"  value="<?php echo "$sess_bdate"; ?>"class="form-control" required /> 
            </div>



            <div class="form-check form-check-inline">
                สถานภาพสมรส  &nbsp; &nbsp; &nbsp; 
                <input name="fstatus" type="radio" value="1" <?php
                if ($sess_fstatus == 1) {
                    echo"checked='checked'";
                }
                ?> />
                <label class="form-check-label" for="inlineCheckbox1">&nbsp; โสด</label>
            </div>
            <div class="form-check form-check-inline">
                <input name="fstatus" type="radio" value="2" <?php
                if ($sess_fstatus == 2) {
                    echo"checked='checked'";
                }
                ?>/>
                <label class="form-check-label" for="inlineCheckbox2">&nbsp; สมรส </label>
            </div>
            <div class="form-check form-check-inline">
                <input name="fstatus" type="radio" value="3" <?php
                if ($sess_fstatus == 3) {
                    echo"checked='checked'";
                }
                ?>/>
                <label class="form-check-label" for="inlineCheckbox3">&nbsp; หม้าย</label>
            </div>
            <div class="form-check form-check-inline">
                <input name="fstatus" type="radio" value="4" <?php
                if ($sess_fstatus == 4) {
                    echo"checked='checked'";
                }
                ?>/>
                <label class="form-check-label" for="inlineCheckbox4"> &nbsp;หย่าร้าง </label>
            </div>
        </div>
        <script type="text/javascript">
            jQuery('#bdate').datetimepicker({
                timepicker: false,
                format: 'd/m/Y'
            });
        </script>


        <div class="form-row">
            <div class="form-group col-md-3">
                <label >ที่อยู่ </label>
                <input name="address" type="text" id="address" value="<?php echo $sess_address; ?>" size="60" maxlength="100" class="form-control" required  >
            </div>
            <div class="form-group col-md-2">
                <label >ตำบล  </label>  
                <input name="address2" type="text" id="address2" maxlength="30" value="<?php echo $sess_address2; ?>" class="form-control" required >
            </div>

            <div class="form-group col-md-2">
                <label > อำเภอ  </label>  
                <input name="address3" type="text" id="address3" maxlength="30" value="<?php echo $sess_address3; ?>" class="form-control" required >
            </div>
            <div class="form-group col-md-2">
                <label > จังหวัด  </label>  
                <select name="province" id="select" class="form-control" required >

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
                </select>
            </div>

            <div class="form-group col-md-2">
                <label > รหัสไปรษณีย์  </label>  
                <input  name="zipcode" type="text" value="<?php echo $sess_zipcode; ?>" class="form-control"  required  id="zipcode" size="10" pattern="[0-9]{5}" title="คุณกรอกรหัสไปรษณีย์ไม่ถูกต้อง" validate="required:true" maxlength="5"/> 
            </div>

        </div>





        <div class="form-row">
            <div class="form-group col-md-2">
                <label >มือถือ </label>
                <input name="mobile" type="text" value="<?php echo $sess_mobile; ?>" class="form-control" required  id="mobile" maxlength="13" validate="required:true"/> 
            </div>
            <div class="form-group col-md-3">
                <label >e-mail  </label>  
                <input name="email" type="text"  id="email" value="<?php echo $sess_email; ?>" size="35"  validate="required:true" class="form-control" required />    
            </div>
        </div>













        <hr>
        <strong>ข้อมูลการศึกษาระดับปริญญาตรี</strong>
        <br>


        <div class="form-row">
            <div class="form-group col-md-3">
                <label >สาขาวิชาเอก  </label>
                <input type="text" name="programbcl" id="programbcl" value="<?php echo $sess_programbcl; ?>" validate="required:true" class="form-control"/>
            </div>
            <div class="form-group col-md-3">
                <label >ชื่อปริญญา     </label>  
                <input type="text" name="degreebcl" id="degreebcl" value="<?php echo $sess_degreebcl; ?>" validate="required:true" class="form-control"/>  
            </div>


        </div>


        <div class="form-row">
            <div class="form-group col-md-2">
                <label >ปีที่สำเร็จการศึกษา  </label>
                <input type="text" name="yearbcl" id="yearbcl" size="5" maxlength="4" value="<?php echo $sess_yearbcl; ?>" validate="required:true" class="form-control" required />
            </div>
            <div class="form-group col-md-2">
                <label >เกรดเฉลี่ยสะสม    </label>  
                <input name="gpabcl" type="text" id="gpabcl" value="<?php echo $sess_gpabcl; ?>" size="2" maxlength="4" validate="required:true" class="form-control" required  />
            </div>


        </div>


        <div class="form-row">
            <div class="form-group col-md-4">
                <label >สถาบันเดิมที่จบ</label>
                <input name="txtSCHOOLID_1" type="hidden" id="txtSCHOOLID_1" value="<?php echo $sess_schoolidbcl; ?>"  class="form-control"/>
                <input name="txtSCHOOLNAME_1"  value="<?php echo $sess_schoolnamebcl; ?>"type="text" id="txtSCHOOLNAME_1" size="50" readonly="readonly" validate="required:true" class="form-control"/>
                <input type="button" name="btnPopup_12"  id="btnPopup_12" value="เพิ่ม" onclick="OpenPopupSchool(1)" class="btn btn-secondary" />
            </div>
        </div>

        <hr>



        <strong>ข้อมูลการศึกษาระดับปริญญาโท</strong>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label >สาขาวิชาเอก : </label>
                <input type="text" name="programmas" id="programmas" value="<?php echo $sess_programmas; ?>" validate="required:true" class="form-control" required />
            </div>
            <div class="form-group col-md-3">
                <label >ชื่อปริญญา :    </label>  
                <input type="text" name="degreemas" id="degreemas" value="<?php echo $sess_degreemas; ?>" validate="required:true" class="form-control" required />
            </div>     
        </div>


        <div class="form-row">
            <div class="form-group col-md-2">
                <label >ปีที่สำเร็จการศึกษา  </label>
                <input type="text" name="yearmas" id="yearmas" size="5" maxlength="4" value="<?php echo $sess_yearmas; ?>" validate="required:true" class="form-control" required />
            </div>
            <div class="form-group col-md-2">
                <label >เกรดเฉลี่ยสะสม    </label>  
                <input name="gpamas" type="text" id="gpamas" value="<?php echo $sess_gpamas; ?>" size="2" maxlength="4" validate="required:true" class="form-control" required  />

            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-4">
                <label >สถาบันเดิมที่จบ</label>
                <input name="txt2SCHOOLID_1" type="hidden" id="txt2SCHOOLID_1" value="<?php echo $sess_schoolidmas; ?>" />
                <input name="txt2SCHOOLNAME_1"  value="<?php echo $sess_schoolnamemas; ?>"type="text" id="txt2SCHOOLNAME_1" size="50" readonly="readonly" validate="required:true" class="form-control" required />
                <input class="btn btn-secondary"  type="button" name="btnPopup_12"  id="btnPopup_12" value="เพิ่ม" onclick="OpenPopupSchool2(1)" />
            </div>
        </div>



        <hr>
        <strong>สถานภาพการทำงาน</strong>
        <br>






        <label>สถานภาพการทำงาน ปัจจุบัน :      
            <input name="cjob" type="radio" value="1" onclick="workForm()"<?php
            if ($sess_cjob == 1) {
                echo"checked='checked'";
            }
            ?>  />
            ทำงาน &nbsp;&nbsp;&nbsp;
            <input name="cjob" type="radio" value="0" onclick="notworkForm()"<?php
            if ($sess_cjob == 0) {
                echo"checked='checked'";
            }
           
            ?>  />
            ไม่ทำงาน </label>
        
        
<!--        ฟังก์ชั่น เปิด/ปิด ฟอร์มทำงานไม่ทำงาน-->
           <script>
      function workForm(){
                document.getElementById("atjob").disabled = false;
                document.getElementById("atwork").disabled = false;
                document.getElementById("workposition").disabled = false;
                document.getElementById("salary").disabled = false;
                document.getElementById("phone").disabled = false;
                document.getElementById("jobphone2").disabled = false;
            }
   
      
            function notworkForm() {
                document.getElementById("atjob").disabled = true;
                document.getElementById("atwork").disabled = true;
                document.getElementById("workposition").disabled = true;
                document.getElementById("salary").disabled = true;
                document.getElementById("phone").disabled = true;
                document.getElementById("jobphone2").disabled = true;
                
             
            }
            
        
        </script>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label >สถานที่ทำงาน</label>
                <input type="text" name="atjob" id="atjob" value="<?php echo $sess_atjob; ?>"class="form-control"  />

            </div>
            <div class="form-group col-md-4">
                <label >ที่ตั้ง</label>
                <input type="text" name="atwork" id="atwork" value="<?php echo $sess_atwork; ?>"class="form-control"   >

            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label >ตำแหน่งงาน</label>
                <input type="text" name="workposition" id="workposition" size="20" value="<?php echo $sess_workposition; ?>" class="form-control" />

            </div>
            <div class="form-group col-md-2">
                <label > รายได้ต่อเดือน</label>
                <input name="salary" type="text" id="salary" size="15"  title="คุณกรอกรายได้ไม่ถูกต้อง" value="<?php echo $sess_salary; ?>"  onKeyUp="if (isNaN(this.value)) {
                            alert('กรุณากรอกตัวเลข');
                            this.value = '';
                        }" class="form-control"  placeholder="ตัวอย่าง 15000" /> 

            </div>
        </div>




        <div class="form-row">
            <div class="form-group col-md-2">
                <label >เบอร์โทรศัพท์</label>
                <input type="text" name="phone"  id="phone" maxlength="13"  pattern="[0-9]{3}[0-9]{3}[0-9]{4}" title="คุณกรอกเบอร์โทรศัพท์ไม่ถูกต้อง" value="<?php echo $sess_jobphone; ?>" class="form-control"   >

            </div>


            <div class="form-group col-md-2">
                <label >โทรสาร</label>
                <input type="text" name="jobphone2" id="jobphone2" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" title="คุณกรอกเบอร์โทรโทรสารไม่ถูกต้อง" value="<?php echo $sess_jobphone2; ?>"class="form-control"  />

            </div>
        </div>

        <hr>
        <strong>สาขาวิชาที่เลือก</strong>
        <div class="border-bottom" >
            <label>
                <table>
                    <tr>
                        <td><div align="center">ลำดับ</div></td>
                        <td><div align="center">รหัสสาขา </div></td>
                        <td><div align="center">สาขาวิชาที่เลือก</div></td>
                        <td><div align="center">ระดับ</div></td>
                        <td><div align="center">เลือก..</div></td>
                    </tr>
                    <!-- Rows 1 -->
                    <tr>
                        <td><div align="center">1
                                <input name="txtQUOTASTATUSID_1" type="hidden" id="txtQUOTASTATUSID_1" value="<?php echo $sess_qcode1; ?>"  />
                                <input name="txtMINGPAX_1" type="hidden" id="txtMINGPAX_1" />
                            </div></td>
                        <td><div align="center">
                                <input name="txtLEVELID_1" type="hidden" id="txtLEVELID_1" />
                                <input type="text" size="3" name="txtQUOTACODE_1"  value="<?php echo $sess_ccode1; ?>" id="txtQUOTACODE_1"  class="form-control" readonly/>

                            </div></td>
                        <td><div align="center">
                                <center>
                                    <input type="text" size="40" name="txtQUOTANAME_1"  id="txtQUOTANAME_1" value="<?php echo $sess_qname1; ?>" class="form-control" readonly required/>
                                </center>
                            </div></td>
                        <td><div align="center">
                                <center>
                                    <input type="text" size="15" name="txtLEVELABB_1" id="txtLEVELABB_1"  value="<?php echo $sess_labb1; ?>"  class="form-control" readonly  />
                                </center>
                            </div></td>
                        <td><div align="center">
                                <center>
                                    <input class="btn btn-light" type="button" name="btnPopup_1"  id="btnPopup_1" value="+" onclick="OpenPopup(1)" />
                                    <input class="btn btn-light" type="button" name="btnPopup_1"  id="btnPopup_1" value="-" onclick="ClearForm(1)" />
                                </center>
                            </div></td>
                    </tr>
                </table>
            </label>
            <input type="hidden" name="hdnMaxLine" value="4">
            <span class="style1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>


        <strong>กรุณาใส่ข้อความที่ท่านเห็น</strong><br>  <br> 
        <?php include("./captcha/index.php"); ?>
        <br>
        <br>
        <div class="col-md-2">
            <input type="text" name="txtcaptcha" id= "txtcaptcha" maxlength="4"  class="form-control" w/> </label>
        </div>
        <!--
        <h3>แนบไฟล์รูปภาพ</h3>
        <div class="mr20" >
                <label>
            <input name="" type="file"  class="email error"/> ขนาดรูปภาพต้องไม่เกิน 80 KB
                </label>
        </div>
        -->
        <input name="captcha" type="hidden" id="captcha" value="<?php echo $_SESSION['captcha']['code']; ?>"  /></td>


            
        <div class="center">
            <label class="label2">
                <input class="btn btn-primary" type="submit" name="submit" id="bt" value="ตกลง"/>
            </label>
            <label  class="label2">
                <input class="btn btn-light" type="reset" name="reset" id="bt" value="ยกเลิก" />
            </label>
            <br />
            <span class="style2">(คลิก &quot;ตกลง&quot; แล้วรอสักครู่ระบบกำลังสร้างรหัสผู้สมัคร)</span></div>
    </form>



    <br>

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


