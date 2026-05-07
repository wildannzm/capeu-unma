<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use App\Models\Registration;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Registered Participants', Registration::count())
                ->description('Total participant registrations')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
            Stat::make('Pending Payments', Payment::where('status', 'pending')->count())
                ->description('Payments awaiting verification')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('warning'),
            Stat::make('Pending Reviews', Registration::where('status', 'submitted')->count())
                ->description('Documents awaiting review')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),
        ];
    }

    protected function getColumns(): int
    {
        return 3;
    }
}
