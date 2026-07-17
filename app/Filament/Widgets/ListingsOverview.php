<?php

namespace App\Filament\Widgets;

use App\Models\Listing;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class ListingsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Pending Listings', Listing::where('status', 'pending')->count())
                ->description('Awaiting review')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),

            Card::make('Approved Listings', Listing::where('status', 'approved')->count())
                ->description('Visible to students')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Card::make('Rejected Listings', Listing::where('status', 'rejected')->count())
                ->description('Not published')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }
}
