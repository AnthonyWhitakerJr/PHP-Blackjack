create table ranks
(
  userId   int not null primary key,
  position int not null,
  constraint ranks_users_id_fk
    foreign key (userId) references users (id)
);