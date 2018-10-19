<?php session_start(); ?>
<html>
    <head>
        <title>Add Applicant</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    </head>
    <body>
        <strong class="strong"> ค้นหารหัสผู้สมัครจากบัตรประชาชน</strong > 
        <hr>
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

                <div class="card border-light mb-3" style="max-width: 30rem; margin: 0 auto;">
<!--                    <div class="card-header">Header</div>-->
                    <div class="card-body">
                        <p class="card-text">รหัสนักศึกษา :  <?php echo $applicantcode; ?>  </p>
                        <p class="card-text">ชื่อ - สกุล : <?php echo $applicantname_cv . "  " . $applicantsurname_cv; ?>      </p>


                        <?php
                        $strSEL1 = "SELECT APPLICANTSELECTION.APPLICANTID, APPLICANTSELECTION.SEQUENCE, QUOTA.QUOTANAME FROM (AVSREG.APPLICANTSELECTION INNER JOIN AVSREG.QUOTASTATUS ON APPLICANTSELECTION.QUOTASTATUSID = QUOTASTATUS.QUOTASTATUSID) INNER JOIN AVSREG.QUOTA ON QUOTASTATUS.QUOTAID = QUOTA.QUOTAID WHERE (((APPLICANTSELECTION.APPLICANTID)='$applicantid')) ORDER BY APPLICANTSELECTION.SEQUENCE";
                        $resultSEL1 = odbc_exec($objConnect, $strSEL1) or die("Error Execute [" . $strSEL1 . "]");
                        while ($objSEL1 = odbc_fetch_row($resultSEL1)) {

                            $quotaname = odbc_result($resultSEL1, "quotaname");
                            $seq = odbc_result($resultSEL1, "sequence");
                            $quotaname_cv = iconv("TIS-620", "UTF-8", "$quotaname");
                            ?>

                            <p class="card-text">ลำดับที่ <?php echo $seq . " : "; ?> <?php echo $quotaname_cv; ?> </p>


                        <?php } ?>     	




                        <!--แสดงประเภท-->
                        <?php
                        $strSELSYS = "SELECT SYSBYTEDES.BYTECODE, SYSBYTEDES.BYTEDES FROM AVSREG.SYSBYTEDES WHERE (((SYSBYTEDES.TABLENAME)='APPLICANT') AND ((SYSBYTEDES.COLUMNNAME)='APPLICANTTYPE') AND ((SYSBYTEDES.BYTECODE)='$applicanttype'))";
                        $resultSELSYS = odbc_exec($objConnect, $strSELSYS) or die("Error Execute [" . $strSELSYS . "]");
                        while ($objSELSYS = odbc_fetch_row($resultSELSYS)) {

                            $apptype = odbc_result($resultSELSYS, "bytedes");
                            $applicanttype_cv = iconv("TIS-620", "UTF-8", "$apptype");
                        }
                        ?>

                        <p class="card-text">ประเภทการสมัคร: <?php echo $applicanttype_cv . " ปีการศึกษา " . $acadyear . " เทอม " . $semester . " รอบ " . $round; ?>    </p>



                    </div>
                </div>






            <?php } ?>


            <br>
            <div class="alert alert-dismissible alert-primary">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>** หมายเหตุ **</strong> <a href="#" class="alert-link"></a>
                <br>
                -  กรณีที่ผู้สมัครเข้าศึกษา สมัครตั้งแต่ 2 รหัสในการเข้าสอบจะสามารถมาสอบได้เพียงรหัสผู้สอบเดียวเท่านั้น<br>
                - พิมพ์หลักฐานการสมัครในรหัสผู้สมัคร และนำมาแสดงวันเข้าสอบ <br/>

            </div>

        </body>
    </html>
    <?php
} else {
    echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmFindByciti&back=9\">";
}
?>