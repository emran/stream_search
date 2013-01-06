<?php
include_once 'fbconfig.php';

$userId = $userInfo['id'];
 $query = "SELECT link_id, owner, owner_comment, created_time, title, summary, url, image_urls FROM link
 WHERE owner = $userId";
    $linkList = $facebook->api(array(
    'method' => 'fql.query',
    'query' =>$query,
    ));


?>
<table id="box-table-a" summary="status" align="center">
    <thead>
    	<tr>
            <th scope="col">No</th>
            <th scope="col">title</th>
            <th scope="col">summary</th>
            <th scope="col">Owner Comment</th>
            <th scope="col">Date/Time</th>
        </tr>
    </thead>
    <tbody>
<?php
$i = 0;
var_dump($linkList);die;
foreach ($linkList as $link)
  {
    if($i == 10)
        break;
    $i++;
    ?>
    
    <tr>
            <td><?php echo $i;?></td>
            <td><a href="<?php $link['url'];?>"><?php echo $link['title']?></a></td>
            <td><?php echo $link['summary'];?></td>
            <td><?php echo $link['owner_comment'];?></td>
            <td><?php echo $link['created_time'];?></td>
    </tr>
    
 <?php  }?>

</tbody>
</table>