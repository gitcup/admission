<?
		
		if ( $_SESSION["username"] == true )
		{
		unset ($_SESSION ['username']);
		//unset ($_SESSION ['sess_chkstatus']);
		session_destroy ();
		
		}
		
?>
<meta http-equiv="Refresh" content="0;URL=index.php" />