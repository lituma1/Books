/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {
    console.log('działa');
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
            
            
            name.click(function(){
                console.log('klikam');
                $.get('./api/books.php?id=' + id, function(json){
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
    var p = $('div');
    console.log(p);

//   $('button').click(function() {
//
//          $.get('http://date.jsontest.com/', function(json) {
//            console.log(json);
//
//              var czas = $('<p><b>Czas: ' + json.time + '</b></p>');
//              var timestamp = $('<p><b>timestamp:</b> ' + json.milliseconds_since_epoch + '</p>');
//              var data = $('<p><b>Data:</b> ' + json.date + '<p>');
//
//              $('div#json').empty();
//              $('div#json').prepend(czas);
//              $('div#json').prepend(timestamp);
//              $('div#json').prepend(data);
//
//          });
//
//    });

});