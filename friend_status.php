
<?php
include_once 'fbconfig.php';

$friendId = $_POST['id'];
$friendData = $facebook->api("/$friendId");
$friendName = $friendData['name'];
$query = "SELECT uid,message,time FROM status WHERE uid = $friendId";
$friendStatus = $facebook->api(array(
            'method' => 'fql.query',
            'query' => $query,
        ));
?>
    <img src="<?php echo "http://graph.facebook.com/".$friendId."/picture"; ?>" alt="Image" />
    <?php echo $friendName;?><br/><br/>
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
        $i = 1;
        if(!empty ($friendStatus)){
            foreach ($friendStatus as $status) {
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $status['message'] ?></td>
                    <td><?php echo date('F j, Y', $status['time']) ?></td>
                </tr>
            <?php } 

        }else {
            ?>
            <tr><td colspan="3">Status Can't read </td></tr>
            <?php
     
 }?>
    </tbody>
</table>