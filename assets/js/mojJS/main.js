$(document).ready(function () {
    getMenu();
    getSliderImages();
    getTopProducts();
    getNewArrivals();
    getPaymentOffers();
    getSocials();
    getGalleryImages();
    addToCart();

    $("#btnClear").click(clearCartBtn);
    $("btnRegister").click(proveraRegistracije);
    $("btnLogin").click(proveraLogovanje);

    if(window.location.href.indexOf("admin")){
        adminPanel();
    }
});
//funkcija za ciscenje cart iz localstorage
     function clearCartBtn(){
        localStorage.removeItem("cart");
        localStorage.removeItem("brojProizvodaLS");
        //displayCartData();
        //printNumberOfProducts();
        //location.reload();
        $("#products").slideToggle();
        $("#buySuccess").slideToggle();
        $("#cart-sum").slideToggle();
        $("#btnClear").slideToggle();
    }
//funkcije za dodavanje proizvoda u korpu
function addToCart(){
    $(document).on('click','.btnAddToCart',function(){
        //console.log(this.dataset.id);
        let idP=(this.dataset.id);
        //console.log(idP);
        $('#shopProducts').slideToggle();
        $('#cartPopup').slideToggle();
        setTimeout(cartAdd, 500);
        //novo 
        let productsCart = getLS("cart");
    if(productsCart == null){
        addFirstItemToCart();
        printNumberOfProducts();
    }
    else{
        if(productIsAlreadyInCart()){
            updateQty();
            printNumberOfProducts();
        }
        else{
            addItemToCart();
            printNumberOfProducts();
        }
    }

    function addFirstItemToCart(){
        let products = [
            {
                id: idP,
                qty: 1
            }
        ];

        setLS("cart", products);
    }

    function productIsAlreadyInCart(){
        return productsCart.filter(el => el.id == idP).length;
    }

    function updateQty(){
        let productsLS = getLS("cart");
        for(let p of productsLS){
            if(p.id == idP){
                p.qty++;
                break;
            }
        }

        setLS("cart", productsLS);
    }

    function addItemToCart(){
        let productLS = getLS("cart");

        productLS.push({
            id: idP,
            qty: 1
        });

        setLS("cart", productLS);
    }

    })
}

//localstorage za korpu
function setLS(key,value){
    localStorage.setItem(key,JSON.stringify(value));
}
function getLS(key){
    return JSON.parse(localStorage.getItem(key));
}


function cartAdd(){
    $('#shopProducts').slideToggle();
    $('#cartPopup').slideToggle();
}

//korpa 

var quantity=0;
function printNumberOfProducts(){
    let productsCart = getLS("cart");
    if(productsCart == null){
        $("#broj-proizvoda").html("(0 products)");
        console.log("problem?");
    }
    else{   
        // quantity=0;
        // for(let i=0;i<productsCart.length;i++){
        //     quantity+=productsCart[i].qty;
        // }
        quantity=productsCart.length;
        let numberOfProducts = quantity;
        let txt = quantity+" ";

        if(numberOfProducts == 1){
            txt = quantity+" "+"product";
        }
        else{
            txt =quantity+" products";
        }
        setLS("brojProizvodaLS",txt);
        $("#broj-proizvoda").html(`${txt}`)
    }
}

//admin panel
function adminPanel(){
    getAllProducts();
    $("#navAdminMeni li a").click(function(e){
        e.preventDefault();
        var stranica = this.dataset.name;
        //console.log(stranica);
        if(stranica=="products"){
            getAllProducts();
        }
        if(stranica == "users"){
            getAllUsers();
        }
        if(stranica == "brands"){
            getAllBrands();
        }
        if(stranica == "genders"){
            getAllGenders();
        }
        if(stranica == "menus"){
            getAllMenus();
        }
    });
}

//Nav
function getMenu(){
    $.ajax({
        url:"navigation.php",
        method:"get",
        dataType:"json",
        success:function(data){
            writeMenu(data);
            writeMenuMobile(data);
        },
        error:function(xhr){
            console.log(xhr);
        }
    });
}

//Ispisivanje navigacije
function writeMenu(data){
    let output = "";
    for (let item of data) {
        output += `<li><a href="index.php?page=${item.name}">${item.name}</a><li>`
    }

    $("#navigation").html(output)
}

