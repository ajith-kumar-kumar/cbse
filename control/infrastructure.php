<?php
require 'header.php';

?>
<head>  
    <link href="http://hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js"></script>
</head>
                <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">INFRASTRUCTURE</h4>
                                    
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                   <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                	<h4 class="m-t-2 header-title"><b>Infrastructure Details</b></h4>
                                	<div class="row">
                        				<div class="col-md-12">
<!--                         					<form class="form-horizontal">
 -->                        						<div class="form-group">
	                                                <label class="col-md-2 control-label">Title</label>
	                                                <div class="col-md-10">
                                                        <input type="hidden" required="" name="iid" id="iid" >
	                                                    <input type="text" name="iname" class="form-control" id="iname" placeholder="Title.....">
	                                                </div>


	                                            </div>
	                                            <div class="form-group">
	                                                <label class="col-md-2 control-label">About Infrastructure</label>
	                                                <div class="col-md-10">
	                                                    <textarea class="form-control" id="idesc" name="idesc" rows="5"></textarea>
	                                                </div>
	                                            </div>
	                                            <div class="form-group">
                                                                <div class="col-sm-4 col-md-offset-2">
                                             <label class="control-label"></label>
                
<!--                                                   <input type="text" id="filename">
 -->
                                            <input type="file"  class="filestyle" data-buttontext="Select file" data-buttonname="btn-default"  name="image" id="image">
                                            <img id='loading' src='loading.gif' style='visibility: hidden;'>



                                                             <!-- <div class="file-upload">
                                                               <div class="file-select" >
                                                               <div class="file-select-button">Choose File</div>
                                                             <div class="file-select-name"  id="filename">No file chosen...</div>  
                                                               <input type="file" name="image" id="image">
                                                             </div>
                                                             </div> -->
                                                                        </div>
                                                                <div id="fileuploader">Upload</div>

                                                                <div class="demo"><img src="uploads/images.png" width="200px" height="auto" id="imgpreview"></div>
                                                            </div>
                                                           
                                                        <div class="form-group">
                                                            <div class="col-sm-4 col-md-offset-10">
                                                        <button class="btn btn-info waves-effect w-md waves-light" type="submit" id="action" name="action" onclick="addInfra(this);">Add</button>
                                                        <button class="btn btn-info waves-effect w-md waves-light" type="submit" id="update" name="action" onclick="updateinfra(this)">update</button>
 
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

                                    <h4 class="m-t-0 header-title"><b>Infrastructure Details Table</b></h4>
                                    

                                    <table id="datatable-keytable"
                                           class="table table-striped  table-colored table-info dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th>s.no</th>
                                            <th>name</th>
                                            <th>image</th>
                                            <th>desc</th>
                                            <th>operations</th>
                                            <th>delete</th>
                                            
                                            
                                        </tr>
                                        </thead>
                                        <tbody id="databody">
                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

            <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/custom.js"></script>
            <script src="assets/js/JIC.js"></script>

        <script src="assets/js/angular.min.js"></script>
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
     <script>
function showLoading(){
document.getElementById("loading").style = "visibility: visible";
}
function hideLoading(){
document.getElementById("loading").style = "visibility: hidden";
}




