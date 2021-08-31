# pgfx

Library for simplify creating vector graphics in PHP.

Inspired by AS3 Graphics API.

```php
use pgfx\display\Graphics;
use pgfx\renderer\gd\GdImageRenderer;

$graphics = new Graphics();
$graphics->beginFill(0x787878);
$graphics->lineStyle(1, 0x00fff);
$graphics->moveTo(50, 50);
$graphics->lineTo(150, 50);
$graphics->lineTo(150, 150);
$graphics->lineTo(50, 50);
$graphics->lineTo(50, 150);
$graphics->lineTo(150, 150);
$graphics->endFill();

$renderer = new GdImageRenderer(200, 200);
$renderer->render($graphics);
```
