<?php
// api.php dosyasını dahil ettim
require_once "api.php";

function convert($amount, $from_currency, $to_currency) {
    // Kur bilgilerini API'den aldım
    $rates = fetchExchangeRates();
    /*var_dump($rates);
    die();*/

    if ($rates === null) {
        return "Kur bilgisi alınamadı.";
    }

    $from_rate = null;
    $to_rate = null;

    // Kaynak kurun ve hedef kurun değerlerini buldum
    foreach ($rates as $rate) {
        if ($rate['Isim'] === $from_currency) {
            $from_rate = floatval($rate['ForexSelling']);
        }
        if ($rate['Isim'] === $to_currency) {
            $to_rate = floatval($rate['ForexSelling']);
        }
    }

    // hata döndürdüm
    if ($from_rate === null || $to_rate === null) {
        return "Geçersiz kur seçimi.";
    }

    // Dönüşüm hesaplama
    $converted_amount = ($amount / $to_rate) * $from_rate;

    return number_format($converted_amount, 2); // Sonucu formatla
}
?>
