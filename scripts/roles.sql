CREATE ROLE administrador;

CREATE ROLE usuario;

GRANT select,update,insert on fondo.credito to administrador;
GRANT select,update,insert on fondo.cuenta_fondo to administrador;
GRANT select,update,insert on fondo.cuenta_aporte to administrador;
GRANT select,update,insert on fondo.mov_cuenta_aporte to administrador;
GRANT select,update,insert on fondo.movimiento_cuenta to administrador;
GRANT select,update,insert on fondo.pago_aporte to administrador;
GRANT select,update,insert on fondo.pago_credito to administrador;
GRANT select,update,insert on fondo.parametro to administrador;
GRANT select,update,insert on fondo.socio to administrador;
GRANT select,update,insert on fondo.socio_administrador to administrador;
GRANT select,update,insert on fondo.tipo_credito to administrador;
GRANT select,update,insert on fondo.tipo_pago to administrador;
GRANT select,update,insert on fondo.tipo_movimiento to administrador;
GRANT select,update,insert on fondo.usuario to administrador;
GRANT connect,resource to administrador;

CREATE USER socio_administrador identified by socioAdmin;

GRANT administrador to socio_administrador;

GRANT select on fondo.credito to usuario;
GRANT select on fondo.mov_cuenta_aporte to usuario;
GRANT select on fondo.pago_aporte to usuario;
GRANT select on fondo.pago_credito to usuario;
GRANT select on fondo.parametro to usuario;
GRANT select on fondo.socio to usuario;
GRANT select on fondo.socio_administrador to usuario;
GRANT select on fondo.tipo_credito to usuario;
CREATE VIEW usuario_id_view as select k_id_usuario, n_username from fondo.usuario;
CREATE PUBLIC SYNONYM usuario_id_syn FOR usuario_id_view;
GRANT select on usuario_id_syn to usuario;
GRANT select on usuario_id_syn to administrador;
GRANT connect to usuario;
