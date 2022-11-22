(function($) {

    $('.selectcustom').selectpicker();
    $(document).ready(function() {


        $('.nav-button').click(function() {
            $('body').toggleClass('nav-open');
            $('.main-header .navbar').toggleClass('navbar-dark');
        });


        $('.search-btn').click(function() {
            $('.weekly-calender-block .search-input').toggleClass('active-search');
        });

        // $("body").niceScroll({
        //     cursorwidth: "2px",
        //     cursorborder: "1px solid #1A1A1A"
        // });

        $(".categury-selection-list").niceScroll({
            cursorwidth: "0px",
            cursorborder: "1px solid #fff"
        });

        $(".main-menu").niceScroll({
            cursorwidth: "2px",
            cursorborder: "1px solid #1A1A1A"
        });

        $('.signin-btn').on('click', function(e) {

            $('#pills-login-tab').addClass('active')
            $('#pills-signup-tab').removeClass('active')
            $('#pills-login').tab('show')
            $('#pills-signup').removeClass('active')
        })

        $('.signup-btn').on('click', function(e) {
            $('#pills-login-tab').removeClass('active')
            $('#pills-signup-tab').addClass('active')
            $('#pills-signup').tab('show')
            $('#pills-login').removeClass('active')
        })

        // $(function() {

        // });

        $('.selectpicker').selectpicker('refresh');

        $('.price-card-box .detail-toggle-wrp .linktoggle-btn').click(function() {
            $(this).hide();
        });

        $('.price-card-box .keepchange-btn').click(function() {
            $('.detail-toggle-wrp .linktoggle-btn').show();
        });


        // Light and Dark Mode js
        $('.lightdarkswitch').click(function() {
            $('body').toggleClass('dark-mode');
            $('.dark-d').toggleClass('d-none');
            $('.light-d').toggleClass('d-block');
        });


        //Mobile Header Toggle Searchbar js
        $('#headeSearcBtn').click(function() {
            $('.mob-toggle-search-bar').toggleClass('show-search');

        });

    });



})(window.jQuery);