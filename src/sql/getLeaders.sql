SELECT username, display_name, net_earnings, @rank:= @rank + 1 AS rank
FROM users, (SELECT @rank:= 0) r
ORDER BY net_earnings DESC, last_active ASC
LIMIT 25;