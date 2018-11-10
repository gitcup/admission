<?php	session_start(); ?>

<?php 
     include("config/connect.php");
	// include("config/config_school.php");
     include("menuType.php");
	  $frommail = $_GET['m'];
	if($frommail == 'true') 
	{
		$applicantid = $_GET['appid'];
	} else {
		 $applicantid = $_SESSION['applicantid_sess'];
		   }
	//echo $applicantid = $_SESSION['applicantid_sess'];	
	?>

<script language="javascript">
	function OpenPopup(intLine,degree)
	{
		window.open('getDataphd.php?Line='+intLine,'myPopup','width=650,height=450,toolbar=0, menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
	}
	
	function OpenPopupSchool(intLine)
	{
		window.open('getDataSchoolphd.php?Line='+intLine,'myPopup','width=650,height=500,toolbar=0, menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
	}
	function OpenPopupSchool2(intLine)
	{
		window.open('getDataSchoolphd2.php?Line='+intLine,'myPopup','width=650,height=500,toolbar=0, menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
	}

function ClearForm(intLine){ 
document.getElementById("txtQUOTASTATUSID_" +intLine).value=""; 
document.getElementById("txtQUOTANAME_" +intLine).value=""; 
document.getElementById("txtLEVELABB_" +intLine).value=""; 
document.getElementById("txtQUOTACODE_" +intLine).value=""; 
document.getElementById("txtMINGPAX_" +intLine).value=""; 
document.getElementById("txtLEVELID_" +intLine).value=""; 
} 	
</script>
<!-- ---------------ปฏิทิน -------------------- -->

<link rel="stylesheet" type="text/css" href="jss/jquery.datetimepicker.css">
<script type="text/javascript" src="jss/jquery.js"></script>
<script type="text/javascript" src="jss/jquery.datetimepicker.js"></script>


  <?php    
	$strSEL = "SELECT avsreg.APPLICANT.*, avsreg.APPLICANTPHD.* FROM avsreg.APPLICANT LEFT JOIN avsreg.APPLICANTPHD ON APPLICANT.APPLICANTID = APPLICANTPHD.APPLICANTID WHERE (((APPLICANT.APPLICANTID)='$applicantid'))";
	$resultSEL = odbc_exec($objConnect, $strSEL) or die ("Error Execute [".$strSEL."]");
	while($objSEL = odbc_fetch_row($resultSEL))
	{
		//$applicantcode = odbc_result($resultSEL,"applicantcode");	
		$applicantname = odbc_result($resultSEL,"applicantname");	
		$applicantnameeng = odbc_result($resultSEL,"applicantnameeng");	
		$applicantsurnameeng = odbc_result($resultSEL,"applicantsurnameeng");	
		$prename = odbc_result($resultSEL,"prefixid");
		$schoolbclid = odbc_result($resultSEL,"schoolbclid");
		$schoolmasid = odbc_result($resultSEL,"schoolmasid");
		$programtype = odbc_result($resultSEL,"programtype");
		$gpax = odbc_result($resultSEL,"gpax");
		$email = odbc_result($resultSEL,"applicantmail");
		$bdate = odbc_result($resultSEL,"birthdate");
		$fstatus = odbc_result($resultSEL,"applyfrom");
		$applicanttype = odbc_result($resultSEL,"applicanttype");
		$applyfrom = odbc_result($resultSEL,"applyfrom");
		$citizenid = odbc_result($resultSEL,"citizenid");
		$applicantstatus = odbc_result($resultSEL,"applicantstatus");
		$applicantsurname = odbc_result($resultSEL,"applicantsurname");	
		$applicantname_cv = iconv( "TIS-620","UTF-8","$applicantname");
		$applicantsurname_cv = iconv( "TIS-620","UTF-8","$applicantsurname");
		$address1 = odbc_result($resultSEL,"homeaddress1");
		$address2 = odbc_result($resultSEL,"homeaddress2");
		$address3 = odbc_result($resultSEL,"homedistrict");
		$address1_cv = iconv( "TIS-620","UTF-8","$address1");
		$address2_cv = iconv( "TIS-620","UTF-8","$address2");
		$address3_cv = iconv( "TIS-620","UTF-8","$address3");
		$zipcode = odbc_result($resultSEL,"homezipcode");
		$mobile = odbc_result($resultSEL,"homephoneno");
		$province = odbc_result($resultSEL,"homeprovinceid");
		//$editseq = odbc_result($resultSEL,"editseq");
		$cjob = odbc_result($resultSEL,"workingstatus");
		$atjob = odbc_result($resultSEL,"officename");
		$atjob_cv = iconv( "TIS-620","UTF-8","$atjob");
		$atwork = odbc_result($resultSEL,"officeaddress1");
		$atwork_cv = iconv( "TIS-620","UTF-8","$atwork");
		$workposition = odbc_result($resultSEL,"workingposition");
		$workposition_cv = iconv( "TIS-620","UTF-8","$workposition");
		$salary = odbc_result($resultSEL,"workingsalary");
		$phone1 = odbc_result($resultSEL,"officephoneno");
		$phone2 = odbc_result($resultSEL,"officefaxno");
		
		$programbcl = odbc_result($resultSEL,"programbcl");
		$programbcl_cv = iconv( "TIS-620","UTF-8","$programbcl");
		$degreebcl = odbc_result($resultSEL,"degreebcl");
		$degreebcl_cv = iconv( "TIS-620","UTF-8","$degreebcl");
		$yearbcl = odbc_result($resultSEL,"graduateyearbcl");
		$gpabcl = odbc_result($resultSEL,"gpabcl");
		$programmas = odbc_result($resultSEL,"programmas");
		$programmas_cv = iconv( "TIS-620","UTF-8","$programmas");
		$degreemas = odbc_result($resultSEL,"degreemas");
		$degreemas_cv = iconv( "TIS-620","UTF-8","$degreemas");
		$yearmas = odbc_result($resultSEL,"graduateyearmas");
		$gpamas = odbc_result($resultSEL,"gpamas");
		
	}
  ?>

<div class="jumbotron">
    <strong >กรอกใบสมัครสอบออนไลน์</strong > <br><span>กรอกข้อมูลการสมัครเข้าศึกษาระดับบัณฑิตศึกษา   ประจำปีการศึกษา 2/2561</span>
    <hr>

    <form action="edit_applicantphd.php" method="post" enctype="multipart/form-data" name="register" class="cmxform" id="register" onsubmit="return check()">
        <strong>ข้อมูลส่วนบุคคล</strong><br>

        <label>คำนำหน้า : 
            <select name="prename" id="prename" validate="required:true" class="form-control" required>
                <option value="">--- กรุณาเลือก ---</option>
           <?php
                        $strSQL = "SELECT PREFIX.PREFIXNAME, PREFIX.PREFIXID FROM avsreg.PREFIX ORDER BY PREFIX.PREFIXID ASC";
						//$strSQL = "SELECT PREFIX.PREFIXNAME, PREFIX.PREFIXID FROM avsreg.PREFIX where (PREFIX.PREFIXID > 1 AND PREFIX.PREFIXID < 5) ORDER BY PREFIX.PREFIXID ASC";
                        $result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
                  		while(odbc_fetch_row($result))
							{
								$prefixid= odbc_result($result,"prefixid");	
								$prefixname= odbc_result($result,"prefixname");	
								$prefixname_cv = iconv("TIS-620", "UTF-8", "$prefixname");
                                $selected = "";
                                if($prename == $prefixid)
                                {
                                    $selected = "selected=\"selected\"";
                                }								
								
								echo "<option value=\"$prefixid\" $selected>$prefixname_cv</option>";
								
                            }
                      ?>              
            </select>
        </label>


        <div class="form-row">
            <span style="padding-left:22px"> ชื่อ-สกุล (ภาษาไทย) :</span>
            <div class="form-group col-md-2">
                <input type="text" name="name" id="name" class="form-control" required value="<?php echo $applicantname_cv; ?>" />
            </div>
            <div class="form-group col-md-2">
                <input type="text" name="surname" id="surname"  class="form-control " required value="<?php echo $applicantsurname_cv; ?>">
            </div>
        </div>


        <div class="form-row">
            ชื่อ-สกุล (ภาษาอังกฤษ) : 
            <div class="form-group col-md-2">
                <input type="text" name="nameeng" id="nameeng" class="form-control" required value="<?php echo $applicantnameeng; ?>" />
            </div>
            <div class="form-group col-md-2">
                <input type="text" name="surnameeng" id="surnameeng"  class="form-control" required value="<?php echo $applicantsurnameeng; ?>">
            </div>
        </div>




        <div class="form-row">
            <div class="form-group col-md-3">
                <label >รหัสบัตรประชาชน</label>
                <input name="citizen" value="<?php echo $citizenid; ?>" type="text" id="citizen" pattern="[0-9]{13}" title="คุณกรอกรหัสประชาชนไม่ถูกต้อง" maxlength="13" validate="required:true" class="form-control" required >
            </div>
            <div class="form-group col-md-2">
                <label >ว/ด/ป เกิด</label>  
                <input type="text" name="bdate" id="bdate"  value="<?php echo date("d/m/Y",strtotime($bdate)); ?>"class="form-control" required /> 
            </div>

            <div class="form-check form-check-inline">
                สถานภาพสมรส  &nbsp; &nbsp; &nbsp; 
                <input name="fstatus" type="radio" value="1" <?php if($fstatus==1){ echo"checked='checked'"; } ?> />
                <label class="form-check-label" for="inlineCheckbox1">&nbsp; โสด</label>
            </div>
            <div class="form-check form-check-inline">
                <input name="fstatus" type="radio" value="2" <?php if($fstatus==2){ echo"checked='checked'"; } ?> 
                <label class="form-check-label" for="inlineCheckbox2">&nbsp; สมรส </label>
            </div>
            <div class="form-check form-check-inline">
                <input name="fstatus" type="radio" value="3" <?php if($fstatus==3){ echo"checked='checked'"; } ?> 
                <label class="form-check-label" for="inlineCheckbox3">&nbsp; หม้าย</label>
            </div>
            <div class="form-check form-check-inline">
                <input name="fstatus" type="radio" value="4"<?php if($fstatus==4){ echo"checked='checked'"; } ?> 
                <label class="form-check-label" for="inlineCheckbox4"> &nbsp;หย่าร้าง </label>
            </div>
        </div>
        <script type="text/javascript">
            jQuery('#bdate').datetimepicker({
                timepicker: false,
                format: 'd/m/Y'
            });
        </script>


        <div class="form-row">
            <div class="form-group col-md-3">
                <label >ที่อยู่ </label>
                <input name="address" type="text" id="address" value="<?php echo $address1_cv;?>" size="60" maxlength="100" class="form-control" required  >
            </div>
            <div class="form-group col-md-2">
                <label >ตำบล  </label>  
                <input name="address2" type="text" id="address2" maxlength="30" value="<?php echo $address2_cv; ?>" class="form-control" required >
            </div>

            <div class="form-group col-md-2">
                <label > อำเภอ  </label>  
                <input name="address3" type="text" id="address3" maxlength="30" value="<?php echo $address3_cv; ?>" class="form-control" required >
            </div>
            <div class="form-group col-md-2">
                <label > จังหวัด  </label>  
                <select name="province" id="select" class="form-control" required >

              <?php
                        $strSQL = "SELECT PROVINCE.PROVINCEID, PROVINCE.PROVINCENAME FROM AVSREG.PROVINCE ORDER BY PROVINCE.PROVINCENAME";
                        $result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
                  		while(odbc_fetch_row($result))
							{
								$provinceid= odbc_result($result,"provinceid");	
								$provincename= odbc_result($result,"provincename");	
								$provincename_cv = iconv("TIS-620", "UTF-8", "$provincename");
                                $selected = "";
                                if($province == $provinceid)
                                {
                                    $selected = "selected=\"selected\"";
                                }
                                echo "<option value=\"$provinceid\" $selected>$provincename_cv</option>";
                            }
                      ?>
                </select>
            </div>

            <div class="form-group col-md-2">
                <label > รหัสไปรษณีย์  </label>  
                <input  name="zipcode" type="text" value="<?php echo $zipcode;?>" class="form-control"  required   id="zipcode" size="10" pattern="[0-9]{5}" title="คุณกรอกรหัสไปรษณีย์ไม่ถูกต้อง"  maxlength="5" validate="required:true"/> 
            </div>

        </div>





        <div class="form-row">
            <div class="form-group col-md-2">
                <label >มือถือ </label>
                <input name="mobile" type="text" value="<?php echo $mobile;?>" class="form-control" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" title="คุณกรอกเบอร์มือถือไม่ถูกต้อง"  id="mobile" maxlength="13" validate="required:true"/> 
            </div>
            <div class="form-group col-md-3">
                <label >e-mail  </label>  
                <input name="email" type="text"  id="email" value="<?php echo $email; ?>" size="35"  validate="required:true" class="form-control" required />    
            </div>
        </div>






        <hr>
        <strong>ข้อมูลการศึกษาระดับปริญญาตรี</strong>
        <br>


        <div class="form-row">
            <div class="form-group col-md-3">
                <label >สาขาวิชาเอก  </label>
                <input type="text" name="programbcl" id="programbcl" value="<?php echo $programbcl_cv;?>" validate="required:true" class="form-control"/>
            </div>
            <div class="form-group col-md-3">
                <label >ชื่อปริญญา     </label>  
                <input type="text" name="degreebcl" id="degreebcl" value="<?php echo $degreebcl; ?>" validate="required:true" class="form-control"/>  
            </div>


        </div>

        
        

        <div class="form-row">
            <div class="form-group col-md-2">
                <label >ปีที่สำเร็จการศึกษา  </label>
                <input type="text" name="yearbcl" id="yearbcl" size="5" maxlength="4" value="<?php echo $yearbcl; ?>" validate="required:true" class="form-control" required />
            </div>
            <div class="form-group col-md-2">
                <label >เกรดเฉลี่ยสะสม    </label>  
                <input name="gpabcl" type="text" id="gpabcl" value="<?php echo $gpabcl; ?>" size="2" maxlength="4" validate="required:true" class="form-control" required  />
            </div>
	 <?php
                        $strSQL = "SELECT SCHOOL.SCHOOLID, SCHOOL.SCHOOLNAME FROM avsreg.SCHOOL WHERE (((SCHOOL.SCHOOLID)='$schoolbclid'))";
                        $result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
                  		while(odbc_fetch_row($result))
							{
								$schoolbclid= odbc_result($result,"schoolid");	
								$schoolname= odbc_result($result,"schoolname");	
								$schoolnamebcl_cv = iconv("TIS-620", "UTF-8", "$schoolname");
                                                                
                            }
      ?>

        </div>


        <div class="form-row">
            <div class="form-group col-md-4">
                <label >สถาบันเดิมที่จบ</label>
                <input name="txtSCHOOLID_1" type="hidden" id="txtSCHOOLID_1" value="<?php echo $schoolidbcl; ?>"  class="form-control"/>
                <input name="txtSCHOOLNAME_1"  value="<?php echo $schoolnamebcl_cv; ?>"type="text" id="txtSCHOOLNAME_1" size="50" readonly="readonly" validate="required:true" class="form-control"/>
                <input type="button" name="btnPopup_12"  id="btnPopup_12" value="เพิ่ม" onclick="OpenPopupSchool(1)" class="btn btn-secondary" />
            </div>
        </div>

        <hr>



        <strong>ข้อมูลการศึกษาระดับปริญญาโท</strong>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label >สาขาวิชาเอก : </label>
                <input type="text" name="programmas" id="programmas" value="<?php echo $programmas_cv; ?>" validate="required:true" class="form-control" required />
            </div>
            <div class="form-group col-md-3">
                <label >ชื่อปริญญา :    </label>  
                <input type="text" name="degreemas" id="degreemas" value="<?php echo $degreemas_cv; ?>" validate="required:true" class="form-control" required />
            </div>     
        </div>


        <div class="form-row">
            <div class="form-group col-md-2">
                <label >ปีที่สำเร็จการศึกษา  </label>
                <input type="text" name="yearmas" id="yearmas" size="5" maxlength="4" value="<?php echo $yearmas; ?>" validate="required:true" class="form-control" required />
            </div>
            <div class="form-group col-md-2">
                <label >เกรดเฉลี่ยสะสม    </label>  
                <?php
                        $strSQL = "SELECT SCHOOL.SCHOOLID, SCHOOL.SCHOOLNAME FROM avsreg.SCHOOL WHERE (((SCHOOL.SCHOOLID)='$schoolmasid'))";
                        $result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
                  		while(odbc_fetch_row($result))
							{
								$schoolmasid= odbc_result($result,"schoolid");	
								$schoolname= odbc_result($result,"schoolname");	
								$schoolnamemas_cv = iconv("TIS-620", "UTF-8", "$schoolname");
                                                                
                            }
      ?>
                <input name="gpamas" type="text" id="gpamas" value="<?php echo $gpamas; ?>" size="2" maxlength="4" validate="required:true" class="form-control" required  />

            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-4">
                <label >สถาบันเดิมที่จบ</label>
                
                <input name="txt2SCHOOLID_1" type="hidden" id="txt2SCHOOLID_1" value="<?php echo $schoolidmas; ?>" />
                <input name="txt2SCHOOLNAME_1"  value="<?php echo $schoolnamemas_cv; ?>"type="text" id="txt2SCHOOLNAME_1" size="50"  validate="required:true" class="form-control" readonly  required />
                <input class="btn btn-secondary"  type="button" name="btnPopup_12"  id="btnPopup_12" value="เพิ่ม" onclick="OpenPopupSchool2(1)" />
            </div>
        </div>



        <hr>
        <strong>สถานภาพการทำงาน</strong>







        <label>สถานภาพการทำงาน ปัจจุบัน :      
            <input name="cjob" type="radio" value="1"onclick="workForm()" <?php
            if ($cjob == 1) {
                echo"checked='checked'";
            }
            ?>  />
            ทำงาน &nbsp;&nbsp;&nbsp;
            <input name="cjob" type="radio" value="0"  onclick="notworkForm()"<?php
            if ($cjob == 0) {
                echo"checked='checked'";
            }
            ?>  />
            ไม่ทำงาน </label>
        
<!--        ฟังก์ชั่น เปิด/ปิด ฟอร์มทำงานไม่ทำงาน-->
           <script>
      function workForm(){
                document.getElementById("atjob").disabled = false;
                document.getElementById("atwork").disabled = false;
                document.getElementById("workposition").disabled = false;
                document.getElementById("salary").disabled = false;
                document.getElementById("phone").disabled = false;
                document.getElementById("jobphone2").disabled = false;
            }
   
      
            function notworkForm() {
                document.getElementById("atjob").value = "";
                document.getElementById("atwork").value = "";
                document.getElementById("workposition").value = "";
                document.getElementById("salary").value = "";
                document.getElementById("phone").value = "";
                document.getElementById("jobphone2").value = "";
                
        
            
        
        </script>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label >สถานที่ทำงาน</label>
                <input type="text" name="atjob" id="atjob" value="<?php echo $atjob_cv; ?>"class="form-control"  />

            </div>
            <div class="form-group col-md-4">
                <label >ที่ตั้ง</label>
                <input type="text" name="atwork" id="atwork" value="<?php echo $atwork_cv; ?>"class="form-control"   >

            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label >ตำแหน่งงาน</label>
                <input type="text" name="workposition" id="workposition" size="20" value="<?php echo $workposition_cv; ?>" class="form-control" />

            </div>
            <div class="form-group col-md-2">
                <label > รายได้ต่อเดือน</label>
                <input name="salary" type="text" id="salary" size="15" value="<?php echo $salary; ?>"  onKeyUp="if (isNaN(this.value)) {
                            alert('กรุณากรอกตัวเลข');
                            this.value = '';
                        }" class="form-control"  placeholder="ตัวอย่าง 15000" /> 

            </div>
        </div>




        <div class="form-row">
            <div class="form-group col-md-2">
                <label >โทรศัพท์</label>
                <input type="text" name="jobphone"  value="<?php echo $phone1; ?>" class="form-control"   >

            </div>


            <div class="form-group col-md-2">
                <label >โทรสาร</label>
                <input type="text" name="jobphone2" id="jobphone2" value="<?php echo $phone2; ?>"class="form-control"  />

            </div>
        </div>

        <hr>
        <strong>สาขาวิชาที่เลือก</strong>
        <div class="border-bottom" >
            <label>
                <table>
                    <tr>
                        <td><div align="center">ลำดับ</div></td>
                        <td><div align="center">รหัสสาขา </div></td>
                        <td><div align="center">สาขาวิชาที่เลือก</div></td>
                        <td><div align="center">ระดับ</div></td>
                        <td><div align="center">เลือก..</div></td>
                    </tr>
                    <!-- Rows 1 -->
                    <tr>
                         <input name="txtapplicanttype" type="hidden" value="<?php echo $applicanttype; ?>" />
                           <?php 
 $strSQL = "SELECT APPLICANTSELECTION.APPLICANTID, QUOTA.QUOTACODE, QUOTA.LEVELID, QUOTASTATUS.MINGPAX, QUOTA.QUOTANAME, LEVELID.LEVELABB, APPLICANTSELECTION.SEQUENCE, APPLICANTSELECTION.QUOTASTATUSID FROM ((avsreg.APPLICANTSELECTION INNER JOIN avsreg.QUOTASTATUS ON APPLICANTSELECTION.QUOTASTATUSID = QUOTASTATUS.QUOTASTATUSID) INNER JOIN avsreg.QUOTA ON QUOTASTATUS.QUOTAID = QUOTA.QUOTAID) INNER JOIN avsreg.LEVELID ON QUOTA.LEVELID = LEVELID.LEVELID WHERE (((APPLICANTSELECTION.APPLICANTID)='$applicantid') and ((APPLICANTSELECTION.SEQUENCE)='1')) ORDER BY APPLICANTSELECTION.SEQUENCE";
$result = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."]");
	while(odbc_fetch_row($result))
							{
								$quotastatusid1= odbc_result($result,"quotastatusid");	
								$quotacode1= odbc_result($result,"quotacode");	
								$quotaname1= odbc_result($result,"quotaname");	
								$levelabb1= odbc_result($result,"levelabb");	
								$sequence= odbc_result($result,"sequence");	
								$mingpa = odbc_result($result,"MINGPAX");	
								$levelid = odbc_result($result,"levelid");	
								$quotaname1_cv = iconv("TIS-620", "UTF-8", "$quotaname1");
								$levelabb1_cv = iconv("TIS-620", "UTF-8", "$levelabb1");
								
								$_SESSION["quotastatus_sess1"] = $quotastatusid1;
								$quotastatusid1	=	$_SESSION["quotastatus_sess1"];
                                                              
                            }
?>
                        <td><div align="center">1
                                <input name="txtQUOTASTATUSID_1" type="hidden" id="txtQUOTASTATUSID_1" value="<?php echo $quotastatusid1; ?>"  />
                                <input name="txtMINGPAX_1" type="hidden" id="txtMINGPAX_1" value="<?php echo $mingpa; ?>"/>
                            </div></td>
                        <td><div align="center">
                                <input name="txtLEVELID_1" type="hidden" id="txtLEVELID_1" value="<?php echo $levelid; ?>" />
                                <input type="text" size="3" name="txtQUOTACODE_1"  value="<?php echo $quotacode1; ?>" id="txtQUOTACODE_1"  class="form-control" required />

                            </div></td>
                        <td><div align="center">
                                <center>
                                    <input type="text" size="40" name="txtQUOTANAME_1"  id="txtQUOTANAME_1" value="<?php echo $quotaname1_cv; ?>" class="form-control" required/>
                                </center>
                            </div></td>
                        <td><div align="center">
                                <center>
                                    <input type="text" size="15" name="txtLEVELABB_1" id="txtLEVELABB_1"  value="<?php echo $levelabb1_cv; ?>"  class="form-control" required />
                                </center>
                            </div></td>
                        <td><div align="center">
                                <center>
                                    <input class="btn btn-light" type="button" name="btnPopup_1"  id="btnPopup_1" value="+" onclick="OpenPopup(1)" />
                                    <input class="btn btn-light" type="button" name="btnPopup_1"  id="btnPopup_1" value="-" onclick="ClearForm(1)" />
                                </center>
                            </div></td>
                    </tr>
                </table>
            </label>
            <input type="hidden" name="hdnMaxLine" value="4">
            <span class="style1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>




            
        <div class="center">
            <label class="label2">
                <input class="btn btn-primary" type="submit" name="submit" id="bt" value="ตกลง"/>
            </label>
            <label  class="label2">
                <input class="btn btn-light" type="reset" name="reset" id="bt" value="ยกเลิก" />
            </label>
            <br />
            <span class="style2">(คลิก &quot;ตกลง&quot; แล้วรอสักครู่ระบบกำลังสร้างรหัสผู้สมัคร)</span></div>
    </form>



    <br>

    <div class="alert alert-dismissible alert-primary">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>** หมายเหตุ **</strong> <a href="#" class="alert-link"></a>
        <br>
        1. มหาวิทยาลัยจะพิจารณาตัดสินการสอบคัดเลือกให้เฉพาะผู้ที่มีคุณสมบัติทั่วไป และคุณสมบัติเฉพาะสาขาตามที่สาขาวิชากำหนด<br>
        2. กรณีที่ชำระเงินค่าธรรมเนียมสมัครแล้วจะไม่คืนเงินค่าสมัครให้ไม่ว่ากรณีใดๆ ทั้งสิ้น<br>
        3. การสมัครจะสมบูรณ์เมื่อผู้สมัครได้ชำระเงินภายในระยะเวลาที่มหาวิทยาลัยกำหนดเท่านั้น <br>
        4. การแก้ไขข้อมูลการสมัคร จะกระทำได้เมื่อผู้สมัครยังมิได้ชำระเงิน <br>
        5. ในวันสอบสัมภาษณ์  มหาวิทยาลัยจะตรวจสอบคุณสมบัติ หากตรวจพบว่าคุณสมบัติของผู้สมัครไม่เป็นไปตามที่มหาวิทยาลัยกำหนดหรือข้อมูลการสมัครเป็นเท็จ  มหาวิทยาลัยจะตัดสิทธิ์ในการรับเข้าเป็นนิสิต
    </div>
</div>
