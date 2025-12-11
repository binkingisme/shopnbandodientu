 <!doctype html>
<!--[if !IE]><!-->
<html lang="vi">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta http-equiv="content-language" content="vi" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="robots" content="noodp,index,follow" />
<meta name='revisit-after' content='1 days' />
<meta name="keywords" content="">
<title>Media Mart</title>
<link rel="canonical" href="index.html">
<link rel="shortcut icon" href="assets/frontend/100/047/633/themes/517833/assets/favicon221b.png" type="image/x-icon" />
<!-- <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=vietnamese" rel="stylesheet"> -->
<link href='assets/frontend/100/047/633/themes/517833/assets/font-awesome.min221b.css?1481775169361' rel='stylesheet' type='text/css' />
<link href='assets/frontend/100/047/633/themes/517833/assets/bootstrap.min221b.css?1481775169361' rel='stylesheet' type='text/css' />
<link href='assets/frontend/100/047/633/themes/517833/assets/owl.carousel221b.css?1481775169361' rel='stylesheet' type='text/css' />
<link href='assets/frontend/100/047/633/themes/517833/assets/responsive221b.css?1481775169361' rel='stylesheet' type='text/css' />
<link href='assets/frontend/100/047/633/themes/517833/assets/styles.scss221b.css?1481775169361' rel='stylesheet' type='text/css' />
<!-- Mailchimp embed stylesheet (recommended) -->
<link href="https://cdn-images.mailchimp.com/embedcode/classic-061523.css" rel="stylesheet" type="text/css" />
<script src='assets/frontend/100/047/633/themes/517833/assets/jquery.min221b.js?1481775169361' type='text/javascript'></script>
<script src='assets/frontend/100/047/633/themes/517833/assets/bootstrap.min221b.js?1481775169361' type='text/javascript'></script>
<script src='assets/frontend/assets/themes_support/api.jquerya87f.js?4' type='text/javascript'></script>
<link href='assets/frontend/100/047/633/themes/517833/assets/bw-statistics-style221b.css?1481775169361' rel='stylesheet' type='text/css' />
</head>
<body class="index">
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/62caefdf7b967b117998e03d/1g7kbi15k';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<!-- header -->
<?php 
    //load MVC bang tay -> load file controller
    include "controllers/HeaderController.php";
    $obj = new HeaderController();
    $obj->index();
 ?>
<!-- end header -->
<div class="content">
  <div class="container">
    <h1 style="display:none;">User</h1>
    <div class="row">
      <!-- <div class="col-xs-12 col-md-3">
        <div class="row" style="margin-bottom: 5px;">
          <div class="col-md-12"><img src="assets/frontend/images/anhle1.jpg" class="img-thumbnail"></div>
        </div>
        <div class="row" style="margin-bottom: 5px;">
          <div class="col-md-12"><img src="assets/frontend/images/anhle2.jpg" class="img-thumbnail"></div>
        </div>
        <div class="row">
          <div class="col-md-12"><img src="assets/frontend/images/anhle3.jpg" class="img-thumbnail"></div>
        </div>
      </div> -->
      <!-- class="col-md-9" -->
      <div > 
        <!-- slide -->
        <div class="owl-slider">
        
          <div class="item" > 
            <!-- ============================ -->
            <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
              </ol>
              
              <!-- Wrapper for slides -->
              <div class="carousel-inner">
                <div class="item active"> <img src="assets/frontend/images/anhbia2.jpg" alt="Los Angeles"> </div>
                <div class="item"> <img src="assets/frontend/images/anhbia3.jpg" alt="Los Angeles"> </div>
                <div class="item"> <img src="assets/frontend/images/anhbia.jpg" alt="Chicago"> </div>
                <!-- <div class="item"> <img src="assets/frontend/images/anhbia4.jpg" alt="New York"> </div> -->
              </div>
              
              <!-- Left and right controls --> 
            </div>
            <!-- ============================ --> 
          </div>
        </div>
        <!-- end slide --> 
      </div>
    </div>

   

    <div class="row">
      <div class="col-xs-12 col-md-12"> 
        <!-- main -->
        
        <?php echo $this->view; ?> 
        
        <!-- end main --> 
      </div>
    </div>
  </div>
