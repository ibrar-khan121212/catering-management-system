<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\EmployeeEventController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\EventManagerController;
use App\Http\Controllers\OrderMenuItemController;
use App\Http\Controllers\MenuItemInventoryItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Models\MenuItem;
use App\Models\Customer;
use App\Models\Event;


Route::get('/', function () {
    return view ('welcome');
})->name('home');

// use App\Http\Controllers\ClientOrderController;

// Route::middleware('auth')->group(function () {
//     Route::get('/client/orders/create', [ClientOrderController::class, 'create'])->name('client.orders.create');
//     Route::post('/client/orders', [ClientOrderController::class, 'store'])->name('client.orders.store');
// });
// routes/web.php

use App\Http\Controllers\ClientOrderController;



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/client/order/create', function () {
//         $customers = Customer::all();
//         $events = Event::all();
//         $menuItems = MenuItem::all();
//         return view('client_order_create', compact('customers', 'events', 'menuItems'));
//     })->name('client.orders.create');
//     Route::post('/client/order/store', [ClientOrderController::class, 'store'])->name('client.orders.store');

// });

Route::middleware('auth')->group(function () {
    Route::get('/client/order/create', [ClientOrderController::class, 'create'])->name('client.orders.create');
    Route::post('/client/order/store', [ClientOrderController::class, 'store'])->name('client.orders.store');
});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// });
// Customer Routes
Route::resource('customers', CustomerController::class);

// Event Routes
Route::resource('events', EventController::class);

// Employee Routes
Route::resource('employees', EmployeeController::class);

// Order Routes
Route::resource('orders', OrderController::class);

// Payment Routes
Route::resource('payments', PaymentController::class);

// MenuItem Routes
Route::resource('menu_items', MenuItemController::class);

// InventoryItem Routes
Route::resource('inventory_items', InventoryItemController::class);

// EmployeeEvent Routes
Route::resource('employee_events', EmployeeEventController::class);

// Chef Routes
Route::resource('chefs', ChefController::class);

// Server Routes
Route::resource('servers', ServerController::class);

// EventManager Routes
Route::resource('event_managers', EventManagerController::class);

// OrderMenuItem Routes
Route::resource('order_menuitem', OrderMenuItemController::class);

// MenuItemInventoryItem Routes
Route::resource('menuitem_inventoryitem', MenuItemInventoryItemController::class);

Route::get('/client/menu', function () {
    $menuItems = MenuItem::all()->map(function ($item) {
        return [
            'id' => $item->MenuItem_ID,
            'name' => $item->Name,
            'description' => $item->Description ?? '',
            'price' => $item->Price,
        ];
    });
    return view('menu', ['menuItems' => $menuItems]);
})->name('client.menu');

Route::middleware(['auth'])->get('/my-orders', [App\Http\Controllers\OrderController::class, 'myOrders'])->name('orders.my');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';



