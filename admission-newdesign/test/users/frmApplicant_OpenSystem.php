<?	include("../config/connect.php"); ?>
<? session_start();
include "check_session.php";  ?>
<? 

	
	$id_edit = $_GET[id_edit];
	$action = $_GET[action];
	
	$yearNew = $_POST[year];
	$semesterNew = $_POST[semester];
	$roundNew = $_POST[round1];
	$applicanttypeNew = $_POST["lsttype"];
	$openstatusNew = $_POST[openstatus];
	$dateopenfromNew = $_POST[startdate];
	$dateopentoNew = $_POST[enddate];
	$datemoneyfromNew = $_POST[startdate2];
	$datemoneytoNew = $_POST[enddate2];
?>
<link rel="stylesheet" href="../tinybox2/style.css" />
<script type="text/javascript" src="../tinybox2/tinybox.js"></script>
<!-- ---------------ปฏิทิน -------------------- -->
<link rel="stylesheet" type="text/css" href="calendar/css/redmond/jquery-ui-1.8.2.custom.css">
<script type="text/javascript" src="calendar/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="calendar/js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="calendar/js/jquery.ui.datepicker-th.js"></script>

<script type="text/javascript">
	$(function(){
		$("#startdateInput").datepicker({
			showOn: 'button',
			buttonImage: 'calendar.gif',
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd'
			//dateFormat: 'dd/mm/yy'
		});
		$("#enddateInput").datepicker({
			showOn: 'button',
			buttonImage: 'calendar.gif',
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd'
			//dateFormat: 'dd/mm/yy'
		});
		$("#startdateInput2").datepicker({
			showOn: 'button',
			buttonImage: 'calendar.gif',
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd'
			//dateFormat: 'dd/mm/yy'
		});
		$("#enddateInput2").datepicker({
			showOn: 'button',
			buttonImage: 'calendar.gif',
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd'
			//dateFormat: 'dd/mm/yy'
		});
	});
</script>

<h2>เปิดรอบการรับสมัคร Online <? echo"$txt"; ?></h2>
<?
     $strSQL2 = "SELECT * FROM AVSREG.APPLICANTCALENDAR order by id aSC";
	 $objExec2 = odbc_exec($objConnect, $strSQL2) or die ("Error Execute [".$strSQL2."]");
?>
<table width="950" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#0066CC">
	
	<table width="100%" border="0" cellspacing="1" cellpadding="5">
      <tr>
        <td width="8%" bgcolor="#0099CC"><div align="center">ปี</div></td>
        <td width="8%" bgcolor="#0099CC"><div align="center">เทอม</div></td>
        <td width="6%" bgcolor="#0099CC"><div align="center">รอบ</div></td>
        <td width="16%" bgcolor="#0099CC"><div align="center">ประเภทการรับสมัคร</div></td>
        <td width="18%" bgcolor="#0099CC"><div align="center">ช่วงวันที่เปิดรับสมัคร</div></td>
        <td width="17%" bgcolor="#0099CC"><div align="center">ช่วงวันที่ชำระเงิน</div></td>
        <td width="15%" bgcolor="#0099CC"><div align="center">สถานะเปิดปิดระบบ</div></td>
        <td width="12%" bgcolor="#0099CC"><div align="center">แก้ไข</div></td>
      </tr>
	   <?
    while(odbc_fetch_row($objExec2))
	{
	      $id = odbc_result($objExec2,"ID");	
	 	  $acadyear = odbc_result($objExec2,"ACADYEAR");
	      $semester = odbc_result($objExec2,"SEMESTER");
		  $round = odbc_result($objExec2,"ROUND");
	      $applicanttype = odbc_result($objExec2,"APPLICANTTYPE");	
		  $openstatus = odbc_result($objExec2,"OPENSTATUS");
	      $dateopenfrom = explode(" ",odbc_result($objExec2,"DATEOPENFROM"));	
		  $dateopento = explode(" ",odbc_result($objExec2,"DATEOPENTO"));	
		  $datemoneyfrom = explode(" ",odbc_result($objExec2,"DATEMONEYFROM"));	
		  $datemoneyto = explode(" ",odbc_result($objExec2,"DATEMONEYTO"));	
  ?>
      <tr>
        <td bgcolor="#FFFFFF">&nbsp;<? echo $acadyear; ?></td>
        <td bgcolor="#FFFFFF"><div align="center"><? echo $semester; ?></div></td>
        <td bgcolor="#FFFFFF"><div align="center"><? echo $round; ?></div></td>
        <td bgcolor="#FFFFFF"><div align="center"><? echo $applicanttype; ?></div></td>
        <td bgcolor="#FFFFFF"><div align="center"><? echo $dateopenfrom[0]; ?><? echo "<br> ถึง <br>".$dateopento[0]; ?></div></td>
        <td bgcolor="#FFFFFF"><div align="center"><? echo $datemoneyfrom[0]; ?><? echo "<br> ถึง <br>".$datemoneyto[0]; ?></div></td>
        <td bgcolor="#FFFFFF">&nbsp;
          <? 
		      if($openstatus == 1 ){ echo"<span class='green'>เปิด</span>"; }
			  if($openstatus == 2 ){ echo"<span class='red'>ปิด</span>"; }
		 ?></td>
        <td bgcolor="#FFFFFF"><div align="center"><? echo "<a href='index.php?p=frmApplicant_OpenSystem&id_edit=$id'><img src='icon_edit.png' title='แก้ไขข้อมูล'></a>"; ?></div></td>
      </tr>
	<?
   	 }
	?>
    </table></td>
  </tr>
