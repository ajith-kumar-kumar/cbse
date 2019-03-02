<?php include 'header.php'; ?>


<nav >
	<ol class="breadcrumb text-uppercase">
		<h2 class="h2-responsive ml-5 mt-4 font-weight-bold">
			infrastructure
		</h2>
		<li class="breadcrumb-item ml-auto">home</li>
		<li class="breadcrumb-item ">infrastructure</li>
	</ol>
</nav>

<div class="container">
	<h2 class="h2-responsive text-center font-weight-bold text-uppercase my-5">our infrastructure and    <span class="text-span">facilities</span></h2>
	<p class="mx-auto text-center desc ">
SAKIVS  has necessary infrastructure with modern facilities and environment which include, spacious classrooms, laboratories, library and sports facilities. Our team of dedicated, motivated, experienced and well-qualified teachers render their tireless service</p>



 <div class="row">
<?php 

require 'control/db_config.php';
$query="SELECT * FROM  infra WHERE status ='1'";
$query=mysqli_query($db,$query);
if (mysqli_num_rows($query) !=0 ) {
  while ($res=mysqli_fetch_array($query)) {
      

?>
<div class="col-lg-4 my-5" >
  <div class="card">
    <div class="view overlay">
      <img src= "<?php echo 'control/uploads/infraimg/'.$res['infra_image'] ?>" class="img-fluid card-img-top img-resp" alt="canteen">
      <div class="mask flex-center rgba-red-strong">
       <p class="white-text m-3"><?php echo $res['infra_desc']; ?>.</p>
       </div>
    </div>
    <div class="card-body">
      <h4 class="card-title text-center "><?php echo $res['infra_name']; ?></h4>
    </div>
</div>
<!-- Card -->
  </div>
  <?php  }
}?>

  <!-- <div class="col-lg-4 my-5" >
  <div class="card">
    <div class="view overlay">
      <img src= "img/creative.jpg" class="img-fluid card-img-top img-resp" alt="canteen">
      <div class="mask flex-center rgba-red-strong">
       <p class="white-text m-3">Creativity makes the thing better.brain twisty games are more powerfuly games.its boost up our children brain with creativity</p>
       </div>
    </div>
    <div class="card-body">
      <h4 class="card-title text-center ">Fun Games</h4>
    </div>
</div>
  </div>
    <div class="col-lg-4 my-5">
<div class="card">

  <div class="view overlay">
    <img class="card-img-top img-resp img-fluid" src="img/yoga.jpg " alt="yoga image">
    <div class="mask flex-center rgba-red-strong">
        <p class="white-text ml-2 ">As a sound mind can only be in a sound body regular physical training classes are conducted by qualified physical instructors. The students are also trained in various games and sports and are encouraged to participate in various games and athletic events conducted in the city</p>
    </div>
  </div>
  <div class="card-body">
    <h4 class="card-title text-center">Yoga class</h4>
  </div>
</div>

</div>
 <div class="col-lg-4 my-5">
<div class="card">

  <div class="view overlay">
    <img class="card-img-top img-resp img-fluid" src="img/library.png" alt="library">
    <div class="mask flex-center rgba-red-strong">
        <p class="white-text ml-2 ">A well stocked library is attached to the school with a good number of magazines and periodicals. A full time librarian is available. The student can approach for books, periodicals and newspapers and also allowed to borrow books regularly.</p>
    </div>
  </div>
  <div class="card-body">
    <h4 class="card-title text-center">Library</h4>
  </div>
</div>

</div>
 <div class="col-lg-4 my-5">
<div class="card">

  <div class="view overlay">
    <img class="card-img-top img-resp img-fluid" src="img/s-lab.jpg" alt="Card image cap">
    <div class="mask flex-center rgba-red-strong">
        <p class="white-text ml-3">The physics, chemistry and biology labs are well equipped. Each child is given an individual place to do or try the experiment.</p>
    </div>
  </div>
  <div class="card-body">
    <h4 class="card-title text-center">Science lab</h4>
  </div>
</div>

</div>
 <div class="col-lg-4 my-5">
<div class="card">

  <div class="view overlay">
    <img class="card-img-top img-resp img-fluid" src="img/bus.jpg" alt="Card image cap">
    <div class="mask flex-center rgba-red-strong">
        <p class="white-text m-3">The school operates buses and vans and pick up children from various points in the city. A detailed information about our pickup points are given here.</p>
    </div>
  </div>
  <div class="card-body">
    <h4 class="card-title text-center">Transport
</h4>
  </div>
</div>

</div>
 <div class="col-lg-4 my-5">
<div class="card">

  <div class="view overlay">
    <img class="card-img-top img-resp img-fluid" src="img/c_lab.jpg" alt="Computer lab">
    <div class="mask flex-center rgba-red-strong">
        <p class="white-text ml-3">A well equipped science laboratory with trained teachers is available for practical demonstration of various experiments, A well equipped computer room with sufficient terminals provide training on computer for classes I to X std. Various audio visual equipments are also available for interactive training to kindergarten kids.</p>
    </div>
  </div>
  <div class="card-body">
    <h4 class="card-title text-center">computer lab</h4>
  </div>
</div>

</div>


<div class="col-lg-4 my-5" >
  <div class="card">
    <div class="view overlay">
      <img src= "img/canteen.jpg" class="img-fluid card-img-top img-resp" alt="canteen">
      <div class="mask flex-center rgba-red-strong">
       <p class="white-text m-3">Nutritious wholesome brunch and lunch is provided by the school canteen at nominal rates.</p>
       </div>
    </div>
    <div class="card-body">
      <h4 class="card-title text-center ">Canteen</h4>
    </div>
</div>
  </div>
   -->
</div>  
</div>
<?php include 'footer.php'; ?>