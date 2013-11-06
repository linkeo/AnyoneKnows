AnyoneKnows
===========

A website for questions and answers, with HTML5

Some models is defined as bellow:

``` MySQL
	CREATE TABLE user(
		uid int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
		username varchar(32) NOT NULL UNIQUE,
		password varchar(32) NOT NULL,
		name varchar(64),
		email varchar(128),
		website varchar(128),
		location varchar(128),
		gender int(1),
		avator longblob,
		time datetime
		);
```