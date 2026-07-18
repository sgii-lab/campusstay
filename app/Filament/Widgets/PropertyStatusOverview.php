<?php

namespace App\Filament\Widgets;

use App\Models\Property;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class PropertyStatusOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Pending Properties', Property::where('status', 'pending')->count())
                ->color('secondary'),

            Card::make('Approved Properties', Property::where('status', 'approved')->count())
                ->color('success'),

            Card::make('Rejected Properties', Property::where('status', 'rejected')->count())
                ->color('danger'),
        ];
    }
}