function writeMenuMobile(data){
    let output = "";
    for (let item of data) {
        output += `<li><a href="index.php?page=${item.name}">${item.name}</a><li>`
    }

    $(".slicknav_nav").html(output)
}

//Slajder
var i = 0;
function getSliderImages(){
    $.ajax({
        url:"models/getSliderImages.php",
        method:"get",
        dataType:"json",
        success:function(data){
            showSliderImages(data);
        },
        error:function(xhr){
            console.log(xhr);
        }
    });

    function showSliderImages(nizSlika) {
            $(".hero__img").html(`<img src="assets/img/hero/${nizSlika[i].name}" alt="" class=" heartbeat">`);
            $("#naslovSlider").html(nizSlika[i].title);
            $("#opisSlider").html(nizSlika[i].caption);
            if(i < nizSlika.length-1){
                i++;
            }
            else{
                i=0;
            }

            setTimeout("getSliderImages()", 3000);
            }
}

//Uzimanje novih proizvoda
function getTopProducts(){
    $.ajax({
        url:"models/getTopProducts.php",
        method:"get",
        dataType:"json",
        success:function(data){
            writeProducts(data);
        },
        error:function(xhr){
            console.log(xhr);
        }
    });
}

// ispis proizvoda
function writeProducts(data){
    let output = "";
    for (const product of data) {
        output += `<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
        <div class="single-popular-items mb-50 text-center">
            <div class="popular-img">
                <img src="assets/img/gallery/${product.img}" alt="">
            </div>
            <div class="popular-caption">
                <h3><a href="index.php?page=product&product=${product.id}">${product.name}</a></h3>
                <span>$ ${product.price}</span>
            </div>
        </div>
    </div>`;
    }
        $("#producstArea").html(output);
    
}

//Dohvatanje najnovijih proizvoda, odnosno koji su poslednji insertovani u tabeli products
function getNewArrivals(){
    $.ajax({
        url:"models/getNewArrivals.php",
        method:"get",
        dataType:"json",
        success:function(data){
            writeNewArrivals(data);
        },
        error:function(xhr){
            console.log(xhr);
        }
    });
}

//Dohvatanje proizvoda za product page
function getProduct(){
    $.ajax({
        url:"models/getProduct.php",
        method:"get",
        dataType:"json",
        success:function(data){
            writeProductPage(data);
        },
        error:function(xhr){
            console.log(xhr);
        }
    });
}

//Ispis product stranice
function writeProductPage(data){
    let output = "";
    for (const product of data) {
        output += `<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
        <div class="single-new-pro mb-30 text-center">
            <div class="product-img">
                <img src="assets/img/gallery/${product.img}" alt="">
            </div>
            <div class="product-caption">
                <h3><a href="index.php?page=product&product=${product.id}">${product.name}</a></h3>
                <span>$ ${product.price}</span>
            </div>
        </div>
    </div>`;
    }

    $("#product-container").html(output);
}

//Ispis najnovijih proizvoda
function writeNewArrivals(data){
    let output = "";
    for (const product of data) {
        output += `<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
        <div class="single-new-pro mb-30 text-center">
            <div class="product-img">
                <img src="assets/img/gallery/${product.img}" alt="">
            </div>
            <div class="product-caption">
                <h3><a href="index.php?page=product&product=${product.id}">${product.name}</a></h3>
                <span>$ ${product.price}</span>
            </div>
        </div>
    </div>`;
    }

    $("#newArrivals").html(output);
}

//Dohvatanje ikonica u crvenom div-u pri dnu stranice
function getPaymentOffers(){
    $.ajax({
        url:"models/getPaymentOffers.php",
        method:"get",
        dataType:"json",
        success:function(data){
            showPaymentOffers(data);
        },
        error:function(xhr){
            console.log(xhr);
        }
    });
}

//Ispis ikonica za crveni div
function showPaymentOffers(data){
    let output = "";
    for (const item of data) {
        output += `<div class="col-xl-4 col-lg-4 col-md-6">
        <div class="single-method mb-40">
            <i class="${item.img}"></i>
            <h6>${item.name}</h6>
            <p>${item.description}</p>
        </div>
    </div>`;
    }

    $("#methodPaymentOffers").html(output);
}

//Dohvatanje ikonica za drustvene mreze
function getSocials(data){
    $.ajax({
        url:"models/getSocialsIcons.php",
        method:"get",
        dataType:"json",
        success:function(data){
            showSocials(data);
        },
        error:function(xhr){
            console.log(xhr);
        }
    });
}

