<!-- Default box -->
<div class="card">

    <div class="card-body">

        <?php $key = key($product); ?>
        <form action="" method="post">

            <div class="form-group">
                <label class="required" for="parent_id">Kategorie</label>
                <?php new \app\widgets\menu\Menu([
                    'cache' => 0,
                    'cacheKey' => 'admin_menu_select',
                    'class' => 'form-control',
                    'container' => 'select',
                    'attrs' => [
                        'name' => 'parent_id',
                        'id' => 'parent_id',
                        'required' => 'required',
                    ],
                    'tpl' => APP . '/widgets/menu/admin_select_tpl.php',
                ]) ?>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="required" for="price">Cena</label>
                        <input type="text" name="price" class="form-control" id="price" placeholder="Cena"
                               value="<?= $product[$key]['price'] ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="old_price">Předchozí cena</label>
                        <input type="text" name="old_price" class="form-control" id="old_price"
                               placeholder="Předchozí cena" value="<?= $product[$key]['old_price'] ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="status"
                           name="status" <?= $product[$key]['status'] ? 'checked' : '' ?>>
                    <label for="status" class="custom-control-label">Přidat na e-shop</label>
                </div>
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="hit"
                           name="hit" <?= $product[$key]['hit'] ? 'checked' : '' ?>>
                    <label for="hit" class="custom-control-label">Hittovka</label>
                </div>
            </div>

            <!-- <div class="row">
                <div class="col-md-12">

                    <div class="form-group">
                        <label for="is_download">Nahrajte soubor, aby se produkt stal digitálním</label>
                        <?php if (isset($product[$key]['download_id'])): ?>
                            <p class="clear-download">
                                <span class="btn btn-danger">Fyzický produkt</span>
                            </p>
                        <?php endif; ?>
                        <select name="is_download" class="form-control select2 is-download" id="is_download" style="width: 100%;">
                            <?php if (isset($product[$key]['download_id'])): ?>
                                <option value="<?= $product[$key]['download_id'] ?>"
                                        selected><?= $product[$key]['download_name'] ?></option>
                            <?php endif; ?>
                        </select>

                    </div>
                </div>
            </div> -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Úvodní obrázek</h3>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-success" id="add-base-img" onclick="popupBaseImage(); return false;">
                                Nahrát
                            </button>
                            <div id="base-img-output" class="upload-images base-image">
                                <div class="product-img-upload">
                                    <img src="<?= $product[$key]['img'] ?>">
                                    <input type="hidden" name="img" value="<?= $product[1]['img'] ?>">
                                    <?php if ($product[$key]['img'] != NO_IMAGE): ?>
                                        <button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Doplňujicí obrázky</h3>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-success" id="add-gallery-img"
                                    onclick="popupGalleryImage(); return false;">Nahrát
                            </button>
                            <div id="gallery-img-output" class="upload-images gallery-image">
                                <?php if (!empty($gallery)): ?>
                                    <?php foreach ($gallery as $item): ?>
                                        <div class="product-img-upload">
                                            <img src="<?= $item ?>">
                                            <input type="hidden" name="gallery[]"
                                                   value="<?= $item ?>">
                                            <button class="del-img btn btn-app bg-danger"><i
                                                    class="far fa-trash-alt"></i></button>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
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
                                <a class="nav-link <?php if ($lang['base']) echo 'active' ?>" data-toggle="pill"
                                   href="#<?= $k ?>">
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
                                    <input type="text" name="product_description[<?= $lang['id'] ?>][title]"
                                           class="form-control" id="title" placeholder="Název"
                                           value="<?= h($product[$lang['id']]['title']) ?>">
                                </div>

                                <div class="form-group">
                                    <label for="description">Meta-popis</label>
                                    <input type="text" name="product_description[<?= $lang['id'] ?>][description]"
                                           class="form-control" id="description" placeholder="Meta-popis"
                                           value="<?= h($product[$lang['id']]['description']) ?>">
                                </div>

                                <div class="form-group">
                                    <label for="keywords">Klíčová slova</label>
                                    <input type="text" name="product_description[<?= $lang['id'] ?>][keywords]"
                                           class="form-control" id="keywords" placeholder="Klíčová slova"
                                           value="<?= h($product[$lang['id']]['keywords']) ?>">
                                </div>

                                <div class="form-group">
                                    <label for="excerpt" class="required">Stručný popis</label>
                                    <input type="text" name="product_description[<?= $lang['id'] ?>][excerpt]"
                                           class="form-control" id="excerpt" placeholder="Stručný popis"
                                           value="<?= h($product[$lang['id']]['excerpt']) ?>">
                                </div>

                                <div class="form-group">
                                    <label for="content">Popis produktu</label>
                                    <textarea name="product_description[<?= $lang['id'] ?>][content]"
                                              class="form-control editor" id="content" rows="3"
                                              placeholder="Popis produktu"><?= h($product[$lang['id']]['content']) ?></textarea>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- /.card -->
            </div>

            <button type="submit" class="btn btn-primary">Uložit</button>

        </form>

    </div>

</div>
<!-- /.card -->
