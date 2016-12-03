
$(function () {
    console.log('działa');
    var form = $('form');
    $.get('./api/books.php', function (json) {
        console.log(json);

        //Najpierw zmieniam json w obiekty javascript 
        $.each(JSON.parse(json), function (index, object) {
            var name = $('<p><b>Tytuł: ' + object.name + '&nbsp' + '</b></p');
            var deleteBook = $("<a href='#'>Usuń " + object.name + " z katalogu</a>");
            var id = object.id;
            var div = $('<div>');
            div.toggle();
            $('#json').append(name);
            $('#json').append(div);
            $('#json').append(deleteBook);
;
            name.click(function () {
                console.log('klikam');
                
                $.get('./api/books.php?id=' + id, function (json) {
                    console.log(json);
                    var object2 = JSON.parse(json);
                    var div = name.next();
                    div.text("Autor: " + object2.author);
                    
                    div.toggle();

                });
                
            })
            deleteBook.click(function () {

                console.log('klikam ' + id);
                $.ajax({
                    type: "DELETE",
                    url: "./api/books.php",
                    data: {"id": id},
                    success: function (data) {
                        if (data) {
                            location.reload();
                            e.preventDefault();
                            //alert(data);
                        } else {
                            //alert('Successfully not posted.');
                        }
                    }
                })
            })



        })
    })
    form.on('submit', function (e) {
        e.preventDefault();

        var name = $('#inputTitle').val();

        var author = $('#inputAuthor').val();

        $.ajax({
            type: "POST",
            url: "./api/books.php",
            data: {"name": name, "author": author},
            success: function (data) {
                if (data) {
                    location.reload();
                    e.preventDefault();
                    //alert(data);
                } else {
                    //alert('Successfully not posted.');
                }
            }
        });
    });
})