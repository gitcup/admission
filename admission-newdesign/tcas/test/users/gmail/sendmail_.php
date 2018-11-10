<?

### INCLUDE PHPMAILER เข้ามา ###
include ("class.phpmailer.php");

### FUNCTION SEND MAIL ####

function admitrbru_sendmail($to_name,$to_email,$from_name,$email_user_send,$email_pass_send,$subject,$body_html,$body_text) {

$mail = new PHPMailer();
$mail -> From     = $email_user_send;
$mail -> FromName = $from_name;

$mail -> AddAddress($to_email,$to_name);
$mail -> Subject	= $subject;
$mail -> Body		= $body_html;
$mail -> AltBody	= $body_text;
$mail -> IsHTML (true);

$mail->IsSMTP();
$mail->Host = 'ssl://smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPAuth		= true;
//$mail->SMTPDebug	= true;
$mail->Username = $email_user_send;
$mail->Password = $email_pass_send;

$mail->Send();
$mail->ClearAddresses();


}
### FUNCTION SEND MAIL ####


#### เวลาเรียกใช้เรียกเป็น Function แบบนี้ #####
//$to_name			="ชื่อของผู้สมัคร";	//1
//$to_email			="nobikung1@hotmail.com";	//2
$from_name			="RBRU ระบบรับสมัครบุคคลเข้าศึกษา ม.ราชภัฏรำไพพรรณี";
$email_user_send	="akalak.s@rbru.ac.th";
$email_pass_send	="";
$subject			="แจ้งสถานะผู้สมัคร ที่ทำการสมัครผ่านระบบ Online";
//$body_html			="เนื้อหาเป็น HTML";	//3
$body_text			="เนื้อหาเป็น Text ธรรมดา";

admitrbru_sendmail($to_name,$to_email,$from_name,$email_user_send,$email_pass_send,$subject,$body_html,$body_text);

//echo "ส่ง email แจ้งผลการตรวจหลักฐานเรียบร้อยแล้ว";

?>