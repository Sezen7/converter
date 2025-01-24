<?php
// api.php dosyasını dahil ettim
require_once "api.php";

function convertCurrency($amount, $from_currency, $to_currency) {
    // Kur bilgilerini API'den aldım
    $rates = fetchExchangeRates();

    if ($rates === null) {
        return "Kur bilgisi alınamadı.";
    }

    $from_rate = null;
    $to_rate = null;

    // Kaynak kurun ve hedef kurun değerlerini buldum
    foreach ($rates as $rate) {
        if ($rate['DovizKod'] === $from_currency) {
            $from_rate = floatval($rate['ForexSelling']);
        }
        if ($rate['DovizKod'] === $to_currency) {
            $to_rate = floatval($rate['ForexSelling']);
        }
    }

    // hata döndürdüm
    if ($from_rate === null || $to_rate === null) {
        return "Geçersiz kur seçimi.";
    }

    // Dönüşüm hesaplama
    $converted_amount = ($amount / $from_rate) * $to_rate;

    return number_format($converted_amount, 2); // Sonucu formatla
}
?>
