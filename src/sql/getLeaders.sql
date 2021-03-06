SELECT username, display_name, net_earnings, position as rank
FROM users
     inner join ranks r on users.id = r.userId
ORDER BY r.position asc
LIMIT 25;