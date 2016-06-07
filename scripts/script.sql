-- Generado por Oracle SQL Developer Data Modeler 4.1.3.901
--   en:        2016-03-11 15:24:27 COT
--   sitio:      Oracle Database 11g
--   tipo:      Oracle Database 11g




CREATE TABLE Credito
  (
    k_id_credito     VARCHAR2 (4 CHAR) NOT NULL ,
    n_estado_credito VARCHAR2 (1 CHAR) NOT NULL ,
    v_monto_prestado NUMBER (9) NOT NULL ,
    v_num_cuotas     NUMBER (3) NOT NULL ,
    f_aprobacion     DATE NOT NULL ,
    f_desembolso     DATE NOT NULL ,
    v_plazo          NUMBER (2) NOT NULL ,
    k_id_socio_admin VARCHAR2 (6 CHAR) NOT NULL ,
    k_id_socio       VARCHAR2 (6 CHAR) NOT NULL,
    k_id_tipo_credito      VARCHAR2 (2 CHAR) NOT NULL
  ) ;
ALTER TABLE Credito ADD CONSTRAINT Credito_PK PRIMARY KEY ( k_id_credito ) ;


CREATE TABLE Cuenta_Fondo
  (
    k_id_cuenta_fondo VARCHAR2 (3 CHAR) NOT NULL ,
    v_saldo_aportes   NUMBER (12,2) NOT NULL ,
    v_saldo_credito   NUMBER (12,2) NOT NULL ,
    v_saldo_intereses NUMBER (12,2) NOT NULL ,
    v_saldo_gastos    NUMBER (12,2) NOT NULL ,
    v_saldo_int_banco NUMBER (12,2) NOT NULL ,
    f_inicio_periodo  DATE NOT NULL ,
    f_fin_periodo     DATE NOT NULL ,
    k_nit_fondo       VARCHAR2 (9 CHAR) NOT NULL
  ) ;
ALTER TABLE Cuenta_Fondo ADD CONSTRAINT Cuenta_Fondo_PK PRIMARY KEY ( k_id_cuenta_fondo ) ;


CREATE TABLE Cuenta_aporte
  (
    k_id_cuenta_aporte VARCHAR2 (6 CHAR) NOT NULL ,
    v_monto_aporte     NUMBER (9) NOT NULL ,
    k_id_socio         VARCHAR2 (6 CHAR) NOT NULL
  ) ;
ALTER TABLE Cuenta_aporte ADD CONSTRAINT Cuenta_aporte_PK PRIMARY KEY ( k_id_cuenta_aporte ) ;


CREATE TABLE Fondo
  (
    k_nit_fondo  VARCHAR2 (9 CHAR) NOT NULL ,
    n_fondo      VARCHAR2 (100 CHAR) NOT NULL ,
    o_num_cuenta VARCHAR2 (13 CHAR) NOT NULL
  ) ;
ALTER TABLE Fondo ADD CONSTRAINT Fondo_PK PRIMARY KEY ( k_nit_fondo ) ;


CREATE TABLE Mov_cuenta_aporte
  (
    k_id_mov_aporte    VARCHAR2 (3 CHAR) NOT NULL ,
    v_mov_aporte       NUMBER (9) NOT NULL ,
    f_mov_aporte       DATE NOT NULL ,
    v_porc_liquid      NUMBER (4,2) ,
    k_id_tipo_mov      VARCHAR2 (4 CHAR) NOT NULL ,
    k_id_cuenta_aporte VARCHAR2 (6 CHAR) NOT NULL
  ) ;
ALTER TABLE Mov_cuenta_aporte ADD CONSTRAINT Mov_cuenta_aporte_PK PRIMARY KEY ( k_id_mov_aporte, k_id_cuenta_aporte ) ;


CREATE TABLE Movimiento_cuenta
  (
    k_id_movimiento     VARCHAR2 (4 CHAR) NOT NULL ,
    v_monto_mov       NUMBER (9) NOT NULL ,
    f_movimiento      DATE NOT NULL ,
    k_id_cuenta_fondo VARCHAR2 (3 CHAR) NOT NULL ,
    k_id_tipo_mov     VARCHAR2 (4 CHAR) NOT NULL
  ) ;
ALTER TABLE Movimiento_cuenta ADD CONSTRAINT Movimiento_cuenta_PK PRIMARY KEY ( k_id_movimiento ) ;


