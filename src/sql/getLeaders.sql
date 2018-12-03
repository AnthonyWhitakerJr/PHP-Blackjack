SELECT @rank:= 0;
SELECT @rank:= @rank + 1 AS rank, u.*
FROM (
  SELECT username, display_name, net_earnings
  FROM users
  ORDER BY net_earnings DESC, last_active ASC
  LIMIT 25
) u;