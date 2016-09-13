<?php
    require_once 'src/Player.php';
    require_once 'src/Game.php';

    class GameTest extends PHPUnit_Framework_TestCase
    {
        // function test_start ()
        // {
        //     // Arrange
        //     $test_Game = new Game;
        //
        //     // Act
        //     $result = $test_Game->start();
        //
        //     // Assert
        //     $this->assertEquals (array(array(),array(), array()), $result);
        // }

        function test_hitPlayer()
        {
            // Arrange
            $test_Game = new Game;

            // Act
            $result = $test_Game->hitPlayer();

            // Assert
            $this->assertEquals (4, $result);
        }

    }
?>
