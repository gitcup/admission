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
//�������� username ��� password �Ҥú�ֻ���
if(($username&&$passw0rd)== ""){
?>
<script type="text/javascript">
	alert("��سҡ�͡ Username ���� Password ���ú");
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


	//����� username ��ҡѺ user ����к������������
	if(($username == $admin)||($username == $admin2)||($username == $admin3)||($username == $admin4)||($username == $admin5)||($username == $admin6)||($username == $admin7) ||($username == $admin8) ||($username == $admin9)){
		$sql = "SELECT * FROM radcheck 
				WHERE username = '$username' ";
			//	AND password = '$passw0rd' ";
				
		$dbquery = mysql_query($sql);
		$num_rows = mysql_num_rows($dbquery);
		
		//����� username ��� password ����Ҷ١��ͧ�ֻ���
		if($num_rows > 0){
			$result = mysql_fetch_array($dbquery);
			$_SESSION["username"] = $result[username];
			
			echo "<meta http-equiv=\"refresh\"content=\"0;url=index.php?p=frmApplicant_paytrue\">";
		}else{
			?>
			<script type="text/javascript">
				alert("Username ���� Password ���١��ͧ");
			</script>
			<meta http-equiv="Refresh" content="0;URL=index.php" />
			<?
		}
	//�ҡ��� username �����ç�Ѻ�Է��� admin ����к��������͡�ҡ�к�
	}else{
		?>
		<script type="text/javascript">
			alert("�س������Ѻ�Է���㹡������к� ����Ѻ�������к���ҹ��");
		</script>
		<meta http-equiv="Refresh" content="0;URL=index.php?p=login" />
		<?
	}
}
?>
</body>
</html>