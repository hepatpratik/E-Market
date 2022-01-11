
<?php require('require/top.php'); ?>

<?php require('slider.php');?>



<?php
 if(isset($_GET['utm_source']) || isset($_SESSION['utm_source'])){
     $s='';
     if(isset($_SESSION['utm_source']) && !isset($_GET['utm_source'])){
        $s=$_SESSION['utm_source'];
     }else{
         $s=$_GET['utm_source'];
     }
     verify_source($con,$s);
     $featured=get_featured_products($con);
    //  prx($featured);
?>
<section class="defaultPadding mt4">
    <div class="container mrlAuto">
        <div class="heading">
            <span>For You</span>
            <h2>Top Featured Products</h2>
        </div>
        <div class="row mt3 ct-row">
            <div class="owl-carousel owl-theme product-slider">
                <?php
                    if(count($featured)>0){
                        foreach($featured as $product){
                    ?>
                <div class="item">
                    <div class="productBox">
                        <a href="javascript:void(0)" class="product-image">
                            <img src="media/product/<?php echo $product['img1']; ?>" alt="product" />
                            <div class="topOption">
                                <span class="offer"><?php
                                 $offn=($product['fa']*100)/$product['price'];
                                 $off=round(100-$offn);
                                 echo $off.'%';
                                ?></span>
                                <?php
                            if(!isset($_SESSION['USER_LOGIN'])){
                            ?>
                                <span class="wishlist" onclick="addwish(<?php echo $product['id']; ?>)">
                                    <i class="uil uil-heart"></i>
                                </span>
                                <?php
                            }else{
                                $pid=$product['id'];
                                $uid=$_SESSION['USER_ID'];
                                $n=mysqli_num_rows(mysqli_query($con,"select * from wishlist where u_id='$uid' and p_id='$pid'"));
                                if($n>0){
                                    ?>
                                    <span class="wishlist" onclick="gowish()">
                                        <i class="uil uil-heart"></i>
                                    </span>
                                    <?php
                                }else{
                                    ?>
                                    <span class="wishlist" onclick="addwish(<?php echo $product['id']; ?>)">
                                        <i class="uil uil-heart"></i>
                                    </span>
                                    <?php
                                }
                            }
                            ?>
                            </div>
                        </a>
                        <div class="product-detail">
                            <p><?php
                             if($product['qty']>0){
                                  echo "Available(In Stock)"; 
                            }else{
                                echo "Unavailable(Out of Stock)";
                            } ?></p>
                            <h4 style="cursor:pointer" onclick="control.redirect('product_detail.php?pid=<?php echo $product['id'] ?>')"><?php echo $product['product_name']; ?></h4>
                            <div class="price">&#8377;<?php echo $product['fa']; ?>
                                <span>&#8377;<?php echo $product['price']; ?></span>
                            </div>
                            <div class="cartqt">
                                <?php

                                if(!isset($_SESSION['USER_LOGIN'])){
                                    if(isset($_SESSION['USER_CART'])){
                                        if(in_array($product['id'],$_SESSION['USER_CART'])){
                                            $index=array_search($product['id'],$_SESSION['USER_CART']);
                                        ?>
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus minus-btn" onclick="decrement(this)" />
                                    <input type="number" name="quantity"
                                        value="<?php echo $_SESSION['CART_QTY'][$index]; ?>" class="qty-text" />
                                    <input type="button" value="+" class="plus plus-btn" onclick="increment(this)" />
                                </div>
                                <div class="ct-icon" onclick="go_to_cart()">
                                    <i class="uil uil-shopping-cart-alt"></i>
                                </div>
                                <?php
                                        }else{
                                        ?>
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus minus-btn" onclick="decrement(this)" />
                                    <input type="number" name="quantity" value="1" class="qty-text" />
                                    <input type="button" value="+" class="plus plus-btn" onclick="increment(this)" />
                                </div>
                                <div class="ct-icon" onclick="add_cart(<?php echo $product['id']; ?>,this)">
                                    <i class="uil uil-shopping-cart-alt"></i>
                                </div>
                                <?php
                                        }
                                    }else{
                                    ?>
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus minus-btn" onclick="decrement(this)" />
                                    <input type="number" name="quantity" value="1" class="qty-text" />
                                    <input type="button" value="+" class="plus plus-btn" onclick="increment(this)" />
                                </div>
                                <div class="ct-icon" onclick="add_cart(<?php echo $product['id']; ?>,this)">
                                    <i class="uil uil-shopping-cart-alt"></i>
                                </div>
                                <?php
                                    }
                                }else{
                                $p_idd=$product['id'];
                                $u_id=$_SESSION['USER_ID'];
                                $query="select cart.u_id,cart_detail.qty from cart,cart_detail where cart.u_id='$u_id' and cart_detail.p_id='$p_idd' and cart_detail.cart_id=cart.id";
                                $rs=mysqli_query($con,$query);
                                $i=mysqli_num_rows($rs);
                                if($i>0){
                                    $g=mysqli_fetch_assoc($rs);
                                    ?>

                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus minus-btn" onclick="decrement(this)" />
                                    <input type="number" name="quantity" value="<?php echo $g['qty'] ?>"
                                        class="qty-text" />
                                    <input type="button" value="+" class="plus plus-btn" onclick="increment(this)" />
                                </div>
                                <div class="ct-icon" onclick="go_to_cart()">
                                    <i class="uil uil-shopping-cart-alt"></i>
                                </div>

                                <?php
                                }else{
                                ?>
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus minus-btn" onclick="decrement(this)" />
                                    <input type="number" name="quantity" value="1" class="qty-text" />
                                    <input type="button" value="+" class="plus plus-btn" onclick="increment(this)" />
                                </div>
                                <div class="ct-icon" onclick="add_cart(<?php echo $product['id']; ?>,this)">
                                    <i class="uil uil-shopping-cart-alt"></i>
                                </div>
                                <?php
                                }
                            }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div>
    </div>
</section>


<section class="defaultPadding mt4">
    <div class="container mrlAuto">
        <div class="heading">
            <span>For You</span>
            <h2>New Products</h2>
        </div>
        <div class="row mt3 ct-row">
            <div class="owl-carousel owl-theme product-slider">
                <?php
                    if(count($featured)>0){
                        foreach($featured as $product){
                    ?>
                <div class="item">
                    <div class="productBox">
                        <a href="javascript:void(0)" class="product-image">
                            <img src="media/product/<?php echo $product['img1']; ?>" alt="product" />
                            <div class="topOption">
                                <span class="offer"><?php
                                 $offn=($product['fa']*100)/$product['price'];
                                 $off=round(100-$offn);
                                 echo $off.'%';
                                ?></span>
                                <?php
                            if(!isset($_SESSION['USER_LOGIN'])){
                            ?>
                                <span class="wishlist" onclick="addwish(<?php echo $product['id']; ?>)">
                                    <i class="uil uil-heart"></i>
                                </span>
                                <?php
                            }else{
                                $pid=$product['id'];
                                $uid=$_SESSION['USER_ID'];
                                $n=mysqli_num_rows(mysqli_query($con,"select * from wishlist where u_id='$uid' and p_id='$pid'"));
                                if($n>0){
                                    ?>
                                    <span class="wishlist" onclick="gowish()">
                                        <i class="uil uil-heart"></i>
                                    </span>
                                    <?php
                                }else{
                                    ?>
                                    <span class="wishlist" onclick="addwish(<?php echo $product['id']; ?>)">
                                        <i class="uil uil-heart"></i>
                                    </span>
                                    <?php
                                }
                            }
                            ?>
                            </div>
                        </a>
                        <div class="product-detail">
                            <p><?php
                             if($product['qty']>0){
                                  echo "Available(In Stock)"; 
                            }else{
                                echo "Unavailable(Out of Stock)";
                            } ?></p>
                            <h4 style="cursor:pointer" onclick="control.redirect('product_detail.php?pid=<?php echo $product['id'] ?>')"><?php echo $product['product_name']; ?></h4>
                            <div class="price">&#8377;<?php echo $product['fa']; ?>
                                <span>&#8377;<?php echo $product['price']; ?></span>
                            </div>
                            <div class="cartqt">
                                <?php

                                if(!isset($_SESSION['USER_LOGIN'])){
                                    if(isset($_SESSION['USER_CART'])){
                                        if(in_array($product['id'],$_SESSION['USER_CART'])){
                                            $index=array_search($product['id'],$_SESSION['USER_CART']);
                                        ?>
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus minus-btn" onclick="decrement(this)" />
                                    <input type="number" name="quantity"
                                        value="<?php echo $_SESSION['CART_QTY'][$index]; ?>" class="qty-text" />
                                    <input type="button" value="+" class="plus plus-btn" onclick="increment(this)" />
                                </div>
                                <div class="ct-icon" onclick="go_to_cart()">
                                    <i class="uil uil-shopping-cart-alt"></i>
                                </div>
                                <?php
                                        }else{
                                        ?>
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus minus-btn" onclick="decrement(this)" />
                                    <input type="number" name="quantity" value="1" class="qty-text" />
                                    <input type="button" value="+" class="plus plus-btn" onclick="increment(this)" />
                                </div>
                                <div class="ct-icon" onclick="add_cart(<?php echo $product['id']; ?>,this)">
                                    <i class="uil uil-shopping-cart-alt"></i>
                                </div>
                                <?php
                                        }
                                    }else{
                                    ?>
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus minus-btn" onclick="decrement(this)" />
                                    <input type="number" name="quantity" value="1" class="qty-text" />
                                    <input type="button" value="+" class="plus plus-btn" onclick="increment(this)" />
                                </div>
                                <div class="ct-icon" onclick="add_cart(<?php echo $product['id']; ?>,this)">
                                    <i class="uil uil-shopping-cart-alt"></i>
                                </div>
                                <?php
                                    }
                                }else{
                                $p_idd=$product['id'];
                                $u_id=$_SESSION['USER_ID'];
                                $query="select cart.u_id,cart_detail.qty from cart,cart_detail where cart.u_id='$u_id' and cart_detail.p_id='$p_idd' and cart_detail.cart_id=cart.id";
                                $rs=mysqli_query($con,$query);
                                $i=mysqli_num_rows($rs);
                                if($i>0){
                                    $g=mysqli_fetch_assoc($rs);
                                    ?>

                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus minus-btn" onclick="decrement(this)" />
                                    <input type="number" name="quantity" value="<?php echo $g['qty'] ?>"
                                        class="qty-text" />
                                    <input type="button" value="+" class="plus plus-btn" onclick="increment(this)" />
                                </div>
                                <div class="ct-icon" onclick="go_to_cart()">
                                    <i class="uil uil-shopping-cart-alt"></i>
                                </div>

                                <?php
                                }else{
                                ?>
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus minus-btn" onclick="decrement(this)" />
                                    <input type="number" name="quantity" value="1" class="qty-text" />
                                    <input type="button" value="+" class="plus plus-btn" onclick="increment(this)" />
                                </div>
                                <div class="ct-icon" onclick="add_cart(<?php echo $product['id']; ?>,this)">
                                    <i class="uil uil-shopping-cart-alt"></i>
                                </div>
                                <?php
                                }
                            }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div>
    </div>
</section>
<?php
    }else{

    ?>

<section class="defaultPadding mt4">
    <div class="container mrlAuto">
        <div class="heading">
            <h2>Please select a location to browse products</h2>
        </div>
    </div>
</section>
<?php

    }
?>


<?php require('require/foot.php'); ?>
<?php require('require/csOwl.php'); ?>
<?php require('require/last.php'); ?>