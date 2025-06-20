<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Transaction;

class TransactionTable extends Component
{
    /**
     * Create a new component instance.
     */
    public $transactions;

    public function __construct($limit = 10)
    {
        $this->transactions = Transaction::with(['item', 'user'])
            ->latest()
            ->take($limit)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.transaction-table');
    }
}
