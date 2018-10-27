<?php	session_start();?>
<html>
<head>
<title>Add Applicant</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
include("config/connect.php");
include("sysconfig.php");
$applicantcode 	= $_POST["txt_applicantcode"];

$strSQL = "SELECT APPLICANT.APPLICANTID, APPLICANT.APPLICANTMETHOD, APPLICANT.APPLICANTTYPE FROM avsreg.APPLICANT WHERE ((APPLICANT.APPLICANTCODE)='$applicantcode') ";
$result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
$resultnum = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
while(odbc_fetch_row($resultnum))$Num_Rows++; // Count Record
if($Num_Rows > 0)
{
	while($objResult = odbc_fetch_row($result))
	{
		$applicantid= odbc_result($result,"applicantid");
		$applicantmethod= odbc_result($result,"applicantmethod");	
		$applicanttype= odbc_result($result,"applicanttype");	
	}
		$_SESSION["applicantid_sess"] = $applicantid;
		if(($applicantmethod == 'W') or ($applicantmethod == 'A')) {
							if($applicanttype == 'E') { echo "<meta http-equiv=\"refresh\"content=\"0;url=indexphd.php?p=frmApplicant_detailphd\">"; } else {
							echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmApplicant_detail\">"; }
									} else {
										echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmPay&back=99\">";
									}
}
else {
		echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmPay&back=9\">";
	 }
?>

</body>
</html>