</table>
<?
      $editSQL = "SELECT * FROM AVSREG.APPLICANTCALENDAR WHERE ID='$id_edit' ORDER BY ID DESC";
	  $objEdit= odbc_exec($objConnect, $editSQL) or die ("Error Execute [".$editSQL."]");
	  $acadyearOld = odbc_result($objEdit,"ACADYEAR");
	  $semesterOld = odbc_result($objEdit,"SEMESTER");
	  $roundOld = odbc_result($objEdit,"ROUND");
	  $lsttype = odbc_result($objEdit,"APPLICANTTYPE");	
	  $dateopenfromOld = explode(" ",odbc_result($objEdit,"DATEOPENFROM"));	
	 //echo $datefromOld = odbc_result($objEdit,"DATEFROM");	
	 //echo $tt = to_date('$datefromOld','dd/mm/yyyy HH24:MI:SS');
	  $dateopentoOld = explode(" ",odbc_result($objEdit,"DATEOPENTO"));	
	  $datemoneyfromOld = explode(" ",odbc_result($objEdit,"DATEMONEYFROM"));	
	  $datemoneytoOld = explode(" ",odbc_result($objEdit,"DATEMONEYTO"));	
	  $openstatusOld = odbc_result($objEdit,"OPENSTATUS");	
	  
	  if(!empty($id_edit))
	  {
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h2 align="center">สำหรับผู้ดูแลระบบ ในการกำหนดเปิด/ปิดการรับสมัคร Online</h2>
<div align="center">
  <form id="form1" name="form1" method="post" action="<? echo "index.php?p=frmApplicant_OpenSystem&action=save&id_edit=$id_edit"; ?>">
    <table cellpadding="3">
      <tr>
        <td>ปี</td>
        <td><input name="year" type="text" id="year" value="<? echo $acadyearOld ?>" size="10" maxlength="4"/></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>เทอม</td>
        <td><input name="semester" type="text" id="semester" value="<? echo $semesterOld ?>" size="3" maxlength="2" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>รอบ</td>
        <td><input name="round1" type="text" id="round1" value="<? echo $roundOld ?>" size="3" maxlength="1"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>ประเภทการรับสมัคร</td>
        <td><select name="lsttype" id="lsttype">
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
        </select></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>สถานะระบบ(เปิด/ปิด ระบบ)</td>
        <td><input type="radio" name="openstatus" id="radio3" value="1"  <? if($openstatusOld==1){ echo"checked='checked'"; } ?>/>
          เปิด  &nbsp;
          <input type="radio" name="openstatus" id="radio3" value="2" <? if($openstatusOld==2){ echo"checked='checked'"; } ?>/>
          ปิด</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>วันที่เริ่มรับสมัคร</td>
        <td><input type="text" name="startdate" id="startdateInput"  value="<? echo "$dateopenfromOld[0]"; ?>"/>
        </td>
        <td>&nbsp;วันสุดท้ายของการรับสมัคร</td>
        <td><input type="text" name="enddate" id="enddateInput"  value="<? echo "$dateopentoOld[0]"; ?>"/></td>
      </tr>
      <tr>
        <td>วันที่เริ่มชำระเงิน</td>
        <td><input type="text" name="startdate2" id="startdateInput2" value="<? echo "$datemoneyfromOld[0]"; ?>"/>
        </td>
        <td>วันที่สุดท้ายของการชำระเงิน</td>
        <td><input type="text" name="enddate2" id="enddateInput2" value="<? echo "$datemoneytoOld[0]"; ?>"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input type="submit" name="button" id="button" value="ตกลง" />
          &nbsp;
          <input type="submit" name="button2" id="button2" value="ยกเลิก" />
        </label></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </form>
</div>
<p align="center">&nbsp; </p>
 <?php
     } 
    if($dateopenfromNew > $dateopentoNew)
	{
		echo "<script language='javascript'>";
		echo "alert('วันที่เปิดรับสมัครเริ่มต้นน้อยมากกว่าวันที่สิ้นสุด');";
		echo "</script>";
	    exit();
	}
	if($datemoneyfromNew > $datemoneytoNew)
	{
		echo "<script language='javascript'>";
		echo "alert('วันที่ชำระเงินไม่ถูกต้อง');";
		echo "</script>";
	    exit();
	}
	
	  if(!empty($action) && $action=="save")
	{
	        $start = explode("-",$dateopenfromNew);
		    $end = explode("-",$dateopentoNew);
   		    $datefrom = $start[2]."-".$start[1]."-".$start[0];
			$dateto = $end[2]."-".$end[1]."-".$end[0];
			
			$start2 = explode("-",$datemoneyfromNew);
		    $end2 = explode("-",$datemoneytoNew);
   		    $datefrom2 = $start2[2]."-".$start2[1]."-".$start2[0];
			$dateto2 = $end2[2]."-".$end2[1]."-".$end2[0];
						
			$sqlUpdate = "UPDATE  AVSREG.APPLICANTCALENDAR SET ACADYEAR='$yearNew', SEMESTER='$semesterNew', ROUND='$roundNew', APPLICANTTYPE='$applicanttypeNew', DATEOPENFROM=to_date('$datefrom','dd/mm/yyyy'), DATEOPENTO=to_date('$dateto','dd/mm/yyyy'), DATEMONEYFROM=to_date('$datefrom2','dd/mm/yyyy'), DATEMONEYTO=to_date('$dateto2','dd/mm/yyyy'), OPENSTATUS='$openstatusNew'  WHERE ID='$id_edit' ";
			$objUpdate = odbc_exec($objConnect, $sqlUpdate) or die ("Error Execute [".$sqlUpdate."]");  
			echo "แก้ไขข้อมูลเรียบร้อยแล้ว";
			echo "<meta http-equiv='refresh' content='2;URL=index.php?p=frmApplicant_OpenSystem' />";	
	}
?>
