import $ from 'jquery';

$(function () {
    $('.reset_fields').on('click', function () {
        $('input').val('');
        $('select#active').val('NULL');
        $('select#view').val('table');
    })
});
