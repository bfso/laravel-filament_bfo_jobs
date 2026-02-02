<?php

namespace App\Filament\Jobs\Resources\Applications\Pages;

use App\Filament\Jobs\Resources\Applications\ApplicationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateApplication extends CreateRecord
{
    protected static string $resource = ApplicationResource::class;
}
