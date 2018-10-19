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
        <div class="jumbotron">



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



        </div>

    </body>
    \
</html>