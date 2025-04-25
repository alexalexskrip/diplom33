<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FlashMessage extends Component
{
    public mixed $message;
    public mixed $type;
    public mixed $timeout;
    public mixed $interval;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'success', $timeout = 5000)
    {
        $this->type = $type;
        $this->message = session($type);
        $this->timeout = $timeout;
        $this->interval = $timeout / 100;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.flash-message');
    }
}
