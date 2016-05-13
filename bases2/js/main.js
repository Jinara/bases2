// Esta clase esta hecha para poner metodos de js que puedan servir en cualquier parte del proyecto!!!

function parse_date(date){
  var aux = date.split(' ');
  var parsed_date = {}
  parsed_date.day = aux[0];
  parsed_date.month = getMonth(date);
  parsed_date.year = aux[2];
  return parsed_date.year + '/' + parsed_date.month + '/' + parsed_date.day;
}

function getMonth(date){
  return new Date(date).getMonth()+1;
}
