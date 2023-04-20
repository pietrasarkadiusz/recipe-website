<div class="card-group justify-content-center">

	<table class="table table-striped table-hover">
		<tr><th></th><th>Measurement Name</th>
			<th>
				
			</th>
		</tr>
		<?php $test='';?>
		<?php if(isset($measurements) && $measurements):?>
			 
			<?php foreach ($measurements as $measurement):?>
			 <?php $test=$measurement;?>
			 <tr>
			 	<td>
			 	</td>
			 	<td class="col-9"><?=$measurement->getName()?></td>

			 	<td>
			 		<?php if(Auth::access('super_admin') || Auth::access('admin')):?>
				 		<a href="<?=ROOT?>/measurements/edit/<?=$measurement->getId()?>">
				 			<button class="btn-sm btn btn-info text-white"><i class="bi bi-pen-fill"></i></button>
				 		</a>

				 		<a href="<?=ROOT?>/measurements/delete/<?=$measurement->getId()?>">
				 			<button class="btn-sm btn btn-danger"><i class="bi bi-trash-fill"></i></button>
				 		</a>
				 	<?php endif;?>
			 	</td>

			 </tr>

 			<?php endforeach;?>
			<?php else:?>
				<tr><td colspan="5"><center>No measurements were.</center></td></tr>
			<?php endif;?>

	</table>
</div>