<?php

class Game {
    /**
     * @var int
     */
    private $wager;
    /**
     * @var Card[]
     */
    private $dealerHand;
    /**
     * @var Card[]
     */
    private $playerHand;
    /**
     * @var State
     */
    private $state;
    /**
     * @var string[]
     */
    private $gameLog;

    /**
     * Game constructor.
     * @param $gameLog
     */
    public function __construct() {
        $this->gameLog = array();
        $this->reset();
    }


    public function reset() {
        $this->wager = 0;
        $this->dealerHand = array();
        $this->playerHand = array();
        $this->state = State::PLACE_WAGER;
    }

    public static function getAvailableWagers($bank) {
        $availableWagers = array();
        for ($i = 50; $i <= 500 && $i <= $bank; $i += 50) {
            $availableWagers[] = $i;
        }
        return $availableWagers;
    }

    public function updateWager($wager) {
        $this->wager = $wager;
    }

    public function deal($userId, $database) {
        $this->state = State::PLAYER;
        $this->placeWager($userId, $database);

        $this->dealerHand[] = GameDeck::getNextCard();
        $this->dealerHand[] = GameDeck::getNextCard();

        $this->playerHand[] = GameDeck::getNextCard();
        $this->playerHand[] = GameDeck::getNextCard();
    }

    /**
     * @param $userId int
     * @param $database PDO
     */
    private function placeWager($userId, $database) {
        $sql = file_get_contents('sql/placeWager.sql');
        $params = array(
            'userId' => $userId,
            'wager' => $this->wager
        );

        $statement = $database->prepare($sql);
        $statement->execute($params);
    }

    public function hit() {
        $this->playerHand[] = GameDeck::getNextCard();
    }

    public function stand() {
        $this->state = State::DEALER;

    }

    public function calculateDealerHand() {
        if ($this->state === State::PLAYER) {
            return $this->dealerHand[1];
        }

        return $this->calculateHand($this->dealerHand);
    }

    /**
     * @param $hand Card[]
     * @return int
     */
    private function calculateHand($hand) {
        $total = 0;
        $hasAce = false;
        foreach ($hand as $card) {
            if ($card->getRank() == Rank::ACE && !$hasAce) {
                $total += 11;
                $hasAce = true;
            } else {
                $total += $card->getRank();
            }
        }
        if ($total > 21 && $hasAce) {
            $total -= 10;
        }
        return $total;
    }

    public function calculatePlayerHand() {
        return $this->calculateHand($this->playerHand);
    }

    /**
     * @return int
     */
    public function getWager() {
        return $this->wager;
    }

    /**
     * @return array
     */
    public function getDealerHand() {
        return $this->dealerHand;
    }

    /**
     * @return array
     */
    public function getPlayerHand() {
        return $this->playerHand;
    }
}