<?	session_start();
include "check_session.php";
include("../config/connect.php"); ?>
<? include("../sysconfig.php");  
	
?>

<? //ตั้งค่าตัวแปรปี

	  $applicantid = $_POST[applicantid];	
	  $check = $_POST[check];	
	  $npage = $_GET[npage];	

	  
	if(isset($_POST['lstacadyear']))
	{
		$re_acadyear = $_POST['lstacadyear'];
	} else {
	 $re_acadyear = $_GET['lstacadyear'];
	} 
		//ตั้งค่าตัวแปร เทอม
	if(isset($_POST['lstsemester']))
	{
		$re_semester = $_POST['lstsemester'];
	} else {
		$re_semester = $_GET['lstsemester'];
		}
		//ตั้งค่าตัวแปร ประเภท นศ.
	if(isset($_POST['lsttype']))
	{
		$re_type = $_POST['lsttype'];
	} else {
			$re_type = $_GET['lsttype'];
	}
	//ตั้งค่าตัวแปร รอบ
	if(isset($_POST['txt_round']))
	{
		$re_round = $_POST['txt_round'];
	} else {
			$re_round = $_GET['txt_round'];
	}
	
	//ตั้งค่าตัวแปร กรองรหัส
	if(isset($_POST['txt_code']))
	{
		$re_code = $_POST['txt_code'];
	} else {
			$re_code = $_GET['txt_code'];
	}
	?>	

<link rel="stylesheet" href="../tinybox2/style.css" />
<script type="text/javascript" src="../tinybox2/tinybox.js"></script>
<style type="text/css">
<!--
.style7 {font-family: Verdana; font-size: 12px; }
-->
</style>
<h2>พิมพ์เอกสารหลักฐานการสมัคร<? echo"$txt"; ?></h2>
<form id="form1" name="form1" method="post" action="index.php?p=frmApplicant_paytruemai">
  ปีการศึกษา 
  <select name="lstacadyear" id="lstacadyear">
    <?
                        $strSQL = "SELECT * FROM AVSREG.Z_ACADYEAR where id > 2557 ORDER BY id";
                        $result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
                  		while(odbc_fetch_row($result))
							{
								$acadyearid= odbc_result($result,"acadyear");	
							//	$facultyname= odbc_result($result,"facultyname");	
                                $selected = "";
                                if($lstacadyear == $acadyearid)
                                {
                                    $selected = "selected=\"selected\"";
                                }
                                echo "<option value=\"$acadyearid\" $selected>$acadyearid</option>";
                            }
                      ?>
  </select>
&nbsp;เทอม
<select name="lstsemester" id="lstsemester">
  <?
                        $strSQL = "SELECT * FROM AVSREG.Z_SEMESTER ORDER BY id";
                        $result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
                  		while(odbc_fetch_row($result))
							{
								$semesterid= odbc_result($result,"semester");	
							//	$facultyname= odbc_result($result,"facultyname");	
                                $selected = "";
                                if($lstsemester == $semesterid)
                                {
                                    $selected = "selected=\"selected\"";
                                }
                                echo "<option value=\"$semesterid\" $selected>$semesterid</option>";
                            }
                      ?>
</select>
 ประเภทการรับสมัคร 
 <select name="lsttype" id="lsttype">
   <?
                        $strSQL = "SELECT SYSBYTEDES.BYTECODE, SYSBYTEDES.BYTEDES FROM AVSREG.SYSBYTEDES WHERE (((SYSBYTEDES.TABLENAME)='APPLICANT') AND ((SYSBYTEDES.COLUMNNAME)='APPLICANTTYPE')) ORDER BY SYSBYTEDES.BYTECODE";
                        $result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
                  		while(odbc_fetch_row($result))
							{
								$bytecode= odbc_result($result,"bytecode");	
								$typename= odbc_result($result,"bytedes");	
								$typename_cv = iconv( "TIS-620","UTF-8","$typename");
                                $selected = "";
                                if($lsttype == $bytecode)
                                {
                                    $selected = "selected=\"selected\"";
                                }
                                echo "<option value=\"$bytecode\" $selected>$bytecode : $typename_cv</option>";
                            }
                      ?>
  </select> 
 รอบ 
 <input name="txt_round" type="text" id="txt_round" value="<? echo $re_round; ?>" size="3" maxlength="1" />
 กรองรหัส
 <input name="txt_code" type="text" id="txt_code" value="<? echo $re_code; ?>" size="10" maxlength="10" /> 
 <input type="submit" name="Submit" value=" ค้นหา " id = "bt"/>
