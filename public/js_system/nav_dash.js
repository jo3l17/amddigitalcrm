window.onload = function() {
    document.getElementById('offcanvas').addEventListener('click', function(e) {
        $('#wrapper').toggleClass('toggled');
    });
    document.getElementById('cerrar_sesion').addEventListener('click', function(e) {
        location.href = URLPRINCIPAL + "Login/destroy_session";
    });
    var nav_clientes_general = document.getElementsByClassName("nav_clientes_general");

    for (var i = 0; i < nav_clientes_general.length; i++) {
        nav_clientes_general[i].addEventListener('click', function() {
            location.href = URLPRINCIPAL + "Cpanel/Pagina/clientes_general";
        });
    }
    var nav_mis_clientes = document.getElementsByClassName("nav_mis_clientes");

    for (var i = 0; i < nav_mis_clientes.length; i++) {
        nav_mis_clientes[i].addEventListener('click', function() {
            location.href = URLPRINCIPAL + "Cpanel/Pagina/mis_clientes";
        });
    }
};