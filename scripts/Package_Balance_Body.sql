CREATE OR REPLACE PACKAGE BODY PK_BALANCE2
AS
  
  /*---------------------------------------------------------------------
  Funcion para calcular el valor de rendimiento financiero para un socio
  de acuerdo a la cantidad de sus aportes.
  Parametros de Entrada: PK_IDSOCIO:    Numero de Identificacion del socio
                         PI_ACTUALIZA   Determina si se realiza la distribucion del rendimiento al socio
  Retorna:                              El valor calculado de rendimiento financiero
  */
  FUNCTION FU_CALCULAR_REND_SOCIO(PK_IDSOCIO IN USUARIO.K_ID_USUARIO%TYPE,
                                  PI_ACTUALIZA IN VARCHAR2)
  RETURN gtr_socio_rend
  AS
    lgtr_salida gtr_socio_rend;
    lv_total_aportes_socio CUENTA_APORTE.V_MONTO_APORTE%TYPE;
    lv_total_aportes CUENTA_FONDO.V_SALDO_APORTES%TYPE;
    lv_total_rendimientos NUMBER(20);
    ln_nombre_socio USUARIO.N_USUARIO%TYPE;
    lv_porcentaje NUMBER(4,2);
  BEGIN
    SELECT SUM(V_MONTO_APORTE) INTO lv_total_aportes_socio FROM CUENTA_APORTE WHERE K_ID_SOCIO = PK_IDSOCIO; 
    SELECT V_SALDO_APORTES INTO lv_total_aportes FROM CUENTA_FONDO WHERE K_ID_CUENTA_FONDO = 000001;
    SELECT SUM(V_SALDO_INT_BANCO+V_SALDO_INTERESES-V_SALDO_GASTOS) INTO lv_total_rendimientos FROM CUENTA_FONDO WHERE K_ID_CUENTA_FONDO=000001;
    SELECT N_USUARIO INTO ln_nombre_socio FROM USUARIO WHERE K_ID_USUARIO=PK_IDSOCIO;
    lv_porcentaje:= lv_total_aportes_socio/lv_total_aportes;
    lgtr_salida.K_IDSOCIO:= PK_IDSOCIO;
    lgtr_salida.N_NOMBRE:= ln_nombre_socio;
    lgtr_salida.V_RENDIMIENTO:= lv_total_rendimientos*lv_porcentaje;
    RETURN lgtr_salida;
    EXCEPTION
    WHEN OTHERS THEN
      RAISE_APPLICATION_ERROR(-20000, 'EL USUARIO NO EXISTE');
  END FU_CALCULAR_REND_SOCIO;
    
  PROCEDURE PR_GENERAR_ESTADO_CUENTA2(PK_IDSOCIO IN USUARIO.K_ID_USUARIO%TYPE)
  AS
  lv_aportes CUENTA_APORTE.V_MONTO_APORTE%TYPE;
  lv_creditos NUMBER;
  lr_rendimiento gtr_socio_rend;
  lm_cadena VARCHAR2(200);
  archivo UTL_FILE.FILE_TYPE;
  lv_monto_prestado CREDITO.V_MONTO_PRESTADO%TYPE;
  lv_monto_capital PAGO_CREDITO.V_MONTO_CAPITAL%TYPE;
  BEGIN
    SELECT V_MONTO_PRESTADO INTO lv_monto_prestado FROM CREDITO WHERE K_ID_SOCIO=PK_IDSOCIO;
    SELECT P.V_MONTO_CAPITAL INTO lv_monto_capital FROM PAGO_CREDITO P, CREDITO C WHERE C.K_ID_CREDITO=P.K_ID_CREDITO AND C.K_ID_SOCIO=PK_IDSOCIO AND ROWNUM <=1 ORDER BY P.F_PAGO DESC;
    SELECT SUM(P.V_MONTO_PAGO) INTO lv_aportes FROM PAGO_APORTE P, CUENTA_APORTE A WHERE A.K_ID_CUENTA_APORTE=P.K_ID_CUENTA_APORTE AND A.K_ID_SOCIO=PK_IDSOCIO;
    lv_creditos:= lv_monto_prestado - lv_monto_capital;
    lr_rendimiento:= FU_CALCULAR_REND_SOCIO(PK_IDSOCIO,'N');
    lm_cadena:='El estado de cuenta del socio es el siguiente:';
    archivo:= UTL_FILE.FOPEN('ESTADO_CUENTA','ESTADO_CUENTA.txt','W', 1000);
    UTL_FILE.PUT_LINE(archivo,lm_cadena);
    UTL_FILE.PUT_LINE(archivo,'Nombre: '||lr_rendimiento.N_NOMBRE);
    UTL_FILE.PUT_LINE(archivo,'Total Aportes: '||lv_aportes);
    UTL_FILE.PUT_LINE(archivo,'Total Credito: '||lv_creditos);
    UTL_FILE.PUT_LINE(archivo,'Total Rendimientos: '||lr_rendimiento.V_RENDIMIENTO);
    UTL_FILE.FCLOSE(archivo);
  EXCEPTION
    WHEN OTHERS THEN
      RAISE_APPLICATION_ERROR(-20001, 'ERROR AL GUARDAR ARCHIVO');
  END PR_GENERAR_ESTADO_CUENTA2;
END PK_BALANCE2;
