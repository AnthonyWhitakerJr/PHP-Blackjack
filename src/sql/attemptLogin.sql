/* Select customers where the username and password match those passed as parameters */
select userId
from users
where username = :username
and password = :password
	