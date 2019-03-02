<?php include 'header.php'; ?>

<head>
	<style type="text/css">
		/***********************************************/
/***************** Accordion ********************/
/***********************************************/
@import url('https://fonts.googleapis.com/css?family=Tajawal');
@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

section{
	padding: 60px 0;
}

#accordion-style-1 h1,
#accordion-style-1 a{
    color:#007b5e;
}
#accordion-style-1 .btn-link {
    font-weight: 400;
    color: #007b5e;
    background-color: transparent;
    text-decoration: none !important;
    font-size: 16px;
    font-weight: bold;
	padding-left: 25px;
}

#accordion-style-1 .card-body {
    border-top: 2px solid #007b5e;
}

#accordion-style-1 .card-header .btn.collapsed .fa.main{
	display:none;
}

#accordion-style-1 .card-header .btn .fa.main{
	background: #007b5e;
    padding: 13px 11px;
    color: #ffffff;
    width: 35px;
    height: 41px;
    position: absolute;
    left: -1px;
    top: 10px;
    border-top-right-radius: 7px;
    border-bottom-right-radius: 7px;
	display:block;
}
	</style>
</head>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb text-uppercase" >
		<h2 class="h3-responsive ml-5 mt-4 font-weight-bold">FAQ</h2>
		<li class="breadcrumb-item ml-auto"> home</li>
		<li class="breadcrumb-item">Faq</li>
	</ol>
</nav>


<div class="container mt-5">
	<h2 class="h2-responsive text-center font-weight-bold ">frequently asked   <span class="text-span"> questions</span>
</h2>
<p class="h6-responsive desc"></p>
</div>

<!-- Accordion -->
    <div class="container-fluid bg-gray" id="accordion-style-1">
    	<div class="container">
    		<section>
    			<div class="row">
    				
    				<div class="col-md-12 col-lg-10 mx-auto">
    					<div class="accordion" id="accordionExample">
    						<div class="card">

                                <?php  
                                    require 'control/db_config.php';
                                $query="SELECT * FROM `faq` WHERE status='1'";
                                $query=mysqli_query($db,$query);
                                if (mysqli_num_rows($query)!=0 ) {
                                    while ($res=mysqli_fetch_array($query)) {
                                    
                                
                                             ?>
    							<div class="card-header" id='<?php echo $res['id'] ?>'>
    								<h5 class="mb-0">
    							<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?php echo $res['f_id'] ?>" aria-expanded="true" aria-controls="collapseOne">
    							  <i class="fa fa-angle-double-right mr-3"></i><?php  echo $res['f_ques']; ?> 
    							</button>
    						  </h5>
    							</div>
    
    							<div id="collapse<?php echo $res['f_id'] ?>" class="collapse  fade" aria-labelledby="headingOne" data-parent="#accordionExample">
    								<div class="card-body desc">
    									<?php echo  $res['f_ans']; ?>

    								</div>
    							</div>
                                  <?php   }
                                }?>

    						</div>
    				
 					</div>
    				</div>	
    			</div>
    		</section>
    	</div>
    </div>
    <!-- .// Accordion -->


<?php include  'footer.php' ?>