CREATE TABLE Pago_aporte
  (
    k_id_pago_aporte   NUMBER (5) NOT NULL ,
    o_num_consignacion VARCHAR2 (11 CHAR) NOT NULL ,
    f_pago             DATE NOT NULL ,
    v_monto_pago       NUMBER (9) NOT NULL ,
    k_id_tipo_pago     VARCHAR2 (2 CHAR) NOT NULL ,
    k_id_cuenta_aporte VARCHAR2 (6 CHAR) NOT NULL
  ) ;
ALTER TABLE Pago_aporte ADD CONSTRAINT Pago_aporte_PK PRIMARY KEY ( k_id_pago_aporte, k_id_cuenta_aporte ) ;


CREATE TABLE Pago_credito
  (
    k_id_pago_credito  NUMBER (3) NOT NULL ,
    o_num_consignacion VARCHAR2 (11 CHAR) NOT NULL ,
    f_pago             DATE NOT NULL ,
    v_monto_cuota      NUMBER (9) NOT NULL ,
    v_monto_capital    NUMBER (6) NOT NULL ,
    v_monto_interes    NUMBER (6) NOT NULL ,
    k_id_tipo_pago     VARCHAR2 (2 CHAR) NOT NULL ,
    k_id_credito       VARCHAR2 (4 CHAR) NOT NULL
  ) ;
ALTER TABLE Pago_credito ADD CONSTRAINT Pago_credito_PK PRIMARY KEY ( k_id_pago_credito, k_id_credito ) ;


CREATE TABLE Parametro
  (
    k_id_parametro VARCHAR2 (3 CHAR) NOT NULL ,
    v_tope_min     NUMBER (9) NOT NULL ,
    v_tope_max     NUMBER (9) NOT NULL ,
    f_vigencia     DATE NOT NULL ,
    v_ndias 	   NUMBER (2) NOT NULL, 
    k_nit_fondo    VARCHAR2 (9 CHAR) NOT NULL
  ) ;
ALTER TABLE Parametro ADD CONSTRAINT Parametro_PK PRIMARY KEY ( k_id_parametro ) ;


CREATE TABLE Socio
  (
    o_estado_socio VARCHAR2 (1 CHAR) NOT NULL ,
	  f_inicio	     DATE NOT NULL,
	  f_fin		       DATE,
    k_nit_fondo    VARCHAR2 (9 CHAR) NOT NULL ,
    k_id_socio     VARCHAR2 (6 CHAR) NOT NULL
  ) ;
ALTER TABLE Socio ADD CONSTRAINT Socio_PK PRIMARY KEY ( k_id_socio ) ;


CREATE TABLE Socio_administrador
  (
    f_inicio_admin   DATE NOT NULL ,
    f_fin_admin      DATE NOT NULL ,
    k_id_socio_admin VARCHAR2 (6 CHAR) NOT NULL
  ) ;
ALTER TABLE Socio_administrador ADD CONSTRAINT Socio_administrador_PK PRIMARY KEY ( k_id_socio_admin ) ;


CREATE TABLE Tipo_Credito
  (
    k_id_tipo_credito VARCHAR2 (2 CHAR) NOT NULL ,
    n_tipo_credito VARCHAR2(30 CHAR) NOT NULL,
	v_tasa_credito    NUMBER (4,2) NOT NULL ,
    v_plazo_max       NUMBER (2) NOT NULL ,
    v_monto_max       NUMBER (9) NOT NULL ,
    f_vigencia        DATE NOT NULL   
  ) ;
ALTER TABLE Tipo_Credito ADD CONSTRAINT Tipo_Credito_PK PRIMARY KEY ( k_id_tipo_credito ) ;


CREATE TABLE Tipo_Pago
  (
    k_id_tipo_pago VARCHAR2 (2 CHAR) NOT NULL ,
    n_tipo_pago    VARCHAR2 (12 CHAR) NOT NULL
  ) ;
ALTER TABLE Tipo_Pago ADD CONSTRAINT Tipo_Pago_PK PRIMARY KEY ( k_id_tipo_pago ) ;


CREATE TABLE Tipo_movimiento
  (
    k_id_tipo_mov VARCHAR2 (4 CHAR) NOT NULL ,
    n_movimiento  VARCHAR2 (30 CHAR) NOT NULL ,
    o_des_mov     VARCHAR2 (200 CHAR) NOT NULL
  ) ;
