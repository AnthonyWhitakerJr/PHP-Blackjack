INSERT INTO ranks (userId, position)
SELECT id as userId, @rank:= @rank + 1 AS position
FROM users, (SELECT @rank:= 0) r
ORDER BY net_earnings DESC, last_active ASC;