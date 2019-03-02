<?php include 'header.php'; ?>


<nav>
  
  <ol class="breadcrumb text-uppercase ">
    <h2 class="h2-responsive ml-5 mt-4 font-weight-bold">
      Activities
    </h2>
    <li class="breadcrumb-item ml-auto">home</li>
    <li class="breadcrumb-item">Activities</li>
  </ol>
</nav>

<!-- Section: Blog v.1 -->
<section class="my-5">
<div class="container"> <h2 class="h2-responsive text-center text-uppercase font-weight-bold my-5">our  <span class="text-span">Activities</span></h2>
  <p class="h6-responsive mx-auto text-center desc">reprehenderit in voluptate velit
    esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
    qui officia deserunt mollit anim id est laborum.</p>
  

 

  <!-- Grid row -->
  <div class="row">
<?php
                 require 'control/db_config.php';
              $query="SELECT * FROM  `activity` WHERE status='1'";
             $query= mysqli_query($db,$query);
              if (mysqli_num_rows($query)!= 0) {
                $res=mysqli_fetch_array($query);
                  
       ?>
    <!-- Grid column -->
    <div class="col-lg-5">

      <!-- Featured image -->
      <div class=" overlay rounded z-depth-2 mb-lg-0 mb-4">
        <img class="img-fluid img-resp" src="<?php echo 'control/uploads/activityimage/'. $res['active_image'] ?>" alt="Sample image">
        <a>
          <div class="mask rgba-white-slight"></div>
        </a>
      </div>

         
    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-lg-7 mt-4 ">

      <!-- Category -->
     
      <!-- Post title -->
      <h3 class="font-weight-bold mb-3"><strong><?php echo $res['active_name'] ?></strong></h3>
      <!-- Excerpt -->
      <p class="h6-responsive desc"><?php echo $res['active_desc']; ?></p>
     

    </div>
    <!-- Grid column -->
 
  </div>
  <!-- Grid row -->

  <hr class="my-5">

  <!-- Grid row -->
  <div class="row">

    <!-- Grid column -->
    <div class="col-lg-7">

      <!-- Category -->
     
      <!-- Post title -->
      <h3 class="font-weight-bold mb-3"><strong><?php echo $res['active_name']; ?></strong></h3>
      <!-- Excerpt -->
      <p class="h6-responsive desc"><?php echo $res['active_desc'];  ?></p>
      <!-- Post data -->
     

    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-lg-5">

      <!-- Featured image -->
      <div class=" overlay rounded z-depth-2">
        <img class="img-fluid img-resp" src="<?php echo 'control/uploads/activityimage/' .$res['active_image']?>" alt="Sample image"> 
        <a>
          <div class="mask rgba-white-slight"></div>
        </a>
      </div>

    </div>
    <!-- Grid column -->
<?php        
              }?>
  </div>
  <!-- Grid row -->

  <!-- <hr class="my-5">

  <div class="row">

    <div class="col-lg-5">

      <div class=" overlay rounded z-depth-2 mb-lg-0 mb-4">
        <img class="img-fluid img-resp" src="img/art.jpg" alt="Sample image">
        <a>
          <div class="mask rgba-white-slight"></div>
        </a>
      </div>

    </div>

    <div class="col-lg-7 mt-4">

     
      <h3 class="font-weight-bold mb-3"><strong>Art & Craft</strong></h3>
      <p class="h6-responsive desc">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur
        magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro qui dolorem ipsum quia sit amet.</p>
      
    </div>

  </div>
  <hr class="my-5">

  Grid row
  <div class="row">

    <div class="col-lg-7">

     
      <h3 class="font-weight-bold mb-3"><strong>Faculty Empowerment</strong></h3>
      <p class="h6-responsive desc">
The empowerment programme for teachers helps them to follow the best methods that facilitate efficient learning experience in the classroom. They are exposed to regular orientation and training programs to keep them updated in their respective disciplines.</p>
     

    </div>

    <div class="col-lg-5">

      <div class=" overlay rounded z-depth-2">
        <img class="img-fluid img-resp" src="img/faculty.jpg" alt="Sample image"> 
        <a>
          <div class="mask rgba-white-slight"></div>
        </a>
      </div>

    </div>

  </div>
</div> -->
</section>
<!-- Section: Blog v.1 -->



<?php include 'footer.php'; ?> 