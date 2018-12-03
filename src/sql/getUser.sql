/* Select users where the id is equal to a passed user id */
select username, display_name, profile_pic_uri, bank, net_earnings, last_borrow, last_active
from users
where id = :userId
order by id
limit 1;