</script>
        <script type="text/javascript">


              $('#image').bind('change', function () {
  var filename = $("#image").val();
  if (/^\s*$/.test(filename)) {
    $(".file-upload").removeClass('active');
    $("#filename").text("No file chosen..."); 
  }
  else {
    $(".file-upload").addClass('active');
    $("#filename").text(filename.replace("C:\\fakepath\\", "")); 
  }
});

          document.getElementById('image').onchange=function(evt){
            var tgt =evt.target || window.event.srcElement,
            files=tgt.files;
            if (FileReader && files && files.length) {
                var fr=new FileReader();
                fr.onload=function(){
                    document.getElementById('imgpreview').src=fr.result;

                }
                fr.readAsDataURL(files[0]);
                          // fr.readAsDataURL(files[0]);

            }
            else{
                alert('please browse a logo');  
            }
          }

           $('#update').hide();

        function addInfra(obj) {
            $("#fileuploader").uploadFile({
   
    });
            if (($('#iname').val()=='')) {
                alert('please enter a name');
            }
            else if($('#idesc').val()==''){
                  alert('please enter a desc');
            } 
            else if(document.getElementById('image').files.length==0)
            {
                alert('please browse a logo' );
            }else{
                var formData=new FormData();
                formData.append("op","addInfra");
                formData.append("iname",$('#iname').val());
                formData.append("idesc",$('#idesc').val());
                formData.append("image" ,document.getElementById('image').files[0]);
                // swal({
                //     title:'add Infrastructure',
                //     text: 'infra name :' +$('#iname').val(),
                //     type:"info",showCancelButton:true,
                //     closeOnConfirm:false,
                //     showLoaderOnConfirm:true,
                // },
                // function(){
                  $.ajax({

                     url:'ajax/infrahandler.php',
                     type:'POST',
                     processData:false,
                     contentType:false,
                     async:false,
                     data:formData,

                     success:function(result){
                        //alert(result);
                        obj=JSON.parse(result);
                        if (obj.err==0) {
                            alert(obj.result);
                            $('#iname').val('');
                            $('#idesc').val('');
                            $('#imgpreview').attr('src','uploads/images.png');
                             $('#image').val('');
                             loadDataIntoTab();
                            }
                            else{
                                alert(obj.result);
                            }
                        }

                     })
                  }
                

                
        // );
        //     }
        
        }


        function loadDataIntoTab() {
             

             var formData=new FormData();
             formData.append("op","fetchInfra");
             $.ajax({
                url:'ajax/infrahandler.php',
                type: 'POST',
                processData:false,
                contentType:false,
                async:false,
                data:formData,
                success:function(result) {
                    //alert(result);
                    obj=JSON.parse(result);
                                                var code;

                    if (obj.err==0) {

                        var n;
                        for(n in obj.data){
                                                        code=code+'<tr>'+
                            '<td>'+(parseInt(n)+1)+'</td>'+
                            '<td> <img src=\" <?php echo 'uploads/infraimg/'; ?>'+obj.data[n].image+'?'+Math.random()+'\" width="120px" height="auto" > '+'</td>'+ 
                            '<td>'+obj.data[n].iname+'</td>'+
                            '<td>'+obj.data[n].idesc+'</td>'+


                            '<td>';
                            if (obj.data[n].status==0) {
                                code = code + '<button class ="btn btn-info waves-effect w-md waves-light "id="updateStatus" onclick="updateStatus(this);" data-id="'+obj.data[n].id+'" data-val="1" type="submit">Activate</button>';
                             }
                             else{
                                code =code+'<button class="btn btn-info waves-effect w-md waves-light" id="updateStatus" onclick="updateStatus(this)" data-id= "'+obj.data[n].id+'"  data-val="0" type="submit">deactivate</button> ';
                             }
                             code=code+'</td>'+
                             '<td>'+
                             '<button class="btn btn-info waves-effect w-md waves-light" id="edittable" onclick="edittable(this);" data-id="'+obj.data[n].id+'" type="submit">edit</button> &nbsp; &nbsp;'+
                               '<button class=" btn btn-info waves-effect w-md waves-light" id="deletetable" onclick="deletetable(this);" data-id="'+obj.data[n].id+'" type="submit">delete </button>'+
                               '</td>'+
                               '</tr>';

                        }
                    } else{
                        alert(obj.result);
                    }
                    $('#databody').empty();
                    $('#databody').html(code);
                }
             });
        }
    loadDataIntoTab();

    function edittable(obj){

        var formData=new FormData();
        formData.append("op","editInfra");
        formData.append("id",$(obj).attr('data-id') );
        console.log($(obj).attr('data-id'));
        $.ajax({

            url:'ajax/infrahandler.php',
            type:'POST',
            processData:false,
            contentType:false,
            async:false,
            data:formData,
            success:function(result) {
                alert(result);
                obj=JSON.parse(result);
                if (obj.err==0) {

                    $('#iname').val(obj.iname);
                    $('#idesc').val(obj.idesc);
                $('#filename').val(obj.image);
                console.log( $('#filename').val(obj.image));

                    $('#imgpreview').val(obj.image);
                    $('#iid').val(obj.id);
                    $('#iname').focus();
                 $('#update').show();
                $('#action').hide();

                    $('#imgpreview').attr('src', '<?php echo 'uploads/infraimg/'; ?>'+obj.image);

                }
            }
        });
    }
    // function updateinfra(obj) {

        
    //     if (($('#iname').val()=='')) {
    //         alert('name is required');
    //     }else if($('#idesc').val()==''){
    //         alert('desc is reqiured');
    //     }else if($('#image').val()==''){
    //        alert('image is required');
    //     }
    //     else{
    //         var formData= new FormData();    
    //         formData.append("op","updateInfra");
    //         formData.append("iname",$('#iname').val());
    //         formData.append("idesc",$('#idesc').val());
    //         formData.append("id" ,$('#iid').val());
    //         formData.append("image",document.getElementById("image").files[0]);

    //         $.ajax({
    //             url:"ajax/infrahandler.php",
    //             type:'POST',
    //             processData:false,
    //             contentType:false,
    //             async:false,
    //             data:formData,
    //             success:function (result) {
    //                 obj=JSON.parse(result);
    //                 if (obj.err==0) {
    //                  alert(result);

    //                     loadDataIntoTab();
    //                     $('#iname').val('');
    //                     $('#idesc').val('');
    //                      $('#action').show();
    //                       $('#update').hide();
    //                     $('#image').val('');
                       
    //                 }else{
    //                    alert(obj.result);
    //                 }
    //             }


    //         });
    //     }
    // }

 function updateinfra(obj){
      if ($('#iname').val() == '') {
          alert("Name is required");        
      }else if($('#idesc').val() == '') {
          alert("Name is required");                  
      }else if ($('#image').val() == '') {
          alert("Browse a logo please" );                
      }else{
          var formData = new FormData();
          formData.append("op","updateinfras");
          formData.append("iname",$('#iname').val());

          formData.append("idesc",$('#idesc').val());

          formData.append("id",$('#iid').val());
        console.log($('#iid').val());

          // if ($('#imgpreview').attr('src').indexOf('data:image/') != -1) {
            formData.append("image",document.getElementById("image").files[0]); // ithula tan img ah key:image la set pannuren..
          //   console.log('browsed');
          // }
        
              $.ajax({
                  url : 'ajax/infrahandler.php',
                  type : 'POST',
                  processData: false,
                  contentType: false,
                  async : false,
                  data :formData,
                  success:function(result)
                  {
                      obj = JSON.parse(result);
                      if(obj.err==0)
                      {
                        alert(obj.result);
                          // setTimeout(function(){ swal(obj.result),1000});
                          loadDataIntoTab();
                          // Materialize.toast(obj.result, 4000);
                          $('#iname').val('');
                          $('#idesc').val('');
                          $('#action').show();
                          $('#update').hide();
                           $('#imgpreview').attr('src','uploads/demoimage.png');

                          $('#image').val('');
                      }else{
// setTimeout(function(){ swal(obj.result),1000});                      }
alert(obj.result);
                  }
              }
              });
                 //setTimeout(function(){        }, 2000); 
           }
      
    }


function deletetable(obj){
    var formData = new FormData();
    formData.append("op","deleteInfra");
    formData.append("id",$(obj).attr('data-id'));
    // console.log($(obj).attr('data-id'));
    $.ajax({
        url:'ajax/infrahandler.php',
        type:'POST',
        processData:false,
        contentType:false,
        async:false,
        data:formData,
        success:function(result) {
            obj = JSON.parse(result);
            alert(obj.result);
            loadDataIntoTab();
        }
    })
}

function updateStatus(obj) {
    var formData=new FormData();
    formData.append("op","updateInfraStatus");
    formData.append("id",$(obj).attr('data-id'));
    formData.append("status",$(obj).attr('data-val'));
    $.ajax({
        url:'ajax/infrahandler.php',
        type:'POST',
        processData:false,
        contentType:false,
        async:false,    
        data:formData,
        success:function (result) {
             alert(result);
             obj= JSON.parse(result);
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