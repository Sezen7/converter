<?php
require_once "include/converter.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['convert'])) {
    $from_currency = $_POST['from_currency'];
    switch($from_currency){
        case "USD":
            $from="ABD DOLARI";
            break;
        case "TRY":
            $from="TRY";
            break;
        case "EURO":
            $from="EURO";
            break;
    }
    $to_currency = $_POST['to_currency'];
    switch($to_currency){
        case "USD":
            $to="ABD DOLARI";
            break;
        case "TRY":
            $to="TRY";
            break;
        case "EURO":
            $to="EURO";
            break;
    }
    $amount = floatval($_POST['amount']);

    // Dönüştürme fonksiyonunu çağır
    $result = convert($amount, $from, $to);

    
    //echo "<p><strong>Sonuç:</strong> $amount $from_currency = $result $to_currency</p>";
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Döviz Çevir</title>
    <link rel="stylesheet" href="style/style.css"> <!-- CSS dosyasını bağladım -->
</head>
<body>
    <div class="converter-container">
        <h2>Döviz Çevir</h2>
        <?php 
            if(isset($result)) {
                echo "<p><strong>Sonuç:</strong> $amount $from_currency = $result $to_currency</p>";
            }
            else {
        ?>
        <form action="" method="post">
            <label for="from_currency">Kaynak Kur:</label>
            <select id="from_currency" name="from_currency">
                <option value="USD">USD - Amerikan Doları</option>
                <option value="EURO">EUR - Euro</option>
                <option value="TRY">TRY - Türk Lirası</option>
            </select>

            <label for="to_currency">Hedef Kur:</label>
            <select id="to_currency" name="to_currency">
                <option value="USD">USD - Amerikan Doları</option>
                <option value="EURO">EUR - Euro</option>
                <option value="TRY">TRY - Türk Lirası</option>
            </select>

            <label for="amount">Tutar:</label>
            <input type="number" id="amount" name="amount" step="0.01" placeholder="Miktar giriniz" required>

            <button type="submit" name="convert">Çevir</button>
        </form>
        <?php } ?>

        <?php
        
        
        ?>
        
            
    </div>
</body>
</html>
        