<?php

define('DB_SERVER_NAME', 'DESKTOP-EA85AVT\\JPSERVER');
define('DB_USERNAME', 'sa');
define('DB_PASSWORD', '4000code');
define('DB_NAME', 'test_db');

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
// $connectionInfo = array("Database" => "test_db", "UID" => "sa", "PWD" => "4000code");
// $conn = sqlsrv_connect($serverName, $connectionInfo);

// if ($conn) {
//   echo "Connection established.<br />";
// } else {
//   echo "Connection could not be established.<br />";
//   die(print_r(sqlsrv_errors(), true));
// }

try {
  $pdoString = "sqlsrv:Server=" . DB_SERVER_NAME . ";Database=" . DB_NAME . "";
  $conn = new PDO($pdoString, DB_USERNAME, DB_PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die('Error connecting to SQL server: ' . $e->getMessage());
}

// $sql = "SELECT * FROM TBLPosts";
// $params = [];
// $options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
// $stmt = sqlsrv_query($conn, $sql, $params, $options);
// $row_count = sqlsrv_num_rows($stmt);

// echo "<table>";
// while ($row = sqlsrv_fetch_array($stmt)) {
//   echo "<tr>";
//   echo "<td>" . $row->title . '</td>';
//   echo "</tr>";
// }
// echo "</table>";

// sqlsrv_close($conn);

// ** INSERT INTO entries
// $title = "Programming PHP 2";
// $description = "Learn to program and database technologies tech 2!";
// $excerpt = 'Learn to live it, move to IT 2';
// // insert new
// $SQL = "INSERT INTO TBLPosts(title, description, excerpt, created_at, updated_at) VALUES(?, ?, ?, ?, ?)";
// $params = [&$title, &$description, &$excerpt, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')];
// $query = $conn->prepare($SQL);
// $insert = $query->execute($params);
// if($insert) {
//   print "awesome!";
// } else {
//   print "Nope!";
// }

// ** UPDATE
// $title = "Programming PHP 2 - update";
// $description = "Learn to program and database technologies tech 2! - update";
// $excerpt = 'Learn to live it, move to IT 2 - update';
// // insert new
// $SQL = "UPDATE TBLPosts SET title = ?, description = ?, excerpt = ?, updated_at = ? WHERE id = ?";
// $params = [$title, $description, $excerpt, date('Y-m-d H:i:s'), 3];
// $query = $conn->prepare($SQL);
// $update = $query->execute($params);
// if ($update) {
//   print $update;
//   print "awesome!";
// } else {
//   print "Nope!";
// }

// ** DELETE
// $SQL = "DELETE FROM TBLPosts WHERE id = ?";
// $query = $conn->prepare($SQL);
// $delete = $query->execute([3]);
// if ($delete) {
//   print $delete;
//   print "awesome!";
// } else {
//   print "Nope!";
// }

// ** RETRIEVE
$SQL = "SELECT * FROM TBLPosts ORDER BY id DESC";
$query = $conn->prepare($SQL);
$query->execute();
$posts = $query->fetchAll(PDO::FETCH_ASSOC);

echo "<table border=1>";
foreach($posts as $post) {
  echo "<tr>";
    echo "<td>{$post['title']}</td>";
    echo "<td>{$post['description']}</td>";
    echo "<td>{$post['excerpt']}</td>";
  echo "</tr>";
}
echo "</table>";

