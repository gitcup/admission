<?php $back = $_GET["back"]; ?>
<!DOCTYPE HTML>
<html>

  



    <body>
        <div class="jumbotron">

            <strong class="strong"> ขั้นตอนการรับสมัครบุคคลเข้าศึกษา</strong > 
            <hr>
            <div style="background: #ffffff">
                <img src="img/chart1.png" alt="ขั้นตอนการสมัคร" class="img-responsive"/>
            </div>
            <strong > ขั้นตอนรายละเอียดการสมัคร</strong > 
            <hr>
            <div class="row">
                <div class="col-sm-3" style="width:350px;" >
                    <ul class="list-group">
                        <li class="list-group-item" style="background: #0d2a4a;color: #ffffff;text-align: center;">กรอกข้อมูลผู้สมัคร </li>
                        <li class="list-group-item" >-  ผู้สมัครกรอกข้อมูลที่ถูกต้อง </li>
                        <li class="list-group-item">  -  จด บันทึก รหัสประจำตัวผู้สมัคร</li>
                        <li class="list-group-item">      -  ระบบจะส่ง email ยืนยันการรับสมัครให้อัตโนมัติเมื่อสมัครเรียบร้อยแล้ว อาจอยู่ใน Junk mail</li>
                        <li class="list-group-item">       -  สามารถแก้ไขข้อมูลผู้สมัครได้จากเมนู "แก้ไขข้อมูลผู้สมัคร"</li>
                    </ul>
                </div>
                <div class="col-sm-3" style="width:350px;" >
                    <ul class="list-group">
                        <li class="list-group-item" style="background: #0d2a4a;color: #ffffff;text-align: center;">พิมพ์แบบฟอร์มชำระเงิน </li>
                        <li class="list-group-item" >- ผู้สมัครเลือก 1 สาขา ค่าสมัคร 200 บาท </li>
                        <li class="list-group-item">- ผู้สมัครเลือกตั้งแต่ 2 สาขาวิชาขึ้นไปค่าสมัคร 300 บาท </li>
                        <li class="list-group-item">  - ปริญญาตรี ภาคพิเศษ ค่าสมัคร 300 บาท</li>

                    </ul>
                </div>
                <div class="col-sm-3" style="width:350px;" >
                    <ul class="list-group">
                        <li class="list-group-item" style="background: #0d2a4a;color: #ffffff;text-align: center;">ชำระเงินที่ธนาคาร</li>
                        <li class="list-group-item" >-  พิมพ์แบบฟอร์มการชำระเงิน และชำระเงินได้ตามธนาคารที่ระบุในแบบฟอร์มชำระเงิน</li>
                        <li class="list-group-item">- ผู้สมัครเลือกตั้งแต่ 2 สาขาวิชาขึ้นไปค่าสมัคร 300 บาท </li>
                        <li class="list-group-item">  - ปริญญาตรี ภาคพิเศษ ค่าสมัคร 300 บาท</li>

                    </ul>
                </div>

                <div class="col-sm-3" style="width:350px;" >
                    <ul class="list-group">
                        <li class="list-group-item" style="background: #0d2a4a;color: #ffffff;text-align: center;">พิมเอกสารหลักฐานการสมัคร</li>
                        <li class="list-group-item" >	-  ตรวจสอบสถานะผู้สมัคร ได้จากเมนู "ตรวจสอบข้อมูลผู้สมัคร"</li>
                        <li class="list-group-item">-  ตรวจสอบสถานะผู้สมัคร ได้จากเมนู "ตรวจสอบข้อมูลผู้สมัคร" </li>
                        <li class="list-group-item">  -  เอกสารหลักฐานการรับสมัครนำมาแสดงในวันสอบข้อเขียน และสัมภาษณ์</li>

                    </ul>
                </div>
            </div>
            <hr class="my-4">
<!--            <p>กรอกใบสมัครสอบออนไลน์</p>-->
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="index.php?p=frmselevel" role="button">กรอกใบสมัครสอบออนไลน์</a>
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
    
</html>