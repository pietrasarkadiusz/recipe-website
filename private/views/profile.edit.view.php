<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>

<div class="container-fluid p-4 mt-5 shadow mx-auto" style="max-width: 1000px;">
    <center>
        <h4>Edit Profile</h4>
    </center>
    <?php if($user):?>
    <?php
 		$image = get_image($user->getImage(),'profile');
 	?>

    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <img src="<?=$image?>" class="border d-block mx-auto" style="width:150px;">
                <br>
                <?php if(Auth::i_own_content($user->getId())):?>
                <div class="text-center">
                    <label for="image_browser" class="btn-sm btn btn-info text-white">
                        <input onchange="display_image_name(this.files[0].name)" id="image_browser" type="file"
                            name="image" style="display: none;">
                        Browse Image
                    </label>
                    <br>
                    <small class="file_info text-muted"></small>
                </div>
                <?php endif;?>
            </div>
            <div class="col-sm-8 col-md-9 bg-light p-2">
                <div class="p-4 mx-auto mr-4 shadow rounded">

                    <?php if(count($errors) > 0):?>
                    <div class="alert alert-warning alert-dismissible fade show p-1" role="alert">
                        <strong>Errors:</strong>
                        <?php foreach($errors as $error):?>
                        <br><?=$error?>
                        <?php endforeach;?>
                        <span type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </span>
                    </div>
                    <?php endif;?>

                    <input class="my-2 form-control" value="<?=get_var('firstname',$user->getFirstName())?>" type="firstname"
                        name="firstname" placeholder="First Name">
                    <input class="my-2 form-control" value="<?=get_var('lastname',$user->getLastName())?>" type="lastname"
                        name="lastname" placeholder="Last Name">
                    <input class="my-2 form-control" value="<?=get_var('email',$user->getEmail())?>" type="email" name="email"
                        placeholder="Email">

                    <select class="my-2 form-control" name="permission">
                        <option <?=check_select('permission',$user->getPermission())?> value="<?=$user->getPermission()?>">
                            <?=ucwords($user->getPermission())?></option>
                        <option <?=check_select('permission','user')?> value="user">User</option>

                        <?php if(Auth::access('admin')):?>
                        <option <?=check_select('permission','admin')?> value="admin">Admin</option>
                        <option <?=check_select('permission','super_admin')?> value="super_admin">Super Admin</option>
                        <?php endif;?>

                    </select>

                    <input class="my-2 form-control" value="<?=get_var('password')?>" type="password" name="password"
                        placeholder="Password">
                    <input class="my-2 form-control" value="<?=get_var('repeatedPassword')?>" type="password" name="repeatedPassword"
                        placeholder="RepeatPassword">
                    <br>
                    <button class="btn btn-primary float-end">Save Changes</button>

                    <a href="<?=ROOT?>/profile/<?=$user->getId()?>">
                        <button type="button" class="btn btn-danger">Back to profile</button>
                    </a>

                </div>
            </div>
        </div>
    </form>
    <br>

    <?php else:?>
    <center>
        <h4>That profile was not found.</h4>
    </center>
    <?php endif;?>

</div>
<script>
function display_image_name(file_name) {
    document.querySelector(".file_info").innerHTML = '<b>Selected file:</b><br>' + file_name;
}
</script>
<?php $this->view('includes/footer')?>