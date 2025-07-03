<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Inertia\Inertia;

class MenuController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::all()->map(function ($item) {
            return [
                'id' => $item->MenuItem_ID,
                'name' => $item->Name,
                'description' => $item->Description ?? '',
                'price' => $item->Price,
            ];
        });
        return Inertia::render('menu', ['menuItems' => $menuItems]);
    }
} 