<?php
$q = $_GET["q"];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://comfy.ua/ua/search/?q={$q}");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_HEADER, false);

$html = curl_exec($curl);

libxml_use_internal_errors(true);

$dom = new DOMDocument();
$dom->loadHTML($html, LIBXML_NOERROR);
$xpath = new DOMXPath($dom);

$productsImg = $xpath->query("//img[contains(@class, 'ci-sl__slide-img')]");
$productsName = $xpath->query("//a[contains(@class, 'products-list-item__name')]");
$count = $productsImg->length;

for ($i = 0; $i < $count; $i++) {
    $img = $productsImg->item($i);
    $src = $img->getAttribute("src");
    $data_src = $img->getAttribute("data-src");
    if (empty($src)) {
        $src = $data_src;
    }
    $productHref = $productsName[$i]->getAttribute('href');
    $name = $productsName[$i]->getAttribute('title');
    $productsPrice = $xpath->query("//div[contains(@class, 'products-list-item__actions-price-current')]/text()")->item($i);
    $price = $productsPrice->textContent;
    echo "
  <div class='col'>
    <div class='card'>
      <img src=" . $src . " class='card-img-top' alt='image$i'>
      <div class='card-body'>
        <a class='card-title' href=" . $productHref . ">" . $name . "</a>
        <p class='card-text'>" . $price . "₴</p>
      </div>
    </div>
  </div>";
}
curl_close($curl);