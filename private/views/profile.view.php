<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>

<div class="container-fluid p-4 mt-5 shadow mx-auto" style="max-width: 1200px;">

    <?php if($user):?>

    <?php
 			$image = get_image($user->getImage(),'profile');
 		?>

    <div class="row">
        <div class="col">
            <img src="<?=$image?>" class="border border-dark d-block mx-auto rounded-circle " style="width:150px;height:150px;">
            <h3 class="text-center"><?=$user->getFullName()?></h3>
            <br>
            <?php if(Auth::i_own_content($user->getId())):?>
            <div class="text-center">
                <a href="<?=ROOT?>/profile/edit/<?=$user->getId()?>">
                    <button class="btn-sm btn btn-success">Edit</button>
                </a>
                <a href="<?=ROOT?>/profile/delete/<?=$user->getId()?>">
                    <button class="btn-sm btn btn-danger">Delete</button>
                </a>
            </div>
            <?php endif;?>
        </div>
        <div class="col bg-light p-2">
            <table class="table table-hover table-striped table-bordered">
                <tr>
                    <th>First Name:</th>
                    <td><?=$user->getFirstName()?></td>
                </tr>
                <tr>
                    <th>Last Name:</th>
                    <td><?=$user->getLastName()?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?=$user->getEmail()?></td>
                </tr>
                <tr>
                    <th>Permission:</th>
                    <td><?=ucwords(str_replace("_"," ",$user->getPermission()))?></td>
                </tr>
                <tr>
                    <th>Date Created:</th>
                    <td><?=get_date($user->getDate())?></td>
                </tr>

            </table>
        </div>
    </div>
    <br>
    <div class="card-group justify-content-center">
        <?php //include(views_path('recipe'))?>
        <?php if($recipes):?>
        <?php foreach ($recipes as $recipe):?>
        <?php include(views_path('recipe'))?>
        <?php endforeach;?>
        <?php else:?>
        <h4>No recipes were found.</h4>
        <?php endif;?>
    </div>
    <?php else:?>
    <center>
        <h4>That profile was not found.</h4>
    </center>
    <?php endif;?>
</div>

</div>

<?php $this->view('includes/footer')?>