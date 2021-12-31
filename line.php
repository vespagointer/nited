<?php

header('Access-Control-Allow-Origin: *.line.me');
//header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
//header('Access-Control-Allow-Headers: X-Requested-With');

/*
$data = '{"status":200,"message":"ok"}';
$bit = json_decode($data, true, 512, JSON_OBJECT_AS_ARRAY);
print_r($bit);
echo $bit["status"];
 */
//
$client_id = "KHaVVejadzlgPueKNlWkop";
$client_secret="Sh43jUi9wbUI7qbTK1FyxS4quSIkXhPkY0BpOinWsgw";
$redirect_uri = "https://nited.spmnan.go.th/line.php";
$redirect_uri2 = "https://nited.spmnan.go.th/token.php";
$state = "spmnan";
$url = "https://notify-bot.line.me/oauth/authorize?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri&scope=notify&state=$state";

if (isset($_GET["code"])) {
 $code = $_GET["code"];
 $state = $_GET["state"];
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Get Line Notify</title>
</head>


<body>
    <?php if(!isset($code)) : ?>
    <a class="btn btn-primary" href="<?=$url;?>" role="button">สมัครรับแจ้งเตือนทาง Line</a>
    <? endif ?>
    <?php
    if(isset($code)){
        $postData = array(
            "grant_type"=> "authorization_code",
            "code"=> "$code",
            "redirect_uri"=> "$redirect_uri",
            "client_id"=> "$client_id",
            "client_secret"=>"$client_secret"
        );
        $ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://notify-bot.line.me/oauth/token");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($postData));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);
$response = json_decode($server_output, true, 512, JSON_OBJECT_AS_ARRAY);
if($response["Status"] == 200){
    $token=$response["access_token"];
}
print_r($response);
    }

?>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>