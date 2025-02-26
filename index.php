<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Döviz Çevir</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="converter-container">
        <h2>Döviz Çevir</h2>

        <form id="converterForm">
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

            <button type="button" id="convertButton">Çevir</button>
        </form>

        <div id="result"></div>
    </div>

    <script>
        $(document).ready(function() {
            $('#convertButton').on('click', function() {
                $.ajax({
                    url: 'https://hasanadiguzel.com.tr/api/kurgetir',
                    dataType: 'json',
                    success: function(data) {
                        var kurlar = data; // API'den gelen kurlar
                        var fromCurrency = $('#from_currency').val();
                        var toCurrency = $('#to_currency').val();
                        var amount = parseFloat($('#amount').val());

                        // Kurları kullanarak hesaplama yap
                        var fromRate = kurlar[fromCurrency];
                        var toRate = kurlar[toCurrency];

                        if (fromRate && toRate) {
                            var result = (amount * toRate) / fromRate;
                            $('#result').html('<p><strong>Sonuç:</strong> ' + amount + ' ' + fromCurrency + ' = ' + result.toFixed(2) + ' ' + toCurrency + '</p>');
                        } else {
                            $('#result').html('<p>Hata: Geçersiz kur seçimi.</p>');
                        }
                    },
                    error: function() {
                        $('#result').html('<p>Hata: API'ye bağlanılamadı.</p>');
                    }
                });
            });
        });
    </script>
</body>
</html>