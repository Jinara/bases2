delete from movimiento_cuenta;
delete from cuenta_fondo;
delete from PAGO_CREDITO;
delete from CREDITO;
delete from TIPO_CREDITO;
delete from MOV_CUENTA_APORTE;
delete from PAGO_APORTE;
delete from CUENTA_APORTE;
delete from SOCIO_ADMINISTRADOR;
delete from SOCIO;
delete from TIPO_MOVIMIENTO;
delete from TIPO_PAGO;
delete from PARAMETRO;
delete from FONDO;
delete from USUARIO;

drop user camilo cascade;
drop user guilleromo cascade;
drop user jeronimo cascade;
drop user jose cascade;
drop user eliana cascade;
drop user daniela cascade;
drop user estefania cascade;
drop user marcela cascade;
drop user rafael cascade;
drop user socio_administrador cascade;

drop role socio;
drop role admin;
drop role usuario;
drop role administrador;

drop view usuario_id cascade;
drop public synonym usuario_id_syn;