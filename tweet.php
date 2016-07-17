<?php
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

// get slide note
$messages = $argv;
array_splice($messages,0, 1);
$message = join(' ', $messages);
if (strlen($message) == 0) {
  exit;
}

// setting
$json = file_get_contents(__DIR__ . "/config.json");
$config = json_decode($json);
$hashTag = $config->{"hash_tag"};
$consumerKey = $config->{"consumer_key"};
$consumerSecret = $config->{"consumer_secret"};
$accessToken = $config->{"access_token"};
$accessTokenSecret = $config->{"access_token_secret"};

// post tweet on Twitter
if (strlen($hashTag) > 0) {
  $message .= " #" . $hashTag;
}
$connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
$res = $connection->post("statuses/update", array("status" => $message));
