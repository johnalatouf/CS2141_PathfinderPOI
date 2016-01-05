DELIMITER $$
DROP TRIGGER IF EXISTS average_ratings$$
CREATE TRIGGER average_ratings
AFTER INSERT ON ratings
FOR EACH ROW
BEGIN

	/* get the avg rating of the attraction */
    
    UPDATE attractions 
    SET attractions.avgRating = (SELECT AVG(ratings.rating) 
		FROM ratings WHERE ratings.attraction = attractions.attractionID)     
    WHERE attractions.attractionID = NEW.attraction; 
    
    /*  Update the popularity  */
    
    UPDATE attractions
    SET attractions.popularity = (
		SELECT COUNT(*)
        FROM ratings WHERE ratings.attraction = NEW.attraction)
	WHERE attractions.attractionID = NEW.attraction; 
    
    /* count the avg rating of the city */
    
	UPDATE cities 
	SET cities.avgRating = (
		SELECT AVG(rating)
		FROM
		(
			SELECT rating, attraction, city FROM ratings
			INNER JOIN attractions ON attractions.attractionID = ratings.attraction
			WHERE city = (SELECT city FROM attractions WHERE attractionID = NEW.attraction)
		) AS tbl
        WHERE cityID = (SELECT city FROM attractions WHERE attractionID = NEW.attraction)
	)
    WHERE cityID = (SELECT city FROM attractions WHERE attractionID = NEW.attraction);
    
    /* count the popularity of the city */
    
    UPDATE cities
	SET popularity = (
		SELECT COUNT(*) 
        FROM
		(
			SELECT rating, attraction, city FROM ratings
			INNER JOIN attractions ON attractions.attractionID = ratings.attraction
			WHERE city = (SELECT city FROM attractions WHERE attractionID = NEW.attraction)
		) AS tbl
	WHERE cityID = (SELECT city FROM attractions WHERE attractionID = NEW.attraction)
    )
    WHERE cityID = (SELECT city FROM attractions WHERE attractionID = NEW.attraction);
    
    /* count the avg rating of the country */
    
	UPDATE countries 
	SET countries.avgRating = (
		SELECT AVG(rating)
		FROM
		(
			SELECT rating, attraction, country FROM ratings
			INNER JOIN attractions ON attractions.attractionID = ratings.attraction
			WHERE country = (SELECT country FROM attractions WHERE attractionID = NEW.attraction)
		) AS tbl
        WHERE countryID = (SELECT country FROM attractions WHERE attractionID = NEW.attraction)
	)
    WHERE countryID = (SELECT country FROM attractions WHERE attractionID = NEW.attraction);
    
    /* count the popularity of the country */
    
    UPDATE countries
	SET popularity = (
		SELECT COUNT(*) 
        FROM
		(
			SELECT rating, attraction, country FROM ratings
			INNER JOIN attractions ON attractions.attractionID = ratings.attraction
			WHERE country = (SELECT country FROM attractions WHERE attractionID = NEW.attraction)
		) AS tbl
	WHERE countryID = (SELECT country FROM attractions WHERE attractionID = NEW.attraction)
    )
    WHERE countryID = (SELECT country FROM attractions WHERE attractionID = NEW.attraction);
    
    /* update the user history */
    INSERT INTO user_history (userID, attraction_visited, date_visited, rating)
    VALUES (NEW.user, NEW.attraction, NEW.date_visited, NEW.rating);
    
    /* include the review ID with the user history */
    UPDATE user_history
    SET reviews = (SELECT reviewID FROM reviews WHERE reviews.user = NEW.user AND reviews.attraction = NEW.attraction)
    WHERE user_history.userID = NEW.user AND user_history.attraction_visited = NEW.attraction;

    /* update the category popularity */
    UPDATE categories 
    SET popularity = (
		SELECT COUNT(*)
        FROM
        (
			SELECT rating, attraction, category FROM ratings
            INNER JOIN attractions ON attractions.attractionID = ratings.attraction
            WHERE category = (SELECT category FROM attractions WHERE attractionID = NEW.attraction)
		) AS tab
	WHERE category = (SELECT category from attractions WHERE attractionID = NEW.attraction)
    )
    WHERE category = (SELECT category from attractions WHERE attractionID = NEW.attraction);
    
    UPDATE categories
	SET categories.avgRating = (
		SELECT AVG(rating)
		FROM
		(
			SELECT rating, attraction, category FROM ratings
			INNER JOIN attractions ON attractions.attractionID = ratings.attraction
			WHERE category = (SELECT category FROM attractions WHERE attractionID = NEW.attraction)
		) AS tbl
        WHERE category = (SELECT category FROM attractions WHERE attractionID = NEW.attraction)
	)
    WHERE category = (SELECT category FROM attractions WHERE attractionID = NEW.attraction);
    
    /* if user has this in their wishlist, remove */
    
    DELETE FROM user_wishlist
    WHERE userID = NEW.user AND attraction = NEW.attraction;
    
END$$
DELIMITER ;