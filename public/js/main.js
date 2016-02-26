/**
 * Created by evhanz on 04/01/16.
 */

function convertDateToString(fecha){

    var año = fecha.getFullYear();
    var mes = fecha.getMonth()+1;
    var dia = fecha.getDate();

    var format_fecha = año+"-"+mes+"-"+dia;

    return format_fecha;

}

function convertStringToDate(fecha){

    var t = fecha.split("-");
    var format_fecha = new Date(t[0],t[1]-1,t[2]);

    return format_fecha;

}