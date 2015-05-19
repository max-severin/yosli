# yosli

## Описание
Плагин слайдер для Webasyst Shop-Script

## Возможности
Плагин позволяет создать слайдер изображений. К изображению можно привязать ссылку и заголовок.

В качестве jQuery плагина используется Nivo Slider - https://github.com/gilbitron/Nivo-Slider.

Доступные настройки плагина:
- выбор из 4х стандартных шаблонов плагина nivo slider;
- смена эффекта анимации;
- настраиваемые размеры загружаемых файлов изображений;
- скорость анимации;
- время паузы;
- отображение кнопок «вперед» и «назад»;
- отображение навигации;
- остановка анимации при наведении;
- отображение миниатюр.

## Установка
### Автоматическая
...

### Ручная
1. Загрузите папку с плагином из репозитория в каталог на вашем веб-сервере: /PATH_TO_WEBASYST/wa-apps/shop/plugins

2. Добавьте следующую строку в файл /PATH_TO_WEBASYST/wa-config/apps/shop/plugins.php (этот файл содержит список подключенных плагинов приложения «Магазин»):

		'yosli' => true,

3. Настройте плагин во вкладке «Плагины» приложения «Магазин».

## Особенности
Для вывода слайдера во фронтенде магазина вставьте в необходимое место шаблона следующий код: **{shopYosliPlugin::display()}**