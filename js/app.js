/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {
    console.log('działa');
    var form = $('form');
    $.get('./api/books.php', function (json) {
        console.log(json);
//        var book = jQuery.parseJSON(json);
//        console.log(book);
//        var name = $('<p><b>Tytuł: ' + json.name + '</b></p>');
//        $('#json').prepend(name);

        //Najpierw zmieniamy json w obiekty javascript 
        $.each(JSON.parse(json), function (index, object) {
            var name = $('<p><b>Tytuł: ' + object.name + '</b></p>');
            var id = object.id;
            var div = $('<div>');
            $('#json').append(name);
            $('#json').append(div);


            name.click(function () {
                console.log('klikam');
                $.get('./api/books.php?id=' + id, function (json) {
                    console.log(json);
                    var object2 = JSON.parse(json);
//                    console.log(object2.author);
//                    
//                    console.log(name.next());
                    name.next().text(object2.author);

                });
            })



        })
    })
//    form.on('submit', function (e) {
//        e.preventDefault();
//        $.post('./api/books.php', function (json) {
//            var title = $('#inputTitle').val();
//            console.log(title);
//            var author = $('#inputAuthor').val();
//            var book = {name: title, author: author};
//            console.log(book);
//            var json = JSON.stringify(book);
//            console.log(json);


    $.ajax({//create an ajax request to load_page.php
    type: "POST",
    url: "./api/books.php",
    data:{"data":"check"},
    success: function(data) {
        if (data) {

           alert(data);
        }
        else {
            alert('Successfully not posted.');
        }
    }
});

    //});
});