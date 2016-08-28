<?php
//buat tes di postmannn
require_once 'Functions.php';

$fun = new Functions();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $email = "anyar@mail.com";
  echo $fun ->getListPosts($email);
  
}
else if ($_SERVER['REQUEST_METHOD'] == 'GET'){

  echo "Learn2Crack Login API";

}
