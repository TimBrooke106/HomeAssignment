use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::prefix('products')->name('products.')->group(function () {
    Route::view('/', 'products.index')->name('index');
    Route::view('/create', 'products.create')->name('create');
});
