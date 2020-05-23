DROP PROCEDURE IF EXISTS getPrestamos;
 
DELIMITER $$
 
CREATE PROCEDURE getPrestamos()

BEGIN

	SELECT 	a.prestamo_id as prestamoId,
			a.cliente_id as clienteId, 
			b.nombre as nombre,
			b.apellido_paterno as apellidoPaterno,
			b.apellido_materno as apellidoMaterno,
			c.monto_id as montoId,
			c.monto,
			d.plazo_id as plazoId,
			d.plazo,
			e.interes_id as interesId,
			e.interes
	FROM prestamos a
		INNER JOIN clientes b ON a.cliente_id = b.cliente_id
		INNER JOIN montos c ON a.monto_id = c.monto_id
		INNER JOIN plazos d ON a.plazo_id = d.plazo_id
		INNER JOIN intereses e ON a.interes_id = e.interes_id;

END $$
DELIMITER ;
