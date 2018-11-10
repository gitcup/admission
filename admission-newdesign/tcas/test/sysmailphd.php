<?php $cur_date = date("H:i:s"); 
   $d = substr($cur_date,0,2);?>
<?php if($d % 2 == 0) {

$from_name			="RBRU ระบบรับสมัครบุคคลเข้าศึกษา ม.ราชภัฏรำไพพรรณี";
$email_user_send	="admit1@rbru.ac.th";
$email_pass_send	="admitrbru";
$subject			="แจ้งสถานะผู้สมัคร ที่ทำการสมัครเข้าศึกษาผ่านระบบ Online";
//$body_html			="เนื้อหาเป็น HTML";	//3
$body_text			="เนื้อหาเป็น Text ธรรมดา";

				} else {
				
$from_name			="RBRU ระบบรับสมัครบุคคลเข้าศึกษา ม.ราชภัฏรำไพพรรณี";
$email_user_send	="admit2@rbru.ac.th";
$email_pass_send	="admitrbru";
$subject			="แจ้งสถานะผู้สมัคร ที่ทำการสมัครเข้าศึกษาผ่านระบบ Online";
//$body_html			="เนื้อหาเป็น HTML";	//3
$body_text			="เนื้อหาเป็น Text ธรรมดา";
				
				}
				
				
?>
