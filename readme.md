# Velocity

Velocity Laravel 4.2 için hazırlanmış bir istek analizi kütüphanesidir. Uygulamanıza yapılan her isteğe göre çalışma zamanını veritabanına kaydeden ve dilediğiniz zaman analizleri görüntülemenizi sağlayan bir kütüphanedir.

## Ekran Görüntüsü

![alt text](http://ahir.com.tr/packages-images/velocity.jpg "Ekran Görüntüsü")


## Kurulum

`composer.json` dosyasınıza aşağıdaki şekilde düzenleyiniz:

```json
{
    "require": {
        "ahir/velocity": "dev-master",
    }
}
```

`app/config/app.php` dosyasını açın ve aşağıdaki satırları dahil edin. 

`providers` dizisine bu bölüm;

```php
'Ahir\Velocity\VelocityServiceProvider',
```

`aliases` dizisine bu bölüm;

```php
'Velocity' => 'Ahir\Velocity\Facades\Velocity',
```

## Konfigürasyon

Kurulumdan sonra içeri aktar işlemlerini tanımlamalısınız;

```
php artisan migrate --package=ahir/velocity
php artisan config:publish ahir/velocity
php artisan migrate ahir/velocity
```

`app/start/global.php` altında aşağıdaki düzenlemeleri yapınız.

```php 
App::before(function($request)
{
	Velocity::start();
});

App::after(function($request, $response)
{
    Velocity::stop();
});

Event::listen('ahir.velocity', 'Ahir\Velocity\Velocity@handle');
```

Daha sonra `app/controllers/BaseController.php` dosyası içerisinde aşağıdaki olay tetiklemelerini dahil ediniz;

```php
/**
 * Construct 
 * 
 * @return null
 */
public function __construct()
{
	Event::fire('ahir.velocity', $this);
}
```

Bu şekilde bir tanımlama yaptığınızda tüm controllerlar izlenecektir. Ancak dilerseniz BaseController yerine spesefik controller tanımlaması da yapabilirsiniz. Ayrıca izlenmesini istemediğiniz url'leri ayar dosyası içerisinde bulunan `ban_url_array` dizisine ekleyerek izlemeden çıkartabilirsiniz.


## İnceleme 

Paketi kurduktan sonra `domain.com/ahir/velocity` adresi üzerinden takip işlemlerini gerçekleştirebilirsiniz.




