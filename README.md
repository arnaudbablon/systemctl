# systemctl
PHP wrapper for system basic action (tested on Debian 9)

# Requirements
- xdotool
- xclip
- shutter
- php 7.2

# How to install
```bash
 $ apt-get install xdotool xclip shutter
 $ composer require arnaudbablon/systemctl
```

## Current supported actions
- click (left / right)
- copy (ctrl+c)
- paste (ctrl+v)
- set clipboard
- key press
- screenshot
- scroll

## Futur actions (work in progress)
- open program
- kill program
- and more...

> I develop this library for personal purpose and will update actions according to my needs. Do not hesitate to contribute if you have any ideas

## How to use

```php
    $actions = [
        new ClickAction(),
        new CopyAction(),
        new PasteAction(),
        new ClipboardAction(),
        new ScrollAction(),
        new ScreenShotAction(),
        new KeyAction()
    ];
    $container = new ActionContainer($actions);
    $application = new Application($container);
    application = new Application();
    
    application->clipboard('use ctrl+v to see the result');
    application->click(x, y); //left click
    application->click(x, y, false); //right click
    application->paste(); 
    application->screenshot('/path/name.png');
    application->key('KP_Enter');
```

## Integration whit symfony
I use this library into symfony command. For integration, most important is to configure the DI with correct
Application classe using autowire most of possible and services definitions.
Thanks to symfony >= 3.4 for !tagged and !iterator annotations.

```yaml
    $actions = [
        new ClickAction(),
        new CopyAction(),
        new PasteAction(),
        new ClipboardAction(),
        new ScrollAction(),
        new ScreenShotAction(),
        new KeyAction()
    ];
    $container = new ActionContainer($actions);
    $application = new Application($container);
    application = new Application();
    
    application->clipboard('use ctrl+v to see the result');
    application->click(x, y); //left click
    application->click(x, y, false); //right click
    application->paste(); 
    application->screenshot('/path/name.png');
    application->key('KP_Enter');
```