<?php

include_once 'fbconfig.php';

function getUserData($userId)
{
    $PROFILE_INFO_URL = "https://graph.facebook.com/";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $PROFILE_INFO_URL . $userId);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    // grab URL and pass it to the browser
    $userData = curl_exec($ch);

    curl_close($ch);
    return $userData;
}

function getUserProfilePicture($userId)
{
    $PROFILE_INFO_URL = "https://graph.facebook.com/";
    $userName =
            $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $PROFILE_INFO_URL . $userId . "/picture");
    curl_setopt($ch, CURLOPT_HEADER, 0);

    // grab URL and pass it to the browser
    $userData = curl_exec($ch);


    curl_close($ch);
    return $userPicture;
}

?>