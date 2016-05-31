--Modificacion formato fecha
ALTER SESSION SET nls_date_format='yyyy-mm-dd';

--Usuarios 9
INSERT INTO USUARIO (k_id_usuario,
	n_apellido_usuario,n_usuario,o_tipo_doc,v_num_doc,v_tarjeta_profesional,
	n_ocupacion,o_estado_civil,o_sexo,v_telefono,o_direccion,o_correo_electronico,n_username)
	VALUES
	('013546','Burgos','Jeronimo','CC','1036897542','5491324','Desarrollador','S','M','3167954681','Carrera 13 #64-29','mcla_chiclayana_@hotmail.com','Jeronimo');
INSERT INTO USUARIO (k_id_usuario,
	n_apellido_usuario,n_usuario,o_tipo_doc,v_num_doc,v_tarjeta_profesional,
	n_ocupacion,o_estado_civil,o_sexo,v_telefono,o_direccion,o_correo_electronico,n_username)
	VALUES
	('002475','Villegas','Estefania','CC','1320356558','4978513','Analista','C','F','3215467821','Calle 13 #8A-34','martindalforno@hotmail.com','Estefania');
INSERT INTO USUARIO (k_id_usuario,
	n_apellido_usuario,n_usuario,o_tipo_doc,v_num_doc,v_tarjeta_profesional,
	n_ocupacion,o_estado_civil,o_sexo,v_telefono,o_direccion,o_correo_electronico,n_username)
	VALUES
	('002476','Fernandez','Guillermo','CC','1037924565','1157989','Desarrollador','U','M','3161237845','Carrera 8 #17-30 Piso 3-4','darky_ardiyani@hotmail.com','Guillermo');
INSERT INTO USUARIO (k_id_usuario,
	n_apellido_usuario,n_usuario,o_tipo_doc,v_num_doc,v_tarjeta_profesional,
	n_ocupacion,o_estado_civil,o_sexo,v_telefono,o_direccion,o_correo_electronico,n_username)
	VALUES
	('013549','Ramirez','Eliana','CE','1032689498','1679513','Analista','S','F','3167985238','Carrera 15A #120-63','jctaech@hotmail.com','Eliana');
INSERT INTO USUARIO (k_id_usuario,
	n_apellido_usuario,n_usuario,o_tipo_doc,v_num_doc,v_tarjeta_profesional,
	n_ocupacion,o_estado_civil,o_sexo,v_telefono,o_direccion,o_correo_electronico,n_username)
	VALUES
	('056231','Carmona','Jose','CC','1032698785','1679856','Analista','S','M','3156987412','Carrera 9 #69-31','lydya.com@hotmail.com','Jose');
INSERT INTO USUARIO (k_id_usuario,
	n_apellido_usuario,n_usuario,o_tipo_doc,v_num_doc,v_tarjeta_profesional,
	n_ocupacion,o_estado_civil,o_sexo,v_telefono,o_direccion,o_correo_electronico,n_username)
	VALUES
	('039891','De,santis','Marcela','CC','1036795626','5945631','Desarrollador','V','F','3134586321','Carrera 7 #22-86 Bloque B','lamh007@hotmail.com','Marcela');
INSERT INTO USUARIO (k_id_usuario,
	n_apellido_usuario,n_usuario,o_tipo_doc,v_num_doc,v_tarjeta_profesional,
	n_ocupacion,o_estado_civil,o_sexo,v_telefono,o_direccion,o_correo_electronico,n_username)
	VALUES
	('031655','Franco','Daniela','P','1036894455','1698856','Desarrollador','U','F','3162679411','Carrera 16 #80-90','forrito93@hotmail.com','Daniela');
INSERT INTO USUARIO (k_id_usuario,
	n_apellido_usuario,n_usuario,o_tipo_doc,v_num_doc,v_tarjeta_profesional,
	n_ocupacion,o_estado_civil,o_sexo,v_telefono,o_direccion,o_correo_electronico,n_username)
	VALUES
	('013548','Cortes','Rafael','P','1039784565','1667841','Desarrollador','S','M','3213597981','Calle 63 #10-83 Piso 2','gahan10@hotmail.com','Rafael');
INSERT INTO USUARIO (k_id_usuario,
	n_apellido_usuario,n_usuario,o_tipo_doc,v_num_doc,v_tarjeta_profesional,
	n_ocupacion,o_estado_civil,o_sexo,v_telefono,o_direccion,o_correo_electronico,n_username)
	VALUES
	('036679','Berrio','Camilo','CC','1078597854','6678451','Desarrollador','S','M','3169875415','Carrera 14 #98-60','soniamedi@hotmail.com','Camilo');

