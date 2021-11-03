<?php

session_start();

require $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

//var_dump($_COOKIE['shopping_cart']);

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $result = array(
    "status" => 0,
    "message" => "Error"
  );

  if (isset($_COOKIE["shopping_cart"])) {
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
  } else {
    $cart_data = array();
  }

  $id = $_POST['id'];
  $qty = $_POST['qty'];
  $action = $_POST['action'];
  $item_id_list = array_column($cart_data, 'item_id');
  $item_name_list = array_column($cart_data, 'owner');

  $query = "SELECT * FROM barang WHERE id = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$id]);

  $row = $stmt->fetch();

  if ($action == 'delete') {
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $keys => $values) {
      if($cart_data[$keys]['item_id'] == $id && $cart_data[$keys]['owner'] == $_SESSION['name']) {
        unset($cart_data[$keys]);
        $item_data = json_encode($cart_data);
        setcookie("shopping_cart", $item_data, time() + (3600*24*2));
      }
    }
  } else {
    if (in_array($_SESSION['name'], $item_name_list)) {

      if (in_array($id, $item_id_list)) {
        $check = false;
        foreach ($cart_data as $keys => $values) {
          if($cart_data[$keys]["item_id"] == $id && $cart_data[$keys]["owner"] == $_SESSION['name']) {
            if ($qty == -1) {

              // $select_current_qty_query = "SELECT qty FROM `detail_item_gudang` WHERE id_barang = ?";
              // $stmt = $pdo->prepare($select_current_qty_query);
              // $stmt->execute([$id]);
              // if ($stmt->fetch()['qty'] < $qty) {
              //   $result['status'] = 0;
              //   $result['message'] = $cart_data[$keys]["item_quantity"];
              // } else {
              //   $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + 1;
              //   $result['message'] = $cart_data[$keys]["item_price_acc"] = $cart_data[$keys]["item_price_acc"] + $row['harga'];
              // }

              $result['status'] = 0;
              $result['message'] = "Item already in the shopping cart";
              $check = true;

            } else {

              $select_current_qty_query = "SELECT qty FROM `detail_item_gudang` WHERE id_barang = ?";
              $stmt = $pdo->prepare($select_current_qty_query);
              $stmt->execute([$id]);

              if ($stmt->fetch()['qty'] < $qty) {
                $result['status'] = 0;
                $result['message'] = $cart_data[$keys]["item_quantity"];
              } else {
                $result['status'] = 1;
                $cart_data[$keys]["item_quantity"] = $qty;
                $result['message'] = $cart_data[$keys]["item_price_acc"] = $row['harga'] * $qty;
              }

              $check = true;
            }
          }
        }

        if ($check == false) {
          $result['message'] = "new shopping cart";
          $item_array = array(
            'owner' => $_SESSION['name'],
            'item_id'   => $row["id"],
            'item_name' => $row["nama"],
            'item_price' => $row["harga"],
            'item_price_acc'=> $row["harga"],
            'item_quantity' => 1
          );
          $cart_data[] = $item_array;
          $result['status'] = 1;
        }


      } else {
        $result['message'] = "new shopping cart";
        $item_array = array(
          'owner' => $_SESSION['name'],
          'item_id'   => $row["id"],
          'item_name' => $row["nama"],
          'item_price' => $row["harga"],
          'item_price_acc'=> $row["harga"],
          'item_quantity' => 1
        );
        $cart_data[] = $item_array;
        $result['status'] = 1;
      }
    } else {
      $result['message'] = "new member";
      $item_array = array(
        'owner' => $_SESSION['name'],
        'item_id'   => $row["id"],
        'item_name' => $row["nama"],
        'item_price' => $row["harga"],
        'item_price_acc'=> $row["harga"],
        'item_quantity' => 1
      );

      $cart_data[] = $item_array;
      $result['status'] = 1;
    }
  }


  $item_data = json_encode($cart_data);
  setcookie('shopping_cart', $item_data, time() + (3600*24*2), '/rucas.co/cart.php');
  setcookie('shopping_cart', $item_data, time() + (3600*24*2), '/rucas.co/services/customer/add-to-card.php');
  setcookie('shopping_cart', $item_data, time() + (3600*24*2), '/rucas.co/services/customer/buy-db.php');

  echo json_encode($result);

} else {
  header("HTTP/1.1 400 Bad Request");

  $error = array('error' => 'Method not allowed');

  echo json_encode($error);
}
