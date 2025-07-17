<?php

namespace App\View\Components;

use App\Models\Article;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Banner;

class AdminDashboard extends Component
{
    /**
     * Create a new component instance.
     */

    public $banners;
    public $articles;

    public function __construct()
    {   
        $this->banners = Banner::all();
        $this->articles = Article::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-dashboard')->with([
            'banners' => $this->banners,
            'articles' => $this->articles,
        ]);
    }
}
