<?php

abstract class Rank {
    const ACE = 1;
    const JACK = 11;
    const KING = 13;
    const QUEEN = 12;

    public static function getRandomRank() {
        return rand(1, 13);
    }

    public static function toString($rank) {
        switch ($rank) {
            case Rank::ACE:
                return 'Ace';
            case Rank::KING:
                return 'King';
            case Rank::QUEEN:
                return 'Queen';
            case Rank::JACK:
                return 'Jack';
            default:
                return (string)$rank;
        }
    }
}