--FONDO PRIMERA ENTREGA
INSERT INTO FONDO
	(k_nit_fondo, n_fondo, o_num_cuenta)
	VALUES
	('159845618','Fondo de Ahorro y Credito de Profesionales de Ingenieria de Sistemas','1389456132789');

INSERT INTO PARAMETRO
	(k_id_parametro,v_tope_min,v_tope_max,f_vigencia,v_ndias,k_nit_fondo)
	VALUES
	('001','100000','10000000','2016/12/31',12,'159845618');
	
INSERT INTO TIPO_PAGO
	(k_id_tipo_pago,n_tipo_pago)
	VALUES
	('01','Efectivo');
INSERT INTO TIPO_PAGO
	(k_id_tipo_pago,n_tipo_pago)
	VALUES
	('02','Cheque');

INSERT INTO TIPO_MOVIMIENTO
	(k_id_tipo_mov,n_movimiento,o_des_mov)
	VALUES
	('1001','Consignacion aporte','Se consigna un aporte');
INSERT INTO TIPO_MOVIMIENTO
	(k_id_tipo_mov,n_movimiento,o_des_mov)
	VALUES
	('1002','Retiro rendimientos','Se retiran los rendimientos');
INSERT INTO TIPO_MOVIMIENTO
	(k_id_tipo_mov,n_movimiento,o_des_mov)
	VALUES
	('1003','Retiro todo','Se retiran todo de la cuenta');
INSERT INTO TIPO_MOVIMIENTO
	(k_id_tipo_mov,n_movimiento,o_des_mov)
	VALUES
	('2001','Retirar intereses','Se retiran los intereses pagados');
INSERT INTO TIPO_MOVIMIENTO
	(k_id_tipo_mov,n_movimiento,o_des_mov)
	VALUES
	('2002','Retirar tatal aportes','Se retiran todo de la cuenta');

--SOCIO
INSERT INTO SOCIO
	(o_estado_socio,f_inicio,f_fin,k_nit_fondo,k_id_socio)
	VALUES
	('A','2013/05/25',NULL,'159845618','013546');
INSERT INTO SOCIO
	(o_estado_socio,f_inicio,f_fin,k_nit_fondo,k_id_socio)
	VALUES
	('A','2014/02/12',NULL,'159845618','013548');
INSERT INTO SOCIO
	(o_estado_socio,f_inicio,f_fin,k_nit_fondo,k_id_socio)
	VALUES
	('A','2014/03/20',NULL,'159845618','013549');
INSERT INTO SOCIO
	(o_estado_socio,f_inicio,f_fin,k_nit_fondo,k_id_socio)
	VALUES
	('A','2014/09/13',NULL,'159845618','031655');
INSERT INTO SOCIO
	(o_estado_socio,f_inicio,f_fin,k_nit_fondo,k_id_socio)
	VALUES
	('A','2015/01/25',NULL,'159845618','036679');
INSERT INTO SOCIO
	(o_estado_socio,f_inicio,f_fin,k_nit_fondo,k_id_socio)
	VALUES
	('A','2015/03/16',NULL,'159845618','039891');
INSERT INTO SOCIO
	(o_estado_socio,f_inicio,f_fin,k_nit_fondo,k_id_socio)
	VALUES
	('A','2015/10/28',NULL,'159845618','056231');
INSERT INTO SOCIO
	(o_estado_socio,f_inicio,f_fin,k_nit_fondo,k_id_socio)
	VALUES
	('A','2015/11/15',NULL,'159845618','002475');
INSERT INTO SOCIO
	(o_estado_socio,f_inicio,f_fin,k_nit_fondo,k_id_socio)
	VALUES
	('A','2015/12/08',NULL,'159845618','002476');

INSERT INTO SOCIO_ADMINISTRADOR
	(f_inicio_admin,f_fin_admin,k_id_socio_admin)
	VALUES
	('2016/01/01','2016/12/31','002475');

INSERT INTO SOCIO_ADMINISTRADOR
	(f_inicio_admin,f_fin_admin,k_id_socio_admin)
	VALUES
	('2016/01/01','2016/12/31','002476');
	
--APORTES	
INSERT INTO CUENTA_APORTE
	(k_id_cuenta_aporte,v_monto_aporte,k_id_socio)
	VALUES
	('000001', 0, '013546');
INSERT INTO CUENTA_APORTE
	(k_id_cuenta_aporte,v_monto_aporte,k_id_socio)
	VALUES
	('000002', 0, '013548');
INSERT INTO CUENTA_APORTE
	(k_id_cuenta_aporte,v_monto_aporte,k_id_socio)
	VALUES
	('000003', 0, '013549');