//Ispis ikonica za drustvene mreze
function showSocials(data) {
    let output = "";
    for (const item of data) {
        output += `<a href="${item.link}"><i class="${item.img}"></i></a>`;
    }

    $(".footer-social").html(output);
}

//Dohvatanje slika za razlicit prikaz u dva diva
function getGalleryImages(){
    $.ajax({
        url:"models/getGalleryImages.php",
        method:"get",
        dataType:"json",
        success:function(data){
            showGalleryArea(data);
            showWatchOfChoice(data);
        },
        error:function(xhr){
            console.log(xhr);
        }
    });
}

//Prikaz dva proizvoda sa razlicitom strukturom divova
function showWatchOfChoice(data){
    let br = 2;
    let output = "";
    for (const item of data) {
        if(item.purpose == 1){
            if(br % 2 == 0){
                output += parniIspis(item);
                br++;
            }
            else{
                output += neparniIspis(item);
                br++;
            }
        }
    }

    $("#watchOfChoiceGallery").html(output);
}

//helper za showWatchChoice f-ju
function parniIspis(item){
    return `<div class="row align-items-center justify-content-between">
    <div class="col-lg-5 col-md-6">
        <div class="watch-details mb-40">
            <h2>${item.title}</h2>
            <p>${item.description}</p>
            <a href="index.php?page=shop" class="btn">Show Sneakers</a>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-10">
        <div class="choice-watch-img mb-40">
            <img src="assets/img/gallery/${item.img}" alt="galleryImage">
        </div>
    </div>
</div>`;
}

//helper za showWatchChoice f-ju
function neparniIspis(item){
    return `<div class="row align-items-center justify-content-between">
    <div class="col-lg-6 col-md-6 col-sm-10">
        <div class="choice-watch-img mb-40">
            <img src="assets/img/gallery/${item.img}" alt="galleryImage">
        </div>
    </div>
    <div class="col-lg-5 col-md-6">
        <div class="watch-details mb-40">
            <h2>${item.title}</h2>
            <p>${item.description}</p>
            <a href="index.php?page=shop" class="btn">Show Sneakers</a>
        </div>
    </div>
</div>`;
}

//helper za ispis 4 slike u vidu mini galerije na home stranici
function showGalleryArea(data){
    let output = "";
    for (const item of data) {
        if(item.purpose == 2){
            output += `<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
            <div class="single-gallery mb-30">
                <div class="gallery-img big-img" style="background-image: url(assets/img/gallery/${item.img});"></div>
            </div>
        </div>`;
        }
    }
    $("#placeForGalleryArea").html(output);
}

//Registracija regex
function proveraRegistracije(){
    var ime=document.getElementById('name');
    var prezime=document.getElementById('lastname');
    var email=document.getElementById('email');
    var password=document.getElementById('password');
    var repassword=document.getElementById('testpassword');

    var regime=/^[A-Z]{1}[a-z]{2,29}$/;
    var regprezime=/^[A-Z]{1}[a-z]{2,29}$/;
    var regmail = /^(\w+[\-\.])*\w+@(\w+\.)+[A-Za-z]+$/;
    var regpassword = /^[A-z0-9_-]{6,12}$/;
    var otpadak = new Array();

    if(!ime.value.match(regime))
        {
            otpadak.push("First name is invalid");
            $("#name").removeClass("formaUspeh");
            $("#imeError").removeClass("invisible");
            $("#imeError").addClass("formaGreska");
            
        } else {
            $("#imeError").addClass("invisible");
            $("#imeError").removeClass("formaGreska");
            $("#name").addClass("formaUspeh");
        }
    if(!prezime.value.match(regprezime))
        {
            otpadak.push("Last name is invalid");
            $("#lastNameError").removeClass("invisible");
            $("#lastNameError").addClass("formaGreska");
        } else {
            $("#lastNameError").addClass("invisible");
            $("#lastNameError").removeClass("formaGreska");
            $("#lastname").addClass("formaUspeh");
        }
    if(!email.value.match(regmail))
        {
            otpadak.push("Email is invalid");
            $("#emailError").removeClass("invisible");
            $("#emailError").addClass("formaGreska");
        } else {
            $("#emailError").addClass("invisible");
            $("#emailError").removeClass("formaGreska");
            $("#email").addClass("formaUspeh");
        }
    if(!password.value.match(regpassword))
        {
            otpadak.push("Password is invalid");
            $("#passwordError").removeClass("invisible");
            $("#passwordError").addClass("formaGreska");
        } else {
            $("#passwordError").addClass("invisible");
            $("#passwordError").removeClass("formaGreska");
            $("#password").addClass("formaUspeh");
        }

    if(password.value != repassword.value || repassword.value == ""){
            otpadak.push("Re password is invalid");
            $("#testPasswordError").removeClass("invisible");
            $("#testPasswordError").addClass("formaGreska");
    } else {
        $("#testPasswordError").addClass("invisible");
        $("#testPasswordError").removeClass("formaGreska");
        $("#testpassword").addClass("formaUspeh");
    }
    if(otpadak.length==0){

    return true;
}
else{
    
    return false;
    
}
}

