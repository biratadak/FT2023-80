create DATABASE IPL;
use IPL;
CREATE TABLE `schedule` (
  `Match No` int PRIMARY KEY,
  `Venue of Match` varchar(100),
  `Team 1 name` varchar(20),
  `Team 2 name` varchar(20),
  `Date of Match` date
);

CREATE TABLE `captain` (
  `Team name` varchar(20),
  `Captain of Team` varchar(20)
);

CREATE TABLE `result` (
  `Match No` int,
  `Match Won by` set('1','2'),
  `Toss Won by` set('1','2')
);

/*

Created a database 'IPL' and then 3 tables in it.
Created three new tables named SCHEDULE, CAPTAIN and RESULT.
defined the Match No as primary key.
I can join the schedule and result table using match-id.
to get the result of any Match or Toss we have to check for the team name field in SCHEDULE table using tha same match id.

*/
