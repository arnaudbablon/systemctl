# systemctl
PHP wrapper that allow to do basic system action like screenshot, click ... 
(tested on debian 9 / php 7.2)

# Requirements
- xdotool
- xclip
- shutter 

# How to install
```bash
 $ apt-get install xdotool xclip shutter
 $ composer require arnaudbablon/systemctl dev-master
```

## Current supported actions
- click (left / right)
- copy (ctrl+c)
- paste (ctrl+v)
- set clipboard
- key press
- screenshot
- scroll
- kill program
- run program

> I develop this library for personal purpose and will update actions according to my needs.

## How to use

```php
    $actions = [
        new ClickAction(),
        new CopyAction(),
        new PasteAction(),
        new ClipboardAction(),
        new ScrollAction(),
        new ScreenShotAction(),
        new KeyAction(),
        new KillallAction(),
        new RunAction()
    ];
    $container = new ActionContainer($actions);
    $application = new Application($container);
    
    application->clipboard('use ctrl+v to see the result');
    application->click(x, y); //left click
    application->click(x, y, false); //right click
    application->paste(); 
    application->screenshot('/path/name.png');
    application->key('KP_Enter');
    $application->run('google-chrome > /dev/null 2>&1 &');
    $application->sleep(4);
    $application->killall('chrome');
```

## Integration with symfony (optional)

```yaml
#config/services.yaml
...
imports:
    - { resource: '../vendor/arnaudbablon/systemctl/Resource/config/services.yaml' }
    
```
You can now normaly inject Application class without instanciate any actions.
