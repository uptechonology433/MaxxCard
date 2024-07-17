<?php
	// header("Access-Control-Allow-Origin: *");
	// header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
	// header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization");
	// header("Access-Control-Allow-Headers: X-Requested-With, Content-Type");
	// header("Access-Control-Max-Age: 10000");
    
	require_once './vendor/autoload.php';
    require_once './env.php';
    require_once './src/slimConfiguration.php';
    require_once './src/jwtAuth.php';
    require_once './src/routes/index.php';

?>