ALTER TABLE Tipo_movimiento ADD CONSTRAINT Tipo_movimiento_PK PRIMARY KEY ( k_id_tipo_mov ) ;


CREATE TABLE Usuario
  (
    k_id_usuario          VARCHAR2 (6 CHAR) NOT NULL ,
    n_usuario             VARCHAR2 (12 CHAR) NOT NULL ,
    n_username             VARCHAR2 (12 CHAR) NOT NULL UNIQUE,
    n_apellido_usuario    VARCHAR2 (12 CHAR) NOT NULL ,
    o_tipo_doc            VARCHAR2 (20 CHAR) NOT NULL ,
    v_num_doc             VARCHAR2 (10 CHAR) NOT NULL ,
    v_tarjeta_profesional VARCHAR2 (7 CHAR) NOT NULL ,
    n_ocupacion           VARCHAR2 (15 CHAR) NOT NULL ,
    o_estado_civil        VARCHAR2 (10 CHAR) NOT NULL ,
    o_sexo                VARCHAR2 (1 CHAR) NOT NULL ,
    v_telefono            VARCHAR2 (10 CHAR) NOT NULL ,
    o_direccion           VARCHAR2 (40 CHAR) NOT NULL ,
    o_correo_electronico  VARCHAR2 (40 CHAR) NOT NULL ,
    n_causal              VARCHAR2 (50 CHAR)
  ) ;

ALTER TABLE Usuario ADD CONSTRAINT Usuario_PK PRIMARY KEY ( k_id_usuario ) ;


ALTER TABLE Credito ADD CONSTRAINT Credito_Socio_FK FOREIGN KEY ( k_id_socio ) REFERENCES Socio ( k_id_socio ) ;

ALTER TABLE Credito ADD CONSTRAINT Credito_Socio_admin_FK FOREIGN KEY ( k_id_socio_admin ) REFERENCES Socio_administrador ( k_id_socio_admin ) ;

ALTER TABLE Credito ADD CONSTRAINT Credito_Tipo_Credito_FK FOREIGN KEY ( k_id_tipo_credito ) REFERENCES Tipo_credito ( k_id_tipo_credito ) ;

ALTER TABLE Cuenta_Fondo ADD CONSTRAINT Cta_Fondo_Fondo_FK FOREIGN KEY ( k_nit_fondo ) REFERENCES Fondo ( k_nit_fondo ) ;

ALTER TABLE Cuenta_aporte ADD CONSTRAINT Cta_apt_Socio_FK FOREIGN KEY ( k_id_socio ) REFERENCES Socio ( k_id_socio ) ;

ALTER TABLE Movimiento_cuenta ADD CONSTRAINT Mov_cta_Cta_Fondo_FK FOREIGN KEY ( k_id_cuenta_fondo ) REFERENCES Cuenta_Fondo ( k_id_cuenta_fondo ) ;

ALTER TABLE Movimiento_cuenta ADD CONSTRAINT Mov_cta_Tipo_mov_FK FOREIGN KEY ( k_id_tipo_mov ) REFERENCES Tipo_movimiento ( k_id_tipo_mov ) ;

ALTER TABLE Mov_cuenta_aporte ADD CONSTRAINT Mov_cta_apt_Cta_apt_FK FOREIGN KEY ( k_id_cuenta_aporte ) REFERENCES Cuenta_aporte ( k_id_cuenta_aporte ) ;

ALTER TABLE Mov_cuenta_aporte ADD CONSTRAINT Mov_cta_apt_Tipo_mov_FK FOREIGN KEY ( k_id_tipo_mov ) REFERENCES Tipo_movimiento ( k_id_tipo_mov ) ;

ALTER TABLE Pago_aporte ADD CONSTRAINT Pago_apt_Cta_apt_FK FOREIGN KEY ( k_id_cuenta_aporte ) REFERENCES Cuenta_aporte ( k_id_cuenta_aporte ) ;

ALTER TABLE Pago_aporte ADD CONSTRAINT Pago_apt_Tipo_Pago_FK FOREIGN KEY ( k_id_tipo_pago ) REFERENCES Tipo_Pago ( k_id_tipo_pago ) ;

ALTER TABLE Pago_credito ADD CONSTRAINT Pago_credito_Credito_FK FOREIGN KEY ( k_id_credito ) REFERENCES Credito ( k_id_credito ) ;

