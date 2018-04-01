var DataTablesOptions = {
    "paging": true,
    "info": true,
    "pageLength": 25,
    "language": {
        "decimal": ",",
        "emptyTable": "Nincs adat ezekkel a beállításokkal!",
        "info": "_START_-_END_ a _TOTAL_ rekordból",
        "infoEmpty": "0 bejegyzés",
        "infoFiltered": "(_MAX_ rekordból szűrve)",
        "infoPostFix": "",
        "thousands": ".",
        "lengthMenu": "_MENU_ rekord mutatása",
        "loadingRecords": "Betöltés...",
        "processing": "Feldolgozás...",
        "search": "Keresés:",
        "zeroRecords": "Nem található rekord!",
        "paginate": {
            "first": "Első",
            "last": "Utolsó",
            "next": "Következő",
            "previous": "Előző"
        },
        "aria": {
            "sortAscending": ": növekvő sorrend",
            "sortDescending": ": csőkkenő sorrend"
        }
    }
};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Load Page
$(function () {

    StickFooter();

    $(window).resize(function () {
        StickFooter();
    });
});

function StickFooter() {
    var full = $(document).height();
    var page = $("html").height() + 50;

    if (full <= page) {
        $("#pageFooter").removeClass("navbar-fixed-bottom");
    }
    else {
        $("#pageFooter").addClass("navbar-fixed-bottom");
    }
}
