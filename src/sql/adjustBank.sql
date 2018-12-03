UPDATE users
SET bank         = bank + :amount,
    net_earnings = net_earnings + :amount
where id = :userId;