</div>
<!-- <div class="privacy">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-4">
        <div class="image"> <img src="assets/frontend/100/047/633/themes/517833/assets/ico-service-1221b.png?1481775169361" alt="Giao hàng miễn phí" title="Giao hàng miễn phí" class="img-responsive"> </div>
        <div class="info">
          <h3>Giao hàng miễn phí</h3>
          <p>Miễn phí giao hàng trong nội thành Hà Nội</p>
        </div>
      </div>
      <div class="col-xs-12 col-sm-4">
        <div class="image"> <img src="assets/frontend/100/047/633/themes/517833/assets/ico-service-2221b.png?1481775169361" class="img-responsive" alt="Khuyến mại" title="Khuyến mại"> </div>
        <div class="info">
          <h3>Khuyến mại</h3>
          <p>Khuyến mại sản phẩm nếu đơn hàng trên 1.000.000đ</p>
        </div>
      </div>
      <div class="col-xs-12 col-sm-4">
        <div class="image"> <img src="assets/frontend/100/047/633/themes/517833/assets/ico-service-3221b.png?1481775169361" class="img-responsive" alt="Hoàn trả lại tiền" title="Hoàn trả lại tiền"> </div>
        <div class="info">
          <h3>Hoàn trả lại tiền</h3>
          <p>Nếu sản phẩm không đảm bảo chất lượng hoặc sản phẩm không đúng miêu tả</p>
        </div>
      </div>
    </div>
  </div>
</div> -->

 <!-- Mailchimp signup: placed on homepage under slider -->
    <div class="row" style="margin-top:18px;">
      <div class="col-xs-12 col-md-6 col-md-offset-3">
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Đăng ký nhận bản tin</strong></div>
          <div class="panel-body">
            <div id="mc_embed_signup">
              <form action="https://gmail.us1.list-manage.com/subscribe/post?u=0020cce5e7af159df51865d11&amp;id=0fe275917d&amp;f_id=003e40e1f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">
                  <h4 style="margin-top:0;margin-bottom:12px;">Subscribe</h4>
                  <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
                  <div class="mc-field-group" style="margin-top:8px;">
                    <label for="mce-EMAIL">Email Address <span class="asterisk">*</span></label>
                    <input type="email" name="EMAIL" class="required email form-control" id="mce-EMAIL" required value="">
                  </div>
                  <div class="mc-field-group" style="margin-top:8px;">
                    <label for="mce-LNAME">Last Name </label>
                    <input type="text" name="LNAME" class="text form-control" id="mce-LNAME" value="">
                  </div>

                  <div id="mce-responses" class="clear" style="margin-top:10px;">
                    <div class="response" id="mce-error-response" style="display:none;color:#a94442;background:#f2dede;padding:8px;border-radius:4px;"></div>
                    <div class="response" id="mce-success-response" style="display:none;color:#3c763d;background:#dff0d8;padding:8px;border-radius:4px;"></div>
                  </div>

                  <!-- honeypot - keep hidden -->
                  <div style="position: absolute; left: -5000px;" aria-hidden="true">
                    <input type="text" name="b_0020cce5e7af159df51865d11_0fe275917d" tabindex="-1" value="">
                  </div>

                  <div class="optionalParent" style="margin-top:12px;">
                    <div class="clear">
                      <input type="submit" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary" value="Subscribe">
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end Mailchimp signup -->

