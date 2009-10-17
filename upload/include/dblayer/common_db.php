<?php

/*---

	Copyright (C) 2008-2009 FluxBB.org
	based on code copyright (C) 2002-2005 Rickard Andersson
	License: http://www.gnu.org/licenses/gpl.html GPL version 2 or higher

---*/

// Make sure no one attempts to run this script "directly"
if (!defined('PUN'))
	exit;


//
// Return current timestamp (with microseconds) as a float (used in dblayer)
//
if (defined('PUN_SHOW_QUERIES'))
{
	function get_microtime()
	{
		list($usec, $sec) = explode(' ', microtime());
		return ((float)$usec + (float)$sec);
	}
}


// Load the appropriate DB layer class
switch ($db_type)
{
	case 'mysql':
		require PUN_ROOT.'include/dblayer/mysql.php';
		break;

	case 'mysql_innodb':
		require PUN_ROOT.'include/dblayer/mysql_innodb.php';
		break;

	case 'mysqli':
		require PUN_ROOT.'include/dblayer/mysqli.php';
		break;

	case 'mysqli_innodb':
		require PUN_ROOT.'include/dblayer/mysqli_innodb.php';
		break;

	case 'pgsql':
		require PUN_ROOT.'include/dblayer/pgsql.php';
		break;

	case 'sqlite':
		require PUN_ROOT.'include/dblayer/sqlite.php';
		break;

	default:
		error('\''.$db_type.'\' is not a valid database type. Please check settings in config.php.', __FILE__, __LINE__);
		break;
}


// Create the database adapter object (and open/connect to/select db)
$db = new DBLayer($db_host, $db_username, $db_password, $db_name, $db_prefix, $p_connect);
