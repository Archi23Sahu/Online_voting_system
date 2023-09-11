create database election;
use election;
create table siteuser
(
voterid varchar(40) primary key,
pwd  varchar(40) ,
fname varchar(40) ,
lname varchar(40) ,
dob date,
gender  varchar(6) ,
email  varchar(30) ,
contact varchar(30) ,
address	varchar(250),
hintq varchar(30) ,
hinta varchar(30) ,
role varchar(30) ,
active varchar(3),
photoid   	int(6),
regionid     int(5) 
);

create table up_db
(
fileid	int(4) primary key auto_increment,
filename	varchar(30),
filetype	varchar(30),
filesize	int(9),
filedata	mediumblob,
purpose	varchar(30),
udate	date,
utime	time
);


create table region
(
regionid	int(5) primary key auto_increment,
regionname varchar(30),
city	varchar(30),
state	varchar(30),
details	varchar(250)
);


create table party
(
partyid	int(3) primary key auto_increment,
partyname varchar(30),
party_symbol_name varchar(30),
party_symbol_id int(5),
partytype	varchar(20)
);


create table candidate
(
cand_voterid	varchar(30) primary key,
qualification	varchar(200),
candidate_type	varchar(50),
partyid		int(4),
candidate_symbol_name varchar(30),
candidate_symbol_id	 int(5),
regionid int(5),
electionid int(5)
);

create table election
(
electionid	int(5) primary key auto_increment, 
electionname  varchar(30),
electiondate  date,
election_start_time time,
election_end_time time
);

create table votes
(
voteid	int(9)	primary key auto_increment,
electionid   int(5),
voter_voterid	varchar(30),
cand_voterid	varchar(30),
regionid int(4)
);

create table applyvoter
(
fname varchar(40) ,
lname varchar(40) ,
dob date,
gender  varchar(6) ,
email  varchar(30) ,
contact varchar(30) ,
address	varchar(250),
role varchar(30) ,
active varchar(3),
docid  	int(6),
regionid     int(5) 
);

create table faq
( 
email varchar(30),
ques varchar(50)

);

create table up_apply
(
fileid	int(4) primary key auto_increment,
filename	varchar(30),
filetype	varchar(30),
filesize	int(9),
filedata	mediumblob,
purpose	varchar(30),
udate	date,
utime	time
);