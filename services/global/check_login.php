<?php
require $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

header("Content-Type: application/json");

session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $email = $_POST['email'];
  $password = $_POST['password'];
  $remember_me = $_POST['remember_me'];

  $result = array(
    'status' => 0,
    'message' => ''
  );

  if ($email == '' || $password == '') {
    $result['status'] = 0;
    $result['message'] = 'You must enter a value';
  } else {
    //cek admin

    $query1 = "SELECT * FROM admin WHERE email = ? AND status = 1";
    $stmt = $pdo->prepare($query1);
    $stmt->execute([$email]);

    if ($stmt->rowCount() != 0) { //jika di dalam database ada data yg diinputkan, maka kode akan dieksekusi
      $stmt->execute();
      $row = $stmt->fetch();

      if (password_verify($password, $row['password'])) {
        $_SESSION['name'] = $row['nama'];
        $user_id = $row['id'];

        $_SESSION['authorization'] = 'Admin';
        $_SESSION['admin_id'] = $user_id;

        if ($_POST['remember_me'] == 1) {
          setcookie('key', $user_id, time() + (3600*24*2) , '/rucas.co/login.php');
          setcookie('username', hash('sha256', $email), time() + (3600*24*2), '/rucas.co/login.php');
          setcookie('role', 'admin', time() + (3600*24*2) , '/rucas.co/login.php');
        }

        $result['status'] = 1;
        $result['message'] = "admin_page.php";
      } else {
        $result['status'] = 0;
        $result['message'] = 'Wrong username or password';
      }

    } else {

      //cek user
      $query2 = "SELECT * FROM customer WHERE email = ?";
      $stmt = $pdo->prepare($query2);
      $stmt->execute([$email]);

      if ($stmt->rowCount() != 0) {
        //$stmt->execute();
        $row = $stmt->fetch();

        if (password_verify($password, $row['password'])) {
          $_SESSION['name'] = $row['nama'];
          $user_id = $row['id'];

          $_SESSION['authorization'] = 'Customer';
          $_SESSION['cust_id'] = $user_id;

          if ($_POST['remember_me'] == 1) {
            setcookie('key', $user_id, time() + (3600*24*2), '/rucas.co/login.php');
            setcookie('username', hash('sha256', $email), time() + (3600*24*2), '/rucas.co/login.php');
            setcookie('role', 'cust', time() + (3600*24*2), '/rucas.co/login.php');
          }
          $result['status'] = 1;
          $result['message'] = "shop.php";

        } else {
          $result['status'] = 0;
          $result['message'] = 'Wrong username or password';
        }

      } else {
        $result['status'] = 0;
        $result['message'] = 'Wrong username or password';
      }


    }
  }

  echo json_encode($result);

} else {

  header("HTTP/1.1 400 Bad Request");
  $error = array('error' => 'Method not allowed');

  echo json_encode($error);
}
