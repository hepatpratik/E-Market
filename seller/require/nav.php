<div class="left-part" id="lft">
    <div class="logo">
        <a href="javascript:void(0)">
            <img src="assets/images/sellerlogo.png" alt="logo" />
        </a>
        <svg viewBox="0 0 339.4 75.201" xmlns="http://www.w3.org/2000/svg">
            <g id="svgGroup" stroke-linecap="round" fill-rule="evenodd" font-size="19pt" stroke="#000"
                stroke-width="0.25mm" fill="none" style="
                stroke: rgb(255, 255, 255);
                stroke-width: 0.35mm;
                fill: #fff;
              ">
               
            </g>
        </svg>
        <div class="close-left-nav" onclick="close_res_nav()">
            <i class="uil uil-times"></i>
        </div>
    </div>
    <div class="list-nav">
        <ul class="nav-list">
            <?php 
                if(profile_completed($con)==1 && profle_verified($con)==1){
            ?>
            <li class="outer-list">
                <a href="index.php">
                    <i class="uil uil-estate"></i>
                    <span>Dashbaord</span>
                </a>
            </li>
            <li class="outer-list">
                <a href="product.php">
                    <i class="uil uil-box"></i>
                    <span>Product</span>
                </a>
            </li>
            <li class="outer-list">
                <a href="order_received.php">
                    <i class="uil uil-archive"></i>
                    <span>Order Received &nbsp; <span style="color:red;font-size:1.2rem;font-weight:700"></span></span>
                </a>
            </li>
           
        
            <li class="outer-list">
                <a href="delivery_c.php">
                    <i class="uil uil-voicemail-rectangle"></i>
                    <span>Delivery Confirmation</span>
                </a>
            </li>
            <li class="outer-list">
                <a href="delivered.php">
                    <i class="uil uil-gift"></i>
                    <span>Delivered</span>
                </a>
            </li>
   
            
            <?php }else{  ?>

            <li class="outer-list">
                <a href="index.php">
                    <i class="uil uil-estate"></i>
                    <span>Dashbaord</span>
                </a>
            </li>

            <?php } ?>
        </ul>
    </div>
    <div class="copyright">
        <p>E market for Self Help Group</p>
    </div>
</div>