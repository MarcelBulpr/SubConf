        </div>

        <!-- jQuery (wird für Bootstrap JavaScript-Plugins benötigt) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
        <script src="js/bootstrap.min.js"></script>

        <script>
        $(function(){
 
            $('.nav-tabs a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
            })

            $('.member-list a').click(function() {
            $('.member-list a.active').removeClass('active');
                $(this).addClass('active');
            });
            
            $('.save-btn').click(function () {
                var btn = $(this)
                btn.button('loading')
                //$.ajax(...).always(function () {
                //    btn.button('reset')
                //});
            });
            
        });
        </script>

    </body>
</html>