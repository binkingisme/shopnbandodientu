<?php
/**
 * Thư viện VNPay tối giản cho project MVC PHP thuần.
 * - build payment url
 * - validate return response (secure hash)
 */

function vnpay_build_payment_url(array $cfg, array $custom = []){
    $vnp_TmnCode = $cfg['tmn_code'];
    $vnp_HashSecret = $cfg['hash_secret'];
    $vnp_Url = $cfg['pay_url'];

    $vnp_TxnRef = $custom['vnp_TxnRef'] ?? date('YmdHis');
    $vnp_OrderInfo = $custom['vnp_OrderInfo'] ?? ('Thanh toan VNPay - '.$vnp_TxnRef);
    $amountVnd = (int)($custom['vnp_Amount'] ?? 0);
    // VNPay nhận amount theo đơn vị *100
    $vnp_Amount = $amountVnd;
    $vnp_ReturnUrl = $custom['vnp_ReturnUrl'] ?? '';
    $vnp_IpAddr = $custom['vnp_IpAddr'] ?? '127.0.0.1';

    $inputData = array(
        "vnp_Version" => $cfg['version'] ?? '2.1.0',
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => $cfg['command'] ?? 'pay',
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => $cfg['curr_code'] ?? 'VND',
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $cfg['locale'] ?? 'vn',
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $cfg['order_type'] ?? 'other',
        "vnp_ReturnUrl" => $vnp_ReturnUrl,
        "vnp_TxnRef" => $vnp_TxnRef,
    );

    // allow thêm tham số (vd: vnp_BankCode, vnp_ExpireDate...) nhưng KHÔNG ghi đè các field cốt lõi
    $reserved = ['vnp_TxnRef','vnp_OrderInfo','vnp_Amount','vnp_ReturnUrl','vnp_IpAddr'];
    foreach($custom as $k => $v){
        if(strpos($k, 'vnp_') === 0 && !in_array($k, $reserved, true)){
            $inputData[$k] = $v;
        }
    }

    ksort($inputData);

    $hashData = "";
    $query = "";
    $i = 0;
    foreach ($inputData as $key => $value) {
        if($value === null || $value === '') continue;
        $encodedValue = urlencode((string)$value);
        $query .= urlencode($key) . "=" . $encodedValue . '&';
        if ($i == 1) {
            $hashData .= '&' . urlencode($key) . "=" . $encodedValue;
        } else {
            $hashData .= urlencode($key) . "=" . $encodedValue;
            $i = 1;
        }
    }

    $vnp_SecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
    $paymentUrl = $vnp_Url . "?" . $query . 'vnp_SecureHash=' . $vnp_SecureHash;

    return $paymentUrl;
}

/**
 * Validate response from VNPay
 * - $inputData: thường là $_GET
 */
function vnpay_validate_response(string $hashSecret, array $inputData, string $secureHash){
    $data = [];
    foreach($inputData as $k => $v){
        if(strpos($k, 'vnp_') === 0){
            $data[$k] = $v;
        }
    }
    unset($data['vnp_SecureHash']);
    unset($data['vnp_SecureHashType']);

    ksort($data);

    $hashData = "";
    $i = 0;
    foreach($data as $key => $value){
        if($value === null || $value === '') continue;
        $encodedValue = urlencode((string)$value);
        if ($i == 1) {
            $hashData .= '&' . urlencode($key) . "=" . $encodedValue;
        } else {
            $hashData .= urlencode($key) . "=" . $encodedValue;
            $i = 1;
        }
    }

    $calculated = hash_hmac('sha512', $hashData, $hashSecret);
    return hash_equals($calculated, $secureHash);
}
