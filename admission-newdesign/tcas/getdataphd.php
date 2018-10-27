<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>


<!--รองรับมือถือ-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<!--css ใหม่-->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>

    <!--font-->
    <link href="https://fonts.googleapis.com/css?family=Pridi" rel="stylesheet">
    
<script language="javascript">
	function selData(intLine,QUOTASTATUSID,QUOTANAME,LEVELABB,QUOTACODE,MINGPAX, LEVELID)
	{
		var sQUOTASTATUSID = self.opener.document.getElementById("txtQUOTASTATUSID_" +intLine);
		sQUOTASTATUSID.value = QUOTASTATUSID;

		var sQUOTANAME = self.opener.document.getElementById("txtQUOTANAME_" +intLine);
		sQUOTANAME.value = QUOTANAME;

		var sLEVELABB = self.opener.document.getElementById("txtLEVELABB_" +intLine);
		sLEVELABB.value = LEVELABB;

		var sQUOTACODE = self.opener.document.getElementById("txtQUOTACODE_" +intLine);
		sQUOTACODE.value = QUOTACODE;	

		var sMINGPAX = self.opener.document.getElementById("txtMINGPAX_" +intLine);
		sMINGPAX.value = MINGPAX;	
		
		var sLEVELID = self.opener.document.getElementById("txtLEVELID_" +intLine);
		sLEVELID.value = LEVELID;	

		window.close();
	}
	
</script>
<body>
<?php
include("config/connect.php");
 include("sysconfigphd.php");
 $line = $_GET["Line"];

if($line == '1') {
$strSQL = "SELECT QUOTA.QUOTAID, QUOTA.QUOTACODE, QUOTA.QUOTANAME, LEVELID.LEVELID, LEVELID.LEVELABB, QUOTASTATUS.QUOTASTATUSID, QUOTA.FACULTYID, FACULTY.FACULTYNAME, QUOTASTATUS.TOTALSEAT, QUOTASTATUS.SELECTIONSEAT, QUOTASTATUS.MINGPAX FROM (avsreg.FACULTY INNER JOIN (avsreg.QUOTA INNER JOIN avsreg.QUOTASTATUS ON QUOTA.QUOTAID = QUOTASTATUS.QUOTAID) ON FACULTY.FACULTYID = QUOTA.FACULTYID) INNER JOIN avsreg.LEVELID ON QUOTA.LEVELID = LEVELID.LEVELID
WHERE (((QUOTASTATUS.ACADYEAR)='$acadyear') AND ((QUOTASTATUS.SEMESTER)='$semester') AND ((QUOTASTATUS.APPLICANTTYPE)='$applicanttype') AND ((QUOTASTATUS.STUDYPERIOD)='$studyperiod') AND ((QUOTASTATUS.ROUND)='$round') AND ((QUOTASTATUS.QUOTASTATUS)=10)) order by QUOTA.FACULTYID, LEVELID.LEVELID, QUOTA.QUOTACODE asc";
				} else {
				
				$strSQL = "SELECT QUOTA.QUOTAID, QUOTA.QUOTACODE, QUOTA.QUOTANAME, LEVELID.LEVELID, LEVELID.LEVELABB, QUOTASTATUS.QUOTASTATUSID, QUOTA.FACULTYID, FACULTY.FACULTYNAME, QUOTASTATUS.TOTALSEAT, QUOTASTATUS.SELECTIONSEAT, QUOTASTATUS.MINGPAX FROM (avsreg.FACULTY INNER JOIN (avsreg.QUOTA INNER JOIN avsreg.QUOTASTATUS ON QUOTA.QUOTAID = QUOTASTATUS.QUOTAID) ON FACULTY.FACULTYID = QUOTA.FACULTYID) INNER JOIN avsreg.LEVELID ON QUOTA.LEVELID = LEVELID.LEVELID
WHERE (((QUOTASTATUS.ACADYEAR)='$acadyear') AND ((QUOTASTATUS.SEMESTER)='$semester') AND ((QUOTASTATUS.APPLICANTTYPE)='$applicanttype') AND ((QUOTASTATUS.STUDYPERIOD)='$studyperiod') AND ((QUOTA.FACULTYID)<>'2') AND ((QUOTASTATUS.ROUND)='$round') AND ((QUOTASTATUS.QUOTASTATUS)=10)) order by QUOTA.FACULTYID asc";
				
				}
$result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
?>
<table width="600" border="1" cellpadding="3" cellspacing="1" class="table" id="menutype">
  <tr>
    <th width="450"> <div align="center">สาขาวิชา </div></th>
    <th width="50"> <div align="center">จำนวนรับ </div></th>
    <th width="50"> <div align="center">จำนวนผู้สมัคร </div></th>
    <th width="350"> <div align="center">คุณสมบัติ </div></th>
  </tr>
<?php
while($objResult = odbc_fetch_array($result))
{
?>
<?php $fac = $objResult["FACULTYID"];?>
	<?php if($tmpfac <> $fac) { ?>
    <tr>
    <td colspan="4"  class="table-primary" style="color: #004085; ">&nbsp;คณะ<?=iconv("TIS-620", "UTF-8",$objResult["FACULTYNAME"]);?></td>
    
  </tr>
  <?php  }  ?>
  <tr>
  <?php  $q = $objResult["QUOTASTATUSID"]; ?>
    <td bgcolor="#FFFFFF"><div align="left"><a href="#" OnClick="selData('<?=$_GET["Line"];?>' ,'<?=$objResult["QUOTASTATUSID"];?>', '<?=iconv("TIS-620", "UTF-8",$objResult["QUOTANAME"]);?>','<?=iconv("TIS-620", "UTF-8",$objResult["LEVELABB"]);?>' ,'<?=$objResult["QUOTACODE"];?>','<?=$objResult["MINGPAX"];?>','<?=$objResult["LEVELID"];?>');">
        <?=$objResult["QUOTACODE"];?>
      :
      <?=iconv("TIS-620", "UTF-8",$objResult["QUOTANAME"]);?>
      <?=iconv("TIS-620", "UTF-8",$objResult["LEVELABB"]);?>
    </a></div></td>
	<?php $sql = "SELECT APPLICANTSELECTION.APPLICANTID FROM avsreg.APPLICANTSELECTION where APPLICANTSELECTION.QUOTASTATUSID = '$q' and APPLICANTSELECTION.SEQUENCE = '1'";
		$objExecnumr = odbc_exec($objConnect, $sql) or die ("Error Execute [".$sql."]");
		$Num_Rows = 0;
		while(odbc_fetch_row($objExecnumr))$Num_Rows++; // Count Record
		 ?>
    <td align="right" bgcolor="#FFFFFF"><?=$objResult["TOTALSEAT"];?></td>
   <td align="right" bgcolor="#FFFFFF"><?php echo $Num_Rows;?></td>
    <?php $gpa = $objResult["MINGPAX"];?>
	<?php $levelid = $objResult["LEVELID"];?>
    <td bgcolor="#FFFFFF"><div align="left">
      <?php if($gpa > 0) { echo "เกรดเฉลี่ยสะสมต้องไม่ต่ำกว่า ".$gpa;}?>
    </div></td>
  </tr>
<?php
$tmpfac = $fac;
}
?>
</table>
<?php
odbc_close($objConnect);
?>
</body>
</html>
