<!-- <footer class="site-footer">
    <div class="copyright">
        <div class="tc">
            <?php $footer_name = \DB::table('settings')->where('name', 'footer_name')->first()->value; ?>
            Copyright © <?= date('Y') . ' ' . $footer_name ?>
        </div>
    </div>
</footer> -->
</div>
<script
        src="http://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
        crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/dt-1.10.18/datatables.min.js"></script>
<script src="{{ asset('assets/admin/js/jquery.sumoselect.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins.js') }}"></script>
<script src="{{ asset('assets/admin/js/calendar/moment.js') }}"></script>
<script src="{{ asset('assets/admin/js/calendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/main.js') }}"></script>


<script>
    $(function () {
        "use strict";
        $('#calendar').fullCalendar();


        if ( ! localStorage.getItem("sidebar_close") ) {
            $('body').addClass('open');
        } else {
            localStorage.setItem("bgColor","green");
        }
        $('[data-toggle="push-menu"]').click(function(){
            if ( ! localStorage.getItem("sidebar_close") ) {
                localStorage.setItem("sidebar_close","1");
            } else {
                localStorage.setItem("sidebar_close","1");
            }
        });
        
    });

</script>

</body>
</html>
