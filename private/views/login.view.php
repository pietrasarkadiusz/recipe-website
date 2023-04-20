<?php $this->view('includes/header')?>

<div class="container-fluid">

    <div class="card justify-content-center p-4 mx-auto mr-4 shadow rounded" style="margin-top: 50px;width:100%;max-width: 340px;">
        <form method="post">
            <img src="<?=ROOT?>/assets/logo.png" class="border border-dark d-block mx-auto rounded-circle"
                style="width:100px;">
            <h3 class="text-center my-3">Login</h3>
            <?php if(count($errors) > 0):?>
            <div class="alert alert-danger alert-dismissible fade show my-2">
                <strong>Error!</strong>
                <?php foreach($errors as $error):?>
                <br><?=$error?>
                <?php endforeach;?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif;?>

            <input class="form-control" value="<?=get_var('email')?>" type="email" name="email" placeholder="Email"
                autofocus autocomplete="off" required>
            <br>
            <input class="form-control" value="<?=get_var('password')?>" type="password" name="password"
                placeholder="Password" required>
            <br>
            <input type="submit" class="btn btn-primary" value="Login">
        </form>
    </div>
</div>

<?php $this->view('includes/footer')?>