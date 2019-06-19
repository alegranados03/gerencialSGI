/* ESTE SCRIPT DEBE CORRERSE CON UN USUARIO DEL SGBD QUE TENGA TODOS LOS PERMISOS Y ATRIBUTOS DE SUPER USUARIO,
   DEBIDO A QUE NO CUALQUIER TIPO DE USUARIO PUEDE OTORGAR ESTOS PERMISOS A LOS USUARIOS QUE SE CREARÁN CON
   ESTE SCRIPT*/
use gerencialpan;
CREATE USER panaderialila@localhost IDENTIFIED BY 'PanaderiaLilaGerencial';
CREATE USER panaderialila_etl@localhost IDENTIFIED BY 'PanaderiaLilaETL';
CREATE USER gerencial_visitante@localhost IDENTIFIED BY 'Visitante';


GRANT ALL PRIVILEGES ON gerencialpan TO panaderialila@localhost IDENTIFIED BY 'PanaderiaLilaGerencial';
GRANT ALL PRIVILEGES ON gerencialpan.* TO panaderialila@localhost IDENTIFIED BY 'PanaderiaLilaGerencial';


GRANT ALL PRIVILEGES ON transaccional_sgi TO panaderialila_etl@localhost IDENTIFIED BY 'PanaderiaLilaETL';
GRANT SELECT ON transaccional_sgi.* TO panaderialila_etl@localhost IDENTIFIED BY 'PanaderiaLilaETL';
GRANT INSERT,DELETE,DROP ON gerencialpan.gerencial_categoria TO panaderialila_etl@localhost IDENTIFIED BY 'PanaderiaLilaETL';
GRANT INSERT,DELETE,DROP ON gerencialpan.gerencial_compra TO panaderialila_etl@localhost IDENTIFIED BY 'PanaderiaLilaETL';
GRANT INSERT,DELETE,DROP ON gerencialpan.gerencial_detalle_orden TO panaderialila_etl@localhost IDENTIFIED BY 'PanaderiaLilaETL';
GRANT INSERT,DELETE,DROP ON gerencialpan.gerencial_pago TO panaderialila_etl@localhost IDENTIFIED BY 'PanaderiaLilaETL';
GRANT INSERT,DELETE,DROP ON gerencialpan.gerencial_producto TO panaderialila_etl@localhost IDENTIFIED BY 'PanaderiaLilaETL';
GRANT INSERT,DELETE,DROP ON gerencialpan.gerencial_proveedor TO panaderialila_etl@localhost IDENTIFIED BY 'PanaderiaLilaETL';
GRANT INSERT,DELETE,DROP ON gerencialpan.gerencial_usuario TO panaderialila_etl@localhost IDENTIFIED BY 'PanaderiaLilaETL';
GRANT INSERT,DELETE,DROP ON gerencialpan.historial_actividad TO panaderialila_etl@localhost IDENTIFIED BY 'PanaderiaLilaETL';
GRANT INSERT,DELETE,DROP ON gerencialpan.gerencial_lote TO panaderialila_etl@localhost IDENTIFIED BY 'PanaderiaLilaETL';
GRANT INSERT,DELETE,DROP ON gerencialpan.gerencial_materia_prima TO panaderialila_etl@localhost IDENTIFIED BY 'PanaderiaLilaETL';
GRANT INSERT,DELETE,DROP ON gerencialpan.gerencial_orden TO panaderialila_etl@localhost IDENTIFIED BY 'PanaderiaLilaETL';
GRANT SUPER ON *.* TO panaderialila_etl@localhost IDENTIFIED BY 'PanaderiaLilaETL';

GRANT SELECT ON gerencialpan.* TO panaderialila_visitante@localhost IDENTIFIED BY 'Visitante';

FLUSH PRIVILEGES;