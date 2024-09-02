<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <script src="https://kit.fontawesome.com/44f557ccce.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

    <title>PizzaKnaller</title>
</head>
<body>
  
    <!--=================================== section1 =======================================-->
    <section class="section1">
        <div class="container">
          <label class="hamburger-menu">
            <input type="checkbox"/>
          </label>
          <aside class="sidebar">
            <nav class="sidebar-nav">
              <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
            </nav>
          </aside>
        
            <div class="navbar">
                <nav>  
                    <ul class="nav-links">
                        <div class="logo">
                        <img src="images/Logo.jpg" alt="Logo" style="width: 100px; height: auto;">
                    </div>
                        <li><a href="menu.html">Menu</a></li>
                        <li><a href="contact.html">Contact us</a></li>
                        <li><a href="limited-offers.html">Limited offers </a></li>
                        <li><a href="account.html">Account</a></li>
                        <li class="icon-link">
                            <span class="icon-container">
                                <i class="ri-shopping-bag-fill ri-2x"></i>
                            </span>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <div class="weeklySpecial"></div>
            <div class="weeklySpecialInfo"> 
<h1>Order, Eat 
& <span style="color: #fc902bfb;">Enjoy</span> 
The <span style="color: #fc902bfb;">Taste</span></h1>
<p>Food tastes better when you share it with your family and friends.</p> 
            
               
            <button class="placeOrder">place order</button>   <button class="getStarted">get started</button>
            </div>
          
    </section>
    <section class="section2">
    <div class="container">
        <div class="specialRecipesInfo">
            <h1>Our Special Recipes</h1>
            <p>These are our top recipes considering the taste and price our customers claimed to be perfect!</p>
        </div>
        <div class="specialRecipes">
            <div class="carousel" data-flickity='{ "freeScroll": true, "wrapAround": true }'>
                <?php include 'db_connection.php'; // Include the PHP script here ?>

                <?php
                // Fetch pizza data from the database
                $stmt = $pdo->query('SELECT * FROM products');

                // Check if there are pizzas available
                if ($stmt->rowCount() > 0) {
                    // Start generating HTML for each pizza
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div class="carousel-cell">';
                        echo '<img src="images/' . $row['image'] . '" alt="' . $row['name'] . '">';
                        echo '<div class="cell-info">';
                        echo '<h1>' . $row['name'] . '</h1>';
                        echo '<button>toppings</button>';
                        echo '<p>' . $row['description'] . '</p>'; // Add description from database
                        echo '</div>';
                        echo '<div class="rating-carousel">';
                        // Add star ratings here if available in database
                        echo '</div>';
                        echo '<div class="cell-order">';
                        echo '<button>Order</button> <p>€' . $row['price'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    // Display a message if there are no pizzas available
                    echo 'No pizzas available.';
                }
                ?>
            </div>
        </div>
    </div>
</section>

    <!--=================================== section3 =======================================-->
    <section class="section3">
        <div class="container">
            <div class="ourMenuImg"></div>
            <div class="ourMenu"><h1>Our Menu:</h1>
                <p>Our menu features a wide variety of pizzas, 
                from classic margarita to our signature BBQ chicken pizza. We also offer a selection of salads, 
                appetizers, and desserts to complement your meal. All of our pizzas are available in small, medium, 
                and large sizes, 
                so you can order the perfect amount for your group
                <button class="seeMenu">see menu</button> </p> 
        </div>
    </div>
    </section>
    <!--=================================== section4 =======================================-->
    <section class="section4">
        <div class="container">
          <div class="ourServices">
            <div class="box box1">
              <img src="images/orderfood.png" alt="Image 1">
              <h2>Order Food !</h2>
              <p>As easy as never ever before ! Now with our advanced stuff, ordering food it’s a piece of cake ! Also you can order online, something even easier with our brand new website !
              </p>
            </div>
            <div class="box box2">
              <img src="images/wedeliver.png" alt="Image 2">
              <h2>We Deliver !</h2>
              <p>We deliver your food if you are taking it away or just seat, relax and have it on your table when ready !</p>
            </div>
            <div class="box box3">
                <img src="images/enjoyfood.png" alt="Image 3" style="height: 90px;">
                <h2>Enjoy Your Food !</h2>
                <p>As soon as you get your food you can enjoy it till the last piece of it and come back soon for another one !</p>
              </div>
          </div>
        </div>
      </section>
      <!--=================================== section5 =======================================-->
    <section class="section5">
        <div class="container">
            <div class="chefInfo">
                <h2>Cooked by the best <br> Chefs in the world:</h2>
                <p>There are many benefits regarding to <br>
                    that but the main ones are:
                </p>
                <div class="checklist">
                    <div class="checklist-item">
                      <h1 class="checkbox"><i class="ri-checkbox-line"></i></h1>
                      <p>Perfect Taste</p>
                    </div>
                    <div class="checklist-item">
                      <h1 class="checkbox"><i class="ri-checkbox-line"></i></h1>
                      <p>Done Quickly</p>
                    </div>
                    <div class="checklist-item">
                      <h1 class="checkbox"><i class="ri-checkbox-line"></i></h1>
                      <p>Food Guaranteed Hygenic</p>
                    </div>
                </div>    
            </div>
            <div class="chefImg"></div>
          </div>
    </section>
    <!--=================================== section6 =======================================-->
    <section class="section6">
        <div class="container">
            <div class="reviewTexts">
                <div class="rev-section">

                    <h2 class="title">Reviews</h2>
                    
                    <div class="reviews">
                    
                    <div class="review">
                       <div class="head-review">
                          <img src="images/review-removebg-preview.png" width="250px">
                       </div>
                       <div class="body-review">
                          <div class="name-review">Sam.B</div>
                          <div class="place-review">Germany</div>
                          <div class="rating">
                             <i class="fas fa-star"></i>
                             <i class="fas fa-star"></i>
                             <i class="fas fa-star"></i>
                             <i class="fas fa-star"></i>
                             <i class="fas fa-star-half"></i>
                          </div>
                          <div class="desc-review">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati eligendi suscipit illum officia ex eos.</div>
                       </div>
                    </div>
                    <div class="review">
                       <div class="head-review">
                          <img src="images/review-removebg-preview.png" width="250px">
                       </div>
                       <div class="body-review">
                          <div class="name-review">Rose.F</div>
                          <div class="place-review">Paris</div>
                          <div class="rating">
                             <i class="fas fa-star"></i>
                             <i class="fas fa-star"></i>
                             <i class="fas fa-star"></i>
                             <i class="fas fa-star"></i>
                             <i class="fas fa-star"></i>
                          </div>
                          <div class="desc-review">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati eligendi suscipit illum officia ex eos.</div>
                       </div>
                    </div>
                    <div class="review">
                       <div class="head-review">
                          <img src="images/review-removebg-preview.png" width="250px">
                       </div>
                       <div class="body-review">
                          <div class="name-review">Harry.H</div>
                          <div class="place-review">New York</div>
                          <div class="rating">
                             <i class="fas fa-star"></i>
                             <i class="fas fa-star"></i>
                             <i class="fas fa-star"></i>
                             <i class="fas fa-star"></i>
                             <i class="fas fa-star-half"></i>
                          </div>
                          <div class="desc-review">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati eligendi suscipit illum officia ex eos.</div>
                       </div>
                    </div>                   
                    </div>
                </div>
          </div>
    </section>
    <!--=================================== footer =======================================-->
    <section class="section7">
        <div class="container">
            <div class="footer"></div>
          </div>
    </section>

<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="script.js"></script>
</body> 
</html>