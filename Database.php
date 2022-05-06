<?php
  define('ROOT_URL', 'http://localhost/wotr/');
  define('BD_HOST', 'localhost');
  define('BD_USER', 'root');
  define('BD_PASS', '');
  define('BD_NAME', 'wotr');

  $conn = mysqli_connect(BD_HOST, BD_USER, BD_PASS, BD_NAME);

  if(mysqli_connect_errno()){
    echo 'Failed to connect to mysql '. mysqli_connect_errno();
  }