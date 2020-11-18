<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/slider.php';?>
<?php
	$slider = new slider();

	if(isset($slider)){
		$show = $slider->show();
	}
	if(isset($_GET['sliderId'])){
		$sliderId = $_GET['sliderId'];
		$delete = $slider->delete($sliderId);
	}
?>
<?php
if(isset($_GET['sliderId']) && isset($_GET['type'])){
	$type = $_GET['type'];
	$sliderId = $_GET['sliderId'];
	$change = $slider->changeStatus($sliderId,$type);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
		<?php
		if(isset($change)){
			echo $change;
		}
		?>
		<?php
		if(isset($delete)){
			echo $delete;
		}
		?>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(isset($show)){
						$i=0;
						while($result = $show->fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i?></td>
					<td><?php echo $result['sliderName']?></td>
					<td class="center"><img src="uploads/<?php echo $result['image']?>" width="80px";></td>
					
					<td>
					<?php if($result['type']==1){
					?>
						<a href="?sliderId=<?php echo $result['sliderId'] ?>&type=0">On</a>
					<?php
					}else if($result['type']==0){
					?>
						<a href="?sliderId=<?php echo $result['sliderId'] ?>&type=1">Off</a>
					<?php
					}
					?>
					</td>		
					<td>
						<a href="?sliderId=<?php echo $result['sliderId']?>" onclick="return confirm('Are you sure to Delete!');" >Delete</a> 
					</td>
					</tr>	
					<?php
						}
					}
					?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
