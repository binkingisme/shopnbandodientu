<?php 
	include "models/CartModel.php";
	include "application/VnPayConfig.php";
	include "application/VnPayLibrary.php";
	class CartController extends Controller{
		//ke thua class CartModel
		use CartModel;
		//ham tao
		public function __construct(){
			//neu gio hang chua ton tai thi khoi tao no
			if(isset($_SESSION["cart"]) == false)
				$_SESSION["cart"] = array();
		}
		//them san pham vao gio hang
		public function create(){
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			//goi ham cartAdd de them san pham vao gio hang
			$this->cartAdd($id);
			//quay tro lai trang gio hang
			header("location:index.php?controller=cart");
		}
		//hien thi gio hang
		public function index(){
			$this->loadView("CartView.php");
		}
		//xoa san pham khoi gio hang
		public function delete(){
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			//goi ham cartDelete de them san pham vao gio hang
			$this->cartDelete($id);
			//quay tro lai trang gio hang
			header("location:index.php?controller=cart");
		}
		//xoa toan bo gio hang
		public function destroy(){
			//goi ham cartDestroy de xoa gio hang
			$this->cartDestroy($id);
			//quay tro lai trang gio hang
			header("location:index.php?controller=cart");
		}
		//cap nhat nhieu san pham
		public function update(){
			//duyet cac phan tu trong session array
			foreach($_SESSION["cart"] as $product){
				$id = $product["id"];
				$quantity = $_POST["product_$id"];
				//goi ham cartUpdate de update lai so luong
				$this->cartUpdate($id,$quantity);
			}
			//quay tro lai trang gio hang
			header("location:index.php?controller=cart");
		}
		//thanh toan gio hang
		
		public function checkout(){
			//kiem tra neu user chua dang nhap thi di chuyen den trang dang nhap
			if(isset($_SESSION["customer_email"]) == false)
				header("location:index.php?controller=account&action=login");
			else{
				//goi ham cartCheckOut de thanh toan gio hang
				$this->cartCheckOut();
				header("location:index.php?controller=cart");
			}
		}

		/*
			VNPay - Tạo URL thanh toán và redirect sang cổng VNPay
			URL: index.php?controller=cart&action=vnpayCreate
		*/
		public function vnpayCreate(){
			
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		

			// yêu cầu đăng nhập để thanh toán
			if(isset($_SESSION["customer_email"]) == false){
				header("location:index.php?controller=account&action=login");
				exit();
			}
			if($this->cartNumber() <= 0){
				$_SESSION["flash_message"] = "Giỏ hàng đang trống.";
				header("location:index.php?controller=cart");
				exit();
			}

			$cfg = vnpay_config();
			$amount = (int)$this->cartTotal();
			$amountVnp = $amount * 100;
			// VNPay yêu cầu TxnRef là duy nhất trong ngày; nên dùng chuỗi chỉ gồm số để an toàn
			$txnRef = date('YmdHis').(isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : '0');
			// Localhost hay trả ::1 (IPv6) -> ép về 127.0.0.1 cho chắc
            $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
            if ($ip === '::1') $ip = '127.0.0.1';


			// lưu tạm vào session để đối chiếu ở bước return
			$_SESSION['vnpay_txn_ref'] = $txnRef;
			$_SESSION['vnpay_amount'] = $amount;

			$returnUrl = vnpay_current_base_url()."index.php?controller=cart&action=vnpayReturn";
			$orderInfo = "Thanh toan don hang gio hang - ".$txnRef;

			$paymentUrl = vnpay_build_payment_url(
				$cfg,
				array(
					"vnp_TxnRef" => $txnRef,
					"vnp_OrderInfo" => $orderInfo,
					"vnp_Amount" => $amountVnp,
					"vnp_ReturnUrl" => $returnUrl,
					"vnp_CreateDate" => date('YmdHis'),
					"vnp_ExpireDate" => date('YmdHis', strtotime('+15 minutes')),
					"vnp_IpAddr" => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'
				)
			);

			header("Location: $paymentUrl");
			exit();
		}

		/*
			VNPay - Return URL (khách được redirect về)
			URL: index.php?controller=cart&action=vnpayReturn
		*/
		public function vnpayReturn(){
			$cfg = vnpay_config();
			$input = $_GET;
			$secureHash = isset($input['vnp_SecureHash']) ? $input['vnp_SecureHash'] : '';
			$valid = vnpay_validate_response($cfg['hash_secret'], $input, $secureHash);

			if(!$valid){
				$_SESSION["flash_message"] = "VNPay: Chữ ký không hợp lệ (SecureHash mismatch).";
				header("location:index.php?controller=cart");
				exit();
			}

			// đối chiếu dữ liệu tối thiểu với session
			$expectedTxn = $_SESSION['vnpay_txn_ref'] ?? null;
			$expectedAmount = $_SESSION['vnpay_amount'] ?? null;
			$returnTxn = $input['vnp_TxnRef'] ?? null;
			$returnAmount = isset($input['vnp_Amount']) ? ((int)$input['vnp_Amount'] / 100) : null;
			$responseCode = $input['vnp_ResponseCode'] ?? null;
			$txnStatus = $input['vnp_TransactionStatus'] ?? null;

			if($expectedTxn && $returnTxn && $expectedTxn !== $returnTxn){
				$_SESSION["flash_message"] = "VNPay: TxnRef không khớp.";
				header("location:index.php?controller=cart");
				exit();
			}
			if($expectedAmount !== null && $returnAmount !== null && (int)$expectedAmount !== (int)$returnAmount){
				$_SESSION["flash_message"] = "VNPay: Số tiền không khớp.";
				header("location:index.php?controller=cart");
				exit();
			}

			// thành công thường là ResponseCode=00 và TransactionStatus=00
			if($responseCode === '00' && $txnStatus === '00'){
				// tạo đơn hàng sau khi xác nhận thanh toán VNPay
				$this->cartCheckOut();
				// xóa dấu vết VNPay trong session
				unset($_SESSION['vnpay_txn_ref']);
				unset($_SESSION['vnpay_amount']);
				$_SESSION["flash_message"] = "Thanh toán VNPay thành công. Đơn hàng đã được tạo!";
			} else {
				$_SESSION["flash_message"] = "Thanh toán VNPay thất bại (ResponseCode=$responseCode, TransactionStatus=$txnStatus).";
			}

			header("location:index.php?controller=cart");
			exit();
		}
	}
 ?>