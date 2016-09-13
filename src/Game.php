<?php
    require_once 'Player.php';
    class Game
    {
        private $deck;
        private $player;
        private $dealer;

        function __construct()
        {
            $this->deck = array(2,2,2,2,3,3,3,3,4,4,4,4,5,5,5,5,6,6,6,6,7,7,7,7,8,8,8,8,9,9,9,9,10,10,10,10,"j","j","j","j","q","q","q","q","k","k","k","k","a","a","a","a");
            $this->player = new Player;
            $this->dealer = new Player;
        }

        function setDeck($new_deck)
        {
            $this->deck = $new_deck;
        }

        function setPlayer($new_player)
        {
            $this->player = $new_player;
        }

        function setDealer($new_dealer)
        {
            $this->dealer = $new_dealer;
        }

        function getDeck()
        {
            return $this->deck;
        }

        function getPlayer()
        {
            return $this->player;
        }

        function getDealer()
        {
            return $this->dealer;
        }

        function start()
        {
            $this->player->setScore(0);
            $this->player->setHand(array());
            $this->dealer->setScore(0);
            $this->dealer->setHand(array());

            $this->hitPlayer();
            $this->hitDealer();
            $this->hitPlayer();
            $this->hitDealer();

            return array($this->player->getHand(), $this->dealer->getHand(), $this->deck);
        }

        function hitPlayer()
        {
            $player1 = $this->player->getHand();
            $deck = $this->deck;
            $playerScore = $this->player->getScore();

            $card = array_rand ($this->deck, 1);
            array_splice($this->deck, $card, 1);
            array_push ($player1, $deck[$card]);

            $this->player->setHand($player1);

            if ($deck[$card] === 'j' || $deck[$card] === 'q' || $deck[$card] === 'k') {
                $playerScore += 10;
            } elseif ($deck[$card] === 'a') {
                $playerScore += 11;
            } else {
                $playerScore += $deck[$card];
            }

            $this->player->setScore($playerScore);
            return $playerScore;
        }

        function hitDealer()
        {
            $dealer = $this->dealer->getHand();
            $deck = $this->deck;
            $dealerScore = (int)$this->dealer->getScore();

            $card = array_rand ($this->deck, 1);
            array_splice($this->deck, $card, 1);
            array_push ($dealer, $deck[$card]);

            $this->dealer->setHand($dealer);

            if ($deck[$card] == 'j' || $deck[$card] == 'q' || $deck[$card] == 'k') {
                $dealerScore += 10;
            } elseif ($deck[$card] == 'a') {
                $dealerScore += 11;
            } else {
                $dealerScore += $deck[$card];
            }

            $this->dealer->setScore($dealerScore);
            return $dealerScore;
        }

        function hold()
        {
            $playerScore = $this->player->getScore();
            $playerMoney = $this->player->getMoney();
            $dealerScore = (int)$this->dealer->getScore();
            if ($playerScore > $dealerScore && $playerScore <= 21) {
                $this->player->setMoney($playerMoney+5);
                return true;
                //player wins
                // display play again button
            } else {
                return false;
                //player loses
                // display play again button
            }
        }

        function saveHand()
        {
            array_push($_SESSION['player'], $this);
        }

        function saveDeck()
        {
            array_push($_SESSION['dealer'], $this);
        }
    }

    $game = new Game;
    $game->start();

?>
