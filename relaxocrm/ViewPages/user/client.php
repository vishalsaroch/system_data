<?php
$host    = "127.0.0.1";
$port    = 25004;
$message = "Hello Host";
echo "Message To Host :".$message;
// create socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
// connect to Host
$result = socket_connect($socket, $host, $port) or die("Could not connect to Host\n");
// send string to Host
socket_write($socket, $message, strlen($message)) or die("Could not send data to Host\n");
// get Host response
$result = socket_read ($socket, 1024) or die("Could not read Host response\n");
echo "<br> Reply From Host  :".$result;
// close socket
socket_close($socket);
?>