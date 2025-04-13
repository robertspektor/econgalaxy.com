<?php


namespace App\View\Components;

use Illuminate\View\Component;

class Window extends Component
{
    public string $title;
    public string $windowId;

    public array $app;

    public function __construct(string $title = 'Window', string $windowId = 'window', array $app = [])
    {
        $this->app = $app;
        $this->title = $title;
        $this->windowId = $windowId;
    }

    public function render()
    {
        return view('components.window');
    }
}