//Logovanje regex
function proveraLogovanje(){
    var email=document.getElementById('email');
    var password=document.getElementById('password');


    var regmail = /^(\w+[\-\.])*\w+@(\w+\.)+[A-Za-z]+$/;
    var regpassword = /^[A-z0-9_-]{6,12}$/;
    var otpadak = new Array();

    if(!email.value.match(regmail))
        {
            otpadak.push("Email is invalid");
            $("#emailError").removeClass("invisible");
            $("#emailError").addClass("formaGreska");
        } else {
            $("#emailError").addClass("invisible");
            $("#emailError").removeClass("formaGreska");
            $("#email").addClass("formaUspeh");
        }
    if(!password.value.match(regpassword))
        {
            otpadak.push("Password is invalid");
            $("#passwordError").removeClass("invisible");
            $("#passwordError").addClass("formaGreska");
        } else {
            $("#passwordError").addClass("invisible");
            $("#passwordError").removeClass("formaGreska");
            $("#password").addClass("formaUspeh");
        }
        if(otpadak.length==0){

            return true;
        }
        else{
            //console.log(otpadak);
            return false;
            
        }
}

//adminPanel f-je

//dohvata sve proizvode i vraca f-ju za ispis istih
function getAllProducts(){
    $.ajax({
        url:"models/getAllProducts.php",
        method:"get",
        dataType:"json",
        success:function(data){
            //console.log(data);
            setLS("sviProizvodi",data);
            tabelaIspis(data, "products");
        },
        error:function(xhr){
            console.log(xhr);
        }
    });
}

//dohvata sve usere i vraca f-ju za ispis istih
function getAllUsers(){
    $.ajax({
        url:"models/getAllUsers.php",
        method:"get",
        dataType:"json",
        success:function(data){
            //console.log(data);
            tabelaIspis(data, "users");
        },
        error:function(xhr){
            console.log(xhr);
        }
    });
}

//dohvata sve brendove i vraca f-ju za ispis istih
function getAllBrands(){
    $.ajax({
        url:"models/getAllBrands.php",
        method:"get",
        dataType:"json",
        success:function(data){
            //console.log(data);
            tabelaIspis(data, "brands");
        },
        error:function(xhr){
            console.log(xhr);
        }
    });
}


//dohvata sve gendere i vraca f-ju za ispis istih
function getAllGenders(){
    $.ajax({
        url:"models/getAllGenders.php",
        method:"get",
        dataType:"json",
        success:function(data){
            tabelaIspis(data, "gender");
        },
        error:function(xhr){
            console.log(xhr);
        }
    });
}

function getAllMenus(){
    $.ajax({
        url:"models/getAllMenus.php",
        method:"get",
        dataType:"json",
        success:function(data){
            tabelaIspis(data, "menus");
        },
        error:function(xhr){
            console.log(xhr);
        }
    });
}



//f-ja za delete recorda, prosledjuje se ime tabele i id recorda koji se brise. U zavisnosti od tabele koja je poslata poziva se php fajl koji ce obrisati record sa prosledjenim id-jem
function deleteRecord(tableName,id){
    let r = confirm("Are you sure you want to delete this?");

    if(r){
        $.ajax({
            url:"models/delete"+ tableName +".php",
            method:"POST",
            dataType:"json",
            data:{
                "delete": true,
                "poslatiID": id
            },
            success:function(data){
                var responseData = data;
                alert(responseData.msg);

                if(responseData.productDeleted){
                    getAllProducts();
                }
                if(responseData.userDeleted){
                    getAllUsers();
                }
                if(responseData.brandDeleted){
                    getAllBrands();
                }
                if(responseData.genderDeleted){
                    getAllGenders();
                }
                if(responseData.menuDeleted){
                    getAllMenus();
                }
            },
            error:function(xhr){
                console.log(xhr);
            }
        });
    }
    
}

