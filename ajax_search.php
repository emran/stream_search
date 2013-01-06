<?php
include_once 'fbconfig.php';

//get the q parameter from URL
$query=$_GET["q"];

//lookup all hints from array if length of q>0
if (strlen($query) > 0)
  {
                  $userId = $userInfo['id'];
                  $key = $query;

                    function single_search($member)
                    {
                        global $key;

                        $in_name = strpos($member['message'], $key);


                        return is_numeric($in_name);
                    }

                    $query = "SELECT uid,status_id,message,time FROM status WHERE uid = $userId";
                    $userStatus = $facebook->api(array(
                                'method' => 'fql.query',
                                'query' => $query,
                            ));

                    $searchedResult = array_filter($userStatus, 'single_search');
  }

// Set output to "No Search Results Found" if no results were found
// or to the correct values
//output the response  
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
  if (isset ($searchedResult))
  {
?>
                        <?php
                        $i = 1;
                        foreach ($searchedResult as $status) {
                            
                        ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $status['message'] ?></td>
                                <td><?php echo date('F j, Y', $status['time']) ?></td>
                            </tr>
                        <?php } ?>
 
<?php

  }
else
  {
 ?>
                            <tr colspan="3"><td>No Search Results Found</td></tr>                          
<?php

}
?>
                   </tbody>
                </table>