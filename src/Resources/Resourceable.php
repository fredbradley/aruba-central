<?php

namespace FredBradley\ArubaCentral\Resources;

use Illuminate\Support\Collection;

interface Resourceable
{
    public function all(): Collection;
}
