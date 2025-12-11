<?php
// render_product_og_tags expects an array $product with keys:
// 'id', 'name', 'description', 'image' (relative or absolute), 'price' (numeric or formatted)
function render_product_og_tags(array $product) {
    $base = rtrim(BASE_URL, '/');
    $id = isset($product['id']) ? $product['id'] : '';
    $product_url = $base . '/Product/Detail/' . rawurlencode($id);

    $title = isset($product['name']) ? htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') : '';
    $descRaw = isset($product['description']) ? strip_tags($product['description']) : '';
    $desc = htmlspecialchars(mb_strlen($descRaw, 'UTF-8') > 200 ? mb_substr($descRaw, 0, 197, 'UTF-8') . '...' : $descRaw, ENT_QUOTES, 'UTF-8');

    $image = '';
    if (!empty($product['image'])) {
        $img = $product['image'];
        if (preg_match('#^https?://#i', $img)) {
            $image = $img;
        } else {
            $image = $base . '/' . ltrim($img, '/');
        }
    }

    echo "<meta property=\"fb:app_id\" content=\"" . FB_APP_ID . "\" />\n";
    echo "<meta property=\"og:type\" content=\"product\" />\n";
    echo "<meta property=\"og:title\" content=\"$title\" />\n";
    echo "<meta property=\"og:description\" content=\"$desc\" />\n";
    echo "<meta property=\"og:url\" content=\"$product_url\" />\n";
    if ($image) echo "<meta property=\"og:image\" content=\"$image\" />\n";
    // Optional product price info (Facebook product tags)
    if (!empty($product['price'])) {
        $price = htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8');
        echo "<meta property=\"product:price:amount\" content=\"$price\" />\n";
        echo "<meta property=\"product:price:currency\" content=\"VND\" />\n";
    }
    // Additional helpful tags
    echo "<meta name=\"twitter:card\" content=\"summary_large_image\" />\n";
    echo "<link rel=\"canonical\" href=\"$product_url\" />\n";
}