<?php
//require_once '../config/connection.php';
require_once __DIR__ . '/../config/connection.php';


if (!isset($_GET['brojProizvoda'])) {
    $results_per_page = 3;
} 
else {
    $results_per_page = $_GET['brojProizvoda'];
}

if (!isset($_GET['sort'])) {
    $sort = "";
} 
else {
    $sort = $_GET['sort'];
}

$query = $connection->query("SELECT * FROM products")->fetchAll();



$number_of_results = count($query);
$number_of_pages = ceil($number_of_results / $results_per_page);


if (!isset($_GET['stranicaProizvoda'])) {
    $page = 1;
} else {
    $page = $_GET['stranicaProizvoda'];
}


$this_page_first_result = ($page - 1) * $results_per_page;

if($sort==""){
    $sql = 'SELECT * FROM products LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
}
else if($sort=="priceDesc"){
    $sql = 'SELECT * FROM products ORDER BY price DESC LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
}
else if($sort=="priceAsc"){
    $sql = 'SELECT * FROM products ORDER BY price ASC LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
}
else if($sort=="nameDesc"){
    $sql = 'SELECT * FROM products p ORDER BY p.name DESC LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
}
else if($sort=="nameAsc"){
    $sql = 'SELECT * FROM products p ORDER BY p.name ASC LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
}

//$sql = 'SELECT * FROM products LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$result = $connection->query($sql)->fetchAll();

foreach ($result as $row) {
    echo '<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
    <div class="single-popular-items mb-50 text-center">
        <div class="popular-img">
            <img src="assets/img/gallery/' . $row['img'] . '" alt="proizvod' . $row['id'] . '">
            <div class="img-cap">
                <span class="btnAddToCart" data-id=' . $row['id'] . '>Add to cart</span>
            </div>
        </div>
        <div class="popular-caption">
            <h3><a href="product_details.html">' . $row['name'] . '</a></h3>
            <span>$ ' . $row['price'] . '</span>
        </div>
    </div>
</div>';
}


echo '<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">';
//   <li class="page-item disabled">
//     <a class="page-link" href="#" tabindex="-1">Previous</a>
//   </li>';
for ($page = 1; $page <= $number_of_pages; $page++) {
    echo '<li class="page-item"><a  class="page-link" href="index.php?sort='.$sort.'&page=shop&brojProizvoda=' . $results_per_page . '&stranicaProizvoda=' . $page . '">' . $page . '</a> </li>';
}
echo '
    </ul>
  </nav>';