ALTER TABLE Pago_credito ADD CONSTRAINT Pago_credito_Tipo_Pago_FK FOREIGN KEY ( k_id_tipo_pago ) REFERENCES Tipo_Pago ( k_id_tipo_pago ) ;

ALTER TABLE Parametro ADD CONSTRAINT Parametro_Fondo_FK FOREIGN KEY ( k_nit_fondo ) REFERENCES Fondo ( k_nit_fondo ) ;

ALTER TABLE Socio ADD CONSTRAINT Socio_Fondo_FK FOREIGN KEY ( k_nit_fondo ) REFERENCES Fondo ( k_nit_fondo ) ;

ALTER TABLE Socio ADD CONSTRAINT Socio_Usuario_FK FOREIGN KEY ( k_id_socio ) REFERENCES Usuario ( k_id_usuario ) ;

ALTER TABLE Socio_administrador ADD CONSTRAINT Socio_admin_Usuario_FK FOREIGN KEY ( k_id_socio_admin ) REFERENCES Usuario ( k_id_usuario ) ;

ALTER TABLE CREDITO add constraint N_ESTADO_CREDITO_CHK check(n_estado_credito in ('A','V','C')) ENABLE;

ALTER TABLE CREDITO add constraint V_MONTO_PRESTADO_CHK check(V_MONTO_PRESTADO > 0) ENABLE;

ALTER TABLE CREDITO add constraint V_NUM_CUOTAS_CHK check(V_NUM_CUOTAS > 1) ENABLE;

ALTER TABLE CREDITO add constraint f_desembolso_CHK check(f_desembolso > f_aprobacion) ENABLE; 

alter table CREDITO add constraint V_PLAZO_CHK check(V_PLAZO > 1) ENABLE;

ALTER TABLE CUENTA_APORTE add constraint V_MONTO_APORTE_CHK check(V_MONTO_APORTE >= 0) ENABLE;

ALTER TABLE CUENTA_FONDO add constraint V_SALDO_APORTES_CHK check(V_SALDO_APORTES >= 0) ENABLE;

ALTER TABLE CUENTA_FONDO add constraint V_SALDO_CREDITO_CHK check(V_SALDO_CREDITO >= 0) ENABLE;

ALTER TABLE CUENTA_FONDO add constraint V_SALDO_INTERESES_CHK check(V_SALDO_INTERESES >= 0) ENABLE;

ALTER TABLE CUENTA_FONDO add constraint V_SALDO_GASTOS_CHK check(V_SALDO_GASTOS >= 0) ENABLE;

ALTER TABLE CUENTA_FONDO add constraint V_SALDO_INT_BANCO_CHK check(V_SALDO_INT_BANCO >= 0) ENABLE;

ALTER TABLE CUENTA_FONDO ADD CONSTRAINT f_fin_periodo CHECK (f_fin_periodo > f_inicio_periodo) ENABLE;

ALTER TABLE MOV_CUENTA_APORTE ADD CONSTRAINT v_mov_aporte_chk CHECK (V_MOV_APORTE > 0) ENABLE;

ALTER TABLE Mov_cuenta_aporte ADD CONSTRAINT v_PORC_LIQUID_chk CHECK (v_porc_liquid > 0 AND v_porc_liquid < 100) ENABLE;

ALTER TABLE Movimiento_cuenta ADD CONSTRAINT v_monto_mov_chk CHECK (v_monto_mov > 0) ENABLE;

ALTER TABLE PAGO_APORTE ADD CONSTRAINT v_monto_pago_chk CHECK (v_monto_pago > 0) ENABLE;

ALTER TABLE Pago_credito ADD CONSTRAINT v_monto_cuota_chk CHECK (v_monto_cuota > 0) ENABLE;

ALTER TABLE Pago_credito ADD CONSTRAINT v_monto_capital_chk CHECK (v_monto_capital > 0) ENABLE;

ALTER TABLE Pago_credito ADD CONSTRAINT v_monto_interes_chk CHECK (v_monto_interes > 0) ENABLE;

ALTER TABLE Parametro ADD  CONSTRAINT v_tope_max_CHK CHECK (v_tope_max > v_tope_min) ENABLE;

ALTER TABLE Parametro ADD  CONSTRAINT v_tope_min_CHK CHECK (v_tope_min > 0) ENABLE;

