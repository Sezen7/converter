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
    
    if($from_currency === 'TRY') {
        $from_rate = 1;
    }
    if($to_currency === 'TRY') {
        $to_rate = 1;
    }

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
// AJAX POST isteğini işle
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
    $from_currency = $_POST['from_currency'] ?? '';
    $to_currency = $_POST['to_currency'] ?? '';

    $result = convert($amount, $from_currency, $to_currency);

    if ($result !== null) {
        echo json_encode([
            'success' => true,
            'amount' => $amount,
            'from_currency' => $from_currency,
            'to_currency' => $to_currency,
            'result' => $result
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Kur bilgisi alınamadı veya geçersiz kur seçimi.'
        ]);
    }
}
?>
