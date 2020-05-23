DROP PROCEDURE IF EXISTS checkLogin;
 
DELIMITER $$
 
CREATE PROCEDURE checkLogin(IN _usuario CHAR(64), IN _password CHAR(64))

BEGIN 	
	SELECT	a.usuario,
			a.password
	FROM usuarios a
	WHERE a.usuario = _usuario AND a.password = _password;
END $$
DELIMITER ;
