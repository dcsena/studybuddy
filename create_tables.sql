CREATE TABLE PartnerRequests (
	id SERIAL PRIMARY KEY,
	email varchar(255) NOT NULL,
	class varchar(50) NOT NULL,
	submitted timestamp default current_timestamp,
	time1 integer NOT NULL,
	time2 integer NOT NULL,
	paired boolean NOT NULL
);

CREATE TABLE Users (
	name varchar(50) NOT NULL,
	email varchar(255) PRIMARY KEY,
	passwordhash varchar(255),
	passwordsalt varchar(255),
	college varchar(255),
	grad_year integer,
	major varchar(255)
);

CREATE TABLE Pairings (
	unique_id SERIAL PRIMARY KEY,
	id1 integer,
	id2 integer,
	email1 varchar(255),
	email2 varchar(255),
	class varchar(50) NOT NULL,
	date timestamp default current_timestamp
);