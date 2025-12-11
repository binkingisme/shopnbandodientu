<?php
// Thay App ID bằng App ID Facebook của bạn
define('FB_APP_ID', '1634600330835560');

// Định nghĩa BASE_URL để sinh đường dẫn tuyệt đối cho og:image, og:url
define('BASE_URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']);

// Bạn có thể thêm các cấu hình khác ở đây...