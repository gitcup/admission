

<!DOCTYPE HTML>
<html>

  




    <body>
        <div class="jumbotron">

            <strong class="strong" > แก้ไขข้อมูลการสมัคร</strong > 
            <hr>

            <!--            รับค่ากลับมา -->
            ﻿<?php $back = $_GET["back"]; ?>
            <!--แสดงข้อมูล-->
            <?php if ($back == '9') { ?> 
                <div class="alert alert-warning" role="alert" style="text-align:center ;margin: 0 auto; width:300px;;" >
                    ไม่พบรหัสผู้สมัคร
                </div>
            <?php } ?>
            <?php if ($back == 'true') { ?> 
                <div class="alert alert-warning" role="alert" style="text-align:center ;margin: 0 auto; width:300px;;" >
                    คุณไม่สามารถแก้ไขข้อมูลการสมัครได้ <br />
                    เนื่องจากชำระเงินแล้ว
                </div>

            <?php } ?>
            <?php if ($back == 'trueh') { ?> 
                <div class="alert alert-warning" role="alert" style="text-align:center ;margin: 0 auto; width:300px;;" >
                    สามารถแก้ไขข้อมูลการสมัครได้เฉพาะ <br>ผู้ที่สมัครผ่านระบบ Online เท่านั้น
                </div>

            <?php } ?>
            <?php if ($back == 'truet') { ?> 


                <div class="alert alert-warning" role="alert" style="text-align:center ;margin: 0 auto; width:300px;;" >
                    ไม่สามารถแก้ไขข้อมูลรหัสนี้ได้
                </div>

            <?php } ?>
            <?php if ($back == 'truend') { ?> 

                <div class="alert alert-warning" role="alert" style="text-align:center ;margin: 0 auto; width:300px;;" >
                    ไม่สามารถแก้ไขข้อมูลรหัสนี้ได้ <br>เนื่องจากหมดเขตรับสมัครแล้ว
                </div>

            <?php } ?>
            <!--แสดงข้อมูล-->

            <div class="row">
                <form style="margin: 0 auto; width:250px;" action="find_applicantForEdit.php" method="post" name="form1" id="form1">
                    <div class="form-group">
                        <label for="exampleInputEmail1">รหัสประจำตัวผู้สมัคร</label>
                        <input  name="txt_applicantcode" type="text" id="txt_applicantcode" maxlength="15" required class="form-control" >
<!--                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">รหัสบัตรประชาชน</label>
                        <input name="citi" type="password" id="citi" maxlength="13"  class="form-control"  required pattern="[0-9]{13}" title="คุณกรอกรหัสประชาชนไม่ถูกต้อง"  placeholder="รหัสบัตรประชาชน 13 หลัก">

                    </div>

                   <label class="label2">
                        <input class="btn btn-primary" type="submit" name="submit" id="bt" value="ตกลง"/>
                    </label>
                    <label  class="label2">
                        <input class="btn btn-light" type="reset" name="reset" id="bt" value="ยกเลิก" />
                    </label>
                </form>

            </div>
            <hr class="my-4">
<!--            <p>กรอกใบสมัครสอบออนไลน์</p>-->

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
 
</html>