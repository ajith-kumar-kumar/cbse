<?php
require 'header.php';

?>
       
 <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">EVENTS</h4>
                                    
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                         <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h4 class="m-t-2 header-title"><b>Event Details</b></h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Event</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" placeholder="Event Name.....">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">About Events</label>
                                                    <div class="col-md-10">
                                                        <textarea class="form-control" rows="5"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div style="margin-left: 18rem;">
                                                                <label class="control-label"></label>
                                                                <input type="file" class="filestyle" data-input="false">

                                                                </div>
                                                            </div>
                                                           <!-- <div class="row">
                                                            <div class="col-offset-md-2">
                                                            <button type="button" class="btn btn-info waves-effect w-md waves-light">Submit</button>
                                                        </div>
                                                        </div>-->
                                                        <div class="form-group">
                                                        <button class="btn btn-info waves-effect w-md waves-light" style="position: absolute; right: 0;">Submit</button>
                                                        <br>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        


                        


                       <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">

                                    <h4 class="m-t-0 header-title"><b>Event Details Table</b></h4>
                                    

                                    <table id="datatable-keytable"
                                           class="table table-striped  table-colored table-info dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th>Event name</th>
                                            <th>Message</th>
                                            <th>File</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                            
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Tiger</td>
                                            <td>bchdchcbj</td>
                                            <td>
                                                                <label class="control-label"></label>
                                                                <input type="file" class="filestyle" data-input="false">

                                                                </td>
                                            <td><button type="button" class="btn btn-warning waves-effect w-md waves-light">Update</button>
                                        </td>
                                            <td><button type="button" class="btn btn-danger waves-effect w-md waves-light">Delete</button></td>
                                            
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="plugins/switchery/switchery.min.js"></script>

       

       

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>
            $(document).ready(function () {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable({keys: true});
                $('#datatable-responsive').DataTable();
                $('#datatable-colvid').DataTable({
                    "dom": 'C<"clear">lfrtip',
                    "colVis": {
                        "buttonText": "Change columns"
                    }
                });
                $('#datatable-scroller').DataTable({
                    ajax: "plugins/datatables/json/scroller-demo.json",
                    deferRender: true,
                    scrollY: 380,
                    scrollCollapse: true,
                    scroller: true
                });
                var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
                var table = $('#datatable-fixed-col').DataTable({
                    scrollY: "300px",
                    scrollX: true,
                    scrollCollapse: true,
                    paging: false,
                    fixedColumns: {
                        leftColumns: 1,
                        rightColumns: 1
                    }
                });
            });
            TableManageButtons.init();

        </script>




<?php
require 'footer.php';
?>