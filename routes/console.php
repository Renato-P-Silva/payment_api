<?php

use App\Infra\Request\RequestTools;

$timezone = config('app.timezone');

if (! RequestTools::isApplicationInDevelopMode()) {
}
