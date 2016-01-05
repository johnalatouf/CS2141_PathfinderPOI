CREATE PROCEDURE `deleteUserReview` (IN uID CHAR(30), IN attID INT)
BEGIN
	DELETE FROM reviews
    WHERE attraction = attID AND user = uID;
END
