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

    $app->get('/add_date', function() use ($app) {
        $males = HouseMate::getMales();
        $females = HouseMate::getFemales();
        $locations = Location::getAll();
        return $app['twig']->render('add_date.html.twig', ['males' => $males, 'females' => $females, 'locations' => $locations]);
    });

    $app->get('/dates', function() use ($app) {
        return $app['twig']->render('dates.html.twig', ['dates' => Date::export()]);
    });

    $app->post('/dates', function() use ($app) {
        $location = $_POST['location'];
        $male_id = $_POST['male'];
        $female_id = $_POST['female'];
        $heartbreak = null;
        if (array_key_exists('heartbreak', $_POST)) {
            $heartbreak = true;
        }
        else {
            $heartbreak = false;
        }
        $new_Date = new Date($location, $male_id, $female_id, $heartbreak);
        $new_Date->save();
        return $app['twig']->render('dates.html.twig', ['dates' => Date::export()]);
    });

    $app->get('/add_location', function() use ($app) {
        return $app['twig']->render('add_location.html.twig');
    });

    $app->post('/locations', function() use ($app) {
        $new_location = new Location($_POST['location']);
        $new_location->save();
        return $app['twig']->render('locations.html.twig', ['locations' => Location::getAll()]);
    });

    $app->get('/add_interest', function() use ($app) {
        return $app['twig']->render('add_interest.html.twig');
    });

    $app->post('/interests', function() use ($app) {
        $new_interest = new Interest($_POST['interest']);
        $new_interest->save();
        return $app['twig']->render('interests.html.twig', ['interests' => Interest::getAll()]);
    });

    $app->get('/add_housemate', function() use ($app) {
        return $app['twig']->render('add_housemate.html.twig', ['interests' => Interest::getAll()]);
    });

    $app->get('/housemates', function() use ($app) {
        return $app['twig']->render('housemates.html.twig', ['housemates' => HouseMate::getAll()]);
    });

    $app->post('/housemates', function() use ($app) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $profession = $_POST['profession'];
        $gender = $_POST['gender'];
        $week_joined = $_POST['week-joined'];
        $week_left = $_POST['week-left'];
        $interests = [];

        // $all_interests = Interest::getAll();
        // foreach ($all_interests as $interest) {
        //     if (array_key_exists($interest->getName(), $_POST['interest'])) {
        //         array_push($interests, $interest->getId());
        //     }
        // }

        $new_HouseMate = new HouseMate($name, $age, $profession, $gender, $week_joined, $week_left);
        $new_HouseMate->save();

        // $new_HouseMate->addInterests();

        return $app['twig']->render('housemates.html.twig', ['housemates' => HouseMate::getAll()]);
    });

    return $app;
?>
