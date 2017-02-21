<?php

    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/HouseMate.php";
    require_once __DIR__."/../src/Interest.php";
    require_once __DIR__."/../src/Location.php";
    require_once __DIR__."/../src/Date.php";

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost:8889;dbname=terrace_house';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider, ["twig.path" => __DIR__."/../views"]);

    $app->get("/", function() use ($app) {
        $house_mates = HouseMate::getAll();
        return $app['twig']->render("home.html.twig", ["housemates" => $house_mates]);
    });

    return $app;
?>
