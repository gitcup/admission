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
<!--รองรับมือถือ-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
        <!--css ใหม่-->
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>

        <!--font-->
        <link href="https://fonts.googleapis.com/css?family=Pridi" rel="stylesheet">
        

</head>

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

$strSQL = "SELECT SCHOOL.SCHOOLID, SCHOOL.SCHOOLNAME FROM avsreg.SCHOOL WHERE (((SCHOOL.SCHOOLNAME) Like '%$searchdata%')) and (SCHOOL.SCHOOLTYPE = 'A') ORDER BY SCHOOL.SCHOOLNAME ";
$result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
?>
<div id="form-regis">
<form action="getDataSchoolphd.php?Line=1" method="post" name="frmsearch" id="frmsearch">
 
      <div style="text-align:center">
                <p align="center"><label class="label2">ระบุคำที่ต้องการกรองข้อมูล :
                        <input name="searchdata" type="text" id="searchdata" class="form-control"  >
                     
                         <br>
                        <input value="  ค้นหา  " type=submit name=submit class="btn btn-primary" >
                    </label> 
                   
                   
                    <br>
                    เช่น คำว่า &quot;ขลุง&quot; จะแสดงรายชื่อมหาลัยที่มีคำว่า ขลุง ปรากฏขึ้น </p>
                 </div>
 <table style="width:70%; margin-left:15%; margin-right:15%; " class="table" id="menutype">
    
    <tr>
      <th width="450" class="table-primary" style="color: #004085; text-align: center;"> ชื่อโรงเรียน / สถาบันเดิมที่จบ</th>
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
