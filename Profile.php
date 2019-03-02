<?php require 'header.php'; ?>





<nav aria-label="breadcrumb"  >
  <ol class="breadcrumb text-uppercase">

	  <h2 class="h2-responsive   ml-5 mt-4 font-weight-bold" >Our Profile
	  </h2>
	  
                       

    	          <li class=" breadcrumb-item   ml-auto ">home</li>
        <li class="breadcrumb-item ">aboutus</li>

    </ol>
</nav>	

<section class="my-5">
	<div class="container">
		

		<div class="row">
			<div class="col-lg-8">
				<h2 class="h2-responsive font-weight-bold text-uppercase my-5">an   <span class="text-span"> introduction</span></h2>
				<p class="h6-responsive desc">Our school aims to provide all students with a multi-faceted, school-based curriculum, that will enable students to develop independent thinking skills, the ability to distinguish between right and wrong, a positive attitude towards life and a thirst for knowledge</p>
			</div>

			<div class="col-lg-4">
				<div class="container">
				<div class="row">
				<h2 class="h2-responsive font-weight-bold text-uppercase my-5" >our    <span class="text-span">founder</span></h2>
				<img src= "img/founder.jpg" class="img-fluid img-resp" alt="our founder image"> 
				</div>
			</div>
			</div>
		</div>
	</div>
	
</section>


<section class="my-5" >
	<div class="container text-center">
		
		<div class="row">
			<div class="col-lg-4 mb-5 ">
				<div class="bg ">
					            <i class="fa fa-2x fa-heart "></i>

					<h4 class="h4-responsive text-uppercase font-weight-bold ">OUR MISSION</h4>
					<p class="black1 desc ">We believe in working towards the common goal. </p>
				</div>
			</div>
			<div class="col-lg-4 mb-5">
				<div class="bg">
					            <i class="fa fa-2x fa-heart"></i>

					<h4 class="h4-responsive text-uppercase font-weight-bold ">OUR vision</h4>
					<p class="black1 desc">Striving for High standards in Education and Discipline. 

 </p>
				</div>
			</div>
			<div class="col-lg-4 mb-5">
				<div class="bg">
					            <i class="fa fa-2x fa-heart"></i>

					<h4 class="h4-responsive text-uppercase font-weight-bold ">OUR goal</h4>
					<p class="black1 desc ">We believe in working towards the common goal. </p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="my-5">
	<div class="container">
      <h2 class="h2-responsive text-center font-weight-bold text-uppercase">our   <span class="text-span"> correspondents </span></h2>
      <p class="text-center mx-auto desc">EDUComp is a fully responsive premium education theme for schools, colleges, insitutions and universities.</p>


       		 <div class="row">

<?php 
     require 'control/db_config.php';
	$query="SELECT * FROM `about` WHERE status='1'";
            $query=mysqli_query($db,$query);
            if (mysqli_num_rows($query) != 0) {
            	while ($res=mysqli_fetch_array($query)) {

	 ?>
<div class="col-lg-3">
	
 	<img src= "<?php echo 'control/uploads/aboutimage/'.$res['a_image'] ?>" class="img-fluid img-resp	 mb-3" alt="correspondents">
 	 <h4 class="h4-responsive text-center font-weight-bold text-capitalize"><?php echo $res['a_name']; ?></h4> 
 	<h6 class="h6-responsive text-center"> <?php  echo $res['a_desc']; ?></h6>

 </div>
            

<?php }} ?><s></s>
 	 <!-- 	<div class="col-lg-3">
<img src= "img/banner-1.jpg" class="img-fluid img-resp	 mb-3" alt="correspondents"> <h4 class="h4-responsive text-center text-capitalize">raguram</h4> 
<h6 class="h6-responsive text-center"> secretary</h6></div>
 	<div class="col-lg-3">
<img src= "img/banner-1.jpg" class="img-fluid img-resp	 mb-3" alt="correspondents"> <h4 class="h4-responsive text-center text-capitalize">raguram</h4> 
<h6 class="h6-responsive text-center"> secretary</h6></div>
 	<div class="col-lg-3"><img src= "img/banner-1.jpg" class="img-fluid img-resp	 mb-3" alt="correspondents"> <h4 class="h4-responsive text-center text-capitalize">raguram</h4> 
 		<h6 class="h6-responsive text-center"> secretary</h6>
</div> -->
 </div>
 </div>
</section>


	<?php include 'footer.php'; ?>