<footer id="footer">
  <div class="top-footer">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-3">
          <h3>THÔNG TIN MEDIAMART</h3>
          <ul class="list-unstyled">
            <li><a href="https://mediamart.vn/he-thong-sieu-thi">Hệ thống 350 Siêu thị (8:00-21:30)</a></li>
            <li><a href="https://mediamart.vn/thong-tin-chung/gioi-thieu-cong-ty">Giới thiệu công ty</a></li>
            <li><a href="https://mediamart.vn/tuyen-dung">Tuyển dụng</a></li>
            <li><a href="https://mediamart.vn/chinh-sach-chung/quy-dinh-thanh-toan">Phương thức thanh toán</a></li>
          </ul>
        </div>
        <div class="col-xs-12 col-sm-3">
          <h3>Hỗ trợ khách hàng</h3>
          <ul class="list-unstyled">
            <li><a href="https://mediamart.vn/ho-tro-mua-hang/huong-dan-mua-hang-online">Hướng dẫn mua hàng Online</a></li>
            <li><a href="https://mediamart.vn/uu-dai-tra-gop">Mua hàng trả góp</a></li>
            <li><a href="https://mediamart.vn/chinh-sach-chung/chinh-sach-doi-tra-hang">Chính sách bảo hành, đổi trả</a></li>
            <li><a href="https://mediamart.vn/chinh-sach-chung/chinh-sach-giao-nhan">Giao hàng và lắp đặt</a></li>
            <li><a href="https://mediamart.vn/chinh-sach-chung/quy-dinh-bao-mat">Chính sách bảo mật TT cá nhân</a></li>
            <li><a href="https://tracuuhoadon.mediamart.com.vn/">In hóa đơn điện tử</a></li>
          </ul>
        </div>
        <div class="col-xs-12 col-sm-3">
          <h3>Tổng đài gọi hỗ trợ</h3>
          <ul class="list-unstyled">
            <li><a href="tel:19006788">Bán hàng: 1900 6788</a></li>
            <li><a href="tel:19006743">Bảo hành: 1900 6743</a></li>
            <li><a href="tel:19006741">Khiếu nại: 1900 6741</a></li>
          </ul>
        </div>
        <div class="col-xs-12 col-sm-3">
          <h3>Theo dõi MediaMart trên</h3>
          <ul class="list-unstyled">
            <li>
              <a style="margin-left: 10px" href="https://www.facebook.com/DienmayMediaMart" title="MediaMart Facebook Fanpage"> 
                <img src="assets/frontend/images/fb.png" alt="MediaMart Facebook Fanpage">
              </a>
              <a style="margin-left: 10px" href="https://www.youtube.com/c/CongtyMediamart" title="MediaMart Youtube Channel"> 
                <img src="assets/frontend/images/yt.png" alt="MediaMart Youtube Channel"> 
              </a>
              <a style="margin-left: 10px" href="https://www.tiktok.com/@mediamart.official" title="MediaMart Tiktok Channel"> 
                <img src="assets/frontend/images/tt.png" alt="MediaMart Tiktok Channel"> 
              </a>
            </li>
            <h3 style="margin-top: 15px">Theo dõi MediaMart trên</h3>
            <li>
              <a href="https://apps.apple.com/vn/app/mediamartvn/id1572630752" title="MediaMart iOS App"> 
                <img style="witdh: 45%"  src="https://cdn.mediamart.vn/images/menu/mediamart-ios-app_4b5435b9.png" alt="MediaMart iOS App">
              </a>
              <a href="#" title="MediaMart Android App"> 
              <img style="witdh: 45%" src="https://cdn.mediamart.vn/images/menu/mediamart-android-app_0f2f434d.png" alt="MediaMart Android App"> 
              </a>
            </li>
          </ul>
          
        </div>
      </div>
      <div class="payments-method"> <img src="assets/frontend/100/047/633/themes/517833/assets/payments-method221b.png?1481775169361" alt="Phương thức thanh toán" title="Phương thức thanh toán"> </div>
    </div>
  </div>
  <div class="bottom-footer">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-5"> © Bản quyền User</div>
        <div class="col-xs-12 col-sm-7">
          <ul class="list-unstyled">
            <li><a href="#">Trang chủ</a></li>
            <li><a href="#">Giới thiệu</a></li>
            <li><a href="#">Tin tức</a></li>
            <li><a href="#">Liên hệ</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Mailchimp validation script -->
<script src="https://s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script>
<script type="text/javascript">
(function($) {
  window.fnames = new Array(); window.ftypes = new Array();
  fnames[0]='EMAIL';ftypes[0]='email';
  fnames[2]='LNAME';ftypes[2]='text';
  fnames[1]='FNAME';ftypes[1]='text';
  fnames[3]='ADDRESS';ftypes[3]='address';
  fnames[4]='PHONE';ftypes[4]='phone';
  fnames[5]='BIRTHDAY';ftypes[5]='birthday';
  fnames[6]='COMPANY';ftypes[6]='text';
}(jQuery));
var $mcj = jQuery.noConflict(true);
</script>

<script src='assets/frontend/100/047/633/themes/517833/assets/owl.carousel.min221b.js?1481775169361' type='text/javascript'></script> 
<script src='assets/frontend/100/047/633/themes/517833/assets/responsive-menu221b.js?1481775169361' type='text/javascript'></script> 
<script src='assets/frontend/100/047/633/themes/517833/assets/elevate-zoom221b.js?1481775169361' type='text/javascript'></script> 
<script src='assets/frontend/100/047/633/themes/517833/assets/main221b.js?1481775169361' type='text/javascript'></script> 
<script src='assets/frontend/100/047/633/themes/517833/assets/ajax-cart221b.js?1481775169361' type='text/javascript'></script>
</body>
</html>