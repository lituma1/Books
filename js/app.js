/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {
    console.log('dom załadowany');
    $.ajax({
        url: 'http://date.jsontest.com/',
        data: {},
        type: 'GET',
        succes: function (json) {
            console.log('sukces!', json);
        },
        error: function (xhr, status, error) {
            console.log('blad', error);
        },
        complete: function (xhr, status) {
            console.log('ok');
        }

    });
});