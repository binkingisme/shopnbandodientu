<?php
/**
 * Cấu hình VNPay
 * - Điền TMN_CODE và HASH_SECRET bạn lấy từ cổng merchant VNPay (sandbox hoặc production)
 * - Demo này mặc định dùng môi trường sandbox
 */

function vnpay_config(){
    $base = vnpay_current_base_url();

    return [
        // Sandbox
        'pay_url' => 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html',

        // Thông tin merchant
        'tmn_code'     => 'G8GDW7HP',
        'hash_secret'  => 'NZRU0JP6V1A7GUTJ3HZNA8B5H2HYSP6A',

        // Return URL (VNPay sẽ redirect về đây sau khi thanh toán)
        // Ví dụ: http://localhost/shopnbandodientu-main/index.php?controller=cart&action=vnpayReturn
        'return_url'   => $base . 'index.php?controller=cart&action=vnpayReturn',

        // Tuỳ chọn
        'version'      => '2.1.0',
        'command'      => 'pay',
        'curr_code'    => 'VND',
        'locale'       => 'vn',
        'order_type'   => 'other',
    ];
}

/**
 * Lấy base url hiện tại (neo về thư mục chứa index.php)
 * - Nếu truy cập: http://localhost/shopnbandodientu-main/index.php
 *   => base:      http://localhost/shopnbandodientu-main/
 */
function vnpay_current_base_url(){
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host   = $_SERVER['HTTP_HOST'] ?? 'localhost';

    // SCRIPT_NAME thường là: /shopnbandodientu-main/index.php
    $script = $_SERVER['SCRIPT_NAME'] ?? '/index.php';

    // Cắt về thư mục gốc chứa index.php
    $basePath = rtrim(str_replace('/index.php', '', $script), '/');

    return $scheme . '://' . $host . ($basePath ? $basePath . '/' : '/');
}
