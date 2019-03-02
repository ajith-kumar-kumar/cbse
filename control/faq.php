<?php
require 'header.php';

?>
            <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">FAQ</h4>
                                    
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                   <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                	<h4 class="m-t-2 header-title"><b>FAQ Details</b></h4>
                                	<div class="row">
                        				<div class="col-md-12">
                        						<div class="form-group">
	                                                <label class="col-md-2 control-label">Question</label>
	                                                <div class="col-md-10">
                                                        <input type="hidden" name="fid" id=
                                                        "fid">
	                                                    <input type="text" class="form-control" name="fques"  id="fques"placeholder="Question Name??????">
	                                                </div>
	                                            </div>
	                                            <div class="form-group">
	                                                <label class="col-md-2 control-label">Answer</label>
	                                                <div class="col-md-10">
	                                                    <textarea  name="fans" id="fans" class="form-control" rows="5"></textarea>
	                                                </div>
	                                            </div>
	                                            
                                                           
                                                           
                                                        <div class="form-group">
                                                           <button class="btn btn-info waves-effect w-md waves-light" type="Submit" name="action" onclick="addfaq(this)" id="action">Add</button>
                                                        <button class="btn btn-info waves-effect w-md waves-light" type="Submit" onclick="updatefaq(this);"  name="action" id="update">update</button>
                                                    </div>
                                                        
                                                    </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">

                                    <h4 class="m-t-0 header-title"><b>Question Details Table</b></h4>
                                    

                                    <table id="datatable-keytable"
                                           class="table table-striped  table-colored table-info dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th>s.no</th>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                            
                                            
                                        </tr>
                                        </thead>
                                        <tbody id="dataBody">
                                        
                                        
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

        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap.js"></script>

        <script src="plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="plugins/datatables/jszip.min.js"></script>
        <script src="plugins/datatables/pdfmake.min.js"></script>
        <script src="plugins/datatables/vfs_fonts.js"></script>
        <script src="plugins/datatables/buttons.html5.min.js"></script>
        <script src="plugins/datatables/buttons.print.min.js"></script>
        <script src="plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="plugins/datatables/dataTables.scroller.min.js"></script>
        <script src="plugins/datatables/dataTables.colVis.js"></script>
        <script src="plugins/datatables/dataTables.fixedColumns.min.js"></script>

        <!-- init -->
        <script src="assets/pages/jquery.datatables.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>




<script type="text/javascript">
    $('#update').hide();


         function addfaq(obj){
      if ($('#fques').val() == '') {
          alert("question is required");     
          }   
     else if($('#fans').val()==''){
         alert('ans is required');
              
                
      }else{

          var formData = new FormData();
          formData.append("op","addFaq");
          formData.append("fques",$('#fques').val());
          formData.append("fans",$('#fans').val());
          console.log($('#fques').val());
        console.log($('#fans').val());
         
        //   swal({     
        //      title: "Add FAQ",   
        //      text: " User Name: "+$('#fques').val(),   
        //      type: "info", showCancelButton: true,   
        //      closeOnConfirm: false,   
        //      showLoaderOnConfirm: true, 
        // }, 
        //      function(){     
              $.ajax({
                  url : 'ajax/faqhandler.php',
                  type : 'POST',
                  processData: false,
                  contentType: false,
                  async : false,
                  data :  formData,
                  success:function(result)
                  {
                      console.log(result);
                      obj = JSON.parse(result);
                      if(obj.err==0)
                      {
                        setTimeout(function(){ swal(obj.result),1000});
                        // alert(obj.result);
                          $('#fques').val('');
                          $('#fans').val('');
                       

                          
                          loadDataIntoTab();
                      }else{
  alert(obj.result);
                      }
                  }
              });
                 //setTimeout(function(){        }, 2000); 
       
      }
    } //    }
        // );
 function loadDataIntoTab(){
      var formData = new FormData();
      formData.append("op","fetchfaq");
      $.ajax({
          url : 'ajax/faqhandler.php',
          type : 'POST',
          processData: false,
          contentType: false,
          async : false,
          data :formData,
          success:function(result)
          {
              alert(result);
              obj = JSON.parse(result);
              var code;
              if(obj.err==0)
              {
                var n;
                for(n in obj.data){
                  code = code + '<tr>'+
                              '<td>'+(parseInt(n)+1)+'</td>'+
                              
                              '<td>'+obj.data[n].fques+'</td>'+
                              '<td>'+obj.data[n].fans+'</td>'+
                                    // '<td>'+obj.data[n].status+'</td>'+

                              '<td>';
                                  if (obj.data[n].status == 0) {
                                    code = code + '<button class="btn btn-info waves-effect w-md waves-light " id="updateStatus" onclick="updateStatus(this);" data-id="'+obj.data[n].id+'" data-val="1" type="submit">Activate</button>';
                                  }else{
                                    code = code + '<button class="btn btn-info waves-effect w-md waves-light" id="updateStatus" onclick="updateStatus(this);" data-id="'+obj.data[n].id+'" data-val="0" type="submit">Deactivate</button>';                                    
                                  }
                                  
                              code = code + '</td>'+
                              '<td>'+
                                  '<button class="btn waves-effect waves-light yellow darken-4" id="editTabEle" onclick="editTabEle(this);" data-id="'+obj.data[n].id+'" type="submit">Edit</button>&nbsp;&nbsp;'+
                                  '<button class="btn waves-effect waves-light red" id="deletetable" onclick="deletetable(this);" data-id="'+obj.data[n].id+'" type="submit">Delete</button>'+
                              '</td>'+
                              '</tr>';
                }
              }else{
                alert(obj.result);
              }
              $('#dataBody').empty();
              $('#dataBody').html(code);
          }
      });
    }
