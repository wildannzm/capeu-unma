<?php

namespace App\Livewire\User;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('CAPEU 2026 - International Mobility Program')]
#[Layout('layouts.guest', [
    'description' => 'Join the CAPEU 2026 International Mobility Program in Majalengka, West Java. Experience cultural exchange, networking sessions, and exciting outdoor activities with Aspire UNMA!',
    'keywords' => 'CAPEU 2026, International Mobility, UNMA, Majalengka, West Java, Aspire, Exchange Program, Outdoor Activities'
])]

class Home extends Component
{
    public function render()
    {
        return view('livewire.user.home');
    }
}
