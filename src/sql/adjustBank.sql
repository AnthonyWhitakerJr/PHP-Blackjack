UPDATE users
SET bank = bank - :amount
where id = :userId;