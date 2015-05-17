# yosli

## Описание
Плагин слайдер для Webasyst Shop-Script

## Возможности
Плагин позволяет создать слайдер изображений. К изображению можно привязать ссылку и заголовок.

В качестве jQuery плагина используется Nivo Slider - https://github.com/gilbitron/Nivo-Slider.

Доступные настройки плагина:
- Выбор из 4х стандартных шаблонов плагина nivo slider;
- Смена эффекта анимации;
- Настраиваемые размеры загружаемых файлов изображений;
- Скорость анимации;
- Время паузы;
- Отображение кнопок «вперед» и «назад»;
- Отображение навигации;
- Остановка анимации при наведении;
- Отображение миниатюр.

## Установка
### Автоматическая
...

### Ручная
Распаковать содержимое плагина в папку /wa-apps/shop/plugins и в файле /wa-config/apps/shop/plugins.php добавить 'yosli' => true

## Особенности
Для вывода слайдера во фронтенде магазина вставьте в необходимое место шаблона следующий код: **{shopYosliPlugin::display()}**