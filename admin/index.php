<style>
    main#viewpanel {
        position: fixed;
        margin-left: 200px;
        width: calc(100% - 200px);
        padding: .5em;
    }
</style>

<body class="w3-2018-quiet-gray">
    <?php
    include 'header.php';
    include 'sidebar.php';
    ?>

    <main id="viewpanel">
        <?php
        $p = filter_input(INPUT_GET, 'page');
        $page = isset($p) ? $p : 'home';
        include $page . '.php';
        ?>
    </main>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirm_modal" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                </div>
                <div class="modal-body">
                    <div id="delete_content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="confirm" onclick="">Continue</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Uni Modal -->
    <div class="modal fade" id="uni_modal" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit" onclick="$('#uni_modal form').submit()">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    // Start Preloading function
    window.start_load = function () {
        $('body').prepend('<div id="preloader2"></div>');
    };

    // End Preloading function
    window.end_load = function () {
        $('#preloader2').fadeOut('fast', function () {
            $(this).remove();
        });
    };

    // Uni Modal Function to load content dynamically
    window.uni_modal = function ($title = '', $url = '') {
        start_load(); // Show preloader
        $.ajax({
            url: $url,
            error: function (err) {
                console.log(err);
                alert("An error occurred while loading the content.");
                end_load(); // Hide preloader
            },
            success: function (resp) {
                if (resp) {
                    $('#uni_modal .modal-title').html($title);
                    $('#uni_modal .modal-body').html(resp);
                    $('#uni_modal').modal('show');
                    end_load(); // Hide preloader after loading content
                }
            }
        });
    };

    // Confirmation function to show a message and call a function
    window._conf = function ($msg = '', $func = '', $params = []) {
        $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")");
        $('#confirm_modal .modal-body').html($msg);
        $('#confirm_modal').modal('show');
    };

    // Alert Toast function for success, danger, info, or warning messages
    window.alert_toast = function ($msg = 'TEST', $bg = 'success') {
        $('#alert_toast').removeClass('bg-success bg-danger bg-info bg-warning');

        if ($bg === 'success') $('#alert_toast').addClass('bg-success');
        if ($bg === 'danger') $('#alert_toast').addClass('bg-danger');
        if ($bg === 'info') $('#alert_toast').addClass('bg-info');
        if ($bg === 'warning') $('#alert_toast').addClass('bg-warning');

        $('#alert_toast .toast-body').html($msg);
        $('#alert_toast').toast({ delay: 3000 }).toast('show');
    };

    // Preload logic to hide preloader when the page loads
    $(document).ready(function () {
        $('#preloader').fadeOut('fast', function () {
            $(this).remove();
        });
    });
</script>
