<div class="card-group justify-content-center">

	<table class="table table-striped table-hover">
		<tr><th></th><th>Category Name</th>
			<th>
				
			</th>
		</tr>
		<?php if(isset($categories) && $categories):?>

			<?php foreach ($categories as $category):?>
			 
			 <tr>
			 	<td>
			 	</td>
			 	<td class="col-9"><?=$category->getName()?></td>

			 	<td>
			 		<?php if(Auth::access('super_admin') || Auth::access('admin')):?>
				 		<a href="<?=ROOT?>/categories/edit/<?=$category->getId()?>">
				 			<button class="btn-sm btn btn-info text-white"><i class="bi bi-pen-fill"></i></button>
				 		</a>

				 		<a href="<?=ROOT?>/categories/delete/<?=$category->getId()?>">
				 			<button class="btn-sm btn btn-danger"><i class="bi bi-trash-fill"></i></button>
				 		</a>
				 	<?php endif;?>
			 	</td>

			 </tr>

 			<?php endforeach;?>
			<?php else:?>
				<tr><td colspan="5"><center>No categories were found.</center></td></tr>
			<?php endif;?>

	</table>
</div>