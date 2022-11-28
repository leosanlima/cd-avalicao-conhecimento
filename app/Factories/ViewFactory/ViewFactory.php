<?php
namespace App\Factories\ViewFactory;

use Illuminate\Contracts\View\View;

interface ViewFactory
{
    public function make(): View;
}
