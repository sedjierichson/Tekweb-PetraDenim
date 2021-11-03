<?php

session_start();

require $_SERVER['DOCUMENT_ROOT']."/rucas.co/conn.php";

header("Content-Type: application/json");


function uploadFileAttachment() {

	if (!empty($_FILES['files']['name'][0])) {
		$files = $_FILES['files'];
		$uploaded = array();
		$failed = array();
		$allowed = array('jpeg', 'jpg', 'png');
		$error_msg = '';

		$file_name_new = array();
		$error = 0;

		foreach ($files['name'] as $position => $file_name) {
			$file_tmp = $files['tmp_name'][$position];
			$file_size = $files['size'][$position];
			$file_error = $files['error'][$position];

			$file_ext = explode('.', $file_name);
			$file_ext = strtolower(end($file_ext));

			$ori_file_name = explode('.', $file_name);
			$ori_file_name = (current($ori_file_name));

			if (in_array($file_ext, $allowed)) {
				if ($file_error === 0) {
					if ($file_size <= 2097152) {
						$rand_file_name = uniqid('', true) . '.' . $file_ext;
						$file_destination = 'tmp/' . $rand_file_name;

						if (move_uploaded_file($file_tmp, $file_destination)) {
							$uploaded[$position] = $file_destination;

							//$file_name_new[$position] = '<img src="tmp/';
							$file_name_new[$position] = $rand_file_name;
							//$file_name_new[$position] .= '"></img>';
							//$file_name_new[$position] .= '<i style = "text-align: center; display:block;">';
							//$file_name_new[$position] .= $ori_file_name;
							//$file_name_new[$position] .= '</i>';

						} else {
							$failed[$position] = "[{$file_name}] failed to upload!";
							$error = 1;
						}
					} else {
						$failed[$position] = "[{$file_name}] is too large!";
						$error = 1;
					}
				} else {
					$failed[$position] = "[{$file_name}] errored with code {$file_error}";
					$error = 1;
				}

			} else {
				$failed[$position] = "[{$file_name}] file extension '{$file_ext}' is not allowed";
				$error = 1;
			}
		}

		if ($error == 0) {
			return $file_name_new;

		} elseif ($error == 1) {
			$error_msg = implode("<br>", $failed);
			echo '<span style="color: red;">'.$error_msg."</span>";
			return false;
		}
	}
	return -1;
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $size = $_POST['size'];
  $desc = $_POST['desc'];
  $files = uploadFileAttachment();
  if($name == ''|| $price==''||$size==''|| $desc==''|| $files == ''){
  	 $result['status'] = 2;
     $result['message'] = 'You must fill all data!';
  }else{
  	$result = array(
    'status' => 1,
    'message' => ''
  );


  if ($files == false) {
    $result['status'] = 2;
    $result['message'] = $files;

  } else {
    $resultt = implode(" ", $files);

    $query = "INSERT INTO `barang` VALUES (DEFAULT, ?, ?, ?, ?, ?, ?, ?, DEFAULT)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([ $name, $price, $size, $desc, $files[0], $files[1], $files[2]]);

		$query = "SELECT MAX(id) AS `id` FROM `barang`";
		$stmt = $pdo->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch();

		$query = "INSERT INTO `detail_item_gudang` VALUES (DEFAULT, 1, ?, 0)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$row['id']]);

		$query = "INSERT INTO `detail_edit_barang` VALUES (DEFAULT, ?, ?, NOW(), 'add')";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$row['id'], $_SESSION['admin_id']]);


    // foreach ($files as $file) {
    //   $query = "INSERT INTO `barang` VALUES (DEFAULT, ?, ?, ?, ?, DEFAULT, DEFAULT, DEFAULT, DEFAULT)";
    //   $stmt = $pdo->prepare($query);
    //   $stmt->execute([ $name, $price, $size, $desc]);
    // }

    $result['status'] = 1;
    $result['message'] = "You have successfuly add data!";   
  	}
  }
  echo json_encode($result);





} else {

  header("HTTP/1.1 400 Bad Request");
  $error = array(
    'error' => 'Method not Allowed'
  );

  echo json_encode($error);

}
