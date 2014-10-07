<?php

use mikehaertl\wkhtmlto\Pdf;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app->get('/', function() use($app) {
    return $app['twig']->render('index.twig');
});

$app->get('/convert', function() {
    $url = $_GET['url'];
    $pdf = new Pdf($url);
    $pdf->binary = __DIR__ . '/../vendor/bin/wkhtmltopdf-amd64';
    $pdf->send("report.pdf");
    exit();
});

$app['debug'] = true;
// ... definitions
//
$app->run();
