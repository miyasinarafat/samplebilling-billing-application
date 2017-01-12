

// sidebar menu js
!function ($) {
    $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
        $(this).find('em:first').toggleClass("glyphicon-minus");
    });
    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
}(window.jQuery);

$(window).on('resize', function () {
    if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
});
$(window).on('resize', function () {
    if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
});

// Table js
$(function () {
    $('#hover, #striped, #condensed').click(function () {
        var classes = 'table';

        if ($('#hover').prop('checked')) {
            classes += ' table-hover';
        }
        if ($('#condensed').prop('checked')) {
            classes += ' table-condensed';
        }
        $('#table-style').bootstrapTable('destroy')
            .bootstrapTable({
                classes: classes,
                striped: $('#striped').prop('checked')
            });
    });
});

function rowStyle(row, index) {
    var classes = ['active', 'success', 'info', 'warning', 'danger'];

    if (index % 2 === 0 && index / 2 < classes.length) {
        return {
            classes: classes[index / 2]
        };
    }
    return {};
}
$(document).ready(function () {
    $('.btnNext').click(function (e) {
        e.preventDefault();

        var amountValue = $(this)
            .closest('fieldset')
            .find('div.form-group input#amount').val();
        var bikashValue = $(this)
            .closest('fieldset')
            .find('div.form-group input#bkasht_id').val();

        if (amountValue === '') {
            alert("Sorry You have to provide amount in digits");
        }
        else if (bikashValue === '') {
            alert("Sorry You have to provide Bkash Transaction ID in digits");
        } else {
            $(this).closest('fieldset').slideUp().next().slideDown();
        }
    });
    $('.btnPrev').click(function (e) {
        e.preventDefault();
        $(this).closest('fieldset').slideUp().prev().slideDown();

    });
});

