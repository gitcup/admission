<!DOCTYPE HTML>
<html>
  
 
    <body>
        <div class="jumbotron">

            <strong class="strong"> กรอกใบสมัครสอบออนไลน์
                <br>
            </strong > 
            <small>กรอกข้อมูลการสมัครเข้าศึกษาระดับบัณฑิตศึกษา ประจำปีการศึกษา 2/2561
                ข้อมูลส่วนบุคคล</small>
            <hr>

            <form action="add_applicantmas.php" method="post" enctype="multipart/form-data" name="register" class="cmxform" id="register" onsubmit="return check()">
                <h3>ข้อมูลส่วนบุคคล</h3>
                <div class="mr20" >
                    <label>คำนำหน้า : 
                        <select name="prename" id="prename" validate="required:true" class="required error">
                            <option value="">--- กรุณาเลือก ---</option>
                            <?php
                            $strSQL = "SELECT PREFIX.PREFIXNAME, PREFIX.PREFIXID FROM avsreg.PREFIX ORDER BY PREFIX.PREFIXID ASC";
                            //$strSQL = "SELECT PREFIX.PREFIXNAME, PREFIX.PREFIXID FROM avsreg.PREFIX where (PREFIX.PREFIXID > 1 AND PREFIX.PREFIXID < 5) ORDER BY PREFIX.PREFIXID ASC";
                            $result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
                            while(odbc_fetch_row($result))
                            {
                            $prefixid= odbc_result($result,"prefixid");	
                            $prefixname= odbc_result($result,"prefixname");	
                            $prefixname_cv = iconv("TIS-620", "UTF-8", "$prefixname");
                            $selected = "";
                            if($prename == $prefixid)
                            {
                            $selected = "selected=\"selected\"";
                            }								

                            echo "<option value=\"$prefixid\" $selected>$prefixname_cv</option>";

                            }
                            ?>            
                        </select>
                    </label>
                    <label>ชื่อ-สกุล (ภาษาไทย) :  
                        <input type="text" name="name" id="name" class="required error" value="<? echo $sess_name; ?>" />
                        - <input type="text" name="surname" id="surname"  class="required error" value="<? echo $sess_surname; ?>"></label>
                    <label>ชื่อ-สกุล (ภาษาอังกฤษ) :  
                        <input type="text" name="nameeng" id="nameeng" class="required error" value="<? echo $sess_nameeng; ?>" />
                        - <input type="text" name="surnameeng" id="surnameeng"  class="required error" value="<? echo $sess_surnameeng; ?>"></label>
                    <label>รหัสบัตรประจำตัวประชาชน : <input name="citizen" value="<? echo $sess_citizenid; ?>" type="text" id="citizen" maxlength="13" validate="required:true" class="required number">  ว/ด/ป เกิด <input type="text" name="bdate" id="bdate"  value="<? echo "$sess_bdate"; ?>"/> 

                        <script type="text/javascript">
                            jQuery('#bdate').datetimepicker({
                                timepicker: false,
                                format: 'd/m/Y'
                            });
                        </script></label>

                    <label>สถานภาพสมรส : <input name="fstatus" type="radio" value="1" <? if($sess_fstatus==1){ echo"checked='checked'"; } ?> /> โสด  <input name="fstatus" type="radio" value="2" <? if($sess_fstatus==2){ echo"checked='checked'"; } ?>/> สมรส <input name="fstatus" type="radio" value="3" <? if($sess_fstatus==3){ echo"checked='checked'"; } ?>/> หม้าย  <input name="fstatus" type="radio" value="4" <? if($sess_fstatus==4){ echo"checked='checked'"; } ?>/> หย่าร้าง </label>
                    <label>ที่อยู่ : <input name="address" type="text" id="address" value="<? echo $sess_address;?>" size="60" maxlength="100" ></label>
                    <label>
                        ตำบล :  <input name="address2" type="text" id="address2" maxlength="30" value="<? echo $sess_address2;?>">

                        อำเภอ :  <input name="address3" type="text" id="address3" maxlength="30" value="<? echo $sess_address3;?>">  </label>
                    <label>
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
                        </select>
                        รหัสไปรษณีย์ : <input name="zipcode" type="text" value="<? echo $sess_zipcode;?>" class="number" id="zipcode" size="10" maxlength="5" validate="required:true"/>  </label>    
                    <label>   มือถือ : <input name="mobile" type="text" value="<? echo $sess_mobile;?>" class="number" id="mobile" maxlength="13" validate="required:true"/> 
                        e-mail : <input name="email" type="text"  id="email" value="<? echo $sess_email;?>" size="35"  validate="required:true"/>    
                    </label>
                </div>

                <h3>ข้อมูลการศึกษาระดับปริญญาตรี</h3>
                <div class="mr20" >

                    <label>สาขาวิชาเอก :      
                        <input type="text" name="programbcl" id="programbcl" value="<? echo $sess_programbcl;?>" validate="required:true" class="required error"/>
                        ชื่อปริญญา :      
                        <input type="text" name="degreebcl" id="degreebcl" value="<? echo $sess_degreebcl;?>" validate="required:true" class="required error"/></label>
                    <label>&nbsp;ปีที่สำเร็จการศึกษา :
                        <input type="text" name="yearbcl" id="yearbcl" size="5" maxlength="4" value="<? echo $sess_yearbcl;?>" validate="required:true" class="required error"/>
                        เกรดเฉลี่ยสะสม :
                        <input name="gpabcl" type="text" id="gpabcl" value="<? echo $sess_gpabcl; ?>" size="2" maxlength="4" validate="required:true" class="required error" />
                    </label>
                    <label class="label2">สถาบันเดิมที่จบ
                        <input name="txtSCHOOLID_1" type="hidden" id="txtSCHOOLID_1" value="<? echo $sess_schoolidbcl; ?>" />
                        :
                        <input name="txtSCHOOLNAME_1"  value="<? echo $sess_schoolnamebcl;?>"type="text" id="txtSCHOOLNAME_1" size="50" readonly="readonly" validate="required:true" class="required error"/>
                        <input type="button" name="btnPopup_12"  id="btnPopup_12" value="... คลิก ..." onclick="OpenPopupSchool(1)" />
                    </label>
                </div>

                <h3>ข้อมูลการศึกษาระดับปริญญาโท</h3>
                <div class="mr20" >

                    <label>สาขาวิชาเอก :      
                        <input type="text" name="programmas" id="programmas" value="<? echo $sess_programmas;?>" validate="required:true" class="required error"/>
                        ชื่อปริญญา :      
                        <input type="text" name="degreemas" id="degreemas" value="<? echo $sess_degreemas;?>" validate="required:true" class="required error"/>
                    </label>
                    <label>&nbsp;ปีที่สำเร็จการศึกษา :
                        <input type="text" name="yearmas" id="yearmas" size="5" maxlength="4" value="<? echo $sess_yearmas;?>" validate="required:true" class="required error"/>
                        เกรดเฉลี่ยสะสม :
                        <input name="gpamas" type="text" id="gpamas" value="<? echo $sess_gpamas; ?>" size="2" maxlength="4" validate="required:true" class="required error" />
                    </label>
                    <label class="label2">สถาบันเดิมที่จบ
                        <input name="txt2SCHOOLID_1" type="hidden" id="txt2SCHOOLID_1" value="<? echo $sess_schoolidmas; ?>" />
                        :
                        <input name="txt2SCHOOLNAME_1"  value="<? echo $sess_schoolnamemas;?>"type="text" id="txt2SCHOOLNAME_1" size="50" readonly="readonly" validate="required:true" class="required error"/>
                        <input type="button" name="btnPopup_12"  id="btnPopup_12" value="... คลิก ..." onclick="OpenPopupSchool2(1)" />
                    </label>
                </div>

                <h3>สถานภาพการทำงาน</h3>
                <div class="mr20" >

                    <label>สถานภาพการทำงาน ปัจจุบัน :      
                        <input name="cjob" type="radio" value="1" <? if($sess_cjob ==1){ echo"checked='checked'"; } ?>/>
                               ทำงาน &nbsp;&nbsp;&nbsp;
                               <input name="cjob" type="radio" value="0" <? if($sess_cjob ==0){ echo"checked='checked'"; } ?>/>
                               ไม่ทำงาน </label><label>สถานที่ทำงาน :      
                        <input type="text" name="atjob" id="atjob" value="<? echo $sess_atjob;?>"/>
                        &nbsp;ที่ตั้ง :
                        <input type="text" name="atwork" id="atwork" value="<? echo $sess_atwork;?>"/></label>
                    <label>ตำแหน่งงาน :
                        <input type="text" name="workposition" id="workposition" size="20" value="<? echo $sess_workposition;?>"/>
                        รายได้ต่อเดือน
                        <input name="salary" type="text" id="salary" size="15" value="<? echo $sess_salary;?>"  onKeyUp="if (isNaN(this.value)) {
                                    alert('กรุณากรอกตัวเลข');
                                    this.value = '';
                                }"/>

                        บาท(ไม่ใส่ &quot;,&quot; )   </label>  <label>  โทรศัพท์ :
                        <input type="text" name="jobphone" id="jobphone" value="<? echo $sess_jobphone;?>"/>

                        โทรสาร :
                        <input type="text" name="jobphone2" id="jobphone2" value="<? echo $sess_jobphone2;?>"/>
                    </label>
                </div>

                <h3>สาขาวิชาที่เลือก </h3>
                <div class="mr20" >
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
                                        <input name="txtQUOTASTATUSID_1" type="hidden" id="txtQUOTASTATUSID_1" value="<? echo $sess_qcode1; ?>" />
                                        <input name="txtMINGPAX_1" type="hidden" id="txtMINGPAX_1" />
                                    </div></td>
                                <td><div align="center">
                                        <input name="txtLEVELID_1" type="hidden" id="txtLEVELID_1" />
                                        <input type="text" size="3" name="txtQUOTACODE_1"  value="<? echo $sess_ccode1; ?>" id="txtQUOTACODE_1"  readonly />

                                    </div></td>
                                <td><div align="center">
                                        <center>
                                            <input type="text" size="40" name="txtQUOTANAME_1"  id="txtQUOTANAME_1" value="<? echo $sess_qname1; ?>" class="required error" readonly/>
                                        </center>
                                    </div></td>
                                <td><div align="center">
                                        <center>
                                            <input type="text" size="15" name="txtLEVELABB_1" id="txtLEVELABB_1"  value="<? echo $sess_labb1; ?>"   readonly />
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
                        <input type="submit" name="submit" id="bt" value="ตกลง"/>
                    </label>
                    <label  class="label2">
                        <input type="reset" name="reset" id="bt" value="ยกเลิก" />
                    </label>
                    <br />
                    <span class="style2">(คลิก &quot;ตกลง&quot; แล้วรอสักครู่ระบบกำลังสร้างรหัสผู้สมัคร)</span></div>
            </form>

<!--            <p>กรอกใบสมัครสอบออนไลน์</p>-->
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="frmselevel.php" role="button">กรอกใบสมัครสอบออนไลน์</a>
            </p>
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
