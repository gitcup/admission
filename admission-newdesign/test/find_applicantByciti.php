<?php session_start(); ?>
<html>
    <head>
        <title>Add Applicant</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style type="text/css">
            <!--
            .style1 {
                font-family: Verdana;
                font-size: 16px;
                color: #660000;
            }
            .style3 {font-size: 16px; font-family: Verdana;}
            -->
        </style>
    </head>
    <body>
        <h2>ค้นหารหัสผู้สมัครจากบัตรประชาชน<?php echo"$txt"; ?></h2>
        <?php
        include("config/connect.php");
        include("sysconfig.php");
        $citizen = $_POST["txt_citizen"];

        $strSQL = "SELECT APPLICANT.APPLICANTID, APPLICANT.APPLICANTCODE, APPLICANT.APPLICANTNAME, APPLICANT.ACADYEAR, APPLICANT.SEMESTER, APPLICANT.APPLICANTTYPE, APPLICANT.ROUND, APPLICANT.APPLICANTSURNAME,APPLICANT.APPLICANTSTATUS FROM avsreg.APPLICANT WHERE ((APPLICANT.CITIZENID)='$citizen') and ((APPLICANT.ACADYEAR)>='2561')";
        $result = odbc_exec($objConnect, $strSQL) or die("Error Execute [" . $strSQL . "]");
        $resultnum = odbc_exec($objConnect, $strSQL) or die("Error Execute [" . $strSQL . "]");
        while (odbc_fetch_row($resultnum))
            $Num_Rows++; // Count Record
        if ($Num_Rows > 0) {
            while ($objResult = odbc_fetch_row($result)) {
                $applicantid = odbc_result($result, "applicantid");
                $applicantcode = odbc_result($result, "applicantcode");
                $acadyear = odbc_result($result, "acadyear");
                $semester = odbc_result($result, "semester");
                $applicanttype = odbc_result($result, "applicanttype");
                $round = odbc_result($result, "round");
                $applicantname = odbc_result($result, "applicantname");
                $applicantsurname = odbc_result($result, "applicantsurname");
                $applicantstatus = odbc_result($result, "applicantstatus");
                $applicantname_cv = iconv("TIS-620", "UTF-8", "$applicantname");
                $applicantsurname_cv = iconv("TIS-620", "UTF-8", "$applicantsurname");

                //$_SESSION["applicantid_sess"] = $applicantid;
                ?>
                <div class="mr20" >

                    <span class="style1">


                        <table width="80%" border="0" cellspacing="3" cellpadding="3">
                            <tr>
                                <td width="29%"><div align="right">รหัสนักศึกษา : </div></td>
                                <td width="71%">
                                    <?php echo $applicantcode; ?>        </td>
                            </tr>
                            <tr>
                                <td><div align="right">ชื่อ - สกุล : </div></td>
                                <td>
                                    <?php echo $applicantname_cv . "  " . $applicantsurname_cv; ?>        </td>
                            </tr> 
                            <?php
                            $strSEL1 = "SELECT APPLICANTSELECTION.APPLICANTID, APPLICANTSELECTION.SEQUENCE, QUOTA.QUOTANAME FROM (AVSREG.APPLICANTSELECTION INNER JOIN AVSREG.QUOTASTATUS ON APPLICANTSELECTION.QUOTASTATUSID = QUOTASTATUS.QUOTASTATUSID) INNER JOIN AVSREG.QUOTA ON QUOTASTATUS.QUOTAID = QUOTA.QUOTAID WHERE (((APPLICANTSELECTION.APPLICANTID)='$applicantid')) ORDER BY APPLICANTSELECTION.SEQUENCE";
                            $resultSEL1 = odbc_exec($objConnect, $strSEL1) or die("Error Execute [" . $strSEL1 . "]");
                            while ($objSEL1 = odbc_fetch_row($resultSEL1)) {

                                $quotaname = odbc_result($resultSEL1, "quotaname");
                                $seq = odbc_result($resultSEL1, "sequence");
                                $quotaname_cv = iconv("TIS-620", "UTF-8", "$quotaname");
                                ?>
                                <tr>
                                    <td><div align="right">ลำดับที่ <?php echo $seq . " : "; ?></div></td>
                                    <td><?php echo $quotaname_cv; ?>

                                        <?   }  ?>     	</td>
                                </tr>
                                <tr>
                                    <td><div align="right">ประเภทการสมัคร : </div></td>
                                    <td><div align="left">
            <?php
            $strSELSYS = "SELECT SYSBYTEDES.BYTECODE, SYSBYTEDES.BYTEDES FROM AVSREG.SYSBYTEDES WHERE (((SYSBYTEDES.TABLENAME)='APPLICANT') AND ((SYSBYTEDES.COLUMNNAME)='APPLICANTTYPE') AND ((SYSBYTEDES.BYTECODE)='$applicanttype'))";
            $resultSELSYS = odbc_exec($objConnect, $strSELSYS) or die("Error Execute [" . $strSELSYS . "]");
            while ($objSELSYS = odbc_fetch_row($resultSELSYS)) {

                $apptype = odbc_result($resultSELSYS, "bytedes");
                $applicanttype_cv = iconv("TIS-620", "UTF-8", "$apptype");
            }
            ?>
                                            <?php echo $applicanttype_cv . " ปีการศึกษา " . $acadyear . " เทอม " . $semester . " รอบ " . $round; ?>
                                        </div></td>
                                </tr>
                                            <?php
                                            $strSELSYS = "SELECT SYSBYTEDES.BYTECODE, SYSBYTEDES.BYTEDES FROM AVSREG.SYSBYTEDES WHERE (((SYSBYTEDES.TABLENAME)='APPLICANT') AND ((SYSBYTEDES.COLUMNNAME)='APPLICANTSTATUS') AND ((SYSBYTEDES.BYTECODE)='$applicantstatus'))";
                                            $resultSELSYS = odbc_exec($objConnect, $strSELSYS) or die("Error Execute [" . $strSELSYS . "]");
                                            while ($objSELSYS = odbc_fetch_row($resultSELSYS)) {

                                                $appstatus = odbc_result($resultSELSYS, "bytedes");
                                                $appstatus_cv = iconv("TIS-620", "UTF-8", "$appstatus");
                                            }
                                            ?>
                              <!-- <tr>
                                  <td><div align="right">สถานะผู้สมัคร : </div></td>
                                  <td><? // echo $appstatus_cv; ?></td>
                                </tr> -->


                                <tr>        </tr></table>


                        </span>
                    </div>

            <?php } ?>
                    <div id="comment">
                        <h2>** หมายเหตุ **</h2>
                        -  กรณีที่ผู้สมัครเข้าศึกษา สมัครตั้งแต่ 2 รหัสในการเข้าสอบจะสามารถมาสอบได้เพียงรหัสผู้สอบเดียวเท่านั้น<br>
                        - พิมพ์หลักฐานการสมัครในรหัสผู้สมัคร และนำมาแสดงวันเข้าสอบ <br/>
                        <br/>
                    </div>

                </body>
            </html>
                    <?php
                }
            }
         else {
            echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmFindByciti&back=9\">";
        }
        ?>