<?php


class GameDeck {

    public static function getNextCard() {
        return new Card(Suit::getRandomSuit(), Rank::getRandomRank());
    }

}