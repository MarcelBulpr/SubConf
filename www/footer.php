        </div>

        <!-- jQuery (wird für Bootstrap JavaScript-Plugins benötigt) -->
        <script src="js/jquery-2.1.1-min.js"></script>
        <!-- Binde alle kompilierten Plugins zusammen ein (wie hier unten) oder such dir einzelne Dateien nach Bedarf aus -->
        <script src="js/bootstrap.min.js"></script>

<!-- folgendes sorgt für Fehler -->
<!--        <script src="js/jQuery.wait/jquery.wait.js"></script> -->
        
        <script>
        $(function(){
        $(".tab-content").load("helper/show.php");

        $('.member-list a').click(function() {
            var str = this.toString();
            var profileid = str.substring(str.length-32);//get profileid
            if($(this).hasClass("active")) {
                $('.member-list a.active').removeClass('active');
            } else if (document.getElementById("cb-"+profileid).checked==false){ // check if profile is not checked
                $('.member-list a.active').removeClass('active');
                $(this).addClass('active');
            };
        });
            <?php
//            $subday = file_get_contents("helper/subday.txt");
//           if(date("D")=="Tue" && $subday == " ") { ?>
//            $(".user-list").load("helper/mail.php", function(){
//                $( ".user-list").load("index.php .user-list", function(){
//                    $(".tab-content").load("helper/show.php");
//                });
//            });
            <?php //} ?>
            <?php
//            if(date("D")=="Tue") {
//                unlink("helper/subday.txt");
//                ob_start();
//                echo " ";
//                $content = ob_get_contents();
//
//                $file = fopen("helper/subday.txt", "w");
//                fwrite($file, $content);
//                ob_clean();
//           } ?>


            // save-button in edit view
            $('.container').on('click', '#editform .save-btn', function ( event ) {
                var btn = $(this);
                btn.button('loading');
                $.ajax({
                    type: "POST",
                    url: "helper/write.php",
                    dataType: "JSON",
                    data: $("#editform").serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        console.log(data.profileid); // show response from the php script.
                        console.log("Loading show view");
                        $( "#edit-list" ).remove();
                        $( "#modal-footer-edit" ).remove();
                        $( ".tab-pane" ).remove();  //sorgt dafür das die alten Inhalte sofort verschwinden
                        $( ".tab-content" ).load( "helper/show.php", function () {
                            $('.member-list a.active').removeClass('active');
                            $( "#list-group-item-text-"+data.profileid ).load( "index.php #list-group-item-text-"+data.profileid );
                            window.location.href="#top";
                            document.getElementById('cb-'+data.profileid).checked=false;
                            document.getElementById('cb-'+data.profileid).disabled=false;
                            $("#cb-"+data.profileid).load("index.php #cb-"+data.profileid);
                        });

                        //load show view (überflüssig? weil doppelt)
//                        console.log("Loading show view");
//                        $( ".tab-pane" ).load("helper/show.php");
                        }
                });

                return false; // avoid to execute the actual submit of the form.
                
            });
            
            // dismiss-button in edit view
            $('.container').on('click', '#editform .dismiss-btn', function ( event ) {
                console.log("Loading show view");
                window.location.href="#top";
                $( ".tab-content" ).load("helper/show.php");
                $('.member-list a.active').removeClass('active');
            });

            // save-button in "new-profile" view
            $('html').on('click', '#addform .save-btn', function ( event ) {
                var btn = $(this);
                btn.button('loading');
                $.ajax({
                    type: "POST",
                    url: "helper/write.php",
                    dataType: "JSON",
                    data: $("#addform").serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        console.log(data); // show response from the php script.
                        $( ".user-list" ).load("index.php .user-list",function(){
                            $( ".tab-content" ).load("helper/edit.php?profileid="+data.profileid);
                            $('.member-list a.active').removeClass('active', function() {
                                $(".user-list #user-"+data.profileid).addClass('active');
                            });
                        });
                    }
                });
                $(".form-control").val('');
                btn.button('loading').button('reset');
                return false; // avoid to execute the actual submit of the form.
            });
            
            // edit-button in show view
            $('.container').on('click', '#LoadEditForm', function ( event ) {
                console.log("Loading Edit Form");
                
                $('.member-list a').addClass('disabled');

                var profileid = $(this).data("profileid");
                $( ".tab-content" ).load("helper/edit.php?profileid="+profileid);
            });

            // dismiss-button in paypal.php
            $('.container').on("click","#paypalModal #paypalNo" ,function (e)
            {
                $("#paypalModal").modal("hide").on("hidden.bs.modal", function(e){
                    $(".tab-content").load("helper/show.php");
                    $('.member-list a.active').removeClass('active');
                });
            });

            $('.container').on("click","#paypalModal #barYes", function(e) {
                var str = this.toString();
                var profileid = str.substring(str.length-32);//get profileid

                $(".tab-content").load("helper/mailbar.php?profileid="+profileid, function() {
                    $(".tab-content").load("helper/show.php", function(){
                        alert("E-mail gesendet, warten sie auf die Bestätigung des Admins");
                    });
                });
                $("#paypalModal").modal("hide").on("hidden.bs.modal", function(e){
                    $(".tab-content").load("helper/show.php");
                    $('.member-list a.active').removeClass('active');
                    alert("E-mail wird gesendet");
                });
            });

            $("#Print").on("click", function(){
                document.location.href = "helper/Print.php";
            })
        });
        </script>

    </body>
</html>
