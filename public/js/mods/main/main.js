/**
 * Created by Servidor Symi on 25/06/2015.
 */


    /*funcion viewMenuFixed*/
$(window).scroll(function(){
    //console.log($(window).scrollTop()+'-');
    if ($(window).scrollTop() >= 36) {
        $('nav').addClass('fixed-header');



    }
    else {
        $('nav').removeClass('fixed-header');
        /* alert('no');*/
    }
});






$('.dropdown')
    .dropdown({
        // you can use any ui transition
        transition: 'drop'
    });


//para configurar el menu

$(document).ready(function(){
    $('.menu a.item').on('click', function() {
        if(!$(this).hasClass('dropdown') && !$(this).hasClass('sub')) {
            $(this).addClass('active').addClass('teal').closest('.ui.menu').find('.item')
                .not($(this))
                .removeClass('active');
        }

    });
});



//para el evento de ocultar el menu

$("#btnHideShow").click(function(){

    var bandera = this.value;

    if (bandera==1) {

        $('#menu-left').hide(800);

        $("#container-principal").removeClass("thirteen wide column");
        $("#container-principal").addClass("sixteen wide column");

        this.value = 0;

    } if (bandera==0){


        $('#menu-left').show(800);
        $("#container-principal").removeClass("sixteen wide column");
        $("#container-principal").addClass("thirteen wide column");

        this.value = 1;

    }

});


/*esto es para morris */


new Morris.Line({
    // ID of the element in which to draw the chart.
    element: 'myfirstchart',
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    data: [
        { year: '2008', value: 20 },
        { year: '2009', value: 10 },
        { year: '2010', value: 5 },
        { year: '2011', value: 5 },
        { year: '2012', value: 20 }
    ],
    // The name of the data record attribute that contains x-values.
    xkey: 'year',
    // A list of names of data record attributes that contain y-values.
    ykeys: ['value'],
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['Value']
});





/*========== evento UI ======*/
$("#linkModProductos").click(function(){
    //$("#container-principal").fadeOut(1000);
    $("#container-principal").load('mod-Productos/index.html');
    //$("#container-principal").fadeIn(1000);

});



