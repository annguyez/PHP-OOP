<?php
	include_once 'lib/database.php';
	include_once 'helpers/format.php';
	include_once 'classes/slider.php';
?>
<?php
	$slider = new slider();
	if(isset($slider)){
		$showHome = $slider->showHome();
	}
?>
	<div class="header_bottom">
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
					<?php
					if(isset($showHome)){
						while($result = $showHome->fetch_assoc()){
							
					?>
						<li><img src="admin/uploads/<?php echo $result['image']?>" alt=""/></li>
						<?php
						}
					}
						?>
				    </ul>
				  </div>
	      </section>
	   
	  <div class="clear"></div>
  </div>	