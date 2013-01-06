<?php
include_once 'fbconfig.php';
include_once 'user.php';
?>
<html>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <head>
        <link rel="stylesheet" type="text/css" href="css/table.css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <style type="text/css">

            ul.tabs {
                margin: 0;
                padding: 0;
                float: left;
                list-style: none;
                height: 32px; /*--Set height of tabs--*/
                border-bottom: 1px solid #999;
                border-left: 1px solid #999;
                width: 100%;
            }
            ul.tabs li {
                float: left;
                margin: 0;
                padding: 0;
                height: 31px; /*--Subtract 1px from the height of the unordered list--*/
                line-height: 31px; /*--Vertically aligns the text within the tab--*/
                border: 1px solid #999;
                border-left: none;
                margin-bottom: -1px; /*--Pull the list item down 1px--*/
                overflow: hidden;
                position: relative;
                background: #ffffff;
                color: #595454;

            }
            ul.tabs li a {
                text-decoration: none;
                color: #595454;
                display: block;
                font-size: 1.2em;
                padding: 0 20px;
                border: 1px solid #fff; /*--Gives the bevel look with a 1px white border inside the list item--*/
                border-bottom: 0px solid #fff;
                outline: none;
                background: #ffffff;
            }
            ul.tabs li a:hover {
                background: #595454;
                color: #fff;
            }

            html ul.tabs li.active a{
                background: #595454;
                border-bottom: 0px solid #fff;
                color: #fff;
                border-bottom: none;
            }
            .tab_container {
                border: 1px solid #999;
                border-top: none;
                overflow: hidden;
                clear: both;
                float: left; width: 100%;
            }
            .tab_content {
                padding: 20px;
                font-size: 1em;
            }
            a#replay {
                text-decoration: none;

            }
            p.message {
                /*                align: center;*/
                color: #4CC417;
                /*                font-family: arial;*/
            }
            body
            {
                font-family:Verdana,Arial,Helvetica,sans-serif;
            }
            input.submit
            {
                text-align: center;
                height: 30px;
                width: 100px;
                font-size: 1em;
                color: #41383C;

            }
        </style>
    </head>
    <body>
        <img align="center" src="images/Banners2.jpg" alt="Image">
        <ul class="tabs">
            <li><a href="#tab1">All Status</a></li>
            <li><a href="#tab2">Search Status</a></li>
            <li><a href="#tab3">Friends Status</a></li>
            <li><a href="#tab4">Test</a></li>
        </ul>
        <div class="tab_container">
            <div id="tab1" class="tab_content">
                <?php include 'all_status.php'; ?>
            </div>
            <div id="tab2" class="tab_content">
                <form name="input" action="<?php echo $callbackUrl; ?>index.php" method="post">
                    <b>Search Through your status:</b><input type="text" name="key" />
                    <input type="submit" id="submit" name="submit" value="Submit" />
                </form>


                <?php
                $userId = $userInfo['id'];

                if (isset($_POST['submit'])) {

                    $key = $_POST['key'];

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
                        foreach ($searchedResult as $status) {
                            if ($i == 10)
                                break;
                            $i++;
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $status['message'] ?></td>
                                <td><?php echo date('F j, Y', $status['time']) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } ?>
                </div>
                <div id="tab3" class="tab_content">
                    <?php include_once 'friend.php'; ?>
                </div>
                <div id="tab4" class="tab_content">
                    <?php include_once 'invite.php';?>
                </div>

            </div>
            <div  id="fb-root"></div>
            <script type="text/javascript">
                window.fbAsyncInit = function() {
                    FB.init({
                        appId  : '<?php echo $appId; ?>',
                    status : true, // check login status
                    cookie : true, // enable cookies to allow the server to access the session
                    xfbml  : true // parse XFBML
                });
                FB.Canvas.setAutoResize(); //set size according to iframe content size
            };

            (function() {
                var e = document.createElement('script');
                e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
                e.async = true;
                document.getElementById('fb-root').appendChild(e);
            }());
        </script>
        <script type="text/javascript">

            $(document).ready(function() {

                // var theFrame = $("#iframe_canvas", parent.document.body);
                // theFrame.height($(document.body).height() + 30);
                $(".tab_content").hide(); //Hide all content
                $("ul.tabs li:first").addClass("active").show(); //Activate first tab
                $(".tab_content:first").show(); //Show first tab content

                //On Click Event
                $("ul.tabs li").click(function() {

                    $("ul.tabs li").removeClass("active"); //Remove any "active" class
                    $(this).addClass("active"); //Add "active" class to selected tab
                    $(".tab_content").hide(); //Hide all tab content

                    var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
                    $(activeTab).fadeIn(); //Fade in the active ID content
                    return false;
                });

            });
        </script>
    </body>
</html>