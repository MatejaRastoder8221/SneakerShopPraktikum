<main>
    <?php
    require_once 'views/fixed/heroArea.php';
    if (isset($_SESSION['user'])):

    if (!isset($_GET['brojProizvoda'])) {
            $results_per_page = 3;
        } else {
            $results_per_page = $_GET['brojProizvoda'];
        }
        
    if (!isset($_GET['sort'])) {
            $sort = "";
        } else {
            $sort = $_GET['sort'];
        }
    if (!isset($_GET['stranicaProizvoda'])) {
            $page = 1;
        } else {
            $page = $_GET['stranicaProizvoda'];
        }
    ?>
    <!-- Latest Products Start -->
    <section class="popular-items latest-padding">
        <div class="container">
            <div class="row product-btn justify-content-between mb-40">
                <div class="properties__button">
                    <!--Nav Button  -->
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link" id="btnPrikazSve" href="index.php?page=shop&brojProizvoda=3&stranicaProizvoda=<?=$page?>&sort=<?=$sort?>" name="noviProizvodi">3 per page</a>
                            <a class="nav-item nav-link" id="btnPrikazSve" href="index.php?page=shop&brojProizvoda=6&stranicaProizvoda=<?=$page?>&sort=<?=$sort?>" name="noviProizvodi">6 per page</a>
                            <a class="nav-item nav-link" id="btnPrikazSve" href="index.php?page=shop&brojProizvoda=<?=$results_per_page?>&stranicaProizvoda=<?=$page?>&sort=nameAsc" name="noviProizvodi">Name A-Z</a>
                            <a class="nav-item nav-link" id="btnPrikaziNove" href="index.php?page=shop&brojProizvoda=<?=$results_per_page?>&stranicaProizvoda=<?=$page?>&sort=nameDesc" name="noviProizvodi">Name Z-A</a>
                            <a class="nav-item nav-link" id="btnPriceHighLow" href="index.php?page=shop&brojProizvoda=<?=$results_per_page?>&stranicaProizvoda=<?=$page?>&sort=priceDesc" name="noviProizvodi" name="cenaViseNize"> Price high to low</a>
                            <a class="nav-item nav-link" id="btnPriceLowHigh" href="index.php?page=shop&brojProizvoda=<?=$results_per_page?>&stranicaProizvoda=<?=$page?>&sort=priceAsc" name="cenaNizeVise"> Price low to high</a>
                        </div>
                    </nav>
                    <!--End Nav Button  -->
                <div id="cartPopup">
                    <p class="alert alert-success text-center">Product added to cart</p>
                 </div>
                </div>
                <!-- Grid and List view -->
                <div class="grid-list-view">
                </div>
                <!-- Select items -->
                <!-- <div class="select-this">
                    <form action="#">
                        <div class="select-itms">
                            <select name="select" id="select1">
                                <option value=""><a href="index.php?page=shop&brojProizvoda=3">3 per page</a></option>
                                <option value=""><a href="index.php?page=shop&brojProizvoda=6">6 per page</a></option>
                            </select>
                        </div>
                    </form>
                </div> -->
            </div>
            <!-- Nav Card -->
            <div class="tab-content" id="nav-tabContent">
                <!-- card one -->
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row" id="shopProducts">
                        <!-- Dinamicki ispis -->
                        <?php include "models/getProducts.php" ?>
                    </div>
                </div>
            </div>
            <!-- End Nav Card -->
        </div>
    </section>
</main>

<?php
endif;
if (!isset($_SESSION['user'])){
        header('Location: index.php?page=login');
}
?>