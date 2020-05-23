DROP PROCEDURE IF EXISTS deleteCupon;
 
DELIMITER $$
 
CREATE PROCEDURE deleteCupon(IN _cuponId INT)

BEGIN

	/* SE ELIMINA EL ARTICULO */
	DELETE FROM cupones WHERE cupon_id = _cuponId;

END $$
DELIMITER ;
