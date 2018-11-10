<?php
@ob_start();
$p = $_GET["p"];
?>

<!DOCTYPE HTML>
<html>

    <?php
    include './header.php';
    ?>
    <?php
    include './navbar.php';
    ?>

    <script src="js/validate/jquery.js" type="text/javascript"></script>
    <script src="js/validate/jquery.validate.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#register").validate();
        });
    </script>

    <script language="JavaScript">
        function check()
        {
            var v1 = document.register.citizen.value;
            var v2 = document.register.gpa.value;
            var v3 = document.getElementById("entrydegree").value;
            //var level1 = document.getElementById("txtLEVELID_1").value; 
            //var level2 = document.getElementById("txtLEVELID_2").value; 
            var qcode1 = document.getElementById("txtQUOTACODE_1").value;
            var cont1 = document.register.txtMINGPAX_1.value;
            var cont2 = document.register.txtMINGPAX_2.value;



            var x = document.forms["register"]["email"].value;
            var atpos = x.indexOf("@");
            var dotpos = x.lastIndexOf(".");


            if (v1.length < 13)
            {
                alert("กรุณาใส่หมายเลขบัตรประจำตัวประชาชนให้ถูกต้อง");
                document.register.citizen.focus();
                return false;
            }
            if (x.length > 0)
            {
                if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
                    alert("รูปแบบ e-mail ไม่ถูกต้อง");
                    document.register.email.focus();
                    return false;
                }
            }

            if ((qcode1 == '207' || qcode1 == '208' || qcode1 == '462-1' || qcode1 == '485-1' || qcode1 == '445-1' || qcode1 == '484-1' || qcode1 == '405-1') && (v3 != 600))
            {
                alert("วุฒิการศึกษานี้ไม่สามารถเลือกสาขาลำดับที่ 1 ได้");
                return false;
            } else if ((v2 < cont1) || (v2 > 4))
            {
                alert("คุณไม่มีสิทธิ์เลือกสาขาวิชาที่ 1 เนื่องจากคุณสมบัติของสาขาวิชานี้ต้องมีเกรดเฉลี่ยมากกว่า " + cont1);
                document.register.gpa.focus();
                return false;
            } else if ((v2 < cont2) || (v2 > 4))
            {
                alert("คุณไม่มีสิทธิ์เลือกสาขาวิชาที่ 2 เนื่องจากคุณสมบัติของสาขาวิชานี้ต้องมีเกรดเฉลี่ยมากกว่า " + cont2);
                document.register.gpa.focus();
                return false;
            }
        }
    </script>

    <body>
        <div align="center">
            <img src="img/header_1.png"  alt="Responsive image"  class="img-responsive"  width="1100">
        </div>    
        <div class="container">



            <?php
            if (!empty($p)) {
                $filename = $p . ".php";
                include("$filename");
            } else {
                //echo "ขั้นตอนการรับสมัคร";
                //$filename = "frmindex.php";
                $filename = "frmindex.php";
                include("$filename");
            }
            ?>

       
            <div class="jumbotron"  >
                <div class="row">
                    <div class="col">
                        <strong> Facebook Page </strong>
                        
                            <hr>
<div class="fb-page" 
  data-href="https://www.facebook.com/RBRU-Admission-118337822191006/"
  data-width="380" 
  data-hide-cover="false"
  data-show-facepile="false"></div>

           <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v3.2&appId=234794663763056&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
                            </div>
 <div class="col">
      <strong> Line </strong>
                        
                            <hr>
                            <a href="https://line.me/R/ti/p/%40vhi9963c">
                            <img src="img/en.png"  height="250" width="150" alt="en"  style=" display: block; 
    margin: 0 auto;" class="img-responsive" />
                            </a>
                            <br>
     <img src="img/ดาวน์โหลด.png" alt="" class="img-responsive" height="250" width="150"/>
     
 
             
            
</div>
 </div>

       </div>
            </div>

    </body>
    
  
    <footer class="modal-footer" style="background-color: #1967be ;color: white;">
        <div class="container" >
            <p style="text-align: center;">กองบริการการศึกษา มหาวิทยาลัยราชภัฏรำไพพรรณี<br>
                41 ม.5 ต.ท่าช้าง อ.เมือง จ.จันทบุรี 22000<br>
                โทร. 0-3931-9111 ต่อ 8401-2 หรือ 039-471070</p>
        </div>
    </footer>
</html>