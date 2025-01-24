<?php
// converter.php dosyasını dahil ettim
require_once "converter.php";
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Döviz Çevirici</title>
    <link rel="stylesheet" href="style.css"> <!-- CSS dosyasını bağladım -->
</head>
<body>
    <div class="converter-container">
        <h2>Döviz Çevirici</h2>
        <form action="" method="post">
            <label for="from_currency">Kaynak Kur:</label>
            <select id="from_currency" name="from_currency">
                <option value="USD">USD - Amerikan Doları</option>
                <option value="EUR">EUR - Euro</option>
                <option value="TRY">TRY - Türk Lirası</option>
            </select>

            <label for="to_currency">Hedef Kur:</label>
            <select id="to_currency" name="to_currency">
                <option value="USD">USD - Amerikan Doları</option>
                <option value="EUR">EUR - Euro</option>
                <option value="TRY">TRY - Türk Lirası</option>
            </select>

            <label for="amount">Tutar:</label>
            <input type="number" id="amount" name="amount" step="0.01" placeholder="Miktar giriniz" required>

            <button type="submit" name="convert">Çevir</button>
        </form>

        <?php
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['convert'])) {
            $from_currency = $_POST['from_currency'];
            $to_currency = $_POST['to_currency'];
            $amount = floatval($_POST['amount']);

            // Dönüştürme fonksiyonunu çağır
            $result = convertCurrency($amount, $from_currency, $to_currency);

            
            echo "<p><strong>Sonuç:</strong> $amount $from_currency = $result $to_currency</p>";
        }
        ?>
        
            
    </div>
</body>
</html>
        