INSERT INTO CUENTA_APORTE
	(k_id_cuenta_aporte,v_monto_aporte,k_id_socio)
	VALUES
	('000004', 0, '031655');
INSERT INTO CUENTA_APORTE
	(k_id_cuenta_aporte,v_monto_aporte,k_id_socio)
	VALUES
	('000005', 0, '036679');
INSERT INTO CUENTA_APORTE
	(k_id_cuenta_aporte,v_monto_aporte,k_id_socio)
	VALUES
	('000006', 0, '039891');
INSERT INTO CUENTA_APORTE
	(k_id_cuenta_aporte,v_monto_aporte,k_id_socio)
	VALUES
	('000007', 0, '056231');
INSERT INTO CUENTA_APORTE
	(k_id_cuenta_aporte,v_monto_aporte,k_id_socio)
	VALUES
	('000008', 0, '002475');
INSERT INTO CUENTA_APORTE
	(k_id_cuenta_aporte,v_monto_aporte,k_id_socio)
	VALUES
	('000009', 0, '002476');	

INSERT INTO PAGO_APORTE
	(k_id_pago_aporte,o_num_consignacion,f_pago,v_monto_pago,
	k_id_tipo_pago,k_id_cuenta_aporte)
	VALUES
	('01', '34567','2016/03/22', 100000, '01', '000001');

INSERT INTO PAGO_APORTE
	(k_id_pago_aporte,o_num_consignacion,f_pago,v_monto_pago,
	k_id_tipo_pago,k_id_cuenta_aporte)
	VALUES
	('02', '345675','2016/04/22', 100000, '01', '000001');
	
INSERT INTO PAGO_APORTE
	(k_id_pago_aporte,o_num_consignacion,f_pago,v_monto_pago,
	k_id_tipo_pago,k_id_cuenta_aporte)
	VALUES
	('01', '345677','2016/03/22', 200000, '01', '000002');

INSERT INTO PAGO_APORTE
	(k_id_pago_aporte,o_num_consignacion,f_pago,v_monto_pago,
	k_id_tipo_pago,k_id_cuenta_aporte)
	VALUES
	('02', '3456758','2016/04/22', 200000, '01', '000002');

INSERT INTO PAGO_APORTE
	(k_id_pago_aporte,o_num_consignacion,f_pago,v_monto_pago,
	k_id_tipo_pago,k_id_cuenta_aporte)
	VALUES
	('01', '3456777','2016/03/22', 150000, '01', '000003');

INSERT INTO PAGO_APORTE
	(k_id_pago_aporte,o_num_consignacion,f_pago,v_monto_pago,
	k_id_tipo_pago,k_id_cuenta_aporte)
	VALUES
	('02', '345675228','2016/04/22', 150000, '01', '000003');

INSERT INTO PAGO_APORTE
	(k_id_pago_aporte,o_num_consignacion,f_pago,v_monto_pago,
	k_id_tipo_pago,k_id_cuenta_aporte)
	VALUES
	('01', '3456777','2016/03/22', 150000, '01', '000004');

INSERT INTO PAGO_APORTE
	(k_id_pago_aporte,o_num_consignacion,f_pago,v_monto_pago,
	k_id_tipo_pago,k_id_cuenta_aporte)
	VALUES
	('02', '345675228','2016/04/22', 150000, '01', '000004');

INSERT INTO PAGO_APORTE
	(k_id_pago_aporte,o_num_consignacion,f_pago,v_monto_pago,
	k_id_tipo_pago,k_id_cuenta_aporte)
	VALUES
	('03', '345675228','2016/04/22', 150000, '01', '000004');
	
INSERT INTO MOV_CUENTA_APORTE
	(k_id_mov_aporte,v_mov_aporte,f_mov_aporte,v_porc_liquid,
	k_id_tipo_mov,k_id_cuenta_aporte)
	VALUES
	('001',25000,'2016/01/10',0.08,'2001','000001');
INSERT INTO MOV_CUENTA_APORTE
	(k_id_mov_aporte,v_mov_aporte,f_mov_aporte,v_porc_liquid,
	k_id_tipo_mov,k_id_cuenta_aporte)
	VALUES
	('001',27000,'2016/01/15',0.09,'2001','000002');
INSERT INTO MOV_CUENTA_APORTE
	(k_id_mov_aporte,v_mov_aporte,f_mov_aporte,v_porc_liquid,
	k_id_tipo_mov,k_id_cuenta_aporte)
	VALUES
	('001',23000,'2016/01/21',0.07,'2001','000003');
INSERT INTO MOV_CUENTA_APORTE
	(k_id_mov_aporte,v_mov_aporte,f_mov_aporte,v_porc_liquid,
	k_id_tipo_mov,k_id_cuenta_aporte)
	VALUES
	('001',20000,'2016/02/02',0.06,'2001','000004');
	

	
