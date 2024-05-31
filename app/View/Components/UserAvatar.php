<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserAvatar extends Component
{

    public $user;
    public $size;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user, $size = 40)
    {
        $this->user = $user;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-avatar');
    }
}
