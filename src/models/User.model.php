<?php


class User {
    private $id;
    private $username;
    private $display_name;
    private $profile_pic_uri;
    private $bank;
    private $net_earnings;
    private $last_borrow;
    private $last_active;

    /**
     * User constructor.
     * @param $id
     * @param $username
     * @param $display_name
     * @param $profile_pic_uri
     * @param $bank
     * @param $net_earnings
     * @param $last_borrow
     * @param $last_active
     */
    public function __construct($id, $username, $display_name, $profile_pic_uri, $bank, $net_earnings, $last_borrow, $last_active) {
        $this->id = $id;
        $this->username = $username;
        $this->display_name = $display_name;
        $this->profile_pic_uri = $profile_pic_uri;
        $this->bank = $bank;
        $this->net_earnings = $net_earnings;
        $this->last_borrow = $last_borrow;
        $this->last_active = $last_active;
    }

    public static function getBlankUser() {
        return new User(null, null, null, null, null, null, null, null);
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getDisplayName() {
        return $this->display_name;
    }

    /**
     * @return mixed
     */
    public function getProfilePicUri() {
        return $this->profile_pic_uri;
    }

    /**
     * @return mixed
     */
    public function getBank() {
        return $this->bank;
    }

    /**
     * @return mixed
     */
    public function getNetEarnings() {
        return $this->net_earnings;
    }

    /**
     * @return mixed
     */
    public function getLastBorrow() {
        return $this->last_borrow;
    }

    /**
     * @return mixed
     */
    public function getLastActive() {
        return $this->last_active;
    }


}