<?php

$config = array(
  'name_blog' => 'Water <br> Geography <br> Life <hr>',
  'title' => 'Water Geography Life',
  'f_b' => 'http://facebook.com',

  'db' => array(
          'server' => 'localhost',
          'username' => 'Podobed',
          'password' => '6568238',
          'name' => 'Blog'
    )
    );

    $connection = mysqli_connect(
     $config['db']['server'],
      $config['db']['username'],
      $config['db']['password'],
      $config['db']['name']
    );

    if($connection == false)
    {
      echo "Не удалось подключиться к базе данных!!<br>";
      echo mysqli_connect_error();
      exsit();
    }

    ?>
