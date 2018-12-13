<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;

// Define your first route
$app->get('/v0/meetup', function ($request, $response)
{
    $urlname = 'SaintLouis_FullStack_WebDevelopment';

    $cURL = curl_init();
    curl_setopt($cURL, CURLOPT_URL, "https://api.meetup.com/2/events?group_urlname=" . $urlname . "&page=1");
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($cURL, CURLOPT_SSL_VERIFYPEER, false);
    $json_string = curl_exec($cURL);

    echo $json_string;
});


// Define your second route
$app->get('/v0/meetup/{urlname}', function ($request, $response, $args)
{
    $urlname = $args['urlname'];

    $cURL = curl_init();
    curl_setopt($cURL, CURLOPT_URL, "https://api.meetup.com/2/events?group_urlname=" . $urlname . "&page=1");
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($cURL, CURLOPT_SSL_VERIFYPEER, false);
    $json_string = curl_exec($cURL);

    $new_text = '"description":"", "event_url"';
    $pattern = '/("description":(?:.*)"event_url")/U';
    echo preg_replace($pattern, $new_text, $json_string);
});

$app->run();
