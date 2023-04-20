<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>
	
	<div class="container-fluid p-4 mt-5 shadow mx-auto" style="max-width: 1000px;">
		<?php if($category):?>
		<div class="card-group justify-content-center">
 

			 <form method="post">
			 	<h3>Are you sure you want to delete?!</h3>
				 <p>All recipes with this category will be removed!<p>
			 	<input disabled autofocus class="form-control" value="<?=$category->getName()?>" type="text" name="class" placeholder="Category Name"><br><br>
			 	<input type="hidden" name="id">
			 	<input class="btn btn-danger float-end" type="submit" value="Delete">
			 	<a href="<?=ROOT?>/categories">
			 		<input class="btn btn-success" type="button" value="Cancel">
			 	</a>
			 </form>
			
		</div>
		<?php else: ?>

			<div style="text-align: center;">
				<h3>That category was not found.</h3>
				<div class="clearfix"></div>
				<br><br>
				<a href="<?=ROOT?>/categories">
			 		<input class="btn btn-danger" type="button" value="Cancel">
			 	</a>
		 	</div>
		<?php endif; ?>

		
	 
	</div>
 
<?php $this->view('includes/footer')?>