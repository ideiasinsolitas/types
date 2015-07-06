<?php

namespace Deck\Types;

use Deck\Resolver\ResolverInterface;

interface FactoryInterface
{
    public function make($resource);
}
