## Instalado

Instalado sekvas ordinarajn procedurojn de [Laravel](https://laravel.com/docs/11.x/installation), nenio speciala.

Vi nur bezonas PHP version 8.2 aǔ pli altan kaj iu ajn lokalan retservan sistemon.

Ĉi-sube estas priskribita instalado uzante SQLite databazon, por kiu ne necesas instali io ajn.

Por la sistemo prenita de [Github](https://github.com/sirandrewgotham/kursaro), oni faru la sekvan:

1. Klonu uzante la retan URL: https://github.com/SirAndrewGotham/Kursaro.git
2. Lanĉu terminalon en la dosierujo, kien vi klonis.
3. Ekzekutu komandon `composer install`
4. Ekzekutu komandon `npm install && npm run build`
5. Kopiu dosieron .env.example en la dosieron .env
6. Ekzekutu comandon `php artisan key:generate`
7. Ekzekutu komandon `php artisan migrate --seed`
8. En la dosiero .env indiku veran retan adreson de la sistemo en la linio `APP_URL=`

Se vi intendas uzi databazon alian ol SQLite, bv. certigi, ke vi havas taŭgan databazan servilon.

Por uzi alian databazon, bv. shanĝi informojn pri la uzata databazo en la dosiero .env post la paŝo 5 supre, kaj sekvu ekzekutante paŝojn 6-8 poste.

Se restas iuj demandoj, bv. demandi en la Telegram-grupo [Retejo Esperanta](https://t.me/retejoesperanta).
