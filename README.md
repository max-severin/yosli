# yosli

## Description
Image slider plugin for Webasyst Shop-Script

## Features
The plugin allows you to create slider of images. To the image, you can snap the link and the title. It is also possible to change the sort order of the slides.

Plugin uses the jQuery Nivo Slider plugin - https://github.com/gilbitron/Nivo-Slider.

Plugin settings:
- choice of 4 standard nivo slider design themes;  
- change the animation effect;
- custom sizes downloadable image files;
- animation speed;
- pause time;
- displays the buttons «forward» and «backward»;
- navigation mapping;
- stop animation while hovering;
- display thumbnails.

## Installing
### Auto
...

### Manual
1. Get the code into your web server's folder /PATH_TO_WEBASYST/wa-apps/shop/plugins

2. Add the following line into the /PATH_TO_WEBASYST/wa-config/apps/shop/plugins.php file (this file lists all installed shop plugins):

		'yosli' => true,

3. Done. Configure the plugin in the plugins tab of shop backend.

## Specificity
To output the slider in shop frontend paste in the template the following code: **{shopYosliPlugin::display()}**