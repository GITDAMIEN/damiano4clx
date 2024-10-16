import $ from 'jquery';

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit', '#filtersForm', function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize();

        $('#usersData').html('<div class="lds-ring"><div></div><div></div><div></div><div></div></div>');

        $.post(url, data, function (data) {
            $('#usersData').html(data);
        }).fail(function () {
            $('#usersData').html('<div class="text-danger">Something went wrong. Please try again later.</div>');
        })
    });

    $(document).on('keyup', '#name, #surname', function () {
        $('#filtersForm').trigger('submit');
    });

    $(document).on('change', '#view, #active', function () {
        $('#filtersForm').trigger('submit');
    });

    $(document).on('click', '.reset_fields', function () {
        $('input').val('');
        $('select#active').val('NULL');
        $('select#view').val('table');
        $('#filtersForm').trigger('submit');
    });

    $(document).on('click', '.ths', function () {
        var order = $(this).hasClass('defaultSort') ? 'asc' : ($(this).hasClass('sortedDesc') ? 'asc' : 'desc');
        var rows = $('#usersTable').find('tbody tr.userTr');
        var columnClass = '.' + $(this).attr('data-targetTd');
        var sortIcon = order === 'asc' ? '<i class="fa-solid fa-arrow-up-wide-short desc"></i>' : '<i class="fa-solid fa-arrow-down-wide-short desc"></i>';

        if ($(this).hasClass('sortNumber')) {
            sortNumberRows(rows, columnClass, order);
        } else if ($(this).hasClass('sortString')) {
            sortStringRows(rows, columnClass, order);
        } else if ($(this).hasClass('sortDate')) {
            sortDateRows(rows, columnClass, order);
        } else if ($(this).hasClass('sortBool')) {
            order = order === 'asc' ? 'desc' : 'asc';
            sortStringRows(rows, columnClass, order);
        }

        $('.ths').find('i').remove();
        if (!$(this).hasClass('defaultSort')) {
            $(this).toggleClass('sortedDesc');
        }
        $('.ths').removeClass('defaultSort');
        $('.ths').not(this).removeClass('sortedDesc');
        $(this).append(sortIcon)
    });

    function sortNumberRows(rows, columnClass, order) {
        rows.sort(function (a, b) {
            if (order === 'asc') {
                return parseFloat($(a).find(columnClass).text()) < parseFloat($(b).find(columnClass).text()) ? 1 : -1;
            } else {
                return parseFloat($(a).find(columnClass).text()) > parseFloat($(b).find(columnClass).text()) ? 1 : -1;
            }
        }).appendTo('#usersTable tbody');
    }

    function sortStringRows(rows, columnClass, order) {
        rows.sort(function (a, b) {
            if (order === 'asc') {
                return $(b).find(columnClass).text().localeCompare($(a).find(columnClass).text());
            } else {
                return $(a).find(columnClass).text().localeCompare($(b).find(columnClass).text());
            }
        }).appendTo('#usersTable tbody');
    }

    function sortDateRows(rows, columnClass, order) {
        rows.sort(function (a, b) {
            var dateA = convertDate($(a).find(columnClass).text());
            var dateB = convertDate($(b).find(columnClass).text());

            if (order === 'asc') {
                return dateB - dateA;
            } else {
                return dateA - dateB;
            }
        }).appendTo('#usersTable tbody');
    }

    function convertDate(dateTimeString) {
        var [dateString, timeString] = dateTimeString.split(' ');
        var newDateString = dateString.split('/').reverse().join('-');
        var fullDateString = newDateString + ' ' + timeString;

        return new Date(fullDateString);
    }
});
