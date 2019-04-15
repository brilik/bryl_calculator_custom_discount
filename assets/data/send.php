<?php
$res = urldecode($_POST['res']);
$price = urldecode($_POST['price']);
$discount = urldecode($_POST['discount']);
$select = urldecode($_POST['select']);

$sendto = urldecode($_POST['mailto']);
$cururl = $_POST['url'];

$error[] = '';
$status = true;

if (!isset($res)) {
    $status = false;
	echo $res;
	echo "<br>";
}
if (!isset($price)) {
    $status = false;
	echo $price;
	echo "<br>";
}
if (!isset($discount)) {
    $status = false;
	echo $discount;
	echo "<br>";
}
if (!isset($select)) {
    $status = false;
	echo $select;
	echo "<br>";
}

$to = $sendto;
$from = "fei.loc@gmail.com";
$subject = "Calculator custom for FirstVoip.";
$boundary = "---"; //Разделитель

$message = "Calculator: \r\n";
$message .= "Choosed count phones: " . $select . ". \r\nFormula: " . $price . " + ( " . $price . " - " . $discount . " * " . $price . " ) = " . $res;
$boundary = "---";

$headers = "From: $from\nReply-To: $from\n";
$headers .= "Content-Type: multipart/mixed; boundary='. $boundary .'";

$body = "--$boundary\n";
$body .= $message . "\n";
$body .= "--" . $boundary . "--\n";

if ($status) {
    $status = mail($to, $subject, $body, $headers);
    $status = 'Сообщение успешно отправлено!';
} else {
    $status = 'При отправке сообщения возникли ошибки!';
}

echo $status;