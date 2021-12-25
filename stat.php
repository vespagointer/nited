<?php 
define("KRITSADAPONG", true);
require_once "conn.php";
require_once"db.php";

$sql="SELECT * FROM `tb_statistics` WHERE `name`='award'";
$result=mysqli_query($conn,$sql);

$data=mysqli_fetch_assoc($result);

unset($data["id"]);
unset($data["name"]);
ksort($data,SORT_NUMERIC);
arsort($data);
//var_dump($data);
$count=1;
foreach($data as $key => $val){
	$labels[]= getschool($conn,"name",substr($key,2));
	$cData[]=$val;
	if($count==5)break;
	$count++;
}
echo json_encode($labels,JSON_UNESCAPED_UNICODE);

 ?>
 
<!DOCTYPE html>
<html lang="th">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="กลุ่มนิเทศ ติดตามและประเมินผลการจัดการศึกษา สำนักงานเขตพื้นที่การศึกษามัธยมศึกษาน่าน">
    <meta name="keywords" content="นิเทศ, สพม, น่าน, มัธยม, สำนักงานเขตพื้นที่การศึกษา,มัธยมศึกษา">
    <meta name="author" content="กฤษฎาพงษ์ สุตะ">

    <title>งานนิเทศ สพม.น่าน</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/all.css" rel="stylesheet">
    <!--[if lt IE 8]>
    <link href="css/font-awesome-ie7.css" rel="stylesheet">
    <![endif]-->

    <link href="css/theme.css" rel="stylesheet">
    <link href="css/bootstrap-datepicker.css" rel="stylesheet">
</head>

<body>

<canvas id="myChart" width="400" height="400"></canvas>


    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
	<script>
	 const ctx=$('#myChart');
	 const myChart = new Chart(ctx, {
		 type: 'bar',
		 data: {
		 labels: <?= json_encode($labels,JSON_UNESCAPED_UNICODE); ?>,
		 datasets: [{
		label:'จำนวนรางวัล',
		 data: <?= json_encode($cData); ?>,
		 backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
		 }]
		 },
		 options: {
        plugins: {
            title: {
                display: true,
                text: 'Top 5 รายงานรางวัลของโรงเรียน'
            },
			    legend: {
        display: false
    }
        }
    }
	 });
	</script>
	
</body>

</html>