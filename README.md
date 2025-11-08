<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 📝 Blog Modülü (Laravel + Docker + Elasticsearch)

Bu proje, Docker üzerinde çalışan bir Laravel uygulamasıdır.
Blog modülü ile CRUD (Create, Read, Update, Delete) işlemleri yapılabilir.

Her ekleme, güncelleme veya silme işleminde Laravel’in Event & Listener yapısı devreye girerek ilgili blog verisini Elasticsearch indeksine otomatik olarak senkronize eder.
Bu sayede arama sonuçları her zaman güncel, hızlı ve doğru olur.

Uygulama, Laravel Scout paketi üzerinden Elasticsearch ile entegre edilmiştir ve tüm işlemler kuyruk sistemi (queue) aracılığıyla arka planda yönetilir.

## ✨ Özellikler

✅ Asenkron Elasticsearch İndeksleme: Blog CRUD işlemleri anında tamamlanır, indeksleme arka planda yapılır

✅ Event-Driven Architecture: Temiz ve bakımı kolay kod yapısı

✅ Queue Sistemi: Database driver ile basit ve etkili kuyruk yönetimi

✅ Laravel Scout: Elasticsearch entegrasyonu için Scout kullanımı

✅ Docker Support: Tüm servisler containerize edilmiş durumda

✅ Auto-Restart: Supervisor ile worker'ların otomatik yeniden başlatılması

✅ Logging: Tüm işlemler detaylı loglanır

✅ Seeder Support: Test verileri için factory ve seeder desteği

### 📋 Projeyi klonlarken unutma


✅ Environment dosyası oluştur

✅ Composer bağımlılıklarını oluştur

✅ Uygulama anahtarı oluştur

✅ Veritabanı , Queue tablosu oluştur

✅ Test verilerini yükle →  sail artisan db:seed 

✅ Elasticsearch indexleme  →  sail artisan scout:import

✅ Worker'ı başlat → sail artisan queue:work



## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
