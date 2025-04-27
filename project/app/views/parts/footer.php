<?php

use wfm\View;

?>


<footer>
    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <h4><?php __('main_index_info'); ?></h4>
                    <ul class="list-unstyled">
                        <li><a href="#"><?php __('main_index_intro'); ?></a></li>
                        <li><a href="#"><?php __('main_index_about'); ?></a></li>
                        <li><a href="#"><?php __('main_index_payment'); ?></a></li>
                        <li><a href="#"><?php __('main_index_contacts'); ?></a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-6">
                    <h4><?php __('main_index_opening'); ?></h4>
                    <ul class="list-unstyled">
                        <li><?php __('main_index_place'); ?></li>
                        <li><?php __('main_index_date'); ?></li>
                        <li>Non-stop</li>
                    </ul>
                </div>

                <div class="col-md-3 col-6">
                    <h4><?php __('main_index_contacts'); ?></h4>
                    <ul class="list-unstyled">
                        <li><a href="tel:123456789">123 456 789</a></li>
                        <li><a href="tel:123456789">123 456 789</a></li>
                        <li><a href="tel:123456789">123 456 789</a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-6">
                    <h4><?php __('main_index_sm'); ?></h4>
                    <div class="footer-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>

<button id="top">
    <i class="fas fa-angle-double-up"></i>
</button>

<div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Košík</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table text-start">
                    <thead>
                        <tr>
                            <th scope="col">Obrázek</th>
                            <th scope="col">Zboží</th>
                            <th scope="col">Množství</th>
                            <th scope="col">Cena</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a href="#"><img src="<?= PATH ?>/assets/img/products/apple_cinema_30.jpg" alt=""></a>
                            </td>
                            <td><a href="#">Apple cinema</a></td>
                            <td>1</td>
                            <td>100</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#"><img src="<?= PATH ?>/assets/img/products/canon_eos_5d_1.jpg" alt=""></a>
                            </td>
                            <td><a href="#">Canon EOS</a></td>
                            <td>1</td>
                            <td>100</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#"><img src="<?= PATH ?>/assets/img/products/hp_1.jpg" alt=""></a>
                            </td>
                            <td><a href="#">HP</a></td>
                            <td>1</td>
                            <td>100</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger ripple" data-bs-dismiss="modal">Pokračovat v nákupu</button>
                <button type="button" class="btn btn-primary">Objednat zboží</button>
            </div>
        </div>
    </div>
</div>

<?php $this->getDbLogs(); ?> 

<script>
    const PATH = '<?= PATH ?>';
</script>
<script src="<?= PATH ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
<script src="<?= PATH ?>/assets/js/js/main.js"></script>
<script src="<?= PATH ?>/assets/js/jquery.magnific-popup.min.js"></script>

</body>

</html>