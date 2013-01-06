<?php

/**
 * @author emran@wneeds.ccom
 * @copyright emran
 */
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

$appId = "175174972552100";
$secret = "c849f7ebe09759a5ffbb4ee28be8f9fc";

$baseUrl = "http://apps.facebook.com/sharedstatus/";
$callbackUrl = "http://184.106.82.14/fb.apps/status/";


/*
 * If user first time authenticated the application facebook
 * redirects user to baseUrl, so I checked if any code passed
 * then redirect him to the application url
 */
if (isset($_GET['code'])) {
    header("Location: " . $baseUrl);
    exit;
}
//~~
//
if (isset($_GET['request_ids'])) {
    //user comes from invitation
    //track them if you need
    echo '<pre>';
    print_r($_GET);
    echo '</pre>';
}
$user = null; //facebook user uid
try {
    include_once "lib/facebook.php";
} catch (Exception $o) {
    echo '<pre>';
    print_r($o);
    echo '</pre>';
}
// Create our Application instance.
$facebook = new Facebook(array(
            'appId' => $appId,
            'secret' => $secret,
            'cookie' => true,
        ));

//Facebook Authentication part
$user = $facebook->getUser();
// We may or may not have this data based
// on whether the user is logged in.
// If we have a $user id here, it means we know
// the user is logged into
// Facebook, but we don�t know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

$loginUrl = $facebook->getLoginUrl(
                array(
                    'scope' => 'email,publish_stream,user_about_me,user_hometown,user_status,friends_status,read_stream'   //user_status,friends_statu?s
                )
);

if ($user) {
    try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook->api('/me');
    } catch (FacebookApiException $e) {
        //you should use error_log($e); instead of printing the info on browser
        d($e);  // d is a debug function defined at the end of this file
        $user = null;
    }
}

if (!$user) {
    echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
    exit;
}

//get user basic description
$userInfo = $facebook->api("/$user");
$userId = $userInfo['id'];
function d($d)
{
    echo '<pre>';
    print_r($d);
    echo '</pre>';
}

?>
