DROP PROCEDURE IF EXISTS getClientes;
 
DELIMITER $$
 
CREATE PROCEDURE getClientes()

BEGIN

	SELECT 	a.cliente_id as clienteId, 
			a.nombre as nombre,
			a.apellido_paterno as apellidoPaterno,
			a.apellido_materno as apellidoMaterno,
			a.rfc
	FROM clientes a;

END $$
DELIMITER ;
