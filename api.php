<?php

include('config.php');

function user_exec($shell,$cmd) {
  fwrite($shell,$cmd . "\n");
  $output = "";
  $start = false;
  $start_time = time();
  $max_time = 2; //time in seconds
  while(((time()-$start_time) < $max_time)) {
    $line = fgets($shell);
    if(!strstr($line,$cmd)) {
      if(preg_match('/\[start\]/',$line)) {
        $start = true;
      }elseif(preg_match('/\[end\]/',$line)) {
        return $output;
      }elseif($start){
        $output[] = $line;
      }
    }
  }
}

function execute_remote_command($ip, $command) {
        $user = $_REMOTE_USER;
        $pass = $_REMOTE_PASS;

        $connection = ssh2_connect($ip);
        ssh2_auth_password($connection,$user,$pass);
        $shell = ssh2_shell($connection,"bash");

	if ($command == "reboot")
		$cmd = "reboot;";
	if ($command == "shutdown")
		$cmd = "sudo shutdown -h now;";
        $output = user_exec($shell,$cmd);

        fclose($shell);
}

function getStatus($ip, $port) {
        $socket = @fsockopen($ip, $port, $errorNo, $errorStr, 2);
        if (!$socket) return false;
        else return true;
    }

if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
{
sleep(1);
if ($_REQUEST['r'] == 'ping') {
	if($_REQUEST['port'] && $_REQUEST['ip']){

	    $ip = $_REQUEST['ip'];
	    $port = $_REQUEST['port'];
	    $protocol = "tcp://";

	    $handle = @fsockopen($protocol.$ip, $port, $errno, $errstr, 10);

	    if ($errstr != '')
	    {
		  echo 'offline';
	    }
	    else
	    {
		  fclose($handle);
		  echo 'online';
	    }

	}
} elseif (($_REQUEST['r'] == 'reboot') or ($_REQUEST['r'] == 'shutdown')) {
	if ($_REQUEST['ip']) {
		$ip = $_REQUEST['ip'];
		$command = $_REQUEST['r'];
		execute_remote_command($ip, $command);
		echo "done";
	} else {
		echo "error";
	}
}

} else {
    echo '..stop';
}
