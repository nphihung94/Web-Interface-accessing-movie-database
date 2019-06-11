-- Movie table with id unique to each movie (Primary Key Constraint).
-- Each movie has to have a title and release year has to be greater 
-- than 1888 - when first movie made (Check Condition)
CREATE TABLE Movie (
       id INT NOT NULL,
       title VARCHAR(100) NOT NULL,
       year INT NOT NULL,
       rating VARCHAR(10),
       company VARCHAR(50),
       PRIMARY KEY (id),
       CHECK (year >= 1888)
)ENGINE = INNODB;

-- The Actor Table with id unique to each actor/director (Primary Key Constraint)
-- Date of birth has to be before Date of death if the person dead (CHECK condition)
CREATE TABLE Actor (
       id INT NOT NULL,
       last VARCHAR(20) NOT NULL,
       first VARCHAR(20) NOT NULL,
       sex VARCHAR(6),
       dob DATE NOT NULL,
       dod DATE,
       PRIMARY KEY (id),
       CHECK (dod IS NULL OR dob < dod)
)ENGINE = INNODB;

-- The Sales table with id unique for each movie. (Primary Key Constraint)
-- mid Referential Constraint with Movie id
CREATE TABLE Sales(
       mid INT NOT NULL,
       ticketsSold INT,
       totalIncome INT,
       PRIMARY KEY (mid),
       FOREIGN KEY (mid) REFERENCES Movie(id)
)ENGINE = INNODB;

-- The Director table with id unique for director. (Primary Key Constraint)
-- CHECK constraint: Date of Death have to be later than Date of Birth
CREATE TABLE Director(
       id INT NOT NULL,
       last VARCHAR(20) NOT NULL,
       first VARCHAR(20) NOT NULL,
       dob DATE NOT NULL,
       dod DATE,
       PRIMARY KEY (id),
       CHECK (dod IS NULL OR dod > dob)
)ENGINE = INNODB;

-- The MovieGenre table with unique mid. (Primary Key Constraint)
-- mid Referential Constraint with Movie id
CREATE TABLE MovieGenre(
       mid INT NOT NULL,
       genre VARCHAR(20),
       PRIMARY KEY (mid),
       FOREIGN KEY (mid) REFERENCES Movie(id)
)ENGINE = INNODB;

-- The Movie Director table, with unique mid and unique did. (Primary Key Constraint)
-- mid and did have Referential Constraint with Movie id and Director id
CREATE TABLE MovieDirector(
       mid INT NOT NULL,
       did INT NOT NULL,
       PRIMARY KEY (mid,did),
       FOREIGN KEY (mid) REFERENCES Movie(id),
       FOREIGN KEY (did) REFERENCES Director(id)
)ENGINE = INNODB;

-- The Movie Actor table with unique mid and aid. (Primary Key Constraint)
-- mid and aid have Referential Constraint with Movie id and Actor id
CREATE TABLE MovieActor(
       mid INT NOT NULL,
       aid INT NOT NULL,
       role VARCHAR(50),
       PRIMARY KEY (mid,aid),
       FOREIGN KEY (mid) REFERENCES Movie(id),
       FOREIGN KEY (aid) REFERENCES Actor(id)
)ENGINE = INNODB;

-- The MovieRating table with unique mid. (Primary Key Constraint)
-- mid has Referential Constraint with Movie id
-- Check condition: imdb and rotten tomatoes rating has to be less than 100 and greater than 0
CREATE TABLE MovieRating(
       mid INT NOT NULL,
       imdb INT,
       rot INT,
       PRIMARY KEY(mid),
       FOREIGN KEY (mid) REFERENCES Movie(id),
       CHECK (imdb IS NULL OR (imdb >= 0 AND imdb <=100)),
       CHECK (rot IS NULL OR (rot >= 0 AND rot <= 100))
)ENGINE = INNODB;

-- The Review table with each person at one time for one movie. (Primary Key Constraint)
-- mid has Referential Constraint with Movie id
-- Check Condition: Rating has to be less than 5 and greater than 0
CREATE TABLE Review(
       name VARCHAR(20) NOT NULL,
       time TIMESTAMP NOT NULL,
       mid INT NOT NULL,
       rating INT,
       comment VARCHAR(500),
       PRIMARY KEY (name,time,mid),
       FOREIGN KEY (mid) REFERENCES Movie(id),
       CHECK (rating IS NULL OR (rating >= 0 AND rating <= 5))
)ENGINE = INNODB;

-- Max ID
CREATE TABLE MaxPersonID(
       id INT NOT NULL,
       PRIMARY KEY (id)
)ENGINE = INNODB;

-- Max Movie ID
CREATE TABLE MaxMovieID(
       id INT NOT NULL,
       PRIMARY KEY (id)
)ENGINE = INNODB;