<br />
</form>

<table width="950" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#0066CC">
	
	<table width="100%" border="0" cellspacing="1" cellpadding="5">
      <tr>
        <td width="3%" bgcolor="#0099CC"><div align="center">ที่</div></td>
        <td width="6%" bgcolor="#0099CC"><div align="center">รหัสผู้สมัคร</div></td>
        <td width="14%" bgcolor="#0099CC"><div align="center">ชื่อ - สกุล </div></td>
        <td width="20%" bgcolor="#0099CC"><div align="center">สาขาที่เลือก</div></td>
        <td width="5%" bgcolor="#0099CC"><div align="center">GPA</div></td>
        <td width="11%" bgcolor="#0099CC"><div align="center">วันที่สมัคร</div></td>
        <td width="9%" bgcolor="#0099CC"><div align="center">Tel.</div></td>
        <td width="7%" bgcolor="#0099CC"><div align="center">พิมพ์<br />
        ใบชำระเงิน</div></td>
        <td width="7%" bgcolor="#0099CC"><div align="center">พิมพ์<br />
        หลักฐาน</div></td>
      </tr>
	  <?   
	  $pagelen = 20; 
	$range = 7 ; 

	if(empty($npage)){ $npage=1; }  
	
	$strSEL = "SELECT APPLICANT.APPLICANTID,APPLICANT.APPLICANTCODE, PREFIX.PREFIXNAME, APPLICANT.APPLICANTNAME, APPLICANT.APPLICANTSURNAME, APPLICANT.GPAX, APPLICANT.CREATEDATETIME, APPLICANT.APPLICANTMETHOD, APPLICANT.EDITSEQ, APPLICANTDOC.DOCX,APPLICANTDOC.DOCY ,APPLICANTDOC.PROBLEM FROM (((AVSREG.APPLICANT INNER JOIN AVSREG.PREFIX ON APPLICANT.PREFIXID = PREFIX.PREFIXID) INNER JOIN AVSREG.APPLICANTDOC ON APPLICANT.APPLICANTID = APPLICANTDOC.APPLICANTID) INNER JOIN AVSREG.APPLICANTSELECTION ON APPLICANTSELECTION.APPLICANTID = APPLICANT.APPLICANTID) INNER JOIN AVSREG.QUOTASTATUS ON QUOTASTATUS.QUOTASTATUSID = APPLICANTSELECTION.QUOTASTATUSID ";
	 $first_where = 0;
		 if($re_acadyear != "") 
		{	
			if($first_where == 0)
			{
				$strSEL .= " WHERE ";
				$first_where = 1;
			}
			else
			{
				$strSEL.= " AND ";
			}
			
			$strSEL .= "APPLICANT.ACADYEAR = '$re_acadyear' \n";
		}		
		// &#3611;&#3637;
		if(($re_semester <> 0) && ($re_semester != ""))
		{	
			if($first_where == 0)
			{
				$strSEL.= " WHERE ";
				$first_where = 1;
			}
			else
			{
				$strSEL .= " AND ";
			}
			
			$strSEL .= "APPLICANT.SEMESTER = '$re_semester' \n";
		}		
		// &#3611;&#3619;&#3632;&#3648;&#3616;&#3607; &#3609;&#3624;.
		if(($re_type <> 0) && ($re_type != ""))
		{	
			if($first_where == 0)
			{
				$strSEL.= " WHERE ";
				$first_where = 1;
			}
			else
			{
				$strSEL .= " AND ";
			}
			
			$strSEL .= "APPLICANT.APPLICANTTYPE = '$re_type' \n";
		}		
		// &#3627;&#3621;&#3633;&#3585;&#3626;&#3641;&#3605;&#3619;
		if(($re_round <> 0) && ($re_round != ""))
		{	
			if($first_where == 0)
			{
				$strSEL.= " WHERE ";
				$first_where = 1;
			}
			else
			{
				$strSEL .= " AND ";
			}
			
			$strSEL .= "APPLICANT.ROUND = '$re_round' \n";
		}		
		
		// &#3594;&#3639;&#3656;&#3629;&#3629;&#3634;&#3592;&#3634;&#3619;
		if($re_code != "")
		{	
			if($first_where == 0)
			{
				$strSEL .= " WHERE ";
				$first_where = 1;
			}
			else
			{
				$strSEL.= " AND ";
			}
			
			$strSEL .= "APPLICANT.APPLICANTCODE LIKE '%$re_code%' \n";
		}	
	$strSEL .= " AND (((APPLICANT.APPLICANTMETHOD)='W') AND ((APPLICANT.APPLICANTSTATUS)>='10')  AND ((APPLICANTSELECTION.SEQUENCE)='1') AND ((QUOTASTATUS.STUDYPERIOD)='$studyperiod')) ORDER BY APPLICANT.CREATEDATETIME ASC";		
	//$resultSEL = odbc_exec($objConnect, $strSEL) or die ("Error Execute [".$strSEL."]");
	$resultSEL2num = odbc_exec($objConnect, $strSEL) or die ("Error Execute [".$strSEL."]");
	$Num_Rows = 0;
	$a = 1;
	while(odbc_fetch_row($resultSEL2num))$Num_Rows++; // Count Record	
	
	$totalrecords= $Num_Rows; 
  	$totalpage = ceil($Num_Rows / $pagelen);
	$goto = ($npage) * $pagelen; 
	$pagelen2 = $goto - $pagelen;
	$start = $npage - $range;
	$end = $npage + $range;
	if ($start <= 1) { $start = 1;}
	if ($end >= $totalpage) { $end = $totalpage; }  
	
	
	$strSEL1 = "SELECT * from(select rownum rnum, bc1.* from(SELECT APPLICANT.APPLICANTID,APPLICANT.APPLICANTCODE, PREFIX.PREFIXNAME, APPLICANT.APPLICANTNAME, APPLICANT.APPLICANTSURNAME, APPLICANT.GPAX, APPLICANT.CREATEDATETIME, APPLICANT.HOMEPHONENO, APPLICANT.APPLICANTMETHOD, APPLICANT.EDITSEQ, APPLICANTDOC.DOCX,APPLICANTDOC.DOCY ,APPLICANTDOC.PROBLEM, APPLICANTDOC.CHKDATE FROM (((AVSREG.APPLICANT INNER JOIN AVSREG.PREFIX ON APPLICANT.PREFIXID = PREFIX.PREFIXID) INNER JOIN AVSREG.APPLICANTDOC ON APPLICANT.APPLICANTID = APPLICANTDOC.APPLICANTID) INNER JOIN AVSREG.APPLICANTSELECTION ON APPLICANTSELECTION.APPLICANTID = APPLICANT.APPLICANTID) INNER JOIN AVSREG.QUOTASTATUS ON QUOTASTATUS.QUOTASTATUSID = APPLICANTSELECTION.QUOTASTATUSID";
	 $first_where = 0;
		 if($re_acadyear != "") 
		{	
			if($first_where == 0)
			{
				$strSEL1 .= " WHERE ";
				$first_where = 1;
			}
			else
			{
				$strSEL1.= " AND ";
			}
			
			$strSEL1 .= "APPLICANT.ACADYEAR = '$re_acadyear' \n";
		}		
		// &#3611;&#3637;
		if(($re_semester <> 0) && ($re_semester != ""))
		{	
			if($first_where == 0)
			{
				$strSEL1.= " WHERE ";
				$first_where = 1;
			}
			else
			{
				$strSEL1 .= " AND ";
			}
			
			$strSEL1 .= "APPLICANT.SEMESTER = '$re_semester' \n";
		}		
		// &#3611;&#3619;&#3632;&#3648;&#3616;&#3607; &#3609;&#3624;.
		if(($re_type <> 0) && ($re_type != ""))
		{	
			if($first_where == 0)
			{
				$strSEL1.= " WHERE ";
				$first_where = 1;
			}
			else
			{
				$strSEL1 .= " AND ";
			}
			
			$strSEL1 .= "APPLICANT.APPLICANTTYPE = '$re_type' \n";
		}		
		// &#3627;&#3621;&#3633;&#3585;&#3626;&#3641;&#3605;&#3619;
		if(($re_round <> 0) && ($re_round != ""))
		{	
			if($first_where == 0)
			{
				$strSEL1.= " WHERE ";
				$first_where = 1;
			}
			else
			{
				$strSEL1 .= " AND ";
			}
			
			$strSEL1 .= "APPLICANT.ROUND = '$re_round' \n";
		}		
		
		// &#3594;&#3639;&#3656;&#3629;&#3629;&#3634;&#3592;&#3634;&#3619;
		if($re_code != "")
		{	
			if($first_where == 0)
			{
				$strSEL1 .= " WHERE ";
				$first_where = 1;
			}
			else
			{
				$strSEL1.= " AND ";
			}
			
			$strSEL1 .= "APPLICANT.APPLICANTCODE LIKE '%$re_code%' \n";
		}	
		
	$strSEL1 .= " AND(((APPLICANT.APPLICANTMETHOD)='W') AND ((APPLICANT.APPLICANTSTATUS)>='10') AND ((APPLICANTSELECTION.SEQUENCE)='1') AND ((QUOTASTATUS.STUDYPERIOD)='$studyperiod')) ORDER BY APPLICANT.CREATEDATETIME ASC) bc1  where rownum <= $goto ) where rnum > $pagelen2";
	$resultSEL1 = odbc_exec($objConnect, $strSEL1) or die ("Error Execute [".$strSEL1."]");
	$resultSEL2num1 = odbc_exec($objConnect, $strSEL1) or die ("Error Execute [".$strSEL1."]");
	$Num_Rows1 = 0;
	while(odbc_fetch_row($resultSEL2num1))$Num_Rows1++; // Count Record
	if($Num_Rows1 > 0) 
	
	{
	$i =1;
	$c = 1;
	while(odbc_fetch_row($resultSEL1))
	
	{
		
		$applicantid = odbc_result($resultSEL1,"applicantid");	
		$applicantcode = odbc_result($resultSEL1,"applicantcode");	
		$applicantname = odbc_result($resultSEL1,"applicantname");	
		$prefixname = odbc_result($resultSEL1,"prefixname");
		$gpax = odbc_result($resultSEL1,"gpax");
		$docx = odbc_result($resultSEL1,"docx");
		$docy = odbc_result($resultSEL1,"docy");
		$chkdate = odbc_result($resultSEL1,"chkdate");
		$datetime = odbc_result($resultSEL1,"createdatetime");
		$tel = odbc_result($resultSEL1,"homephoneno");
		$editseq = odbc_result($resultSEL1,"editseq");
		$applicantmethod = odbc_result($resultSEL1,"applicantmethod");
		$prefixname_cv = iconv( "TIS-620","UTF-8","$prefixname");
		$applicantsurname = odbc_result($resultSEL1,"applicantsurname");	
		$applicantname_cv = iconv( "TIS-620","UTF-8","$applicantname");
		$applicantsurname_cv = iconv( "TIS-620","UTF-8","$applicantsurname");
		
		 if($npage > 1)
			 {
			     $c = (($npage-1)*$pagelen)+$i;
			 }
	
  ?>
      <tr>
        <td bgcolor="#FFFFFF"><span class="style7">&nbsp;<? echo $c; ?></span></td>
        <td bgcolor="#FFFFFF"><span class="style7">&nbsp;<? echo $applicantcode; ?></span></td>
        <td bgcolor="#FFFFFF"><span class="style7">&nbsp;<? echo $prefixname_cv.$applicantname_cv."  ".$applicantsurname_cv; ?></span></td>
        <td bgcolor="#FFFFFF"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
	   <?    
	$strSEL2 = "SELECT APPLICANTSELECTION.APPLICANTID, APPLICANTSELECTION.SEQUENCE, QUOTA.QUOTANAME FROM (AVSREG.APPLICANTSELECTION INNER JOIN AVSREG.QUOTASTATUS ON APPLICANTSELECTION.QUOTASTATUSID = QUOTASTATUS.QUOTASTATUSID) INNER JOIN AVSREG.QUOTA ON QUOTASTATUS.QUOTAID = QUOTA.QUOTAID WHERE (((APPLICANTSELECTION.APPLICANTID)='$applicantid')) ORDER BY APPLICANTSELECTION.SEQUENCE";
	$resultSEL2 = odbc_exec($objConnect, $strSEL2) or die ("Error Execute [".$strSEL2."]");
		
	while($objSEL2 = odbc_fetch_row($resultSEL2))
	{
		
		$quotaname = odbc_result($resultSEL2,"quotaname");	
		$seq = odbc_result($resultSEL2,"sequence");	
		$quotaname_cv = iconv( "TIS-620","UTF-8","$quotaname");
	
  ?>
        <tr>
          <td class="style7">ที่ <? echo $seq; ?> : &nbsp;<? echo $quotaname_cv; ?></td>
          </tr>
	<?   }  ?>
      </table>		</td>
        <td bgcolor="#FFFFFF"><span class="style7">&nbsp;<? echo $gpax; ?></span></td>
        <td bgcolor="#FFFFFF"><span class="style7">&nbsp;<? echo datethai($datetime); ?><br><br>
        </span></td>
        <td bgcolor="#FFFFFF"><div align="center"><span class="style7"><? echo $tel; ?></span></div></td>
        <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <form action="index.php?p=frmApplicant_check" method="post" name="form2" class="style7" id="form2">
              <td><div align="center"><a href="pay_entry.php?appid=<? echo $applicantid; ?>" target="_blank">พิมพ์</a></div></td>
            </form>
          </tr>
        </table></td>
        <td bgcolor="#FFFFFF">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr><form action="index.php?p=frmApplicant_check" method="post" name="form2" class="style7" id="form2">
              <td><div align="center"><a href="frmprint2.php?appid=<? echo $applicantid; ?>" target="_blank">พิมพ์</a></div></td>
            </form>
              </tr>
          </table>        </td>
      </tr>
	  <? 
	   $a++ ; 
	    $c++ ; 
	  $i++; }  }   ?>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>

