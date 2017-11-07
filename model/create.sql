CREATE TABLE image (
id int primary key,
path varchar(1024),
category varchar(64),
comment varchar(1024),
totalNotes int,
nbVotes int
);
CREATE TABLE membre(
user_id integer primary key AUTOINCREMENT,
login varchar(32),
password varchar(32)
);
