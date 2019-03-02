<?php
require 'header.php';

?>
 <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">ACTIVITY</h4>
                                    
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                   <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                	<h4 class="m-t-2 header-title"><b>Activity Details</b></h4>
                                	<div class="row">
                        				<div class="col-md-12">
<!--                         					<form class="form-horizontal">
 -->                        						<div class="form-group">
	                                                <label class="col-md-2 control-label">Activity</label>
	                                                <div class="col-md-10">
                                                        <input type="hidden" name="aid" id="aid" required>
	                                                    <input type="text" class="form-control" name="aname" id="aname" placeholder="Activity Name.....">
	                                                </div>
	                                            </div>
	                                            <div class="form-group">
	                                                <label class="col-md-2 control-label">About Activity</label>
	                                                <div class="col-md-10">
	                                                    <textarea class="form-control" id="adesc" name="adesc" rows="5"></textarea>
	                                                </div>
	                                            </div>
                                              
	                                            <div class="form-group">
                                                                <div class="col-sm-4 col-md-offset-2">
                                                                <label class="control-label"></label>
                                                                <input type="file" class="filestyle" id="image" name="image" data-buttontext="Select file" data-buttonname="btn-default" >
                                                                </div>
                                                                <div class="file-field input-field col s6">
                                   <img src="uploads/images.png" width="200px" height="auto" id="imgpreview" />
                                                            </div>
                                                           
                                                        <div class="form-group">
                                                            <div class="col-sm-4 col-md-offset-10">
                                                        <button class="btn btn-info waves-effect w-md waves-light" type="Submit" name="action" onclick="addacti(this)" id="action">Add</button>
                                                        <button class="btn btn-info waves-effect w-md waves-light" type="Submit" onclick="updateacti(this);"  name="action" id="update">update</button>
                                                    </div>
                                                        
                                                    </div>
<!-- 	                                        </form>
 -->	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">

                                    <h4 class="m-t-0 header-title"><b>Activity Details Table</b></h4>
                                    

                                    <table id="datatable-keytable"
                                           class="table table-striped  table-colored table-info dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th>s.no</th>
                                            <th>Activity Name</th>
                                            <th>Activity Details</th>
                                            <th>Photo</th>
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
            
document.getElementById('image').onchange = function (evt) {
      var tgt = evt.target || window.event.srcElement,
          files = tgt.files;

      // FileReader support
      if (FileReader && files && files.length) {
          var fr = new FileReader();
          fr.onload = function () {
              document.getElementById('imgpreview').src = fr.result;
          }
          fr.readAsDataURL(files[0]);
      }else {
          // fallback -- perhaps submit the input to an iframe and temporarily store
          // them on the server until the user's session ends.
          alert("Please browse the image"); 
      }
    }
