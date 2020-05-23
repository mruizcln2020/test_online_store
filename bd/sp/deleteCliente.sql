DROP PROCEDURE IF EXISTS deleteCliente;
 
DELIMITER $$
 
CREATE PROCEDURE deleteCliente(IN _clienteId INT)

BEGIN

	DELETE FROM clientes WHERE cliente_id = _clienteId;

END $$
DELIMITER ;
