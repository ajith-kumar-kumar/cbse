<?php  
 include 'header.php';
require 'control/db_config.php';

 ?>


<head>
	<style type="text/css">
		.gallery-block{
  padding-bottom: 60px;
  padding-top: 60px;
}

.gallery-block .heading{
    margin-bottom: 50px;
    text-align: center;
}

.gallery-block .heading h2{
    font-weight: bold;
    font-size: 1.4rem;
    text-transform: uppercase;
}

.gallery-block.compact-gallery .item{
  overflow: hidden;
  margin-bottom: 0;
  background: black;
  opacity: 1;
     margin-bottom: 30px;
    margin-left: 70px;
}

.gallery-block.compact-gallery .item .image{
  transition: 0.8s ease;
}

.gallery-block.compact-gallery .item .info{
  position: relative;
    display: inline-block;
}

.gallery-block.compact-gallery .item .description{
  display: grid;
    position: absolute;
    bottom: 0;
    left: 0;
    color: #fff;
    padding: 10px;
    font-size: 17px;
    line-height: 18px;
    width: 100%;
    padding-top: 15px;
    padding-bottom: 15px;
    opacity: 1;
    color: #fff;
    transition: 0.8s ease;
    text-align: center;
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);
    background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.39));
}

.gallery-block.compact-gallery .item .description .description-heading{
  font-size: 1em;
  font-weight: bold;
}

.gallery-block.compact-gallery .item .description .description-body{
  font-size: 0.8em;
  margin-top: 10px;
  font-weight: 300;
}

@media (min-width: 576px) {




  .gallery-block.compact-gallery .item .description {
    opacity: 0; 
  }

  .gallery-block.compact-gallery .item a:hover .description {
    opacity: 1; 
  } 

  .gallery-block .zoom-on-hover:hover .image {
    transform: scale(1.3);
    opacity: 0.7; 
  }
}


@media (max-width: 786px)
{
	.gallery-block.compact-gallery .item
{
	margin-left: -1px;
}

}

@media (min-width: 700px) and (max-width: 865px)
{
	.gallery-block.compact-gallery .item
{
	margin-left: 30px;
}

}

	</style>
</head>
<body class="body-content-background">
<nav aria-label="breadcrumb" >
	<ol class="breadcrumb text-uppercase">
		<h2 class="h2-responsive ml-5 mt-4 font-weight-bold">recent clicks </h2>

	</ol>
	
</nav>



<section class="gallery-block compact-gallery">
    		               <div class="container-fluid">    
        		    		<div class="row no-gutters">

                                <?php 

                                        // print_r($_SESSION['gid']);
                                   $query="SELECT galcat.galname, gallery.image,gallery.gcat FROM  galcat INNER JOIN gallery ON galcat.galname=gallery.gcat AND galcat.gid= '".$_GET['id']."'";
 
                                // $query=" SELECT * FROM `gallery` WHERE status='1' AND  ";
                                     $query=mysqli_query($db,$query);
                                     if (mysqli_num_rows($query) != 0 ) {   
                                        while ($res=mysqli_fetch_array($query)) {
                                
                                 ?>
    			<div class=" col-lg-3 col-md-5  item zoom-on-hover">
    				<a class="lightbox" href="<?php echo 'control/uploads/galimage/'.$res['image']; ?>">
    					<img class="img-fluid image img-resp " src="<?php echo 'control/uploads/galimage/'.$res['image']; ?>">
    					<!-- <span class="description">
    						<span class="description-heading">Lorem Ipsum</span>
    						<span class="description-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
    					</span> -->
    				</a>
    			</div>
    			<?php  }}else{
                    echo '404 error';
                } ?>
    			
    		 	<div class=" col-lg-3 col-md-5	  item zoom-on-hover">
    				<a class="lightbox" href="img/f2.jpg">
    					<img class="img-fluid image img-resp" src="img/F2.jpg">
    					<span class="description">
    						<span class="description-heading">Lorem Ipsum</span>
    						<span class="description-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
    					</span>
    				</a>
    			</div>
    			
    			
    			<div class=" col-lg-3 col-md-5	 item zoom-on-hover">
    				<a class="lightbox" href="img/F3.jpg">
    					<img class="img-fluid image img-resp" src="img/F3.jpg">
    					<span class="description">
    						<span class="description-heading">Lorem Ipsum</span>
    						<span class="description-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
    					</span>
    				</a>
    			</div>
    			
    			<div class=" col-lg-3 col-md-5	 item zoom-on-hover">
    				<a class="lightbox" href="img/F4.jpg">
    					<img class="img-fluid image img-resp" src="img/F4.jpg">
    					<span class="description">
    						<span class="description-heading">Lorem Ipsum</span>
    						<span class="description-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
    					</span>
    				</a>
    			</div>
    			
    			
    			<div class=" col-lg-3 col-md-5	 item zoom-on-hover">
    				<a class="lightbox" href="img/F5.jpg">
    					<img class="img-fluid image img-resp" src="img/F5.jpg">
    					<span class="description">
    						<span class="description-heading">Lorem Ipsum</span>
    						<span class="description-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
    					</span>
    				</a>
    			</div>
    			
    			
    			<div class=" col-lg-3 col-md-5	 item zoom-on-hover">
    				<a class="lightbox" href="img/F6.jpg">
    					<img class="img-fluid image img-resp" src="img/F6.jpg">
    					<span class="description">
    						<span class="description-heading">Lorem Ipsum</span>
    						<span class="description-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
    					</span>
    				</a>
    			</div>
    			
    			<div class=" col-lg-3 col-md-5	 item zoom-on-hover">
    				<a class="lightbox" href="img/F7.jpg">
    					<img class="img-fluid image img-resp" src="img/F7.jpg">
    					<span class="description">
    						<span class="description-heading">Lorem Ipsum</span>
    						<span class="description-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
    					</span>
    				</a>
    			</div>
    			
    			<div class=" col-lg-3 col-md-5	 item zoom-on-hover">
    				<a class="lightbox" href="img/F8.jpg">
    					<img class="img-fluid image img-resp" src="img/F8.jpg">
    					<span class="description">
    						<span class="description-heading">Lorem Ipsum</span>
    						<span class="description-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
    					</span>
    				</a>
    			</div>
    			
    			<div class=" col-lg-3 col-md-5	 item zoom-on-hover">
    				<a class="lightbox" href="img/F9.jpg">
    					<img class="img-fluid image img-resp" src="img/F9.jpg">
    					<span class="description">
    						<span class="description-heading">Lorem Ipsum</span>
    						<span class="description-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
    					</span>
    				</a>
    			</div> -->
</div>

    	</div>
    </section>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script>
	      baguetteBox.run('.compact-gallery',{animation:'slideIn'});
	  </script>

<?php include 'footer.php' ?>