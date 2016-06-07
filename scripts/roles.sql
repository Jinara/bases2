CREATE ROLE administrador;

CREATE ROLE usuario;

GRANT select,update,insert on credito to administrador;
GRANT select,update,insert on cuenta_fondo to administrador;
GRANT select,update,insert on cuenta_aporte to administrador;
GRANT select,update,insert on mov_cuenta_aporte to administrador;
GRANT select,update,insert on movimiento_cuenta to administrador;
GRANT select,update,insert on pago_aporte to administrador;
GRANT select,update,insert on pago_credito to administrador;
GRANT select,update,insert on parametro to administrador;
GRANT select,update,insert on socio to administrador;
GRANT select,update,insert on socio_administrador to administrador;
GRANT select,update,insert on tipo_credito to administrador;
GRANT select,update,insert on tipo_pago to administrador;
GRANT select,update,insert on tipo_movimiento to administrador;
GRANT select,update,insert on usuario to administrador;
GRANT select on fondo to administrador;
GRANT connect,resource to administrador;

CREATE USER socio_administrador identified by socioAdmin;

GRANT administrador to socio_administrador;

GRANT select on credito to usuario;
GRANT select on mov_cuenta_aporte to usuario;
GRANT select on pago_aporte to usuario;
GRANT select on pago_credito to usuario;
GRANT select on parametro to usuario;
GRANT select on socio to usuario;
GRANT select on socio_administrador to usuario;
GRANT select on tipo_credito to usuario;
CREATE VIEW usuario_id_view as select k_id_usuario, n_username from usuario;
CREATE PUBLIC SYNONYM usuario_id_syn FOR usuario_id_view;
GRANT select on usuario_id_syn to usuario;
GRANT select on usuario_id_syn to administrador;
GRANT connect to usuario;
