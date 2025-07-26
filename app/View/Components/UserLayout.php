<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserLayout extends Component
{
    public $PageTitle;
    public $PageSubtitle;
    public $notificationsUser;
    public function __construct(string $PageTitle = "Default Title", string $PageSubtitle = "Default Subtitle")
    {
        $this->PageTitle = $PageTitle;
        $this->PageSubtitle = $PageSubtitle;
        $this->notificationsUser = $notificationsUser ?? collect();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-layout', [
            'PageTitle' => $this->PageTitle,
            'PageSubtitle' => $this->PageSubtitle,
            'notifications' => $this->notificationsUser
        ]);
    }
}
