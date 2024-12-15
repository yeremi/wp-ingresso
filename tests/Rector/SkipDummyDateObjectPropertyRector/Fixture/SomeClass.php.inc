<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Tests\Rector\SkipDummyDateObjectPropertyRector\Fixture;

use Yeremi\Ingresso\Domain\ValueObject\DummyDate;

class SomeClass
{
    public function __construct(
        private readonly null|DummyDate $date = null,
    ) {
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Tests\Rector\SkipDummyDateObjectPropertyRector\Fixture;

use Yeremi\Ingresso\Domain\ValueObject\DummyDate;

class SomeClass
{
    public function __construct(
        private readonly null|DummyDate $date = null,
    ) {
    }
}

?>