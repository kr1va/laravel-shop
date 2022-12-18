<?php

namespace App\Contracts;

use Illuminate\Contracts\Routing\Registrar;

interface RouterRegistrar
{
    public function map(Registrar $registrar): void;

}
