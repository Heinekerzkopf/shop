<!-- Default box -->
<div class="card">

    <div class="card-body">

        <form action="" method="post">

            <div class="form-group">
                <label class="required" for="parent_id">Kategorie</label>
                <select name="parent_id" id="parent_id" required class="form-control">
                    <?php foreach ($options as $id => $optLabel): ?>
                        <option value="<?= $id ?>" <?= ($id == get_field_value('parent_id')) ? 'selected' : '' ?>>
                            <?= $optLabel ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="required" for="price">Cena</label>
                        <input type="text" name="price" class="form-control" id="price" placeholder="cena" value="<?= get_field_value('price') ?: 0 ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="old_price">Předchozí cena</label>
                        <input type="text" name="old_price" class="form-control" id="old_price" placeholder="Předchozí cena" value="<?= get_field_value('old_price') ?: 0 ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="status" name="status" checked>
                    <label for="status" class="custom-control-label">Přidat do obchodu</label>
                </div>
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="hit" name="hit">
                    <label for="hit" class="custom-control-label">Hitovka</label>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Hlavní obrázek</h3>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-success" id="add-base-img" onclick="popupBaseImage(); return false;">Nahrát</button>
                            <div id="base-img-output" class="upload-images base-image"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Další obrázky</h3>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-success" id="add-gallery-img" onclick="popupGalleryImage(); return false;">Nahrát</button>
                            <div id="gallery-img-output" class="upload-images gallery-image"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>


            <div class="card card-info card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <?php foreach (\wfm\App::$app->getProperty('languages') as $k => $lang): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if ($lang['base']) echo 'active' ?>" data-toggle="pill" href="#<?= $k ?>">
                                    <img src="<?= PATH ?>/assets/img/lang/<?= $k ?>.png" alt="">
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        <?php foreach (\wfm\App::$app->getProperty('languages') as $k => $lang): ?>
                            <div class="tab-pane fade <?php if ($lang['base']) echo 'active show' ?>" id="<?= $k ?>">

                                <div class="form-group">
                                    <label class="required" for="title">Název</label>
                                    <input type="text" name="product_description[<?= $lang['id'] ?>][title]" class="form-control" id="title" placeholder="Název" value="<?= get_field_array_value('product_description', $lang['id'], 'title') ?>">
                                </div>

                                <div class="form-group">
                                    <label for="description">Meta-popis</label>
                                    <input type="text" name="product_description[<?= $lang['id'] ?>][description]" class="form-control" id="description" placeholder="Meta-popis" value="<?= get_field_array_value('product_description', $lang['id'], 'description') ?>">
                                </div>

                                <div class="form-group">
                                    <label for="keywords">Klíčová slova</label>
                                    <input type="text" name="product_description[<?= $lang['id'] ?>][keywords]" class="form-control" id="keywords" placeholder="Klíčová slova" value="<?= get_field_array_value('product_description', $lang['id'], 'keywords') ?>">
                                </div>

                                <div class="form-group">
                                    <label for="excerpt" class="required">Stručný popis</label>
                                    <input type="text" name="product_description[<?= $lang['id'] ?>][excerpt]" class="form-control" id="excerpt" placeholder="Stručný popis" value="<?= get_field_array_value('product_description', $lang['id'], 'excerpt') ?>">
                                </div>

                                <div class="form-group">
                                    <label for="content">Popis produktu</label>
                                    <textarea name="product_description[<?= $lang['id'] ?>][content]" class="form-control editor" id="content" rows="3" placeholder="Popis produktu"><?= get_field_array_value('product_description', $lang['id'], 'content') ?></textarea>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- /.card -->
            </div>

            <button type="submit" class="btn btn-primary">Uložit</button>

        </form>

        <?php
        if (isset($_SESSION['form_data'])) {
            unset($_SESSION['form_data']);
        }
        ?>

    </div>

</div>
<!-- /.card -->