--CREDITOS
INSERT INTO TIPO_CREDITO
	(k_id_tipo_credito,n_tipo_credito,v_tasa_credito,v_plazo_max,v_monto_max,f_vigencia)
	VALUES
	('01','Libre inversion',0.156,72,15000000,'2016/12/31');
INSERT INTO TIPO_CREDITO
	(k_id_tipo_credito,n_tipo_credito,v_tasa_credito,v_plazo_max,v_monto_max,f_vigencia)
	VALUES
	('02','Estudio',0.187,60,18000000,'2016/12/31');
INSERT INTO TIPO_CREDITO
	(k_id_tipo_credito,n_tipo_credito,v_tasa_credito,v_plazo_max,v_monto_max,f_vigencia)
	VALUES
	('03','Capital de trabajo',0.216,48,25000000,'2016/12/31');

INSERT INTO CREDITO
	(k_id_credito,n_estado_credito,v_monto_prestado,v_num_cuotas,f_aprobacion,
	f_desembolso,v_plazo,k_id_socio_admin,k_id_socio,k_id_tipo_credito)
	VALUES
	(k_id_credito_seq.NEXTVAL,'V',8000000,36,'2016/01/12','2016/01/25',3,'002475','013546','02');
INSERT INTO CREDITO
	(k_id_credito,n_estado_credito,v_monto_prestado,v_num_cuotas,f_aprobacion,
	f_desembolso,v_plazo,k_id_socio_admin,k_id_socio,k_id_tipo_credito)
	VALUES
	(k_id_credito_seq.NEXTVAL,'V',18000000,36,'2016/01/25','2016/02/10',3,'002475','013548','03');
INSERT INTO CREDITO
	(k_id_credito,n_estado_credito,v_monto_prestado,v_num_cuotas,f_aprobacion,
	f_desembolso,v_plazo,k_id_socio_admin,k_id_socio,k_id_tipo_credito)
	VALUES
	(k_id_credito_seq.NEXTVAL,'A',12000000,36,'2016/03/12','2016/03/20',3,'002475','013549','03');
	
INSERT INTO PAGO_CREDITO
	(k_id_pago_credito,o_num_consignacion,f_pago,v_monto_cuota,v_monto_capital,
	v_monto_interes,k_id_tipo_pago,k_id_credito)
	VALUES
	('001','52631579512','2016/02/25',256889,222223,346666,'01','1');
INSERT INTO PAGO_CREDITO
	(k_id_pago_credito,o_num_consignacion,f_pago,v_monto_cuota,v_monto_capital,
	v_monto_interes,k_id_tipo_pago,k_id_credito)
	VALUES
	('001','51364978415','2016/03/10',256889,222223,346666,'01','2');
INSERT INTO PAGO_CREDITO
	(k_id_pago_credito,o_num_consignacion,f_pago,v_monto_cuota,v_monto_capital,
	v_monto_interes,k_id_tipo_pago,k_id_credito)
	VALUES
	('002','52631579597','2016/03/25',256889,222223,346666,'01','1');
	
	
--FONDO SEGUNDA ENTREGA
INSERT INTO CUENTA_FONDO
	(k_id_cuenta_fondo,v_saldo_aportes,v_saldo_credito,v_saldo_intereses,
	v_saldo_gastos,v_saldo_int_banco,f_inicio_periodo,f_fin_periodo,k_nit_fondo)
	VALUES
	('001',880000000,320000000,162000000,40000000,150000,'2015/01/01','2015/12/31','159845618');


CREATE USER Camilo IDENTIFIED BY 123;
GRANT socio TO Camilo;
CREATE USER Daniela IDENTIFIED BY 123;
GRANT socio TO Daniela;
CREATE USER Eliana IDENTIFIED BY 123;
GRANT socio TO Eliana;
CREATE USER Estefania IDENTIFIED BY 123;
GRANT socio_admin TO Estefania;
CREATE USER Guillermo IDENTIFIED BY 123;
GRANT socio_admin TO Guillermo;
CREATE USER Jeronimo IDENTIFIED BY 123;
GRANT socio TO Jeronimo;
CREATE USER Jose IDENTIFIED BY 123;
GRANT socio TO Jose;
CREATE USER Marcela IDENTIFIED BY 123;
GRANT socio TO Marcela;
CREATE USER Rafael IDENTIFIED BY 123;
GRANT socio TO Rafael;

/*
INSERT INTO MOVIMIENTO_CUENTA
	(id_movimiento,v_monto_mov,f_movimiento,k_id_cuenta_fondo,k_id_tipo_mov)
	VALUES
	('');
*/