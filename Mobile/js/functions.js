/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).on('pagecreate', function() {



    $("#btnlogout").on('click', function(event) {

        event.preventDefault();

        var opt = 2;



        var usu = $("#email");
        var pass = $("#password");

        usu.val("");
        pass.val("");

        $.post("php-responses/login.php", {option: opt}, function(respuesta) {

            $.mobile.changePage("index.php", 'pop', false, true);

        });

    });


    $("#btnlogout").on('click', function(event) {

        event.preventDefault();

        var opt = 2;



        var usu = $("#email");
        var pass = $("#password");

        usu.val("");
        pass.val("");

        $.post("php-responses/login.php", {option: opt}, function(respuesta) {

            $.mobile.changePage("index.php", 'pop', false, true);

        });

    });


});







