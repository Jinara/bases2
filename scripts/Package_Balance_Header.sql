CREATE OR REPLACE PACKAGE PK_BALANCE2
AS
  --Declaracion de un tipo de registro con los datos basicos de un socio
  TYPE gtr_socio_rend IS RECORD(
    K_IDSOCIO USUARIO.K_ID_USUARIO%TYPE,
    N_NOMBRE USUARIO.N_USUARIO%TYPE,
    V_RENDIMIENTO NUMBER(17,2)
  );
  
  TYPE tt_socio IS TABLE OF gtr_socio_rend INDEX BY BINARY_INTEGER;

  /*---------------------------------------------------------------------
  Funcion para calcular el valor de rendimiento financiero para un socio
  de acuerdo a la cantidad de sus aportes.
  Parametros de Entrada: PK_IDSOCIO:    Numero de Identificacion del socio
                         PI_ACTUALIZA   Determina si se realiza la distribucion del rendimiento al socio
  Retorna:                              El valor calculado de rendimiento financiero
  */
  FUNCTION FU_CALCULAR_REND_SOCIO(PK_IDSOCIO IN USUARIO.K_ID_USUARIO%TYPE,
                                  PI_ACTUALIZA IN VARCHAR2)
  RETURN gtr_socio_rend;
                                  
  PROCEDURE PR_GENERAR_ESTADO_CUENTA2(PK_IDSOCIO IN USUARIO.K_ID_USUARIO%TYPE);
  
END PK_BALANCE2;