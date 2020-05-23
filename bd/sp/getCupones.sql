DROP PROCEDURE IF EXISTS getCupones;
 
DELIMITER $$
 
CREATE PROCEDURE getCupones()

BEGIN

	SELECT 	a.cupon,
			a.tipo_descuento as tipoDescuento,
			a.descuento,
			IF(a.aplicado=0, "NO", "SI") as aplicadoTexto,
			a.aplicado
	FROM cupones a;

END $$
DELIMITER ;
