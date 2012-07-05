<?php
ob_start();
session_start();
if($_SESSION['admin_id']=="")
{
	header("location:index.php");
}
require("../config.inc.php");
require("../class/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);			
$db->connect();
  
if($_REQUEST['srchstr']!="")
{
	$where=" where first_name like '%$_REQUEST[srchstr]%' or last_name like '%$_REQUEST[srchstr]%' or email like '%$_REQUEST[srchstr]%'";
}
elseif(($_REQUEST['date_from']!="") && ($_REQUEST['date_to']!=""))
{		
	$date_from=strftime("%Y-%m-%d", strtotime($_REQUEST['date_from']));
	$date_to=strftime("%Y-%m-%d", strtotime($_REQUEST['date_to']));		
	$where=" where date_added between '$date_from' and '$date_to'";		
}
elseif(($_REQUEST['date_from']!="") && ($_REQUEST['date_to']==""))
{		
	$date_from=strftime("%Y-%m-%d", strtotime($_REQUEST['date_from']));
	$where=" where date_added>='$date_from'";		
}
elseif(($_REQUEST['date_from']=="") && ($_REQUEST['date_to']!=""))
{		
	$date_to=strftime("%Y-%m-%d", strtotime($_REQUEST['date_to']));		
	$where=" where date_added<='$date_to'";		
}
else
{
	$where="";
}

  $query="select first_name as `First Name`,last_name AS `Last Name`,email as `Email`,address1 as `Address 1`,address2 as `Address2`,city as `City`,state as `State`,country as `Country`,zip as `Postal Code`,date_added as `Registration Date` from ".TABLE_USERS."$where";
  
  $result = mysql_query( $query) or die(mysql_error());
  
  $file_name=date("Y_m_d_h_i:s");
  
  header( 'Content-Type: text/csv' );
  header( "Content-Disposition: attachment;filename=$file_name.csv" );
  $row = mysql_fetch_assoc( $result );
  if ( $row )
  {
    echocsv( array_keys( $row ) );
  }
  while ( $row )
  {
    echocsv( $row );
    $row = mysql_fetch_assoc( $result );
  }

  function echocsv( $fields )
  {
    $separator = '';
    foreach ( $fields as $field )
    {
      if ( preg_match( '/\\r|\\n|,|"/', $field ) )
      {
        $field = '"' . str_replace( '"', '""', $field ) . '"';
      }
      echo $separator . $field;
      $separator = ',';
    }
    echo "\r\n";
  }
?>