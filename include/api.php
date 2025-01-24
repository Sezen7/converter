<?php
        // API URL'si
        $api_url = "http://hasanadiguzel.com.tr/api/kurgetir";
        
        // cURL isteği başlat
        $curl = curl_init($api_url);
        
        // cURL seçeneklerini ayarla
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // SSL doğrulamasını devre dışı bırak
        
        // İsteği gönder ve yanıtı al
        $response = curl_exec($curl);
        
        // cURL isteğini kapat
        curl_close($curl);
        
        // JSON formatındaki yanıtı PHP dizisine çevir
        $data = json_decode($response, true);
        
        // Çıktıyı kontrol et
        if ($data && isset($data['TCMB_AnlikKurBilgileri'])) {
            $kur_bilgileri = $data['TCMB_AnlikKurBilgileri'];
            echo "<pre>";
            print_r($kur_bilgileri); // Tüm kur bilgilerini yazdır
            echo "</pre>";
        } else {
            echo "Kur bilgisi alınamadı.";
        }
        ?>