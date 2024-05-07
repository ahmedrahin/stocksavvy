<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController\DashboardController;
use App\Http\Controllers\AdminController\EmployeesController;
use App\Http\Controllers\AdminController\CustomerController;
use App\Http\Controllers\AdminController\SuplliersController;
use App\Http\Controllers\AdminController\SalaryController;
use App\Http\Controllers\AdminController\AdvSalaryController;
use App\Http\Controllers\AdminController\CategoryController;
use App\Http\Controllers\AdminController\ProductController;
use App\Http\Controllers\AdminController\ExpenseController;
use App\Http\Controllers\AdminController\AttendanceController;
use App\Http\Controllers\AdminController\SettingController;
use App\Http\Controllers\AdminController\PosController;
use App\Http\Controllers\AdminController\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

// login page
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin dashboard
Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // employees
    Route::controller(EmployeesController::class)->group(function(){
        Route::group(['prefix' => '/employees',], function(){
            Route::get('/manage', 'manage')->name('manage.employees');
            Route::get('/add', 'create')->name('add.employees');
            Route::post('/store', 'store')->name('store.employees');
            Route::get('/edit/{id}', 'edit')->name('edit.employees');
            Route::put('/update/{id}', 'update')->name('update.employees');
            Route::delete('/delete/{id}', 'destroy')->name('delete.employees');
        });
    });

     // customer
     Route::controller(CustomerController::class)->group(function(){
        Route::group(['prefix' => '/customers',], function(){
            Route::get('/manage', 'manage')->name('manage.customer');
            Route::get('/add', 'create')->name('add.customer');
            Route::post('/store', 'store')->name('store.customer');
            Route::get('/edit/{id}', 'edit')->name('edit.customer');
            Route::get('/show/{id}', 'show')->name('show.customer');
            Route::put('/update/{id}', 'update')->name('update.customer');
            Route::delete('/delete/{id}', 'destroy')->name('delete.customer');
        });
    });

    // customer
    Route::controller(SuplliersController::class)->group(function(){
        Route::group(['prefix' => '/suppliers',], function(){
            Route::get('/manage', 'manage')->name('manage.supplier');
            Route::get('/add', 'create')->name('add.supplier');
            Route::post('/store', 'store')->name('store.supplier');
            Route::get('/edit/{id}', 'edit')->name('edit.supplier');
            Route::get('/show/{id}', 'show')->name('show.supplier');
            Route::put('/update/{id}', 'update')->name('update.supplier');
            Route::delete('/delete/{id}', 'destroy')->name('delete.supplier');
        });
    });

    // adv salary
    Route::controller(AdvSalaryController::class)->group(function(){
        Route::group(['prefix' => '/adv-salary',], function(){
            Route::get('/manage', 'manage')->name('manage.advsalary');
            Route::get('/add', 'create')->name('add.advsalary');
            Route::post('/store', 'store')->name('store.advsalary');
            Route::get('/edit/{id}', 'edit')->name('edit.advsalary');
            Route::get('/show/{id}', 'edit')->name('show.advsalary');
            Route::put('/update/{id}', 'update')->name('update.advsalary');
            Route::delete('/delete/{id}', 'destroy')->name('delete.advsalary');
        });
    });

    // salary
    Route::controller(SalaryController::class)->group(function(){
        Route::group(['prefix' => '/salary',], function(){
            Route::get('/pay-salary', 'pay_salary')->name('pay.salary');
            Route::get('/add', 'create')->name('add.salary');
            Route::post('/store', 'store')->name('store.salary');
            Route::get('/edit/{id}', 'edit')->name('edit.salary');
            Route::get('/show/{id}', 'edit')->name('show.salary');
            Route::put('/update/{id}', 'update')->name('update.salary');
            Route::delete('/delete/{id}', 'destroy')->name('delete.advsalary');
        });
    });

    // Cateogry
    Route::controller(CategoryController::class)->group(function(){
        Route::group(['prefix' => '/categories',], function(){
            Route::get('/manage', 'manage')->name('manage.category');
            Route::get('/add', 'create')->name('add.category');
            Route::post('/store', 'store')->name('store.category');
            Route::get('/edit/{id}', 'edit')->name('edit.category');
            Route::get('/show/{name}', 'show')->name('show.category');
            Route::put('/update/{id}', 'update')->name('update.category');
            Route::put('/update-status/{id}', 'activeStatus')->name('update.status.category');
            Route::delete('/delete/{id}', 'destroy')->name('delete.category');
        });
    });

    // Products
    Route::controller(ProductController::class)->group(function(){
        Route::group(['prefix' => '/product',], function(){
            Route::get('/manage', 'manage')->name('manage.product');
            Route::get('/add', 'create')->name('add.product');
            Route::post('/store', 'store')->name('store.product');
            Route::get('/edit/{id}', 'edit')->name('edit.product');
            Route::get('/show/{slug}', 'show')->name('show.product');
            Route::put('/update/{id}', 'update')->name('update.product');
            Route::put('/update-status/{id}', 'activeStatus')->name('update.status.product');
            Route::delete('/delete/{id}', 'destroy')->name('delete.product');

            // import & export
            Route::get('/import-product', 'import_product')->name('import.product');
            Route::get('/export-product', 'export_product')->name('export.product');
            Route::post('/import-xlsx', 'import_xlsx')->name('import.xlsx');
        });
    });

    // expenses
    Route::controller(ExpenseController::class)->group(function(){
        Route::group(['prefix' => '/expenses',], function(){
            Route::get('/manage', 'manage')->name('manage.expenses');
            Route::get('/add', 'create')->name('add.expenses');
            Route::get('/today', 'today')->name('today.expenses');
            Route::get('/month', 'month')->name('month.expenses');
            Route::get('/year', 'year')->name('year.expenses');
            Route::post('/store', 'store')->name('store.expenses');
            Route::get('/edit/{id}', 'edit')->name('edit.expenses');
            Route::get('/show/{slug}', 'show')->name('show.expenses');
            Route::put('/update/{id}', 'update')->name('update.expenses');
            Route::delete('/delete/{id}', 'destroy')->name('delete.expenses');

            // others monthly expenses
            Route::get('/monthly-expenses/{month}', 'monthlyExpenses')->name('monthly.expenses');
            Route::get('/monthly-day-expenses', 'monthlyDayExpenses')->name('monthly.day.expenses');
        });
    });

    // Attendance
    Route::controller(AttendanceController::class)->group(function(){
        Route::group(['prefix' => '/attendence',], function(){
            Route::get('/manage', 'manage')->name('manage.attendance');
            Route::get('/add', 'take')->name('take.attendance');
            Route::post('/store', 'store')->name('store.attendance');
            Route::get('/edit/{edit_date}', 'edit')->name('edit.attendance');
            Route::get('/month-attendance', 'month_attendance')->name('month.attendance');
            Route::get('/monthly-attendances/{month}', 'monthly_attendance')->name('monthly.attendance');
            Route::put('/update/{edit_date}', 'update')->name('update.attendance');
            Route::delete('/delete/{id}', 'destroy')->name('delete.attendance');
        });
    });

    // settings
    Route::controller(SettingController::class)->group(function(){
        Route::group(['prefix' => '/settings',], function(){
            Route::get('/manage', 'manage')->name('manage.settings');
            Route::post('/update', 'update')->name('update.settings');
        });
    });

    // Pos
    Route::controller(PosController::class)->group(function(){
        Route::group(['prefix' => '/pos',], function(){
            Route::get('/manage', 'manage')->name('manage.pos');
            // cart
            Route::post('/add-cart', 'add_cart')->name('add.cart');
            Route::post('/update-cart/{id}', 'update_cart')->name('update.cart');
            Route::delete('/del-cart/{id}', 'del_cart')->name('del.cart');
            // order
            Route::post('/place-order', 'place_order')->name('place.order');
        });
    });

     // order
     Route::controller(OrderController::class)->group(function(){
        Route::group(['prefix' => '/order',], function(){
            Route::get('/manage', 'manage')->name('manage.order');
            Route::get('/details/{id}', 'show')->name('details.order');
            Route::delete('/delete/{id}', 'destroy')->name('destroy.order');
            Route::post('/update/{id}', 'update')->name('update.status');
            Route::get('/order-invoice/{id}', 'order_invoice')->name('order.invoice');
        });
    });

});
