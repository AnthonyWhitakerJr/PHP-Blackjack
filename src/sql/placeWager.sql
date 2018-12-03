UPDATE users
SET bank = bank - :wager
where id = :userId;