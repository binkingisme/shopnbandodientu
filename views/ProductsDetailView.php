<?php 
  //load LayoutTrangChu.php
  $this->layoutPath = "LayoutTrangTrong.php";

  // Open Graph: require config + helper, build product data từ $record và lưu meta vào $this->og_meta
  require_once __DIR__ . '/../config.php';
  require_once __DIR__ . '/../libs/og.php';

  if (isset($record)) {
      // tính giá sau giảm (numeric)
      $discount = isset($record->discount) ? $record->discount : 0;
      $priceRaw = isset($record->price) ? $record->price : 0;
      $finalPrice = $priceRaw - ($priceRaw * $discount / 100);

      $product = [
          'id' => isset($record->id) ? $record->id : '',
          'name' => isset($record->name) ? $record->name : '',
          'description' => !empty(trim(strip_tags(@$record->description))) ? strip_tags($record->description) : strip_tags(@$record->content),
          'image' => !empty($record->photo) ? 'assets/upload/products/' . $record->photo : '',
          'price' => $finalPrice
      ];

      // capture output của render_product_og_tags vào property controller ($this->og_meta)
      ob_start();
      render_product_og_tags($product);
      $this->og_meta = ob_get_clean();
  }
?>
<div class="top">
  <div class="row">
    <div class="col-xs-12 col-md-6 product-image">
      <div class="featured-image"> 
        <img src="assets/upload/products/<?php echo $record->photo; ?>" style="width: 100%;" class="img-responsive"/>
      </div>
      <!--
      <div class="box-image">
        <ul>
          <li><img src="assets/upload/products/132195017985165066_1.jpg" id="img-1"></li>
          <li><img src="assets/upload/products/132195018346013007_2.jpg" id="img-2"></li>
          <li><img src="assets/upload/products/132195018673480610_3.jpg" id="img-3"></li>
          <li><img src="assets/upload/products/132195019156699102_4.jpg" id="img-4"></li>
          <li><img src="assets/upload/products/132195019983557925_6.jpg" id="img-5"></li>
          <li><img src="assets/upload/products/132195020344748063_7.jpg" id="img-6"></li>
        </ul>
      </div>
      -->
      <script type="text/javascript">
        $(document).ready(function(){
          //---
          $("#img-1").click(function(){
            $(".featured-image img").fadeOut(function(){
                  //lay duong dan cua id=img-1
                  var srcImg = $("#img-1").attr("src");
                  $(".featured-image img").attr("src",srcImg);
                  $(".featured-image img").fadeIn();
                });                                
          });
          //---
          //---
          $("#img-2").click(function(){
            $(".featured-image img").fadeOut(function(){
                  //lay duong dan cua id=img-2
                  var srcImg = $("#img-2").attr("src");
                  $(".featured-image img").attr("src",srcImg);
                  $(".featured-image img").fadeIn();
                });                                
          });
          //---
          //---
          $("#img-3").click(function(){
            $(".featured-image img").fadeOut(function(){
                  //lay duong dan cua id=img-3
                  var srcImg = $("#img-3").attr("src");
                  $(".featured-image img").attr("src",srcImg);
                  $(".featured-image img").fadeIn();
                });                                
          });
          //---
          //---
          $("#img-4").click(function(){
            $(".featured-image img").fadeOut(function(){
                  //lay duong dan cua id=img-4
                  var srcImg = $("#img-4").attr("src");
                  $(".featured-image img").attr("src",srcImg);
                  $(".featured-image img").fadeIn();
                });                                
          });
          //---
          //---
          $("#img-5").click(function(){
            $(".featured-image img").fadeOut(function(){
                  //lay duong dan cua id=img-5
                  var srcImg = $("#img-5").attr("src");
                  $(".featured-image img").attr("src",srcImg);
                  $(".featured-image img").fadeIn();
                });                                
          });
          //---
          //---
          $("#img-6").click(function(){
            $(".featured-image img").fadeOut(function(){
                  //lay duong dan cua id=img-6
                  var srcImg = $("#img-6").attr("src");
                  $(".featured-image img").attr("src",srcImg);
                  $(".featured-image img").fadeIn();
                });                                
          });
          //---
        });
      </script>
      <style type="text/css">
        .box-image ul{padding:0px; margin:0px; list-style: none;}
        .box-image ul li{display: inline; margin-right: 10px;;}
        .box-image img{width: 50px; border:1px solid #dddddd; margin-bottom: 10px; cursor: pointer;}
      </style>
    </div>
    <div class="col-xs-12 col-md-6 info">
      <h1 itemprop="name"><?php echo $record->name; ?></h1>
      <p class="vendor"> Category:&nbsp; <span> <?php echo $this->getCategory($record->category_id); ?> </span></p>
      <p itemprop="price" class="price-box product-price-box"> <span class="special-price"> <span class="price product-price" style="text-decoration:line-through;"> <?php echo number_format($record->price); ?>₫ </span></span></p>
      <p itemprop="price" class="price-box product-price-box"> <span class="special-price"> <span class="price product-price"> <?php echo number_format($record->price-($record->price*$record->discount)/100); ?>₫ </span></span></p>
    </p>
    <a href="index.php?controller=cart&action=create&id=<?php echo $record->id; ?>" class="btn btn-primary">Cho vào giỏ hàng</a>

    <!-- Share buttons -->
    <?php
      // build absolute product URL cho nút share
      $productUrl = rtrim(BASE_URL, '/') . '/index.php?controller=products&action=detail&id=' . urlencode($record->id);
      $productNameJs = json_encode($record->name);
      $productUrlJs = json_encode($productUrl);
    ?>
    <div class="product-share" style="margin-top:12px;">
      <button id="btnShareFb" class="btn btn-primary" type="button" aria-label="Share to Facebook">Chia sẻ lên Facebook</button>
      <button id="btnShareIg" class="btn btn-instagram" type="button" aria-label="Share to Instagram">Chia sẻ lên Instagram</button>
      <button id="btnCopyLink" class="btn btn-default" type="button" aria-label="Sao chép liên kết">Sao chép liên kết</button>
    </div>
    <style>
      .btn-instagram{ background: #E1306C; color:#fff; border-color: #E1306C; margin-left:8px; }
      .product-share .btn{ margin-right:6px; }
    </style>

    <script type="text/javascript">
      (function(){
        var productUrl = <?php echo $productUrlJs; ?>;
        var productName = <?php echo $productNameJs; ?>;

        // Facebook: mở sharer.php (preview dùng Open Graph meta)
        document.getElementById('btnShareFb').addEventListener('click', function(e){
          var url = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(productUrl);
          window.open(url, 'fbshare', 'width=600,height=400');
        });
        
        // Instagram: dùng Web Share API nếu có (sẽ hiện Instagram trong share sheet trên mobile nếu cài)
        document.getElementById('btnShareIg').addEventListener('click', function(e){
          if (navigator.share) {
            navigator.share({
              title: productName,
              text: productName,
              url: productUrl
            }).catch(function(err){
              // không cần xử lý
            });
          } else {
            // fallback: copy link và hướng dẫn người dùng dán trong Instagram (story hoặc bio)
            copyToClipboard(productUrl).then(function(){
              alert('Liên kết sản phẩm đã được sao chép. Mở Instagram và dán liên kết trong mô tả bài hoặc story (nếu có chức năng).');
            }).catch(function(){
              // fallback 2: mở product URL để người dùng sử dụng chia sẻ app
              window.open(productUrl, '_blank');
            });
          }
        });
        
        // Copy link button
        document.getElementById('btnCopyLink').addEventListener('click', function(){
          copyToClipboard(productUrl).then(function(){
            alert('Đã sao chép liên kết sản phẩm vào clipboard.');
          }).catch(function(){
            prompt('Sao chép liên kết sản phẩm:', productUrl);
          });
        });

        // hàm copy an toàn
        function copyToClipboard(text){
          if (navigator.clipboard && navigator.clipboard.writeText) {
            return navigator.clipboard.writeText(text);
          }
          return new Promise(function(resolve, reject){
            var textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.style.position = 'fixed';
            textarea.style.left = '-9999px';
            document.body.appendChild(textarea);
            textarea.select();
            try {
              var ok = document.execCommand('copy');
              document.body.removeChild(textarea);
              if (ok) resolve();
              else reject();
            } catch (err) {
              document.body.removeChild(textarea);
              reject(err);
            }
          });
        }
      })();
    </script>

    <!-- rating -->
    <div style="border:1px solid #dddddd; margin-top: 15px;">
      <h4 style="padding-left: 10px;">Rating</h4>
      <table style="width: 100%;">
        <tr>
          <td style="width: 80%; padding-left: 10px;"><img src="assets/frontend/images/star.jpg"></td>
          <td><span class="label label-primary"><?php echo $this->getStar($record->id,1); ?> vote</span></td>
        </tr>
        <tr>
          <td style="width: 80%; padding-left: 10px;"><img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"></td>
          <td><span class="label label-warning"><?php echo $this->getStar($record->id,2); ?> vote</span></td>
        </tr>
        <tr>
          <td style="width: 80%; padding-left: 10px;"><img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"></td>
          <td><span class="label label-danger"><?php echo $this->getStar($record->id,3); ?> vote</span></td>
        </tr>
        <tr>
          <td style="width: 80%; padding-left: 10px;"><img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"></td>
          <td><span class="label label-info"><?php echo $this->getStar($record->id,4); ?> vote</span></td>
        </tr>
        <tr>
          <td style="width: 80%; padding-left: 10px;"><img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"></td>
          <td><span class="label label-success"><?php echo $this->getStar($record->id,5); ?> vote</span></td>
        </tr>
      </table>
      <br>
    </div>
    <!-- /rating -->
  </div>  
</div>
<div class="middle" style="padding-top: 20px;">
  <?php echo $record->description; ?>
  <?php echo $record->content; ?>
</div>