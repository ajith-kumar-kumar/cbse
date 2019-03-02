<?php include 'header.php'; ?>


<nav aria-label="breadcrumb">
  <ol class="breadcrumb text-uppercase">
    <h2 class="h2-responsive ml-5 mt-4 font-weight-bold">
      events
    </h2>
    <li class="breadcrumb-item ml-auto">home</li>
    <li class="breadcrumb-item" >events</li>
  </ol>
</nav>





<div class="container">


  <!-- Section heading -->
  <h2 class="h1-responsive font-weight-bold text-center my-5">Upcoming <span class="text-span"> Events</span></h2>
  <!-- Section description -->
  <p class="text-center w-responsive mx-auto mb-5 desc"> OUR EVENTS ARE VERY INTERSTING   </p>  
  <div class="row">
     <?php  include 'control/db_config.php';
   $query=mysqli_query($db,"SELECT * FROM event WHERE status='1'");

        if (mysqli_num_rows($query) > 0) {
           while ($res=mysqli_fetch_array($query)) {
        
?>
    <div class="col-lg-6 my-5">
         
    
      <div class="card card-event" >

         
          <img src="<?php echo 'control/uploads/eventimage/'.$res['event_image'] ?>" class="img-fluid img-resp" alt="images">

      

      <div class="card-body">
        <h4 class="card-title text-center text-uppercase font-weight-bold "><?php echo $res['event_name']; ?></h4>
        <h6 class="text-center desc"><?php echo $res['event_desc']; ?></h6> 
        </div>

      </div>

    </div>
                       <?php } }?>


<!--     <div class="col-lg-6 my-5">
      <div class="card card-event" >
              
          <img src="img/annual1.jpg" class="img-fluid  img-resp " alt="images">

      

      <div class="card-body">
        <h4 class="card-title text-center text-uppercase font-weight-bold ">Annual day celebrations</h4>
        <h6 class="text-center desc">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</h6> 
        </div>
      </div>
    </div>
    <div class="col-lg-6 my-5">
      <div class="card card-event" >
              
          <img src="img/sports.jpg" class="img-fluid img-resp " alt="images">

      

      <div class="card-body">
        <h4 class="card-title text-center text-uppercase font-weight-bold ">sports day</h4>
        <h6 class="text-center desc">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</h6> 
        </div>
      </div>
    </div>
    <div class="col-lg-6 my-5">
      <div class="card card-event" >
              
          <img src="img/teachers.jpg" class="img-fluid img-resp " alt="images">

      

      <div class="card-body">
        <h4 class="card-title text-center text-uppercase font-weight-bold ">Teachers day</h4>
        <h6 class="text-center desc">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart..</h6> 
        </div>
      </div>
    </div><div class="col-lg-6 my-5">
      <div class="card card-event" >
              
          <img src="img/independence.jpg" class="img-fluid img-resp  " alt="images">

      

      <div class="card-body">
        <h4 class="card-title text-center text-uppercase font-weight-bold ">Independence day</h4>
        <h6 class="text-center desc">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</h6> 
        </div>
      </div>
    </div> -->
          


  </div>

</div>

<?php include 'footer.php'; ?> 