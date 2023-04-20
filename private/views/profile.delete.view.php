<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>
<div class="container-fluid p-4 mt-5 shadow mx-auto" style="max-width: 1000px;">
    <?php if($user):?>
    <div class="card-group justify-content-center">
        <form method="post">
            <h3>Are you sure you want to delete this user?!</h3>
            <input disabled autofocus class="form-control" value="<?=$user->getFirstName()?>" type="text"
                name="class" placeholder="Recipe Name"><br>
            <input type="hidden" name="id">
            <input class="btn btn-danger float-end" type="submit" value="Delete">
            <a href="<?=ROOT?>/profile/<?=$user->getId()?>">
                <input class="btn btn-success" type="button" value="Cancel">
            </a>
        </form>
    </div>
    <?php else: ?>
    <div style="text-align: center;">
        <h3>That user was not found.</h3>
        <div class="clearfix"></div>
        <br><br>
        <a href="<?=ROOT?>/profile/<?=$user->getId()?>">
            <input class="btn btn-danger" type="button" value="Cancel">
        </a>
    </div>
    <?php endif; ?>
</div>
<?php $this->view('includes/footer')?>