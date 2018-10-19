

<?php $back = $_GET["back"]; ?>

<!DOCTYPE HTML>
<html>
   
 

   



    <body>
        <div class="jumbotron">

            <strong class="strong"> ค้นหารหัสผู้สมัครจากบัตรประชาชน</strong > 
            <hr>

            
<!--           ตรวจข้อมูลผู้สมัคร-->
 <?php if ($back == '9') { ?> <div class="alert alert-warning" role="alert" style="text-align:center ;margin: 0 auto; width:300px;;" >
                    ไม่พบรหัสผู้สมัคร
                </div>
 <?php  }  ?>


 <!--           ตรวจข้อมูลผู้สมัคร-->

            <div class="row">
                <form style="margin: 0 auto; width:250px;"action="index.php?p=find_applicantByciti" method="post" name="form1" id="form1">
                    <div class="form-group">
                        <label for="exampleInputEmail1">รหัสประจำตัวบัตรประชาชน</label>
                        <input class="form-control" name="txt_citizen" type="text" id="txt_citizen" maxlength="13" >
                        <small class="form-text text-muted" style="color: #ff3333;">  * ผู้ที่มาสมัคร ณ กองบริการการศึกษา ต้องรอเจ้าหน้าที่กรอกข้อมูลเข้าระบบถึงจะได้รับรหัสผู้สมัคร</small>
                    </div>


                    <input type="submit" name="submit" id="bt" value="ตกลง" />


                    <input type="reset" name="submit2" id="bt" value="ยกเลิก" />
                </form>

            </div>
            <hr class="my-4">

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