//helper za ispis tabele
function tabelaIspis(data, tableName){
    let output = `<input type="button" class="btn btn-danger mt-4 mb-4" value="Add New ${tableName}" id="btnAdd" onclick="addNewRecord('${tableName}')">`;
    output += `<table class="table table-striped">
    <thead class="thead-dark">
      <tr>`;

      let nizImena = Object.keys(data[0]);
      for(let i=0; i<nizImena.length;i++){
        output += `<th scope="col">${nizImena[i]}</th>`;
      }

    output += `
    <th scope="col">Edit</th>
    <th scope="col">Delete</th>
    </tr></thead>
    <tbody>`;

    for (const item of data) {
        output += `<tr>`;
        var br = 1;
        for (const cell of Object.values(item)) {
            if(br == 5 && tableName=="products"){
                output += `<td><img  class="img-fluid" src="assets/img/gallery/${cell}"></td>`;
                br=1;
                continue;
            }
            br++
            output += `<td>${cell}</td>`;
        }
        //href="index.php/?page=editproduct&id=${item.id}"
        output += `<td><a class="bojaIkonice" ><i class="fas fa-edit"></i></a></td>
        <td><a class="bojaIkonice" onclick="deleteRecord('${tableName}', ${item.id})"><i class="fas fa-trash-alt"></i></a></td>
        </tr>`;
    }

    output += `</tbody></table>`;

    output += `<input type="button" class="btn btn-danger mt-4 mb-4" value="Add New ${tableName}" id="btnAdd" onclick="addNewRecord('${tableName}')">`;

    $("#adminIspis").html(output);

}

function addNewRecord(tableName){
    if(tableName == "products"){
        formAddProduct();
    }
    if(tableName == "users"){
        formAddUser();
    }
    if(tableName == "brands"){
        formAddBrand();
    }
    if(tableName == "gender"){
        formAddGender();
    }
    if(tableName == "menus"){
        formAddMenu();
    }
}

//ispis forme za dodavanje novog proizvoda
function formAddProduct(){
    $.ajax({
        url:"models/getBrandsAndGenders.php",
        method:"get",
        dataType:"json",
        success:function(data){
            //response = JSON.parse(data);
            //console.log(data.genders[0]);
            var forma=''
    forma+=`
        <h2>Add Product</h2>
        <div>
            <form method="POST" action="">
                <div class="col-md-12 form-group p_star">
                    <input type="text" class="form-control" id="productName" name="productName" value="" placeholder="Product Name">
                </div>
                <span class="col-md-12 form-group invisible" id="productError">
                    Enter valid product name!
                </span>

                <div class="col-md-12 form-group p_star">
                    <input type="text" class="form-control" id="price" name="price" value="" placeholder="Price">
                </div>
                <span class="col-md-12 form-group invisible" id="priceError">
                    Enter valid product price!
                </span>

                <div class="col-md-12 form-group p_star">
                    <input type="text" class="form-control" id="oldPrice" name="oldPrice" value="" placeholder="Old Price">
                </div>
                <span class="col-md-12 form-group invisible" id="oldPriceError">
                    Enter valid product old price!
                </span>

                <label>Choose image</label>
                <input type="file" id="imgFile">

                <div class="col-md-12 form-group p_star">
                    <input type="text" class="form-control" id="description" name="description" value="" placeholder="Enter description">
                </div>
                <span class="col-md-12 form-group invisible" id="oldPriceError">
                    Enter valid description!
                </span>

                <select id="selectGender">
                 <option value="0">Genders</option>`
                for(let i=0;i<data.genders.length;i++){
                    forma+=`<option value="${data.genders[i].id}">${data.genders[i].name}</option>`
                }
                forma+=`</select>

                <select id="selectBrand">
                 <option value="0">Brands</option>`
                for(let i=0;i<data.brands.length;i++){
                    forma+=`<option value="${data.brands[i].id}">${data.brands[i].name}</option>`
                }
                forma+=`</select> 


                <div class="col-md-12 form-group mt-5">
                    <button type="button" value="button" name="btnInsertProduct" id="btnInsertProduct" class="btn btn-danger">
                        Add New Product
                    </button>
                </div>
                <div id="errorAdmin"></div>
                <div id="successAdmin"></div>
            </form>
        </div>`

        $("#adminIspis").html(forma)

        $("#btnInsertProduct").click(addNewProduct);
     },
     error:function(xhr){
                console.log(xhr);
            }
     
    });
}

