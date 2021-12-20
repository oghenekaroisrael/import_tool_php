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
                                            Total Uploadables <h4 id="total_uploadable"></h4>
                                        </div>
                                        <div class="col-md-4 col-sm-12 text-center">
                                            Total Paycodes with Issues <h4 id="total_issues"></h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <button class="btn btn-primary" id="upload">Upload Data</button>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <button class="btn btn-secondary pull-right" id="cancel">Cancel Upload</button>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-12 col-sm-12">
                                            <ul class="list-group" id="row_elements" style="list-style-type: none;height: 400px;overflow-y: scroll;"></ul>
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
                        const resp = JSON.parse(response);
                        document.getElementById('import_row').style.display = 'none';
                        document.getElementById('importing_row').style.display = 'block';
                        document.getElementById('total_rows').innerHTML = resp['total'];
                        uploadables = resp.upload;
                        var parentUL = document.getElementById('row_elements');
                        uploadables.forEach(function(item, index) {
                            var node = document.createElement('li');
                            node.classList.add('list-group-item');
                            node.classList.add('list-group-item-success');
                            node.classList.add('p-3');
                            // add name if neccessary
                            node.innerHTML = item['paycode'] + " " + item['amount'];
                            parentUL.appendChild(node);
                        });
                    }
                });
            });

            a('#cancel').on('click', function(e) {
                e.preventDefault();
                document.getElementById('import_row').style.display = 'block';
                document.getElementById('importing_row').style.display = 'none';
                uploadables = NULL;
            });
        });
    </script>
</body>

</html>
<!-- end document-->