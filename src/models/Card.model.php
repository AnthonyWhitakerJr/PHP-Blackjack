<?php


class Card {

    private $suit;
    private $rank;

    /**
     * Card constructor.
     * @param $suit
     * @param $rank
     */
    public function __construct($suit, $rank) {
        $this->suit = $suit;
        $this->rank = $rank;
    }

    public function getImageLocation() {
        return "/assets/cards/" . $this->suit . "/" . $this->rank;
    }

    public function __toString() {
        return Rank::toString($this->rank) . ' of ' . ucfirst($this->suit);
    }

    /**
     * @return Suit
     */
    public function getSuit() {
        return $this->suit;
    }

    /**
     * @return int
     */
    public function getRank() {
        return $this->rank;
    }


}