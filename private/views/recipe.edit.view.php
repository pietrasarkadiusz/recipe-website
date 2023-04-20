<?php $this->view('includes/header')?>
<?php $this->view('includes/nav')?>

<?php
 	$image = get_image($recipe->getImage());
?>

<div class="container-fluid">
    <div class="row mx-auto" style="max-width: 800px;">
        <form method="post" enctype="multipart/form-data">
            <div class="card p-4 mx-auto mr-4 mt-5 shadow rounded" style="width:100%;">
                <div class="row text-center">
                    <div class="col">
                        <img src="<?=$image?>" class="border d-block mx-auto" style="width:400px;">
                        <br>
                        <label for="image_browser" class="btn-sm btn btn-info text-white w-auto">
                            <input onchange="display_image_name(this.files[0].name)" id="image_browser" type="file"
                                name="image" style="display: none;">
                            Change Image
                        </label>
                        <br>
                        <small class="file_info text-muted"></small>
                    </div>
                </div>
                <?php if(count($errors) > 0):?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Error!</strong>
                    <?php foreach($errors as $error):?>
                    <br><?=$error?>
                    <?php endforeach;?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif;?>
                <div class="row">
                    <div class="col">
                        <input class="my-2 form-control" value="<?=get_var('name',$recipe->getName())?>" name="name"
                            placeholder="Recipe name...">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <textarea class="my-2 form-control" name="description"
                            placeholder="Recipe description..."><?=get_var('description',$recipe->getDescription())?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <label>Category</label>
                    </div>
                    <div class="col-6 py-2">
                        <select name="category_id" class="form-select" id="select_box">
                            <?php foreach($allCategories as $category):?>
                            <option value="<?=($category->getId())?>"
                                <?=check_select('category_id',$category->getId(),$recipe->getCategoryId())?>>
                                <?=($category->getName())?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <label>Difficulty</label>
                    </div>
                    <div class="col-6 py-2">
                        <select name="difficulty" class="form-select" id="select_box2">
                            <option <?=check_select('difficulty','Beginner',$recipe->getDifficulty())?>
                                value="Beginner">Beginner</option>
                            <option <?=check_select('difficulty','Intermediate',$recipe->getDifficulty())?>
                                value="Intermediate">Intermediate
                            </option>
                            <option <?=check_select('difficulty','Expert',$recipe->getDifficulty())?> value="Expert">
                                Expert</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <label>Servings</label>
                    </div>
                    <div class="col-6 py-2">
                        <input class="form-control" value="<?=get_var('servings',$recipe->getServings())?>"
                            type="number" min="1" name="servings" placeholder="Number of servings...">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <label>Preparation time</label>
                    </div>
                    <div class="col-6 py-2">
                        <input class="form-control" value="<?=get_var('prep_time',$recipe->getPrepTime())?>"
                            type="number" min="1" name="prep_time" placeholder="Preparation time in minutes...">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <label>Cooking time</label>
                    </div>
                    <div class="col-6 py-2">
                        <input class="form-control" value="<?=get_var('cook_time',$recipe->getCookTime())?>"
                            type="number" min="1" name="cook_time" placeholder="Cooking time in minutes...">
                    </div>

                </div>
            </div>
            <div class="card p-4 mx-auto shadow rounded" style="margin-top: 50px;width:100%;max-width: 800px;">
                <div class="card-title text-center">
                    <h4>Ingredients</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="sortable" style="border-collapse: separate; border-spacing:0 10px;">
                                <tbody id="tbIngredients">
                                    <?php if (!isset($_POST['quantities'])):?>
                                    <?php foreach ($quantities as $key => $quantity):?>
                                    <tr class="mt-3">
                                        <td>
                                            <input type="hidden" name="quantities[<?=$key?>][id]"
                                                value="<?=$quantity->getId()?>">
                                            <input type="number" min="0" step="any"
                                                value="<?=$quantity->getQuantity()?>" class="form-control"
                                                name="quantities[<?=$key?>][quantity]" placeholder="Quantity">
                                        </td>
                                        <td>
                                            <select name="quantities[<?=$key?>][measurement_id]" class="form-select"
                                                id="select_box2">
                                                <?php foreach($allMeasurements as $measurement):?>
                                                <option value="<?=($measurement->getId())?>"
                                                    <?=check_select_when_equal($measurements[$key]->getId(),$measurement->getId())?>>
                                                    <?=($measurement->getName())?>
                                                </option>
                                                <?php endforeach;?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="hidden" name="ingredients[<?=$key?>][id]"
                                                value="<?=$ingredients[$key]->getId()?>">
                                            <input type="text" class="form-control" name="ingredients[<?=$key?>][name]"
                                                placeholder="Ingredient name"
                                                value="<?=$ingredients[$key]->getName()?>">
                                        </td>
                                        <td><input type="text" class="form-control"
                                                name="ingredients[<?=$key?>][description]" placeholder="Description"
                                                value="<?=$ingredients[$key]->getDescription()?>">
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                    <?php else:?>
                                    <?php foreach ($_POST['quantities'] as $key => $quantity):?>
                                    <tr class="mt-3">
                                        <td>
                                            <input type="hidden" name="quantities[<?=$key?>][id]"
                                                value="<?=$quantity['id']?>">
                                            <input type="number" min="0" step="any" class="form-control"
                                                name="quantities[<?=$key?>][quantity]" placeholder="Quantity"
                                                value="<?=$quantity['quantity']?>">
                                        </td>
                                        <td>
                                            <select name="quantities[<?=$key?>][measurement_id]" class="form-select"
                                                id="select_box2">
                                                <?php foreach($allMeasurements as $measurement):?>
                                                <option value="<?=($measurement->getId())?>"
                                                    <?=check_select_when_equal($quantity['measurement_id'],$measurement->getId())?>>
                                                    <?=($measurement->getName())?>
                                                </option>
                                                <?php endforeach;?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="hidden" name="ingredients[<?=$key?>][id]"
                                                value="<?=$_POST['ingredients'][$key]['id']?>">
                                            <input type="text" class="form-control" name="ingredients[<?=$key?>][name]"
                                                placeholder="Ingredient name"
                                                value="<?=$_POST['ingredients'][$key]['name']?>">
                                        </td>
                                        <td><input type="text" class="form-control"
                                                name="ingredients[<?=$key?>][description]" placeholder="Description"
                                                value="<?=$_POST['ingredients'][$key]['description']?>">
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-4 mx-auto shadow rounded" style="margin-top: 50px;width:100%;max-width: 800px;">
                <div class="card-title text-center">
                    <h4>Preparation</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="sortable" class="col-12"
                                style="border-collapse: separate; border-spacing:0 10px;">
                                <tbody id="tbSteps">
                                    <?php if (!isset($_POST['steps'])):?>
                                    <?php foreach ($steps as $key => $step):?>
                                    <tr>
                                        <td>
                                            <input type="hidden" name="steps[<?=$key?>][id]"
                                                value="<?=$step->getId()?>">
                                            <textarea type="text" class="form-control"
                                                name="steps[<?=$key?>][description]"
                                                placeholder="Step description..."><?=$step->getDescription()?></textarea>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                    <?php else:?>
                                    <?php foreach ($_POST['steps'] as $key => $step):?>
                                    <tr>
                                        <td>
                                            <input type="hidden" name="steps[<?=$key?>][id]"
                                                value="<?=$_POST['steps'][$key]['id']?>">
                                            <textarea type="text" class="form-control"
                                                name="steps[<?=$key?>][description]"
                                                placeholder="Step description..."><?=$step['description'];?></textarea>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-2">
                <button class="btn btn-primary float-end">Update Recipe</button>
                <a href="<?=ROOT?>/recipe/<?=$recipe->getId()?>">
                    <button type="button" class="btn btn-secondary">Cancel</button>
                </a>
            </div>
        </form>
    </div>
</div>
<script>
function display_image_name(file_name) {
    document.querySelector(".file_info").innerHTML = '<b>Selected file:</b><br>' + file_name;
}
</script>
<?php $this->view('includes/footer')?>