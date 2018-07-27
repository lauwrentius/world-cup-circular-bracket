<?php
ini_set("display_errors",1);
require 'Slim/Slim.php';
require_once('PhpConsole/__autoload.php');

// include "../../../inc/dbinfo.inc";

// function debug( $msg ){
// 	$handler = PhpConsole\Handler::getInstance();
//
// 	if( !$handler->isStarted())
// 		$handler->start();
//
// 	$handler->debug( $msg );
// }
function PST(){
	date_default_timezone_set('America/Los_Angeles');
	return (new DateTimeZone("America/Los_Angeles"))->getOffset(new DateTime());
}

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$req = $app->request();


$app->get('/', function() use($app){
	echo "WC Brackets API HOME";
	// echo getConnection();
});

$app->get('/teams', function() use ($app) {

	$sql_query = "SELECT * FROM teams ORDER BY name;";


	try {
		$users = [];
		$db = getConnection();
		$stmt = $db->query($sql_query);

		do{
			$arr = [];
			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
				$arr[ reset($row) ] = $row;
			}
			array_push( $users, $arr);

		}while( $stmt->nextRowset() );
		$db = null;
		echo json_encode($users, JSON_NUMERIC_CHECK);
	}
	catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
});




$app->run();

function getConnection() {
	try {
		$conn = new PDO('mysql:host=lmdb.celmatwbtx0m.us-west-2.rds.amazonaws.com;dbname=wc-brackets', 'lauwrentius', 'LAuwrent1us');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}
	return $conn;
}
?>