function addNewProduct(){

    var imgFile=document.getElementById("imgFile").files[0]
    var name=document.getElementById("productName").value
    var price=document.getElementById("price").value
    var oldPrice=document.getElementById("oldPrice").value
    var description=document.getElementById("description").value
    var gender=document.getElementById("selectGender").value
    var brand=document.getElementById("selectBrand").value

    var dataForSend= new FormData();


    dataForSend.append("imgFile",imgFile)
    dataForSend.append("productName",name)
    dataForSend.append("price",price)
    dataForSend.append("oldPrice",oldPrice)
    dataForSend.append("description",description)
    dataForSend.append("selectGender",gender)
    dataForSend.append("selectBrand",brand)

    dataForSend.append("insert","true")


    $.ajax({
        url:"models/insertNewProduct.php",
        method:"post",
        dataType:"json",
        processData:false,
        contentType:false,
        data:dataForSend,
        success:function(data){
            console.log(data);
            $("#successAdmin").html(data);
            $("#successAdmin").addClass("alert alert-success p-3");
        },
        error(xhr){
            console.log(xhr);
            $("#errorAdmin").html(JSON.parse(xhr.responseText))
            $("#errorAdmin").addClass("alert alert-warning p-3")
        }
    });
}

function formAddUser(){
    $.ajax({
        url:"models/getRoles.php",
        method:"get",
        dataType:"json",
        success:function(data){
            // console.log(data[0].name);
            var forma=''
    forma+=`
        <h2>Add User</h2>
        <div>
            <form method="POST" action="">
                <div class="col-md-12 form-group p_star">
                    <input type="text" class="form-control" id="firstName" name="firstName" value="" placeholder="Firstname">
                </div>
                <span class="col-md-12 form-group invisible" id="productError">
                    Enter valid product name!
                </span>

                <div class="col-md-12 form-group p_star">
                    <input type="text" class="form-control" id="lastname" name="lastname" value="" placeholder="Lastname">
                </div>
                <span class="col-md-12 form-group invisible" id="priceError">
                    Enter valid product price!
                </span>

                <div class="col-md-12 form-group p_star">
                    <input type="email" class="form-control" id="email" name="email" value="" placeholder="Email">
                </div>
                <span class="col-md-12 form-group invisible" id="oldPriceError">
                    Enter valid product old price!
                </span>

                <div class="col-md-12 form-group p_star">
                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="Password">
                </div>
                <span class="col-md-12 form-group invisible" id="oldPriceError">
                    Enter valid description!
                </span>

                <div class="col-md-12 form-group p_star">
                    <input type="password" class="form-control" id="testPassword" name="testPassword" value="" placeholder="Re-type password">
                </div>
                <span class="col-md-12 form-group invisible" id="oldPriceError">
                    Enter valid description!
                </span>

                <select id="selectRole">
                 <option value="0">Roles</option>`
                for(let i=0;i<data.length;i++){
                    forma+=`<option value="${data[i].id}">${data[i].name}</option>`
                }
                forma+=`</select>

                <div class="col-md-12 form-group mt-5">
                    <button type="button" value="button" name="btnInsertUser" id="btnInsertUser" class="btn btn-danger">
                        Add New User
                    </button>
                </div>
                <div id="errorAdmin"></div>
                <div id="successAdmin"></div>
            </form>
        </div>`

        $("#adminIspis").html(forma)

        $("#btnInsertUser").click(addNewUser);
     },
     error:function(xhr){
                console.log(xhr);
            }
     
    });
}

