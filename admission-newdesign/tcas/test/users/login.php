<?	include("../config/connect.php"); ?>
<? //include("../sysconfig.php");  ?>

<link rel="stylesheet" href="../tinybox2/style.css" />
<script type="text/javascript" src="../tinybox2/tinybox.js"></script>
<!-- ---------------ปฏิทิน -------------------- -->
<link rel="stylesheet" type="text/css" href="calendar/css/redmond/jquery-ui-1.8.2.custom.css">
<script type="text/javascript" src="calendar/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="calendar/js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="calendar/js/jquery.ui.datepicker-th.js"></script>


<h2>สำหรับผู้ดูแลระบบรับสมัคร Online <? echo"$txt"; ?></h2>
<table width="950" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#0066CC">
	
	<table width="100%" border="0" cellspacing="1" cellpadding="5">
      <tr>
        <td bgcolor="#FFFFFF"><form id="form1" name="form1" method="post" action="chkstatus.php">
          <table width="60%" border="0" align="center" cellpadding="3" cellspacing="0">
            <tr>
              <td><div align="right">Username : </div></td>
              <td><label><input type="text" name="username" id="username"/>
              </label></td>
            </tr>
            <tr>
              <td><div align="right">Password : </div></td>
              <td><input name="passw0rd" type="password" id="passw0rd" /></td>
            </tr>
            <tr>
              <td><div align="right"></div></td>
              <td><input type="submit" name="Submit" value=" ตกลง " /></td>
            </tr>
            <tr>
              <td><div align="right"></div></td>
              <td>* ตัวเดียวกับระบบ Authen* </td>
            </tr>
          </table>
                </form>
        </td>
        </tr>
	   <? /*
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
		  */
  ?>
	<?
   /*	 }	*/
	?>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h2 align="center">&nbsp;</h2>
<p align="center">&nbsp; </p>
 