ALTER TABLE Socio ADD CONSTRAINT o_estado_socio_chk CHECK (o_estado_socio IN ('A','I','P')) ENABLE;

ALTER TABLE Socio_administrador ADD  CONSTRAINT f_fin_admin_chk CHECK (f_fin_admin > f_inicio_admin) ENABLE;

ALTER TABLE Tipo_Credito ADD  CONSTRAINT v_tasa_credito_chk check (v_tasa_credito > 0 AND v_tasa_credito < 100) ENABLE;

ALTER TABLE Tipo_Credito ADD CONSTRAINT v_plazo_max_chk check (v_plazo_max > 0) ENABLE;

ALTER TABLE Tipo_Credito ADD CONSTRAINT v_monto_max_chk check (v_monto_max > 0) ENABLE;

ALTER TABLE USUARIO ADD CONSTRAINT o_tipo_doc_chk CHECK (o_tipo_doc IN ('CC','CE', 'P')) ENABLE;

ALTER TABLE USUARIO ADD CONSTRAINT o_estado_civil_chk CHECK (o_estado_civil IN ('S','C', 'U', 'V')) ENABLE;

ALTER TABLE USUARIO ADD CONSTRAINT o_sexo_chk CHECK (o_sexo IN ('F','M')) ENABLE;

ALTER TABLE Parametro ADD CONSTRAINT v_ndias_chk CHECK (v_ndias > 1 AND v_ndias < 28) ENABLE; 

ALTER TABLE Cuenta_aporte ADD CONSTRAINT k_id_socio_UK UNIQUE (k_id_socio);

ALTER TABLE Cuenta_Fondo ADD CONSTRAINT k_nit_fondo_UK UNIQUE (k_nit_fondo );

CREATE SEQUENCE k_id_credito_seq START WITH 0001 INCREMENT BY 1 MINVALUE 0001 NOCYCLE; 

CREATE SEQUENCE k_id_cuenta_aporte_seq START WITH 000001 INCREMENT BY 1 MINVALUE 000001 NOCYCLE; 

CREATE SEQUENCE k_id_usuario_seq START WITH 000001 INCREMENT BY 1 MINVALUE 000001 NOCYCLE; 

CREATE SEQUENCE k_nit_fondo_seq START WITH 000001 INCREMENT BY 1 MINVALUE 000001 NOCYCLE;

CREATE SEQUENCE k_tipo_credito_seq START WITH 01 INCREMENT BY 1 MINVALUE 01 NOCYCLE;

CREATE SEQUENCE k_id_parametro_seq START WITH 001 INCREMENT BY 1 MINVALUE 001 NOCYCLE;

CREATE SEQUENCE k_id_movimiento START WITH 001 INCREMENT BY 1 MINVALUE 001 NOCYCLE;

-- Informe de Resumen de Oracle SQL Developer Data Modeler: 
-- 
-- CREATE TABLE                            15
-- CREATE INDEX                             0
-- ALTER TABLE                             32
-- CREATE VIEW                              0
-- ALTER VIEW                               0
-- CREATE PACKAGE                           0
-- CREATE PACKAGE BODY                      0
-- CREATE PROCEDURE                         0
-- CREATE FUNCTION                          0
-- CREATE TRIGGER                           0
-- ALTER TRIGGER                            0
-- CREATE COLLECTION TYPE                   0
-- CREATE STRUCTURED TYPE                   0
-- CREATE STRUCTURED TYPE BODY              0
-- CREATE CLUSTER                           0
-- CREATE CONTEXT                           0
-- CREATE DATABASE                          0
-- CREATE DIMENSION                         0
-- CREATE DIRECTORY                         0
-- CREATE DISK GROUP                        0
-- CREATE ROLE                              0
-- CREATE ROLLBACK SEGMENT                  0
-- CREATE SEQUENCE                          0
-- CREATE MATERIALIZED VIEW                 0
-- CREATE SYNONYM                           0
-- CREATE TABLESPACE                        0
-- CREATE USER                              0
-- 
-- DROP TABLESPACE                          0
-- DROP DATABASE                            0
-- 
-- REDACTION POLICY                         0
-- 
-- ORDS DROP SCHEMA                         0
-- ORDS ENABLE SCHEMA                       0
-- ORDS ENABLE OBJECT                       0
-- 
-- ERRORS                                   0
-- WARNINGS                                 0
