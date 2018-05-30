## Gallery Modulü

yii 2 framework te yazılmıştır.Gallery modulünü ekleyip kullana bilirsiniz.Bunun için aşağıda gösterilenleri yapmalısınız.

## Kurulum Aşaması

Projenizin ana klasörünün altında bulunan `composer.json` adlı dosyayı açın. `repositories` kısmına

> {

  

> "type": "vcs",

`

> "url": "[https://github.com/ahmadmammadov/gallery.git](https://github.com/ahmadmammadov/gallery.git)"

  

> }

>  `require` kısmına

> "kouosl/gallery": "dev-master"

> yapıştırın. Daha sonra proje klasörünün olduğu dizinde bir komut satırı açın.

>  > php yii migrate --migrationPath=@vendor/kouosl/gallery/migrations --interactive=0

  

komutu ile veri tabanını oluşturmanız lazım.

  

**Portal/Backend/config** ve **Portal/Frontend/config** dizinleri altındaki `main.php` içine

  

> 'modules' => [ 'gallery' => [ 'class' => 'kouosl\gallery\Module', ],

> eklemelerini yapın.

## Gallery Oluşturma

Modulün **index** sayfasından **Create Gallery** butonuna tıklayarak yeni bir gallery oluştura bilirsiniz. Sonra **Create Photos** kısmında yeni resimler ekleyebilirsiniz. Bu kısımda **update** ve **delete** işlemi de yapabilirsiniz.
>
