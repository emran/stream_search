<?php
include_once 'fbconfig.php';
$userId = $userInfo['id'];

$fql = "SELECT uid2 FROM friend WHERE uid1= $userId";
$friendList = $facebook->api(array(
            'method' => 'fql.query',
            'query' => $fql,
        ));
?>
<select id="friend">
    <option value="default">Select your friends</option>
    <?php
    $i = 0;
    foreach ($friendList as $friend) {
       
        $friendId = $friend['uid2'];
        $friendData = $facebook->api("/$friendId");
        $friendName = $friendData['name'];
        //echo ' '.$friendData['name'].'   ';
    ?>
        <option value="<?php echo $friendId; ?>"><?php echo $friendName; ?></option>
    <!--    <img src="<?php //echo "http://graph.facebook.com/".$friendId."/picture"; ?>" alt="Image" />-->

    <?php
    }

//var_dump($friendList);
    ?>
</select>
<span id="friendStatusResult"></span>
<script>

    $("select").change(function () {
            var friendId = $("#friend").val();
            //alert(friendId);
            $.post('<?php //echo $callbackUrl;?>friend_status.php', {id : friendId}, function(data) {
                $('#friendStatusResult').html(data);

            });
        })

</script>