USE `PathfinderPOI`;
DROP procedure IF EXISTS `removeAttraction`;

DELIMITER $$
USE `PathfinderPOI`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `removeAttraction`(IN attID INT)
BEGIN
	DELETE FROM ratings
	WHERE attraction = attID;
    
    DELETE FROM user_wishlist
    WHERE attraction = attID;
    
    DELETE FROM user_history
    WHERE attraction_visited = attID;
    
    DELETE FROM reviews
    WHERE attraction = attID;
    
    DELETE FROM attractions
    WHERE attractionID = attID;
END$$

DELIMITER ;