<p> <?
			   /* ------------------------------------------- แบ่งหน้า -------------------------------------------- */
 echo "<strong>ทั้งหมด : </strong>  $totalrecords  คน/ จำนวน $totalpage หน้า <br/>"; 
	if ($npage > 1) 
	{
		$back = $npage - 1;
		echo ""." <a href=\"$pathPresent?p=frmApplicant_paytruemai&npage=1&lstacadyear=$re_acadyear&lstsemester=$re_semester&lsttype=$re_type&txt_round=$re_round&txt_code=$re_code\" >แรกสุด</a> ";
		echo " <a href=\"$pathPresent?p=frmApplicant_paytruemai&npage=$back&lstacadyear=$re_acadyear&lstsemester=$re_semester&lsttype=$re_type&txt_round=$re_round&txt_code=$re_code\" >ก่อนหน้า</a> ";
		if ($start > 1) { echo "..."; }
	}

	For ($i=$start ; $i<=$end ; $i++) 
	{
		if ($i == $npage ) 
		{
			//echo "<a href=\"$pathPresent?npage=$i&mac=$mac&ckdate1=$ckdate\"><strong> $i </strong></a>&nbsp;";
			echo " <strong> $i </strong> ";
		}else{
				 echo " <a href=\"$pathPresent?p=frmApplicant_paytruemai&npage=$i&lstacadyear=$re_acadyear&lstsemester=$re_semester&lsttype=$re_type&txt_round=$re_round&txt_code=$re_code\"> $i </a> ";
		 	   }		   
	}

	if ($npage < $totalpage) 
	{
		$next = $npage+1;
		if ($end < $totalpage) { echo "... "; }
		echo " <a href='$pathPresent?p=frmApplicant_paytruemai&npage=$next&lstacadyear=$re_acadyear&lstsemester=$re_semester&lsttype=$re_type&txt_round=$re_round&txt_code=$re_code'>ถัดไป</a> ";
		echo " <a href='$pathPresent?p=frmApplicant_paytruemai&npage=$totalpage&lstacadyear=$re_acadyear&lstsemester=$re_semester&lsttype=$re_type&txt_round=$re_round&txt_code=$re_code' >ท้ายสุด</a> ";
	}
	?>
&nbsp;</p>
