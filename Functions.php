<?php

require_once 'DBOperations.php';

class Functions{

private $db;

public function __construct() {

      $this -> db = new DBOperations();

}

public function registerUser($name, $email, $password) {

   $db = $this -> db;

   if (!empty($name) && !empty($email) && !empty($password)) {

      if ($db -> checkUserExist($email)) {

         $response["result"] = "failure";
         $response["message"] = "User Already Registered !";
         return json_encode($response);

      } else {

         $result = $db -> insertData($name, $email, $password);

         if ($result) {

              $response["result"] = "success";
            $response["message"] = "User Registered Successfully !";
            return json_encode($response);

         } else {

            $response["result"] = "failure";
            $response["message"] = "Registration Failure";
            return json_encode($response);

         }
      }
   } else {

      return $this -> getMsgParamNotEmpty();

   }
}

public function loginUser($email, $password) {

  $db = $this -> db;

  if (!empty($email) && !empty($password)) {

    if ($db -> checkUserExist($email)) {

       $result =  $db -> checkLogin($email, $password);

       if(!$result) {

        $response["result"] = "failure";
        $response["message"] = "Invaild Login Credentials";
        return json_encode($response);

       } else {

        $response["result"] = "success";
        $response["message"] = "Login Sucessful";
        $response["user"] = $result;
        return json_encode($response);

       }
    } else {

      $response["result"] = "failure";
      $response["message"] = "Invaild Login Credentials";
      return json_encode($response);

    }
  } else {

      return $this -> getMsgParamNotEmpty();
    }
}

public function changePassword($email, $old_password, $new_password) {

  $db = $this -> db;

  if (!empty($email) && !empty($old_password) && !empty($new_password)) {

    if(!$db -> checkLogin($email, $old_password)){

      $response["result"] = "failure";
      $response["message"] = 'Invalid Old Password';
      return json_encode($response);

    } else {

    $result = $db -> changePassword($email, $new_password);

      if($result) {

        $response["result"] = "success";
        $response["message"] = "Password Changed Successfully";
        return json_encode($response);

      } else {

        $response["result"] = "failure";
        $response["message"] = 'Error Updating Password';
        return json_encode($response);

      }
    }
  } else {

      return $this -> getMsgParamNotEmpty();
  }
}

public function isEmailValid($email){

  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

public function getMsgParamNotEmpty(){

  $response["result"] = "failure";
  $response["message"] = "Parameters should not be empty !";
  return json_encode($response);

}

public function getMsgInvalidParam(){

  $response["result"] = "failure";
  $response["message"] = "Invalid Parameters";
  return json_encode($response);

}

public function getMsgInvalidEmail(){

  $response["result"] = "failure";
  $response["message"] = "Invalid Email";
  return json_encode($response);

}

public function insertPost($email, $title, $newspost){
  $db = $this -> db;
  if(!empty($email) && !empty($title) && !empty($newspost)){

    $result = $db -> insertPost($email, $title, $newspost);
    // $result = true;
    if($result) {
      $response["result"] = "success";
      $response["message"] = "News posted!";
      return json_encode($response);
    } else {
      $response["result"] = "failure";
      $response["message"] = "Cannot posting news!";
      return json_encode($response);
    }
  } else {
    return $this -> getMsgParamNotEmpty();
  }

}

public function getListPosts($email){
  $db = $this -> db;
  if(!empty($email)){
    $result = $db -> getListPosts($email);

    // $response["result"] = "success";
    // $response["message"] = "sakses";
    // $response["posts"] = $result;
    // return json_encode($response);

    if($result){
      $response["result"] = "success";
      $response["message"] = "List post!";
      $response["posts"] = $result;
      return json_encode($response);
    } else {
      $response["result"] = "failed";
      $response["message"] = "cannot get list post!";
      return json_encode($response);
    }
  }
}


}
