<?php

declare(strict_types=1);

namespace Yeremi\Utilities\Rector;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use Rector\Rector\AbstractRector;

class SkipDummyDateObjectPropertyRector extends AbstractRector
{
    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [Property::class];
    }

    /**
     * @param Class_ $node
     */
    public function refactor(Node $node): ?Node
    {
        if (!$node instanceof Property) {
            return null;
        }

        foreach ($node->type?->types ?? [] as $type) {
            if ($type->toString() === 'DummyDate') {
                // Skip renaming this property
                return null;
            }
        }

        return $node;
    }
}
