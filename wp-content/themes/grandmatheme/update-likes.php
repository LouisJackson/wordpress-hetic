<?php
require 'inc/database.php';

$ip_address = $_SERVER['REMOTE_ADDR'];

$queryIp = $pdo->query("SELECT * FROM ip_likes WHERE post_id = '". $_POST['tipId'] ."' AND ip_address = '". $ip_address ."'");
$resultIp = $queryIp->fetch();

$query = $pdo->query("SELECT * FROM wp_postmeta WHERE post_id = '". $_POST['tipId'] ."' AND meta_key = 'likes'");
$result = ($query->fetch()->meta_value);

if (empty($resultIp)){
	if (isset($_POST['tipId']) && !empty($_POST['tipId'])){
		$result = $result + 1;

		$insertLikeQuery = $pdo->prepare("UPDATE wp_postmeta SET meta_value = '". $result ."' WHERE post_id = :post_id AND meta_key = 'likes'");
		$insertLikeQuery->bindValue(':post_id', $_POST['tipId']);
		$insertLikeQuery->execute();

		$insertIpQuery = $pdo->prepare("INSERT INTO ip_likes (post_id, ip_address) VALUES (:post_id, :ip_address)");
		$insertIpQuery->bindValue(':post_id', $_POST['tipId']);
		$insertIpQuery->bindValue(':ip_address', $ip_address);
		$insertIpQuery->execute();

		echo $result;
	}
}

else {
	echo $result;
}