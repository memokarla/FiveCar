<?php

namespace App\Livewire\Contact;

use Livewire\Component;
use App\Models\Contact;

class Index extends Component
{
    public $name, $email, $phone, $message;
    public $showToast = false;

    public function placeContact() {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'message' => 'required',
        ]);

        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ]);

        session()->flash('message', 'Message Sent Successfully.');
        $this->showToast = true;
    }

    public function dismissToast()
    {
        $this->showToast = false; 
    }

    public function render()
    {
        return view('livewire.contact.index');
    }
}
