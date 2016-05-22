CREATE ROLE socio_admin;

CREATE ROLE socio;

GRANT select,update,insert on fondo.credito to socio_admin;
GRANT select,update,insert on fondo.cuenta_fondo to socio_admin;
GRANT select,update,insert on fondo.cuenta_aporte to socio_admin;
GRANT select,update,insert on fondo.mov_cuenta_aporte to socio_admin;
GRANT select,update,insert on fondo.movimiento_cuenta to socio_admin;
GRANT select,update,insert on fondo.pago_aporte to socio_admin;
GRANT select,update,insert on fondo.pago_credito to socio_admin;
GRANT select,update,insert on fondo.parametro to socio_admin;
GRANT select,update,insert on fondo.socio to socio_admin;
GRANT select,update,insert on fondo.socio_administrador to socio_admin;
GRANT select,update,insert on fondo.tipo_credito to socio_admin;
GRANT select,update,insert on fondo.tipo_pago to socio_admin;
GRANT select,update,insert on fondo.tipo_movimiento to socio_admin;
GRANT select,update,insert on fondo.usuario to socio_admin;
GRANT connect,resource to socio_admin;

CREATE USER socio_administrador identified by socioAdmin;

GRANT socio_admin to socio_administrador;

GRANT select on fondo.credito to socio;
GRANT select on fondo.mov_cuenta_aporte to socio;
GRANT select on fondo.pago_aporte to socio;
GRANT select on fondo.pago_credito to socio;
GRANT select on fondo.parametro to socio;
GRANT select on fondo.socio to socio;
GRANT select on fondo.socio_administrador to socio;
GRANT select on fondo.tipo_credito to socio;
create public synonym usuario for k_id_usuario;
grant select on usuario to socio;
GRANT connect to socio;
