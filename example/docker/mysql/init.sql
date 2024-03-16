create table `users` (
	`id` int unsigned not null auto_increment,
	`login` binary(16) not null comment 'md5',
	`password` binary(64) not null comment 'sha-512',
	`nickname` varchar(255) not null,
	`ct` int unsigned not null,
	`ut` int unsigned not null,
	primary key (`id`),
	key `login` (`login`)
);

create table `posts` (
	`id` int unsigned not null auto_increment,
	`title` varchar(255) not null,
	`src` varchar(30000) not null,
	`html` varchar(30000) not null,
	`author` int unsigned not null, 
	`pubTime` int unsigned not null,
	`ct` int unsigned not null,
	`ut` int unsigned not null,
	primary key (`id`),
	foreign key `author` (`author`)
		references `users` (`id`)
		on update cascade
		on delete cascade
);

create table `comments` (
	`id` int unsigned not null auto_increment,
	`ct` int unsigned not null,
	`ut` int unsigned not null,
	primary key (`id`)
);