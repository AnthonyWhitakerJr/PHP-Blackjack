<?php

class Game {

    /**
     * @var Card[]
     */
    private $dealerHand;
    /**
     * @var string[]
     */
    private $gameLog;
    /**
     * @var Card[]
     */
    private $playerHand;
    /**
     * @var bool
     */
    private $playerHasBlackjack;
    /**
     * @var State
     */
    private $state;
    /**
     * @var int
     */
    private $wager;

    /**
     * Game constructor.
     * @param $gameLog
     */
    public function __construct() {
        $this->gameLog = array();
        $this->reset();
    }

    public static function getAvailableWagers($bank) {
        $availableWagers = array();
        for ($i = 50; $i <= 500 && $i <= $bank; $i += 50) {
            $availableWagers[] = $i;
        }
        return $availableWagers;
    }

    public function calculateDealerHand() {
        if ($this->state === State::PLAYER) {
            return $this->dealerHand[1];
        }

        return $this->calculateHand($this->dealerHand);
    }

    public function calculatePlayerHand() {
        return $this->calculateHand($this->playerHand);
    }

    public function canHit() {
        return $this->state == State::PLAYER && $this->calculatePlayerHand() < 21;
    }

    public function canStand() {
        return $this->state == State::PLAYER;
    }

    public function deal($userId, $database) {
        $this->state = State::PLAYER;
        $this->placeWager($userId, $database);
        $this->log("Player wagers $" . $this->wager);

        $this->dealerHand[] = GameDeck::getNextCard();
        $this->dealerHand[] = GameDeck::getNextCard();

        $this->playerHand[] = GameDeck::getNextCard();
        $this->playerHand[] = GameDeck::getNextCard();

        if ($this->calculatePlayerHand() == 21) {
            $this->playerHasBlackjack = true;
            $this->log('Player has blackjack!');
            $this->stand($userId, $database);
        }
    }

    public function hit($userId, $database) {
        if (!$this->canHit()) {
            return;
        }

        $this->playerHand[] = GameDeck::getNextCard();
        $this->log("Player hits.");

        $playerScore = $this->calculatePlayerHand();
        $this->log("Player has " . $playerScore);
        if ($playerScore >= 21) {
            $this->stand($userId, $database);
        }

    }

    public function reset() {
        $this->wager = 0;
        $this->dealerHand = array();
        $this->playerHand = array();
        $this->state = State::PLACE_WAGER;
        $this->playerHasBlackjack = false;
    }

    public function stand($userId, $database) {
        if (!$this->canStand()) {
            return;
        }

        $this->state = State::DEALER;
        $playerScore = $this->calculatePlayerHand();
        if ($playerScore > 21) {
            $this->log("Player busts.");
        } else {
            $this->log("Player stands at " . $playerScore . ".");
        }

        do {
            $this->dealerHand[] = GameDeck::getNextCard();
            $this->log("Dealer hits.");

            $dealerScore = $this->calculateDealerHand();
            $this->log("Dealer has " . $dealerScore);
        } while ($dealerScore < 17);

        if ($dealerScore > 21) {
            $this->log("Dealer busts.");
        } else {
            $this->log("Dealer stands at " . $dealerScore . ".");
        }

        $this->endRound($userId, $database);
    }

    public function updateWager($wager) {
        $this->wager = $wager;
    }

    /**
     * @param $amount $int
     * @param $userId $int
     * @param $database PDO
     */
    private function adjustBank($amount, $userId, $database) {
        $sql = file_get_contents('sql/adjustBank.sql');
        $params = array(
            'userId' => $userId,
            'amount' => $amount
        );

        $statement = $database->prepare($sql);
        $statement->execute($params);
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

    private function endRound($userId, $database) {
        $dealerScore = $this->calculateDealerHand();
        $playerScore = $this->calculatePlayerHand();

        if ($playerScore > 21) { //Player busts
            $this->log("House wins.");
        } elseif ($this->calculatePlayerHand() === $this->calculateDealerHand()) { // Push
            $this->log("Push...");
            $amount = $this->wager;
            $this->log("Player wins $" . $amount . "!");
            $this->adjustBank($amount, $userId, $database);
        } else if ($this->playerHasBlackjack) { // Player blackjack
            $amount = 2.5 * $this->wager;
            $this->log("Player wins $" . $amount . "!");
            $this->adjustBank($amount, $userId, $database);
        } elseif ($dealerScore > 21 || $playerScore > $dealerScore) {
            $amount = 2 * $this->wager;
            $this->log("Player wins $" . $amount . "!");
            $this->adjustBank($amount, $userId, $database);
        } else {
            $this->log("House wins.");
        }

        $this->state = State::ROUND_END;
    }

    private function log($message) {
        $this->gameLog[] = $message;
    }

    /**
     * @param $userId int
     * @param $database PDO
     */
    private function placeWager($userId, $database) {
        $amount = -1 * $this->wager;
        $this->adjustBank($amount, $userId, $database);
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