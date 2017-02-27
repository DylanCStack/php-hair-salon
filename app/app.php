<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__."/../views"
    ));

    $app['debug'] = true;

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get('/', function() use ($app) {
        return $app['twig']->render("index.html.twig", array("stylists" => Stylist::getAll()));
    });

    $app->post('/', function() use ($app) {
        $stylist = new Stylist($_POST['stylist-name']);
        $stylist->save();

        return $app['twig']->render("index.html.twig", array("stylists" => Stylist::getAll()));
    });

    $app->delete('/', function() use ($app) {
        Stylist::deleteAll();
        Client::deleteAll();

        return $app['twig']->render("index.html.twig", array("stylists" => Stylist::getAll()));
    });

    $app->get('/stylist/{name}/edit', function($name) use ($app) {
        $stylist = Stylist::findByName($name);

        return $app['twig']->render("stylist-edit.html.twig", array("stylist" => $stylist ));
    });

    $app->patch('/edit-stylist/{id}', function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->update($_POST['new-stylist-name']);

        return $app['twig']->render("index.html.twig", array("stylists" => Stylist::getAll()));
    });

    $app->delete('/delete-stylist/{id}', function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();

        return $app['twig']->render("index.html.twig", array("stylists" => Stylist::getAll()));
    });

    $app->get('/{name}/clients', function($name) use ($app) {
        $stylist = Stylist::findByName($name);

        return $app['twig']->render("clients.html.twig", array("clients" => Client::getAllByStylist($stylist->getId()), "stylist" => $stylist));
    });

    $app->post('/{name}/clients', function($name) use ($app) {
        $stylist = Stylist::findByName($name);
        $client = new Client($_POST['client-name'] , $stylist->getId() );
        $client->save();

        return $app['twig']->render("clients.html.twig", array("clients" => Client::getAllByStylist($stylist->getId()), "stylist" => $stylist));
    });

    $app->get('/{name}/client/{name2}/edit', function ($name, $name2) use ($app) {
        $stylist = Stylist::findByName($name);
        $client = Client::findByName($name2);

        return $app['twig']->render("client-edit.html.twig", array("stylist" => $stylist, "client" => $client));
    });

    $app->patch('/edit-client/{name}/client/{name2}', function($name, $name2) use ($app) {
        $stylist = Stylist::findByName($name);
        $client = Client::findByName($name2);
        $client->update($_POST['new-client-name']);

        return $app['twig']->render("clients.html.twig", array("clients" => Client::getAllByStylist($stylist->getId()), "stylist" => $stylist));
    });

    $app ->delete('/{name}/delete-client/{id}', function($name, $id) use ($app) {
        $stylist = Stylist::findByName($name);
        $client = Client::find($id);
        $client->delete();

        return $app['twig']->render("clients.html.twig", array("clients" => Client::getAllByStylist($stylist->getId()), "stylist" => $stylist));
    });

    $app->delete('/{name}/clients', function($name) use ($app) {
        $stylist= Stylist::findByName($name);
        Client::deleteAllByStylist($stylist->getId());

        return $app['twig']->render("clients.html.twig", array("clients" => Client::getAllByStylist($stylist->getId()), "stylist" => $stylist));
    });

    return $app;
?>
