<?php
require 'header.php';

?>
<head>  <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
</head>
         <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">EVENTS</h4>
                                    
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                   <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                	<h4 class="m-t-2 header-title"><b>Event Details</b></h4>
                                	<div class="row">
                        				<div class="col-md-12">
<!--                         					<form class="form-horizontal">
 -->                        						<div class="form-group">
                                                     <input type="hidden" name="Eid" id="Eid" required>
	                                                <label class="col-md-2 control-label">Event</label>
	                                                <div class="col-md-10">
	                                                    <input type="text" class="form-control" placeholder="Event Name....." name="Ename" id="Ename">
	                                                </div>
	                                            </div>
	                                            <div class="form-group">
	                                                <label class="col-md-2 control-label">About Events</label>
	                                                <div class="col-md-10">
	                                                    <textarea class="form-control" id
                                                        ="Edesc" name="Edesc" rows="5"></textarea>
	                                                </div>
	                                            </div>
	                                             <div class="form-group">
                                                                <div class="col-sm-4 col-md-offset-2" >
                                                                     <!-- <input type="text" class="form-control" disabled id="filename"  > -->

                                                                <input type="file" class="filestyle"  data-buttontext="Select file" data-buttonname="btn-default"  name="image" id="image" >
                                                                </div>

                                                             <div class="file-field input-field col s6">
                                   <img src="uploads/images.png" width="200px" height="auto" id="imgpreview" />
                                                    </div>  
                                                            </div>
                                                           
                            <div class="form-group">
                          <div class="col-sm-4 col-md-offset-10">
                          <button class="btn btn-info waves-effect w-md waves-light" type="Submit" name="action" onclick="addEvent(this)" id="action">Add</button>
                                                        <button class="btn btn-info waves-effect w-md waves-light" type="Submit" onclick="updateEvent(this);"  name="action" id="update">update</button>
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

                                    <h4 class="m-t-0 header-title"><b>Event Details Table</b></h4>
                                    

                                    <table id="datatable-keytable"
                                           class="table table-striped  table-colored table-info dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th>s.no</th>
                                            <th>Event img</th>
                                            <th>Event name</th>
                                            <th>Event DEsc</th>
                                            <th>change</th>
                                            <th>add/delete</th>
                                            
                                            
                                            
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
        <script src="plugins/sweetalert/js/index.js"></script>

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

             function addEvent(obj){
      if ($('#Ename').val() == '') {
          alert("Name is required");     
          }   
     else if($('#Edesc').val()==''){
         alert('Edesc is required');
              
      }else if (document.getElementById("image").files.length == 0) {
          alert("Browse a User Photo please");                
      }else{

          var formData = new FormData();
          formData.append("op","addEvent");
          formData.append("Ename",$('#Ename').val());
          formData.append("Edesc",$('#Edesc').val());

          formData.append("image",document.getElementById("image").files[0]); // ithula tan img ah key:image la set pannuren..
          swal({     
             title: "Add Event",   
             text: " User Name: "+$('#Ename').val(),   
             type: "info", showCancelButton: true,   
             closeOnConfirm: false,   
             showLoaderOnConfirm: true, 
        }, 
             function(){     
              $.ajax({
                  url : 'ajax/eventhandler.php',
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
                          $('#Ename').val('');
                          $('#Edesc').val('');
                        $('#imgpreview').attr('src','uploads/images.png');

                          $('#image').val('');
                          loadDataIntoTab();
                      }else{
setTimeout(function(){ swal(obj.result),1000});                         
 // alert(obj.result);
                      }
                  }
              });
                 //setTimeout(function(){        }, 2000); 
           }
        );
      }
    }

    function updateEvent(obj){
      if ($('#Ename').val() == '') {
          alert("Name is required");        
      }else if($('#Edesc').val() == '') {
          alert("Name is required");                  
      }else if ($('#image').val() == '') {
          alert("Browse a logo please" );                
      }else{
          var formData = new FormData();
          formData.append("op","updateEvent");
          formData.append("Ename",$('#Ename').val());
          formData.append("Edesc",$('#Edesc').val());
          formData.append("id",$('#Eid').val());
          // if ($('#imgpreview').attr('src').indexOf('data:image/') != -1) {
            formData.append("image",document.getElementById("image").files[0]); // ithula tan img ah key:image la set pannuren..
          //   console.log('browsed');
          // }
        
              $.ajax({
                  url : 'ajax/eventhandler.php',
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
                          $('#Ename').val('');
                          $('#Edesc').val('');
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



    // function clearAll() {
    //   $('#name').val('');
    //   $('#name').focus();
    //   $('#imgpreview').attr('src','uploads/img.png');
    //   $('#filename').val('');
    //   $('#phone').val('+91   -   -    ');
    //   $('#mail').val('');
    // }

    function loadDataIntoTab(){
      var formData = new FormData();
      formData.append("op","fetchEvent");
      $.ajax({
          url : 'ajax/eventhandler.php',
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
                              '<td> <img src=\"<?php echo  'uploads/eventimage/'; ?>'+obj.data[n].image+'?'+Math.random()+'\" width="120px" height="auto" /> </td>'+
                              '<td>'+obj.data[n].Ename+'</td>'+
                              '<td>'+obj.data[n].Edesc+'</td>'+
                                                            // '<td>'+obj.data[n].status+'</td>'+

                              '<td>';
                                  if (obj.data[n].status == 0) {
                                    code = code + '<button class="btn btn-info waves-effect w-md waves-light " id="updateStatusTabEle" onclick="updateStatusTabEle(this);" data-id="'+obj.data[n].id+'" data-val="1" type="submit">Activate</button>';
                                  }else{
                                    code = code + '<button class="btn btn-info waves-effect w-md waves-light" id="updateStatusTabEle" onclick="updateStatusTabEle(this);" data-id="'+obj.data[n].id+'" data-val="0" type="submit">Deactivate</button>';                                    
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
      formData.append("op","editEvent");
      formData.append("id",$(obj).attr('data-id'));
      $.ajax({
          url : 'ajax/eventhandler.php',
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
                $('#Ename').val(obj.Ename);
                $('#Edesc').val(obj.Edesc);
                $('#filename').val(obj.image);
                $('#Eid').val(obj.id);
                $('#Ename').focus();
                $('#update').show();
                $('#action').hide();
                $('#imgpreview').attr('src','<?php echo 'uploads/eventimage/'; ?>'+obj.image);

//                $('#imgpreview').attr('src',getBase64Image(document.getElementById("imgpreview"),obj.logo.substr((obj.logo.indexOf('.')+1),obj.logo.length)));
              }
          }
      });      
    }
    function deleteTabEle(obj){
      var formData = new FormData();
      formData.append("op","deleteEvent");
      formData.append("id",$(obj).attr('data-id'));
      $.ajax({
          url : 'ajax/eventhandler.php',    
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
    function updateStatusTabEle(obj) {
      var formData = new FormData();
      formData.append("op","updateStatus"); 
      formData.append("id",$(obj).attr('data-id'));
      formData.append("status",$(obj).attr('data-val'));
      $.ajax({
          url : 'ajax/eventhandler.php',
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

  <script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>

<?php
require 'footer1.php';
?>