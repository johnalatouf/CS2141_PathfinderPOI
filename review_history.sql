DELIMITER $$
DROP TRIGGER IF EXISTS review_history$$
CREATE TRIGGER review_history
AFTER INSERT ON reviews
FOR EACH ROW
BEGIN

    /* include the review ID with the user history */
    UPDATE user_history
    SET user_history.reviews = (SELECT reviewID FROM reviews WHERE reviews.user = NEW.user AND reviews.attraction = NEW.attraction)
    WHERE user_history.userID = NEW.user AND user_history.attraction_visited = NEW.attraction;

    
END$$
DELIMITER ;