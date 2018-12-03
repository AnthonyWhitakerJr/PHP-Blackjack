<?php


abstract class Suit {
    const CLUBS = "clubs";
    const DIAMONDS = "diamonds";
    const HEARTS = "hearts";
    const SPADES = "spades";

    private static const values = [Suit::CLUBS, Suit::DIAMONDS, Suit::HEARTS, Suit::SPADES];

    /**
     * @return string
     */
    public static function getRandomSuit() {
        $index = rand(0, 3);
        return Suit::values[$index];
    }
}