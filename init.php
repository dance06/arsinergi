<?php
	$CONF_CONTACTEMAIL = '';
	$CONF_CONTACTBILLINGEMAIL = '';
	$CONF_CONTACTSUPPORTEMAIL = '';
	$CONF_CONTACTINFOEMAIL = '';

	$GLOBAL_WEB_PATH_ONLINE    = 'http://arsinergi.net/arsinergi';
	$GLOBAL_DBASE_HOST_ONLINE  = 'localhost';
	$GLOBAL_DBASE_NAME_ONLINE  = 'arsinerg_dbase';
	$GLOBAL_DBASE_USER_ONLINE  = 'arsinerg_usr';
	$GLOBAL_DBASE_PASS_ONLINE  = 'F22O]l7A@=k%';

	$GLOBAL_WEB_PATH_OFFLINE   = 'http://localhost/arsinergi/';
	$GLOBAL_DBASE_HOST_OFFLINE = 'localhost';
	$GLOBAL_DBASE_NAME_OFFLINE = 'arsinergi';
	$GLOBAL_DBASE_USER_OFFLINE = 'root';
	$GLOBAL_DBASE_PASS_OFFLINE = 'root';

	$GLOBAL_ERRORCODE01    = 'Server error code 01 : unable to connect to MySQL Server.';
	$GLOBAL_ERRORCODE02    = 'Server error code 02 : unable to connect to database';
	$GLOBAL_ERRORCODE03    = 'Server error code 03 : unable to execute specified query.';
	$GLOBAL_ERRORCODE04    = 'Server error code 04 : no record found.';

	if (substr($_SERVER['HTTP_HOST'],0,9)=='localhost')
	{
		$GLOBAL_STATUS_WEB   = 'offline';
		$GLOBAL_STATUS_DBASE = 'offline';
	}
	else
	{
		$GLOBAL_STATUS_WEB   = 'online';
		$GLOBAL_STATUS_DBASE = 'online';
	}

	if ($GLOBAL_STATUS_WEB == 'offline')
	{
		$GLOBAL_WEB_PATH    = $GLOBAL_WEB_PATH_OFFLINE;
		$GLOBAL_DBASE_HOST  = $GLOBAL_DBASE_HOST_OFFLINE;
		$GLOBAL_DBASE_NAME  = $GLOBAL_DBASE_NAME_OFFLINE;
		$GLOBAL_DBASE_USER  = $GLOBAL_DBASE_USER_OFFLINE;
		$GLOBAL_DBASE_PASS  = $GLOBAL_DBASE_PASS_OFFLINE;
	}
	else
	{
		$GLOBAL_WEB_PATH    = $GLOBAL_WEB_PATH_ONLINE;
		$GLOBAL_DBASE_HOST  = $GLOBAL_DBASE_HOST_ONLINE;
		$GLOBAL_DBASE_NAME  = $GLOBAL_DBASE_NAME_ONLINE;
		$GLOBAL_DBASE_USER  = $GLOBAL_DBASE_USER_ONLINE;
		$GLOBAL_DBASE_PASS  = $GLOBAL_DBASE_PASS_ONLINE;
	}

	$conn=mysqli_connect($GLOBAL_DBASE_HOST,$GLOBAL_DBASE_USER,$GLOBAL_DBASE_PASS) or die ($GLOBAL_ERRORCODE01);
	mysqli_select_db($conn, $GLOBAL_DBASE_NAME) or die ($GLOBAL_ERRORCODE02);

	session_start();
?>
