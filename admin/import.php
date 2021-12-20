<?php
include_once("inc/header2.php");
$active_page = "dashboard";
// Include database class
include_once '../inc/db.php';
?>

<body class="animsition">
    <div class="page-wrapper">
        <!-- PAGE CONTAINER-->
        <div class="page-container">

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row" id="import_row">
                                <div class="col-md-12">
                                    <h4 class="pb-2 display-5 text-center">Import File From CSV</h4>
                                    <form id="import">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-12">
                                                <input type="file" name="csv" class="form-control">
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <input type="submit" value="Upload" name="submitCsv" class="btn btn-primary">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row" id="importing_row" style="display: none;">
                                <div class="col-md-12">
                                    <h4 class="pb-2 display-5 text-center">Importing File From CSV</h4>
                                    <div class="row mb-5">
                                        <div class="col-md-4 col-sm-12 text-center">
                                            Total Rows <h4 id="total_rows"></h4>
                                        </div>
                                        <div class="col-md-4 col-sm-12 text-center">
                                            Total Uploaded <h4 id="total_uploadable"></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="toastCan">

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2021.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <?php include_once("inc/footer2.php"); ?>
    <script type="text/javascript">
        var a = jQuery.noConflict();
        let uploadables;
        let issues;
        a(function() {
            a('#import').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(a(this)[0]);
                a.ajax({
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: 'imp.php',
                    success: function(response) {
                        document.getElementById('total_uploadable').style.display = 'none';
                        document.getElementById('total_uploadable').innerHTML = response;
                    }
                });
            });
        });
    </script>
</body>

</html>
<!-- end document-->