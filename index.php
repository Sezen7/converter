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
                <option value="ABD DOLARI">USD - Amerikan Doları</option>
                <option value="EURO">EUR - Euro</option>
                <option value="İNGİLİZ STERLİNİ">TPOUND STERLING</option>
            </select>

            <label for="to_currency">Hedef Kur:</label>
            <select id="to_currency" name="to_currency">
                <option value="ABD DOLARI">USD - Amerikan Doları</option>
                <option value="EURO">EUR - Euro</option>
                <option value="İNGİLİZ STERLİNİ">TPOUND STERLING</option>
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
                        console.log(data);

                        var kurlar = data.TCMB_AnlikKurBilgileri; // API'den alınan döviz kurları

                        var fromCurrency = $('#from_currency').val();
                        var toCurrency = $('#to_currency').val();
                        var amount = parseFloat($('#amount').val());

                        // Dövizleri listede bul
                        var fromRateObj = kurlar.find(kur => kur.Isim == fromCurrency);
                        var toRateObj = kurlar.find(kur => kur.Isim == toCurrency);

                        if (fromRateObj && toRateObj) {
                            var fromRate = fromRateObj.ForexSelling;
                            var toRate = toRateObj.ForexSelling;

                            var result = (amount * toRate) / fromRate;
                            $('#result').html(`<p><strong>Sonuç:</strong> ${amount} ${fromCurrency} = ${result.toFixed(2)} ${toCurrency}</p>`);
                        } else {
                            $('#result').html('<p>Hata: Geçersiz kur seçimi. Lütfen doğru kurları seçtiğinizden emin olun.</p>');
                        }
                    },
                    error: function() {
                        $('#result').html('<p>Hata: API’ye bağlanılamadı. Lütfen daha sonra tekrar deneyin.</p>');
                    }
                });
            });
        });
    </script>
</body>
</html>