loadDataIntoTab();
 function editTabEle(obj){
      var formData = new FormData();
      formData.append("op","editfaq");
      formData.append("id",$(obj).attr('data-id'));
      $.ajax({
          url : 'ajax/faqhandler.php',
          type : 'POST',
          processData: false,
          contentType: false,
          async : false,
          data :formData,
          success:function(result)
          {
              alert(result);
              obj = JSON.parse(result);
              // Materialize.toast(obj.result, 4000); 
              if (obj.err == 0) {
                $('#fques').val(obj.fques);
                $('#fans').val(obj.fans);
                $('#fid').val(obj.id);
                $('#fques').focus();
                $('#update').show();
                $('#action').hide();
                
              }
          }
      });      
    }
    function updatefaq(obj){
         
         var formData= new FormData();
         formData.append('op','updateFaq');
         formData.append('fques',$('#fques').val());
         formData.append('fans',$('#fans').val());
         formData.append('id' ,$('#fid').val());
         $.ajax({
            url:'ajax/faqhandler.php',
            type:'POST',
            processData:false,
            contentType:false,
            data:formData,
            async:false,
            success:function (result) {
                console.log(result);
                                    obj=JSON.parse(result);

                if (obj.err==0) {

                    alert(result);
                    loadDataIntoTab();
                    $('#fques').val('');
                    $('#fans').val('');
                    $('#action').show();
                    $('#update').hide();

                }
                else{
                    alert(obj.result);
                }
            }
         })



    }
    function deletetable(obj){
        var formData= new FormData();
        formData.append('op','deletefaq');
        formData.append('id' ,$(obj).attr('data-id'));
        $.ajax({
            url:'ajax/faqhandler.php',
            type:'POST',
            processData:false,
            contentType:false,
            data:formData,
            async:false,
            success:function (result) {
                 alert(result);
                 obj=JSON.parse(result);
                  loadDataIntoTab();
            }
        })


    }
    function updateStatus(obj) {
         var formData=new FormData();
         formData.append('op','updateStatus');
         formData.append('id',$(obj).attr('data-id'));
         // console.log($(obj.attr('data-id')));
         formData.append('status',$(obj).attr('data-val'));
         // console.log($(obj).attr('data-val'));
         $.ajax({
            url:'ajax/faqhandler.php',
            type:'POST',
            processData:false,
            contentType:false,
            data:formData,
            async:false,
            success:function(result){
               alert(result);
               obj=JSON.parse(result);
                             loadDataIntoTab();

            }
         })
    }
</script>

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
                    ajax: "../plugins/datatables/json/scroller-demo.json",
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
require 'footer1.php';
?>