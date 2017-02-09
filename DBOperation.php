<?php
class DBOperations {
  private $host = '127.0.0.1';
  private $user = 'root';
  private $db = 'web-sec-login';
  private $pass = '';
  private $conn;


  public function __construct() {
    $this -> conn = new PDO("mysql:host=".$this -> host.";dbname=".$this -> db, $this -> user, $this -> pass);
  }

  public function insertData($username,$password){

    $unique_id = uniqid('', true);
    $hash = $this->getHash($password);
    $encrypted_password = $hash["encrypted"];
    $salt = $hash["salt"];

    $sql = 'INSERT INTO users SET uid =:uid,username =:username,encrypted_password =:encrypted_password,salt =:salt,created_at = NOW()';

    $query = $this ->conn ->prepare($sql);
    $query->execute(array('uid' => uid, ':username' => $username,
     ':encrypted_password' => $encrypted_password, ':salt' => $salt));
    if ($query) {
        return true;
    } else {
        return false;
    }
  }




}



?>
