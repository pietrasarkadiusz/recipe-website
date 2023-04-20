<?php $this->view('includes/header')?>
 
	<div class="container-fluid">

		<form method="post">
		<div class="p-4 mx-auto mr-4 mt-5 shadow rounded" style="margin-top: 50px;width:100%;max-width: 500px;">
			<img src="<?=ROOT?>/assets/logo.png" class="border border-dark d-block mx-auto rounded-circle" style="width:100px;">
			<?php if(count($errors) > 0):?>
				<div class="alert alert-danger alert-dismissible fade show my-2">
                    <strong>Error!</strong>
                    <?php foreach($errors as $error):?>
                    <br><?=$error?>
                    <?php endforeach;?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
			<?php endif;?>

			<input class="my-2 form-control" value="<?=get_var('firstname')?>" type="text" name="firstname" placeholder="First Name" required>
			<input class="my-2 form-control" value="<?=get_var('lastname')?>" type="text" name="lastname" placeholder="Last Name" required>
			<input class="my-2 form-control" value="<?=get_var('email')?>" type="email" name="email" placeholder="Email" required>
			
			<?php if(Auth::getPermission() == 'super_admin'):?>
				<select class="my-2 form-control" name="permission">
					<option <?=check_select('permission','user')?> value="user">User</option>
					<option <?=check_select('permission','admin')?> value="admin">Admin</option>
					<option <?=check_select('permission','super_admin')?> value="super_admin">Super Admin</option>
				</select>
			<?php endif;?>	

			<input class="my-2 form-control" value="<?=get_var('password')?>" type="password" name="password" placeholder="Password" required>
			<input class="my-2 form-control" value="<?=get_var('repeatedPassword')?>" type="password" name="repeatedPassword" placeholder="Repeat Password" required>
			<br>
			<button class="btn btn-primary float-end">Submit</button>
			<a href="<?=ROOT?>/home">
				<button type="button" class="btn btn-danger">Cancel</button>
			</a>
		</div>
		</form>
	</div>

<?php $this->view('includes/footer')?>