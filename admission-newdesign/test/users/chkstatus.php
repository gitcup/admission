<? 
session_start();
$username = $_POST["username"];
$passw0rd = $_POST["passw0rd"];

include("config-authen.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<?
//เช็คว่าใส่ username และ password มาครบรึป่าว
if(($username&&$passw0rd)== ""){
?>
<script type="text/javascript">
	alert("กรุณากรอก Username หรือ Password ให้ครบ");
</script>
<meta http-equiv="Refresh" content="0;URL=index.php" />
<?
}else{
$admin = "ladda.c";
$admin2 = "akalak.s";
$admin3 = "sarawadee.s";
$admin9 = "chaiyasit.k";
$admin4 = "sirilak.c";
$admin5 = "amornrat.l";
$admin6 = "jakrapong.s";
$admin7 = "nongluk.n";
$admin8 = "thanphisha.v";


	//เช็คว่า username เท่ากับ user ที่ระบุไว้หรือเปล่า
	if(($username == $admin)||($username == $admin2)||($username == $admin3)||($username == $admin4)||($username == $admin5)||($username == $admin6)||($username == $admin7) ||($username == $admin8) ||($username == $admin9)){
		$sql = "SELECT * FROM radcheck 
				WHERE username = '$username' ";
			//	AND password = '$passw0rd' ";
				
		$dbquery = mysql_query($sql);
		$num_rows = mysql_num_rows($dbquery);
		
		//เช็คว่า username และ password ใส่มาถูกต้องรึป่าว
		if($num_rows > 0){
			$result = mysql_fetch_array($dbquery);
			$_SESSION["username"] = $result[username];
			
			echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmApplicant_paytrue\">";
		}else{
			?>
			<script type="text/javascript">
				alert("Username หรือ Password ไม่ถูกต้อง");
			</script>
			<meta http-equiv="Refresh" content="0;URL=index.php" />
			<?
		}
	//หากใส่ username มาไม่ตรงกับสิทธิ์ admin ที่ระบุไว้ให้ออกจากระบบ
	}else{
		?>
		<script type="text/javascript">
			alert("คุณไม่ได้รับสิทธิ์ในการเข้าระบบ สำหรับผู้ดูแลระบบเท่านั้น");
		</script>
		<meta http-equiv="Refresh" content="0;URL=index.php?p=login" />
		<?
	}
}
?>
</body>
</html>