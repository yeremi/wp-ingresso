<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Tests\Rector\SkipDummyDateObjectPropertyRector\Fixture;

use Yeremi\Ingresso\Domain\ValueObject\DummyDate;

class AnotherClass
{
    public function __construct(
        private readonly DummyDate $date,
    ) {
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Tests\Rector\SkipDummyDateObjectPropertyRector\Fixture;

use Yeremi\Ingresso\Domain\ValueObject\DummyDate;

class AnotherClass
{
    public function __construct(
        private readonly DummyDate $date,
    ) {
    }
}

?>