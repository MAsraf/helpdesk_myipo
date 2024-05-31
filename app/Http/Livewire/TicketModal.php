<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Modal\ModalComponent;

class TicketModal extends ModalComponent
{
    public function render(): View
    {
        return view('livewire.ticket-modal');
    }
}
