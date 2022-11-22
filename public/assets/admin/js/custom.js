(function($) {

    $('.selectcustom').selectpicker();

    $(document).ready(function() {
       /*  $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            $.fn.dataTable.tables({
                visible: true,
                api: true
            }).columns.adjust();
        }); */
       /*  $('table.datatable-style').DataTable({
            scrollY: 800,
            scrollCollapse: true,
            paging: false,
            searching: false,
            info: false

        }); */
        
        $('.nav-button').click(function() {
            $('body').toggleClass('sidebar-nav-open');
            // $('.main-header .navbar').toggleClass('navbar-dark');
        });

        $('#headeSearcBtn').click(function() {
            $('.mob-toggle-search-bar').toggleClass('show-search');

        });
    });

})(window.jQuery);