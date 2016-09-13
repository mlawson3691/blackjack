<?php
    class Player
    {
        private $hand;
        private $score;
        private $money;

        function __construct ($hand = array(), $score = 0, $money = 50)
        {
            $this->hand = $hand;
            $this->score = $score;
            $this->money = $money;
        }

        function setHand($new_hand)
        {
            $this->hand = (array) $new_hand;
        }

        function setScore($new_score)
        {
            $this->score = (int) $new_score;
        }

        function setMoney($new_money)
        {
            $this->money = (int) $new_money;
        }

        function getHand()
        {
            return $this->hand;
        }

        function getScore()
        {
            return $this->score;
        }

        function getMoney()
        {
            return $this->money;
        }


    }
?>
