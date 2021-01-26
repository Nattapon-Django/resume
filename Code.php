<html>
<head>
    <meta charset="utf-8">
    <title>รายงานในแบบกราฟเส้น</title>
</head>
<?php
$con= mysqli_connect("localhost","root","","fried") or die("Error: " . mysqli_error($con)); 
mysqli_query($con, "SET NAMES 'utf8' ");
 
$query = "SELECT * FROM tbl_data WHERE `Date`='09/16/2020' AND `Time` BETWEEN '23:47:16' AND '23:53:00'";
$result = mysqli_query($con, $query);
$resultchart = mysqli_query($con, $query);  


 //for chart
$date = array();
$DHTtemp = array();

while($rs = mysqli_fetch_array($resultchart)){ 
  $date[] = "\"".$rs['Time']."\""; 
  $DHTtemp[] = "\"".$rs['DHTtemp']."\""; 
}
$numbersum = count($DHTtemp);
echo max($DHTtemp);
echo min($DHTtemp);
echo "$avg";
// echo "$numbersum";
$date = implode(",", $date); 
$DHTtemp = implode(",", $DHTtemp);

 
?>

<h3 align="center">รายงานในแบบกราฟเส้น</h3>
<table width="200" border="1" cellpadding="0"  cellspacing="0" align="center">
  <thead>
  <tr>
    <th width="100%">วันที่</th>
    <th width="100%">อุณหภูมิ</th>
  </tr>
  </thead>
  
  <?php while($row = mysqli_fetch_array($result)) { ?>
    <tr>
      <td align="center"><?php echo $row['Date'];?></td>
      <td align="right"><?php echo number_format($row['DHTtemp']);?></td> 
    </tr>
    <?php } ?>

</table>
<?php mysqli_close($con);?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
<hr>
<p align="center">


<canvas id="myChart" width="1000px" height="300px"  ></canvas>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo $date;?> //แกนX
    
        ],
        datasets: [{
            label: 'อุณหภูมิ',
            data: [<?php echo $DHTtemp;?> //แกนY
            ],
            backgroundColor: [
                'rgba(0, 162, 225, 0.5)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(0,191,255,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>  
</p> 
</html>