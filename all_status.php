<?php
include_once 'fbconfig.php';

$userId = $userInfo['id'];
$query = "SELECT uid,message,time FROM status WHERE uid = $userId";
    $userStatus = $facebook->api(array(
    'method' => 'fql.query',
    'query' =>$query,
    ));

    
?>
<table id="box-table-a" summary="status" align="center">
    <thead>
    	<tr>
            <th scope="col">No</th>
            <th scope="col">Status</th>
            <th scope="col">Time</th>
        </tr>
    </thead>
    <tbody>
<?php
$i = 0;
foreach ($userStatus as $status)
  {
    if($i == 10)
        break;
    $i++;
    ?>
        <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $status['message']?></td>
            <td><?php echo date('F j, Y',$status['time'])?></td>
        </tr>
 <?php }?>
</tbody>
</table>