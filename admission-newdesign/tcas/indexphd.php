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

   <script type="text/javascript" src="js/validate/jquery.js"></script>
<script type="text/javascript" src="js/validate/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#register").validate();
});
</script>

<script language="JavaScript">
function check()
{
      var v1 = document.register.citizen.value; 
	  var m1 = document.register.mobile.value; 
	  var n1 = document.register.name.value; 
	  var n2 = document.register.surname.value; 
	/*  var v2 = document.register.gpa.value;
	  var v3 = document.getElementById("entrydegree").value;	 
	  var level1 = document.getElementById("txtLEVELID_1").value; 
	  var level2 = document.getElementById("txtLEVELID_2").value; 
	   var cont1 = document.register.txtMINGPAX_1.value;
	   var cont2 = document.register.txtMINGPAX_2.value;*/
	
	 
	  
	var x = document.forms["register"]["email"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
	   
	  
	  if ( v1.length<13) 
           {
           alert("กรุณาใส่หมายเลขบัตรประจำตัวประชาชนให้ถูกต้อง");
           document.register.citizen.focus();           
           return false;
           } 
	  if(x.length > 0)		   
		   {
		   if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("รูปแบบ e-mail ไม่ถูกต้อง");
		 document.register.email.focus();   
        return false;
		} }
		if ( n1.length<1) 
           {
           alert("กรุณาใส่ชื่อผู้สมัคร");
           document.register.name.focus();           
           return false;
           } 
		if ( n2.length<1) 
           {
           alert("กรุณาใส่นามสกุลผู้สมัคร");
           document.register.surname.focus();           
           return false;
           } 
		   
	  if ( m1.length<1) 
           {
           alert("กรุณาใส่หมายเลขโทรศัพท์ที่ติดต่อได้");
           document.register.mobile.focus();           
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



        </div>

    </body>
    <footer class="footer" style="background-color: #1967be ;color: white;;">
        <div class="container" >
            <p style="text-align: center;">กองบริการการศึกษา มหาวิทยาลัยราชภัฏรำไพพรรณี<br>
                41 ม.5 ต.ท่าช้าง อ.เมือง จ.จันทบุรี 22000<br>
                โทร. 0-3931-9111 ต่อ 8401-2 หรือ 039-471070</p>
        </div>
    </footer>
</html>