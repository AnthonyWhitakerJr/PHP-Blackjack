<?php


class GameDeck {

    public static function getNextCard() {
//        return new Card(Suit::getRandomSuit(), Rank::getRandomRank()); //TODO Turn on random suits.
        return new Card(Suit::CLUBS, Rank::getRandomRank());
    }

}