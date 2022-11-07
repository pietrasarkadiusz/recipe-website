<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>

<div class="container-fluid p-4 mt-5 shadow mx-auto" style="max-width: 1000px;">

    <div class="card-group justify-content-center">

        <form method="post">
            <h3>Add New Category</h3>

            <?php if(count($errors) > 0):?>
            <div class="alert alert-danger alert-dismissible fade show my-2">
                <strong>Error!</strong>
                <?php foreach($errors as $error):?>
                <br><?=$error?>
                <?php endforeach;?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif;?>

            <input autofocus class="form-control" value="<?=get_var('class')?>" type="text" name="name"
                placeholder="Category Name"><br><br>
            <input class="btn btn-primary float-end" type="submit" value="Create">

            <a href="<?=ROOT?>/categories">
                <input class="btn btn-danger" type="button" value="Cancel">
            </a>
        </form>
    </div>

</div>

<?php $this->view('includes/footer')?>