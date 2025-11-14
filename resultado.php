<?php
session_start();
require_once 'autoload.php';
//use Facebook\Facebook;



$fb = new Facebook\Facebook([
  'app_id' => '175428196259619', // Replace {app-id} with your app id
  'app_secret' => '8f3fc09d6c9506d307682bf147fc58eb',
  'default_graph_version' => 'v2.8',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://www.domohs.com/domohs/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';

?>