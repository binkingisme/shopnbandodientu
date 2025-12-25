<?php 
	//load LayoutTrangChu.php
	$this->layoutPath = "LayoutTrangTrong.php";
 ?>

<?php if(isset($_SESSION["flash_message"])): ?>
  <div class="alert alert-info" style="margin: 10px 0;">
    <?php echo $_SESSION["flash_message"]; unset($_SESSION["flash_message"]); ?>
  </div>
<?php endif; ?>
 	<div class="template-cart">
          <form action="index.php?controller=cart&action=update" method="post">
            <div class="table-responsive">
              <table class="table table-cart">
                <thead>
                  <tr>
                    <th class="image">Ảnh sản phẩm</th>
                    <th class="name">Tên sản phẩm</th>
                    <th class="price">Giá bán lẻ</th>
                    <th class="quantity">Số lượng</th>
                    <th class="price">Thành tiền</th>
                    <th>Xóa</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($_SESSION["cart"] as $product): ?>
                  <tr>
                    <td><img src="assets/upload/products/<?php echo $product['photo']; ?>" class="img-responsive" /></td>
                    <td><a href="index.php?controller=products&action=detail&id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></td>
                    <td> <?php echo number_format($product['price']); ?>₫ </td>
                    <td><input type="number" id="quantity" min="1" class="input-control" value="<?php echo $product['number']; ?>" name="product_<?php echo $product['id']; ?>" required="Không thể để trống"></td>
                    <td><p><b><?php echo number_format($product['number']*$product['price']); ?>₫</b></p></td>
                    <td><a href="index.php?controller=cart&action=delete&id=<?php echo $product['id']; ?>" data-id="2479395"><i class="fa fa-trash"></i></a></td>
                  </tr>
              	<?php endforeach; ?>
                </tbody>
                <?php if($this->cartNumber() > 0): ?>
                <tfoot>
                  <tr>
                    <td colspan="6"><a href="index.php?controller=cart&action=destroy" class="button pull-left">Xóa toàn bộ</a> <a href="index.php" class="button pull-right black">Tiếp tục mua hàng</a>
                      <input type="submit" class="button pull-right" value="Cập nhật"></td>
                  </tr>
                </tfoot>
            	<?php endif; ?>
              </table>
            </div>
          </form>

          <?php if($this->cartNumber() > 0): ?>
            
            <div class="total-cart"> Tổng tiền thanh toán:
              <?php echo number_format($this->cartTotal()); ?>₫ <br>
              <a href="index.php?controller=cart&action=checkout"  class="button black">Thanh toán</a>

              <div style="text-align: center;" class="total-cart">Hình thức thanh toán online</div>
              <a href="index.php?controller=cart&action=vnpayCreate" class="button black" style="margin-left:8px;">Thanh toán VNPay</a>
              <?php 
              $vnd_to_usd = round($this->cartTotal()/23000,2);
              ?>
              <!-- Replace PayPal default placement with a button that visually matches VNPay button.
                   Clicking it will instantiate PayPal Buttons and immediately open the PayPal flow. -->
              <a href="#" id="paypal-payment-button" class="button black" style="margin-left:8px; display:inline-block;">Thanh toán PayPal</a>
              <div id="paypal-temp" style="display:none;"></div>

                <input type="hidden" id="vnd_to_usd" 
                value="<?php echo $vnd_to_usd; ?>">
            </div>
          <?php endif; ?>
            
           
</div>

<script src="https://www.paypal.com/sdk/js?client-id=AeBxYtIVn21LHKs4y-A0UGhM-jAUcTijbqKUNCb3j_x6RBBQcEklDGEz1X0El4QWTG9RZSVf9fdIUEWA">
</script>
<script>
  var usd = document.getElementById("vnd_to_usd").value;

  // When user clicks our styled PayPal anchor, create and render PayPal Buttons into a hidden container,
  // then trigger a programmatic click on the generated button to open the PayPal checkout.
  document.getElementById('paypal-payment-button').addEventListener('click', function(e){
    e.preventDefault();

    var btnAnchor = this;
    btnAnchor.setAttribute('disabled', 'disabled');
    btnAnchor.style.opacity = '0.6';

    // Render PayPal Buttons into hidden container and then trigger the internal button
    paypal.Buttons({
      style: {
          layout: 'vertical',
          color: 'blue',
          shape: 'pill'
      },
      createOrder: function(data, actions){
        return actions.order.create({
          purchase_units:[{
            amount:{
              value: `${usd}`
            }
          }]
        });
      },
      onApprove: function(data, actions){
        return actions.order.capture().then(function(details){
          console.log(details);
          alert("Xử lý thanh toán thành công, bấm THANH TOÁN để hoàn tất");
          // optionally redirect or call your server to finalize the order
          // window.location.href = 'index.php?controller=cart&action=checkoutSuccess';
        });
      },
      onCancel: function(data){
        alert("Xử lý thanh toán thất bại");
      },
      onError: function(err){
        console.error(err);
        alert("Lỗi khi kết nối PayPal");
      }
    }).render('#paypal-temp').then(function(){
      // try to find a button element inside the rendered PayPal area and click it
      // (this opens the PayPal popup/flow)
      setTimeout(function(){
        var hiddenBtn = document.querySelector('#paypal-temp button');
        if(hiddenBtn){
          hiddenBtn.click();
        } else {
          // fallback: show the rendered container to let user click manually
          document.getElementById('paypal-temp').style.display = 'block';
          btnAnchor.style.display = 'none';
        }
        // re-enable anchor after a delay so the user can retry if needed
        setTimeout(function(){
          btnAnchor.removeAttribute('disabled');
          btnAnchor.style.opacity = '';
        }, 3000);
      }, 300);
    }).catch(function(err){
      console.error(err);
      alert('Không thể khởi tạo PayPal. Vui lòng thử lại sau.');
      btnAnchor.removeAttribute('disabled');
      btnAnchor.style.opacity = '';
    });
  });
</script>

