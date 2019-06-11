-- Load to Actor Table
LOAD DATA LOCAL INFILE '~/data/actor1.del' INTO TABLE Actor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

LOAD DATA LOCAL INFILE '~/data/actor2.del' INTO TABLE Actor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

LOAD DATA LOCAL INFILE '~/data/actor3.del' INTO TABLE Actor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

-- Load to Director Table
LOAD DATA LOCAL INFILE '~/data/director.del' INTO TABLE Director
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

-- Load to Movie Table
LOAD DATA LOCAL INFILE '~/data/movie.del' INTO TABLE Movie
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

-- Load to Movie Actor Table
LOAD DATA LOCAL INFILE '~/data/movieactor1.del' INTO TABLE MovieActor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

LOAD DATA LOCAL INFILE '~/data/movieactor2.del' INTO TABLE MovieActor
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

-- Load to Movie Director Table
LOAD DATA LOCAL INFILE '~/data/moviedirector.del' INTO TABLE MovieDirector
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

-- Load to Movie Genre Table
LOAD DATA LOCAL INFILE '~/data/moviegenre.del' INTO TABLE MovieGenre
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

-- Load to Sales Table
LOAD DATA LOCAL INFILE '~/data/sales.del' INTO TABLE Sales
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

-- Load to Movie Rating Table
LOAD DATA LOCAL INFILE '~/data/movierating.del' INTO TABLE MovieRating
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

-- Tuples for MaxPersonID
INSERT INTO MaxPersonID values (69000);

-- Tuples for MaxMovieID
INSERT INTO MaxMovieID values (4750);
