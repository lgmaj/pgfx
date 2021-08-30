#pgfx

Library for simplify creating vector graphics in PHP.

Inspired by AS3 Graphics API.

```php
use pgfx\display\Graphics;
use pgfx\renderer\gd\GdImageRenderer;

$graphics = new Graphics();
$graphics->lineStyle();
$graphics->moveTo(10, 10);
$graphics->lineTo(100, 10);
$graphics->lineTo(100, 100);
$graphics->lineTo(10, 100);
$graphics->lineTo(10, 10);

$renderer = new GdImageRenderer(200, 200);
$renderer->render($graphics);
```