function addNewUser(){

    var firstname=document.getElementById("firstName").value
    var lastname=document.getElementById("lastname").value
    var email=document.getElementById("email").value
    var password=document.getElementById("password").value
    var testPassword=document.getElementById("testPassword").value
    var role=document.getElementById("selectRole").value

    var dataForSend= new FormData();

    dataForSend.append("firstName",firstname)
    dataForSend.append("lastname",lastname)
    dataForSend.append("email",email)
    dataForSend.append("password",password)
    dataForSend.append("testPassword",testPassword)
    dataForSend.append("selectRole",role)

    dataForSend.append("insert","true")


    $.ajax({
        url:"models/insertNewUser.php",
        method:"post",
        dataType:"json",
        processData:false,
        contentType:false,
        data:dataForSend,
        success:function(data){
            console.log(data);
            $("#successAdmin").html(data);
            $("#successAdmin").addClass("alert alert-success p-3");
        },
        error(xhr){
            console.log(xhr);
            $("#errorAdmin").html(JSON.parse(xhr.responseText))
            $("#errorAdmin").addClass("alert alert-warning p-3")
        }
    });
}

function formAddBrand(){
    var forma='';
    forma+=`
        <h2>Add Brand</h2>
        <div>
            <form method="POST" action="">
                <div class="col-md-12 form-group p_star">
                    <input type="text" class="form-control" id="brandName" name="brandName" value="" placeholder="Brand name">
                </div>

                <div class="col-md-12 form-group mt-5">
                    <button type="button" value="button" name="btnInsertBrand" id="btnInsertBrand" class="btn btn-danger">
                        Add New Brand
                    </button>
                </div>
                <div id="errorAdmin"></div>
                <div id="successAdmin"></div>
            </form>
        </div>`

        $("#adminIspis").html(forma)

        $("#btnInsertBrand").click(addNewBrand);
}

function addNewBrand(){
    var brandName=document.getElementById("brandName").value

    var dataForSend= new FormData();

    dataForSend.append("brandName",brandName)
    dataForSend.append("insert","true")

    $.ajax({
        url:"models/insertNewBrand.php",
        method:"post",
        dataType:"json",
        processData:false,
        contentType:false,
        data:dataForSend,
        success:function(data){
            console.log(data);
            $("#successAdmin").html(data);
            $("#successAdmin").addClass("alert alert-success p-3");
        },
        error(xhr){
            console.log(xhr);
            $("#errorAdmin").html(JSON.parse(xhr.responseText))
            $("#errorAdmin").addClass("alert alert-warning p-3")
        }
    });
}

function formAddGender(){
    var forma='';
    forma+=`
        <h2>Add Gender</h2>
        <div>
            <form method="POST" action="">
                <div class="col-md-12 form-group p_star">
                    <input type="text" class="form-control" id="genderName" name="genderName" value="" placeholder="Gender name">
                </div>

                <div class="col-md-12 form-group mt-5">
                    <button type="button" value="button" name="btnInsertGender" id="btnInsertGender" class="btn btn-danger">
                        Add New Gender
                    </button>
                </div>
                <div id="errorAdmin"></div>
                <div id="successAdmin"></div>
            </form>
        </div>`

        $("#adminIspis").html(forma)

        $("#btnInsertGender").click(addNewGender);
}

function addNewGender(){
    var genderName=document.getElementById("genderName").value

    var dataForSend= new FormData();

    dataForSend.append("genderName",genderName)
    dataForSend.append("insert","true")

    $.ajax({
        url:"models/insertNewGender.php",
        method:"post",
        dataType:"json",
        processData:false,
        contentType:false,
        data:dataForSend,
        success:function(data){
            console.log(data);
            $("#successAdmin").html(data);
            $("#successAdmin").addClass("alert alert-success p-3");
        },
        error(xhr){
            console.log(xhr);
            $("#errorAdmin").html(JSON.parse(xhr.responseText))
            $("#errorAdmin").addClass("alert alert-warning p-3")
        }
    });
}

function formAddMenu(){
    $.ajax({
        url:"models/getPrivileges.php",
        method:"get",
        dataType:"json",
        success:function(data){
            // console.log(data[0].name);
            var forma='';
            forma+=`
                <h2>Add Menu Item</h2>
                <div>
                    <form method="POST" action="">
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="menuItemName" name="menuItemName" value="" placeholder="Menu item name">
                        </div>
        
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="menuItemPosition" name="menuItemPosition" value="" placeholder="Menu item position">
                        </div>

                        <select id="selectPrivilege">
                            <option value="0">Privilege</option>`
                                for(let i=0;i<data.length;i++){
                                    forma+=`<option value="${data[i].id}">${data[i].name}</option>`
                                }
                        forma+=`</select>
        
                        <div class="col-md-12 form-group mt-5">
                            <button type="button" value="button" name="btnInsertMenu" id="btnInsertMenu" class="btn btn-danger">
                                Add New Menu Item
                            </button>
                        </div>
                        <div id="errorAdmin"></div>
                        <div id="successAdmin"></div>
                    </form>
                </div>`
        
                $("#adminIspis").html(forma)
        
                $("#btnInsertMenu").click(addNewMenu);
     },
     error:function(xhr){
                console.log(xhr);
            }
     
    });
}

