<?
    $p=$_GET[p];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบรับสมัครนักศึกษา Online</title>


<link href="regisOnline.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wapper-main">
    <div id="wapper-header">
      <p><img src="../images/header.jpg" /></p>
      <p align="right"><a href="index.php?p=frmApplicant_OpenSystem">เปิดรอบการรับสมัคร</a> | <a href="index.php?p=frmApplicant_paytrue">พิมพ์เอกสารภาคปกติ</a> | <a href="index.php?p=frmApplicant_paytrueexce">พิมพ์เอกสารภาคพิเศษ</a> | <a href="index.php?p=frmApplicant_paytruephd">พิมม์เอกสารระดับบัณฑิตศึกษา</a> | <a href="index.php?p=logout_staff">ออกจากระบบ</a> </p>
    </div>
   
   
    <div id="wapper-body">
       <?
            if(!empty($p))
			{ 
			    $filename = $p.".php";
				include("$filename");
			}else{
			           echo "<meta http-equiv='refresh' content='0;URL=index.php?p=login' />";
			       }
		?>
   </div>
   <div class="clr"></div>
   <div id="wapper-buttom" class="center">
      กองบริการการศึกษา มหาวิทยาลัยราชภัฏรำไพพรรณี<br/>
      41 ม.5 ต.ท่าช้าง อ.เมือง จ.จันทบุรี 22000<br/>
      โทร. 0-3931-9111 ต่อ 8401-5
   </div>
</div>
</body>
</html>
