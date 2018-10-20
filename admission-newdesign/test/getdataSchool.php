<?php
//ตั้งค่าตัวแปร
	if(isset($_POST['searchdata']))
	{
		$searchdata = $_POST['searchdata'];
	}
	else if(isset($_GET['$searchdata']))
	{
		$searchdata = $_GET['$searchdata'];
	}
	$searchdata = iconv("UTF-8", "TIS-620",$searchdata);
?>
<html>
<head>
<title>พิมพ์คำค้น</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
body {
	margin-top: 50px;
}
-->
</style>
<link href="css/regisOnline.css" rel="stylesheet" type="text/css">
</head>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<script language="javascript">
	function selData(intLine,SCHOOLID,SCHOOLNAME)
	{
		var sSCHOOLID = self.opener.document.getElementById("txtSCHOOLID_" +intLine);
		sSCHOOLID.value = SCHOOLID;

		var sSCHOOLNAME = self.opener.document.getElementById("txtSCHOOLNAME_" +intLine);
		sSCHOOLNAME.value = SCHOOLNAME;

		window.close();
	}
	
</script>
<body>
<?php
include("config/connect.php");

$strSQL = "SELECT SCHOOL.SCHOOLID, SCHOOL.SCHOOLNAME FROM avsreg.SCHOOL WHERE (((SCHOOL.SCHOOLNAME) Like '%$searchdata%')) ORDER BY SCHOOL.SCHOOLNAME ";
$result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
?>
<div id="form-regis">
<form action="getDataSchool.php?Line=1" method="post" name="frmsearch" id="frmsearch">
 <br> <p align="center"><label class="label2">ระบุคำที่ต้องการกรองข้อมูล :
    <input name="searchdata" type="text" id="searchdata">
     &nbsp;
     <INPUT value="  ค้นหา  " type=submit name=submit >
</label> 
   <br>
   <br>
 เช่น คำว่า &quot;ขลุง&quot; จะแสดงรายชื่อโรงเรียนที่มีคำว่า ขลุง ปรากฏขึ้น </p>
  <table width="462" border="1" align="center" cellpadding="3" cellspacing="1" class="DataTable" id="menutype">
    
    <tr>
      <th width="450"> <div align="center">ชื่อโรงเรียน / สถาบันเดิมที่จบ</div></th>
    </tr>
    <?php
while($objResult = odbc_fetch_array($result))
{
?>
    <tr>
      <td bgcolor="#FFFFFF"><div align="left"><a href="#" OnClick="selData('<?=$_GET["Line"];?>' ,'<?=$objResult["SCHOOLID"];?>', '<?=iconv("TIS-620", "UTF-8",$objResult["SCHOOLNAME"]);?>');">
          <?=iconv("TIS-620", "UTF-8",$objResult["SCHOOLNAME"]);?>
      </a></div></td>
    </tr>
    <?php
}
?>
  </table>
</form>
</div>
<?php
odbc_close($objConnect);
?>
</body>
</html>
