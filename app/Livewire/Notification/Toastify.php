<?php

namespace App\Livewire\Notification;

use Livewire\Attributes\On;
use Livewire\Component;

class Toastify extends Component
{
    #[On('toastify-success')]
    public function success($message)
    {
        $this->dispatch('show-success', $message);
    }

    #[On('toastify-error')]
    public function error($message)
    {
        $this->dispatch('show-error', $message);
    }

    public function render()
    {
        return view('livewire.notification.toastify');
    }
}
