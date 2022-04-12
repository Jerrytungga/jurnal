<?php
#Pie Chart
include 'database.php';

$result = mysqli_query($conn, "SELECT nis , mark  FROM absent ");

//$rows = array();
$rows['mark'] = 'pie';
$rows['name'] = 'jerry';
//$rows['innerSize'] = '50%';
while ($r = mysqli_fetch_array($result)) {
    $rows['data'][] = array($r['nis'], $r['mark']);
}
$rslt = array();
array_push($rslt, $rows);
print json_encode($rslt);

mysqli_close($con);
