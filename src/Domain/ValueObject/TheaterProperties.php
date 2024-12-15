<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Domain\ValueObject;

use Yeremi\SchemaMapper\Attributes\ApiSchema;

class TheaterProperties
{
    public function __construct(
        #[ApiSchema('hasBomboniere')]
        private readonly bool $hasBomboniere = false,
        #[ApiSchema('hasContactlessWithdrawal')]
        private readonly bool $hasContactlessWithdrawal = false,
        #[ApiSchema('hasSession')]
        private readonly bool $hasSession = false,
        #[ApiSchema('hasSeatDistancePolicy')]
        private readonly bool $hasSeatDistancePolicy = false,
        #[ApiSchema('hasSeatDistancePolicyArena')]
        private readonly bool $hasSeatDistancePolicyArena = false,
    ) {
    }

    public function isHasBomboniere(): bool
    {
        return $this->hasBomboniere;
    }

    public function isHasContactlessWithdrawal(): bool
    {
        return $this->hasContactlessWithdrawal;
    }

    public function isHasSession(): bool
    {
        return $this->hasSession;
    }

    public function isHasSeatDistancePolicy(): bool
    {
        return $this->hasSeatDistancePolicy;
    }

    public function isHasSeatDistancePolicyArena(): bool
    {
        return $this->hasSeatDistancePolicyArena;
    }
}