$('#update').hide();

            function addacti(obj){
      if ($('#aname').val() == '') {
          alert("Name is required");     
          }   
     else if($('#adesc').val()==''){
         alert('adesc is required');
              
      }else if (document.getElementById("image").files.length == 0) {
          alert("Browse a User Photo please");                
      }else{

          var formData = new FormData();
          formData.append("op","addactive");
          formData.append("aname",$('#aname').val());
          formData.append("adesc",$('#adesc').val());

          formData.append("image",document.getElementById("image").files[0]); // ithula tan img ah key:image la set pannuren..
        //   swal({     
        //      title: "Add activity",   
        //      text: " User Name: "+$('#aname').val(),   
        //      type: "info", showCancelButton: true,   
        //      closeOnConfirm: false,   
        //      showLoaderOnConfirm: true, 
        // }, 
        //      function(){     
              $.ajax({
                  url : 'ajax/activehandler.php',
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
                        // setTimeout(function(){ swal(obj.result),1000});
                        // alert(obj.result);
                          $('#aname').val('');
                          $('#adesc').val('');
                        $('#imgpreview').attr('src','uploads/images.png');

                          $('#image').val('');
                          loadDataIntoTab();
                      }else{
// setTimeout(function(){ swal(obj.result),1000});                         
 // alert(obj.result);
                      }
                  }
              });
                 //setTimeout(function(){        }, 2000); 
        //    }
        // );
      }
    }


     function loadDataIntoTab(){
      var formData = new FormData();
      formData.append("op","fetchactive");
      $.ajax({
          url : 'ajax/activehandler.php',
          type : 'POST',
          processData: false,
          contentType: false,
          async : false,
          data :formData,
          success:function(result)
          {

            // alert(obj.data[n].col-xs-12status);
              obj = JSON.parse(result);
              var code;
              if(obj.err==0)
              {
                var n;
                for(n in obj.data){
                  code = code + '<tr>'+
                              '<td>'+(parseInt(n)+1)+'</td>'+
                              '<td> <img src=\"<?php echo  'uploads/activityimage/'; ?>'+obj.data[n].image+'?'+Math.random()+'\" width="120px" height="auto" /> </td>'+
                              '<td>'+obj.data[n].aname+'</td>'+
                              '<td>'+obj.data[n].adesc+'</td>'+
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
                                  '<button class="btn waves-effect waves-light red" id="deleteTabEle" onclick="deleteTabEle(this);" data-id="'+obj.data[n].id+'" type="submit">Delete</button>'+
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
      formData.append("op","editactive");
      formData.append("id",$(obj).attr('data-id'));
      $.ajax({
          url : 'ajax/activehandler.php',
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
                $('#aname').val(obj.aname);
                $('#adesc').val(obj.adesc);
                $('#filename').val(obj.image);
                $('#aid').val(obj.id);
                $('#aname').focus();
                $('#update').show();
                $('#action').hide();
                $('#imgpreview').attr('src','<?php echo 'uploads/activityimage/'; ?>'+obj.image);

//                $('#imgpreview').attr('src',getBase64Image(document.getElementById("imgpreview"),obj.logo.substr((obj.logo.indexOf('.')+1),obj.logo.length)));
              }
          }
      });      
    }
     function updateacti(obj){
      if ($('#Ename').val() == '') {
          alert("Name is required");        
      }else if($('#Edesc').val() == '') {
          alert("Name is required");                  
      }else if ($('#image').val() == '') {
          alert("Browse a logo please" );                
      }else{
          var formData = new FormData();
          formData.append("op","updateactive");
          formData.append("aname",$('#aname').val());
          formData.append("adesc",$('#adesc').val());
          formData.append("id",$('#aid').val());
          // if ($('#imgpreview').attr('src').indexOf('data:image/') != -1) {
            formData.append("image",document.getElementById("image").files[0]); // ithula tan img ah key:image la set pannuren..
          //   console.log('browsed');
          // }
        
              $.ajax({
                  url : 'ajax/activehandler.php',
                  type : 'POST',
                  processData: false,
                  contentType: false,
                  async : false,
                  data :formData,
                  success:function(result)
                  {
                          console.log(result);
                      obj = JSON.parse(result);
                      if(obj.err==0)
                      {
                        alert(result);
                          // setTimeout(function(){ swal(obj.result),1000});
                          loadDataIntoTab();
                          // Materialize.toast(obj.result, 4000);
                          $('#aname').val('');
                          $('#adesc').val('');
                          $('#action').show();
                          $('#update').hide();
                          // $('#imgpreview').attr('src','uploads/img.png');
                          $('#image').val('');
                      }else{
setTimeout(function(){ swal(obj.result),1000});                      }
                  }
              });
                 //setTimeout(function(){        }, 2000); 
           }
      
    }

 function deleteTabEle(obj){
      var formData = new FormData();
      formData.append("op","deleteactive");
      formData.append("id",$(obj).attr('data-id'));
      $.ajax({
          url : 'ajax/activehandler.php',    
          type : 'POST',
          processData: false,
          contentType: false,
          async : false,
          data :formData,
          success:function(result)
          {
            alert(result);
              obj = JSON.parse(result);
            alert(obj.result);                
              loadDataIntoTab();
          }
      });
    }
    function updateStatus(obj) {
      var formData = new FormData();
      formData.append("op","updateStatus"); 
      formData.append("id",$(obj).attr('data-id'));
      formData.append("status",$(obj).attr('data-val'));
      $.ajax({
          url : 'ajax/activehandler.php',
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
              loadDataIntoTab();
          }
      });
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