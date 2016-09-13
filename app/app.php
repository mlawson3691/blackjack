<?php
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Player.php';
    require_once __DIR__.'/../src/Game.php';

    session_start();

    if (empty($_SESSION['game'])) {
        $player = new Player;
        $dealer = new Player;
        $_SESSION['game'] = new Game(array(), $player, $dealer);
    }

    use Symfony\Component\Debug\Debug;
    Debug::enable();
    $app = new Silex\Application();
    $app['debug'] = true;
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get('/', function() use ($app) {
        $_SESSION['game']->start();

        return $app['twig']->render('main.html.twig', array( 'game' => $_SESSION['game']));
    });

    $app->post('/', function() use ($app) {
        $game = $_SESSION['game'];
        if ($_POST['hit'] == 1) {
            $lose = $game->hitPlayer();
            if ($lose === true) {
                return $app['twig']->render('lose.html.twig', array( 'game' => $_SESSION['game']));
            } else {
                return $app['twig']->render('main.html.twig', array( 'game' => $_SESSION['game']));
            }
        } elseif ($_POST['hold'] == 1) {
            $win = $game->hold();
            if ($win === true) {
                echo 'You win!';
                return $app['twig']->render('win.html.twig', array( 'game' => $_SESSION['game']));
            } else {
                echo 'You Lose!';
                return $app['twig']->render('lose.html.twig', array( 'game' => $_SESSION['game']));
            }
        }
    });


    return $app;
?>