function addNewMenu(){
    var menuItemName=document.getElementById("menuItemName").value
    var menuItemPosition=document.getElementById("menuItemPosition").value
    var privilege=document.getElementById("selectPrivilege").value

    var dataForSend= new FormData();

    dataForSend.append("menuItemName",menuItemName)
    dataForSend.append("menuItemPosition",menuItemPosition)
    dataForSend.append("selectPrivilege",privilege)
    dataForSend.append("insert","true")

    $.ajax({
        url:"models/insertNewMenuItem.php",
        method:"post",
        dataType:"json",
        processData:false,
        contentType:false,
        data:dataForSend,
        success:function(data){
            console.log(data);
            $("#successAdmin").html(data);
            $("#successAdmin").addClass("alert alert-success p-3");
        },
        error(xhr){
            console.log(xhr);
            $("#errorAdmin").html(JSON.parse(xhr.responseText))
            $("#errorAdmin").addClass("alert alert-warning p-3")
        }
    });
}

//ispis i brisanje proizvoda u korpi 
$(document).ready(function(){
    let productsCartLS=getLS("cart");
    
    if (productsCartLS==null || productsCartLS.length<1){
        $("#products").html(`<div id="greskaShop"><h1>Your shopping cart is empty!</h1></div>`);
        $("#btnClear").slideToggle();
    }
    else{
        displayCartData();
        generateTable(productInfo);
    }
    });
    var productsCartLS=getLS("cart");
    //funkcija za dohvatanje proizvoda za korpu
    
    
    function displayCartData(){
        productInfo=getLS("sviProizvodi");
        //console.log(productInfo);
        productInfo=productInfo.filter(p=>{
            for(let product of productsCartLS){
                if(p.id == product.id){
                    p.quantity=product.qty;
                    return true;
                }
            }
        })
        //console.log(productInfo);
    }
    
    function generateTable(){
        let html=`
        <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Product</th>
          <th scope="col">Image</th>
          <th scope="col">Qty</th>
          <th scope="col">Price</th>
          <th scope="col">Total</th>
          <th scope="col">Remove</th>
        </tr>
      </thead>
      <tbody>`
      let total=0;
      for(let p of productInfo){
        html+=`    
                <tr>
                    <th scope="row">${p.name}</th>
                    <td><img src="assets/img/gallery/${p.img}" alt="${p.name}" class="image-cart"/></td>
                    <td>${p.quantity}</td>
                    <td>$${p.price}</td>
                    <td>$${parseFloat(p.price)*p.quantity}</td>
                    <td><button onclick="removeFromCart(${p.id})" class="btn" value="remove">remove</button></td>
                </tr>`
        total+=parseInt((p.price)*p.quantity);
      }
      //console.log(total);
       $("#cart-sum").html(`<p class="text-center">total: $${total}</p>`);
        html+=`
        </tbody>
        </table>
        `
        $("#products").html(html);
    }
    function removeFromCart(id){
        let korpa=getLS("cart");
        let filtered=korpa.filter(p=>p.id != id);
        setLS("cart",filtered);
        displayCartData();
        printNumberOfProducts();
        location.reload();
    }
    
    var quantity=0;
    function printNumberOfProducts(){
        let productsCart = getLS("cart");
        if(productsCart == null){
            $("#broj-proizvoda").html("(0 products)");
           // console.log("problem?");
        }
        else{
                quantity=productsCart.length;
            let numberOfProducts = quantity;
            let txt = quantity+" ";
    
            if(numberOfProducts == 1){
                txt = quantity+" "+"product";
            }
            else{
                txt =quantity+" products";
            }
            setLS("brojProizvodaLS",txt);
            $("#broj-proizvoda").html(`${txt}`)
        }
    }