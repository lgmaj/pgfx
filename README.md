# pgfx

Library for simplify creating vector graphics in PHP.

Inspired by AS3 Graphics API.

### Example vector graphics

```php
use pgfx\display\Graphics;
use pgfx\renderer\gd\GdImageRenderer;

$graphics = new Graphics();
$graphics->beginFill(0x787878);
$graphics->lineStyle(1, 0x00ffff);
$graphics->moveTo(50, 50);
$graphics->lineTo(150, 50);
$graphics->lineTo(150, 150);
$graphics->lineTo(50, 50);
$graphics->lineTo(50, 150);
$graphics->lineTo(150, 150);
$graphics->endFill();

$renderer = new GdImageRenderer(200, 200);
$renderer->setBackgroundColor(0x232323);
$renderer->render($graphics);
```


### Example animation

```php
use pgfx\attribute\PGFX;
use pgfx\display\Graphics;
use pgfx\display\Stage;
use pgfx\geom\Point;
use pgfx\renderer\gd\GdImageRenderer;

class Particle
{
    public function __construct(private int   $size,
                                private int   $color,
                                private Point $position,
                                private Point $direction)
    {
    }

    public function move(): void
    {
        $this->position = $this->position->add($this->direction);
    }

    public function draw(Graphics $graphics): void
    {
        $graphics->beginFill($this->color);
        $graphics->lineStyle(1, 0x000000);
        $graphics->drawCircle($this->position->x, $this->position->y, $this->size);
        $graphics->endFill();
    }
}

#[PGFX(frameCount: 25, frameRate: 5, wight: 200, height: 100)]
class ExampleAnimation extends Stage
{
    /** @var array<int, Particle> */
    private array $particles = [];

    function onAddedToStage(): void
    {
        for ($itr = 0; $itr < 100; $itr++) {
            $this->particles[] = new Particle(
                rand(2, 7),
                rand(0x780000, 0x870000),
                new Point(),
                new Point(rand(1, 200) / 10, rand(1, 200) / 10)
            );
        }
    }

    function onEnterFrame(): void
    {
        foreach ($this->particles as $particle) {
            $particle->move();
            $particle->draw($this->graphics);
        }
    }
}

$renderer = new GdImageRenderer();
$renderer->renderStage(new ExampleAnimation());
```