$(document).ready(function(){
    $('ul.nav-tabs li a:first').addClass('active');
    $('.secciones article').hide();
    $('.secciones article:first').show();

    $('ul.nav-tabs li a').click(function(){
        $('ul.nav-tabs li a').removeClass('active');
        $(this).addClass('active');
        $('.secciones article').hide();

        var pestañaActive = $(this).attr('href');
        $(pestañaActive).show(); 
        return false;
    })
});    
    