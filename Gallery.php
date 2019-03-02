<?php 

include 'header.php';

 ?>
<body >
<nav aria-label="breadcrumb" >
	<ol class="breadcrumb text-uppercase" >
		<h2 class="h2-responsive ml-5  mt-4 font-weight-bold">
		Gallery
		</h2> 
		<li class="  breadcrumb-item ml-auto">
			Home
		</li>
		<li class="breadcrumb-item">
			gallery
		</li>
          	  	
	</ol>
	
</nav>




<div class="container my-5"> 
	<h2 class="h2-responsive  font-weight-bold text-uppercase text-center">our <span class="text-span"> gallery</span></h2>
<p class="h6-responsive desc mx-auto text-center"> Galleries are the wonderful memories to kept up with in to  make the students  to more appreciative  and innovative </p>

	<div class="row my-5">

		<?php 

require 'control/db_config.php';
$query=mysqli_query($db,"SELECT  * FROM galcat WHERE status=1");
                    if (mysqli_num_rows($query) != 0) {

                     while ($res=mysqli_fetch_array($query)) {
                     



		 ?>
		<div class="col-lg-4  col-md-4">
			<div class=" overlay rounded z-depth-2">
				
			<img src="<?php echo'control/uploads/galcatimage/'.$res['image']; ?>"  style="width:100%; height:230px;" class="img-fluid" >
			<a>
				<div class="mask rgba-white-slight"></div>
			</a>

			</div>
			<div class="card-body text-center">
				<h4 class="h4-responsive font-weight-bold" >
					       
	<!--   <?php 
          ?> -->
				<?php echo $res['galname'] ?></h4>
				<p class="black-text"><?php  echo $res['galdesc']; ?></p>
				<a class="btn btn-primary btn-md" href="gallery_items.php?id=<?php echo  $res['gid'];   ?>">view more</a>

			</div>
		</div>
	<?php }} ?>

		<!-- <div class="col-lg-4  col-md-4">
         <div class=" overlay  rounded z-depth-2">
         	<img src="img/images/sam.png" style="width:100%; height:230px;" class="img-fluid">
         	<a>
         		<div class="mask rgba-white-slight"></div>
         	</a>
         </div>
         <div class="card-body text-center">
         	<h4 class="h4-responsive font-weight-bold   mb-3">
         		event 1
         	</h4>
         	<p class="black-text">dsfasdgsdgsdfgfdgdfgdfgdfgdsfgsddf</p>
              <a class="btn btn-primary  btn-md " href="gallery_items.php">  view more</a>

         </div>
           
		 </div>



<div class="col-lg-4  col-md-4">
	<div class=" overlay rounded z-depth-2">
		<img src="img/images/graph.png" style="width:100%; height:230px;" class="img-fluid">
		<a >
			<div class="mask rgba-white-slight"></div>
		</a>
	</div>
	<div class="card-body text-center">
		<h4 class="h4-responsive font-weight-bold">
			dsf,dfjdsl
		</h4>
		<p >dsgndfgjdhfkjgh jdf</p>
		<a class="btn btn-primary btn-md" href="gallery_items.php">view more</a>
	</div>
</div>


<div class="col-lg-4  col-md-4 ">
	<div class=" overlay rounded z-depth-2">
		<img src="img/images/am.jpg" style="width: 100%; height: 230px;" class="img-fluid">
	</div>
		<div class="card-body text-center pb-0 ">
			<h4 class="h4-responsive">
				fdsfdsf
			</h4>
			<p>dskjldfghdfshgkjbmdh</p>
			<a class="btn btn-primary btn-md" href="gallery_items.php">view more</a>
		</div>
	</div>

 


 <div class="col-lg-4  col-md-4">
 	<div class=" overlay rounded z-depth-2">

    <img src="img/images/webimage.gif" style="width: 100%; height: 230px;" class="img-fluid">

 	 </div>


        <div class="card-body text-center ">
        	<h4 class="h4-responsive">dfdmfdfdfds</h4>
        	<p class="black-text">gfdgdfgdsfs</p>
        	<a class="btn-primary btn btn-md" href="gallery_items.php">view more</a>
        </div> 	 
 </div>


 <div class="col-lg-4  col-md-4">
 	<div class=" overlay rounded z-depth-2 ">
 		<a>
 			<img src="img/images/di.png" style="width: 100%;  height: 230px;" class="img-fluid">
 		</a>
 		</div>
 		<div class="card-body text-center">
 			<h4 class="h4-responsive">class</h4>
 			<p class="black-text">ndkfngdfjk</p>
 			<a class=" btn-primary btn btn-md" href="gallery_items.php">view more</a>
 		</div>
 	
 	
 </div>
	<div class="card-body text-center">
		 	<h4 class="h4-responsive font-weight-bold"> ffdfnsdfnsdjf,sd</h4>
		 	<p class="black-text">dgfdgfdgd</p>
		 	<a class="btn btn-primary" href="gallery_items.php">view more</a>
		 </div>-->
	</div>
</div>
	
<?php include 'footer.php'; ?>