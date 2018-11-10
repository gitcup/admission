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
$citi 	= $_POST["citi"];

$strSQL = "SELECT APPLICANT.APPLICANTID, APPLICANT.APPLICANTTYPE, APPLICANT.FINANCESTATUS, APPLICANT.APPLICANTMETHOD, APPLICANT.APPLICANTSTATUS FROM avsreg.APPLICANT WHERE ((APPLICANT.APPLICANTCODE ='$applicantcode') and (APPLICANT.CITIZENID = '$citi') and (APPLICANT.ACADYEAR >= '2561')) and ((APPLICANT.APPLICANTTYPE = 'Q') or (APPLICANT.APPLICANTTYPE = 'E')) ";
$result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
$resultnum = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
while(odbc_fetch_row($resultnum))$Num_Rows++; // Count Record
if($Num_Rows > 0)
{
	while($objResult = odbc_fetch_row($result))
	{
		$applicantid= odbc_result($result,"applicantid");	
		$applicanttype= odbc_result($result,"applicanttype");
		$financestatus= odbc_result($result,"financestatus");
		$applicantstatus= odbc_result($result,"applicantstatus");
		$applicantmethod= odbc_result($result,"applicantmethod");
	}
		$_SESSION["applicantid_sess"] = $applicantid;
		
		if($financestatus == 'N')
			{
				echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmEditApplicant&back=true\">";
			} else if ($applicantmethod <> 'W') 
					{
				echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmEditApplicant&back=trueh\">";	
					} 
					else if ($applicantstatus <> '10') 
					{
				echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmEditApplicant&back=truet\">";	
					} 
					
					else 
					{
		//หน้าที่จะไปแก้ไข	
				$strSQLP = "SELECT QUOTASTATUS.STUDYPERIOD,QUOTASTATUS.applicanttype,QUOTASTATUS.round FROM AVSREG.APPLICANTSELECTION INNER JOIN AVSREG.QUOTASTATUS ON APPLICANTSELECTION.QUOTASTATUSID = QUOTASTATUS.QUOTASTATUSID WHERE (((APPLICANTSELECTION.APPLICANTID)='$applicantid') AND ((APPLICANTSELECTION.SEQUENCE)='1'))";
$resultp = odbc_exec($objConnect, $strSQLP) or die ("Error Execute [".$strSQLP."]");
while($objResultp = odbc_fetch_row($resultp))
	{
		$period= odbc_result($resultp,"studyperiod");	
		$applicanttype= odbc_result($resultp,"applicanttype");	
		$rr= odbc_result($resultp,"round");
	}
			if($period == '1') {	
				if(($applicanttype == 'T') and ($rr == '3')) {
				//if(($applicanttype == 'A')) {
				echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmRegister1ForEdit\">";
				//echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmEditApplicant&back=truend\">";	
				}
				if($applicanttype == 'E') {// )โท เอก ภาคปกติ 
			
				echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmRegisterMasForEdit\">";
				}
				if($applicanttype == 'B') {
			
				echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmRegister1quotaForEdit\">";
				}
				if($applicanttype == 'Q') {
			
				echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmRegister1qnewForEdit\">";
				}
				//echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmRegister1\">";
								} else { 
										
										if($applicanttype == 'E') {
			
																echo "<meta http-equiv=\"refresh\"content=\"0;url=indexphd.php?p=frmRegisterphdForEdit\">";
																   }
										else {						   
										echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmRegister1ForEditexce\">";
											 }
								 }
						
					}
}
else {
		echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmEditApplicant&back=9\">";
	 }
?>

</body>
</html>
