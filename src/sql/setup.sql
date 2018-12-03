create table users
(
  id              int          not null auto_increment primary key,
  username        varchar(45)  not null,
  password        varchar(256) not null,
  display_name    varchar(45),
  profile_pic_uri varchar(512),
  bank            int          not null default 1000,
  net_earnings    int          not null default 0,
  last_borrow     datetime     not null default now(),
  last_active     datetime     not null default now() on update now(),
  unique key `username_UNIQUE` (`username` ASC)
);