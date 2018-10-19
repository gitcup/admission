<?php $back = $_GET["back"]; ?>

<!DOCTYPE HTML>
<html>

  

    



    <body>
        <div class="jumbotron">

            <strong class="strong"> ตรวจสถานะ / พิมพ์แบบฟอร์มการชำระเงิน / พิมพ์เอกสารการสมัคร</strong > 
        
            <hr>

    <?php if ($back == '9') { ?><div class="alert alert-warning" role="alert" style="text-align:center ;margin: 0 auto; width:300px;;" >
                        ไม่พบรหัสผู้สมัคร
                    </div>
                <?php } ?>
                <?php if ($back == '99') { ?>

                    <div class="alert alert-warning" role="alert" style="text-align:center ;margin: 0 auto; width:300px;;" >
                        เฉพาะผู้ที่ทำการสมัครผ่านระบบออนไลน์เท่านั้น
                    </div>
                <?php } ?>

            <div class="row">
                <!--                ตรวจสอบสถานะ-->
                

                <form style="margin: 0 auto; width:250px;"action="find_applicant.php" method="post" name="form1" id="form1">
                    <div class="form-group">
                        <label for="exampleInputEmail1">รหัสประจำตัวผู้สมัคร</label>
                        <input class="form-control" name="txt_applicantcode" type="text" id="txt_applicantcode" maxlength="15" >
                        <small class="form-text text-muted"> * เฉพาะผู้ที่ทำการสมัครผ่านระบบออนไลน์ เท่านั้น</small>
                    </div>


                    <input type="submit" name="submit" id="bt" value="ตกลง" />


                    <input type="reset" name="submit2" id="bt" value="ยกเลิก" />
                </form>

            </div>
            <hr class="my-4">
<!--            <p>กรอกใบสมัครสอบออนไลน์</p>-->
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="frmselevel.php" role="button">กรอกใบสมัครสอบออนไลน์</a>
            </p>
            <div class="alert alert-dismissible alert-primary">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>** หมายเหตุ **</strong> <a href="#" class="alert-link"></a>
                <br>
                1. การรับสมัครออนไลน์จะเสร็จสมบูรณ์เมื่อผู้สมัคร พิมพ์แบบฟอร์มการชำระเงินไปชำระเงินเรียบร้อยแล้วเท่านั้น<br>
                2. การแก้ไขข้อมูลการสมัคร จะกระทำได้เมื่อผู้สมัครยังมิได้ชำระเงิน <br>
                3. หลังจากผู้สมัครชำระเงินเรียบร้อยแล้ว มหาวิทยาลัยจะทำการปรับสถานะผู้สมัครเป็นชำระเงินแล้ว หลังจากที่ผู้สมัครชำระเงินที่ธนาคารภายใน 24 ชั่วโมง  <br>

            </div>
        </div>

    </body>
    <?php
    include './footer.html';
    ?>
</html>