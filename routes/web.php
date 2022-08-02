<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Administration\Client\ClientController;
use App\Http\Controllers\Package\PackageController;
use App\Http\Controllers\Administration\Agency\AgencyController;
use App\Http\Controllers\Administration\Agent\AgentController;
use App\Http\Controllers\Administration\Airline\AirlineController;
use App\Http\Controllers\Administration\Carrier\CarrierController;
use App\Http\Controllers\Whatsapp\WhatsappController;
use App\Http\Controllers\Administration\Country\CountryController;
use App\Http\Controllers\Administration\Country\StateController;
use App\Http\Controllers\Administration\Country\ListController;
use App\Http\Controllers\Administration\Wharehouse\WharehouseController;
use App\Http\Controllers\Administration\Rate\NationalRateController;
use App\Http\Controllers\Administration\Rate\InternationalRateController;
use App\Http\Controllers\Administration\DeliveryCompany\DeliveryCompanyController;
use App\Http\Controllers\Administration\PackageStatus\PackageStatusController;
use App\Http\Controllers\Administration\Traking\TrakingController;
use App\Http\Controllers\Administration\TypeOfGoods\TypeOfGoodsController;
use App\Http\Controllers\Administration\TypeOfPackagings\TypeOfPackagingsController;
use App\Http\Controllers\AdministrationClient\Calculation\CalculationController;
use App\Http\Controllers\AdministrationClient\ClientRecipient\ClientRecipientController;
use App\Http\Controllers\Consolidado\ConsolidadoController;
use App\Http\Controllers\Historial\HistorialStatusController;
use App\Http\Controllers\Package\PackageSelectController;
use App\Http\Controllers\PackageLump\PackageLumpController;
use App\Http\Controllers\PackageTypeOfGood\PackageTypeOfGoodController;
use App\Http\Controllers\Tula\TulaController;
use App\Http\Controllers\MasterGuide\MasterGuideController;
use App\Http\Controllers\Paddle\PaddleController;
use App\Http\Controllers\PreAlert\PreAlertController;

Route::get('/', function () {
    
    return view('welcome');
})->name('welcome');

Route::post('asignacnioasd','UserController@assigndatabase')->name('assigndatabase');

Auth::routes();

Route::get('/home',  [BackendController::class, 'index'])->name('home');

Route::group(["prefix"=>'clients'],function(){
    Route::get('/index', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/register', [ClientController::class, 'register'])->name('clients.create');
    Route::post('/store', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/consult/{id_client}', [ClientController::class, 'consult'])->name('clients.consult');
});

Route::group(["prefix"=>'countries'],function(){
    Route::get('list/codephone/{id_country}',[ListController::class, 'listCodePhone'])->name('countries.listCodePhone');
    Route::get('list/makingcode/{id_country}',[ListController::class, 'listMakingCodes'])->name('countries.listMakingCodes');
    Route::get('listcity/{id_country}', [ListController::class, 'list'])->name('cities.list');

});

Route::group(["prefix"=>'trakings'],function(){
    Route::get('/', [TrakingController::class, 'index'])->name('trakings.index');
    Route::post('package', [TrakingController::class, 'packageWithTracking'])->name('trakings.packageWithTracking');

});

Route::group(["prefix"=>'agencies'],function(){
    Route::get('/', [AgencyController::class, 'index'])->name('agencies.index');
    Route::get('create', [AgencyController::class, 'create'])->name('agencies.create');
    Route::post('store', [AgencyController::class, 'store'])->name('agencies.store');
    Route::get('edit/{id}', [AgencyController::class, 'edit'])->name('agencies.edit');
    Route::delete('delete', [AgencyController::class, 'destroy'])->name('agencies.delete');
});

Route::group(["prefix"=>'airlines'],function(){
    Route::get('/', [AirlineController::class, 'index'])->name('airlines.index');
    Route::get('create', [AirlineController::class, 'create'])->name('airlines.create');
    Route::post('store', [AirlineController::class, 'store'])->name('airlines.store');
    Route::get('edit/{id}', [AirlineController::class, 'edit'])->name('airlines.edit');
    Route::patch('update/{id}', [AirlineController::class, 'update'])->name('airlines.update');
    Route::delete('delete', [AirlineController::class, 'destroy'])->name('airlines.delete');
});


Route::group(["prefix"=>'whatsapps'],function(){
    Route::get('/', [WhatsappController::class, 'index'])->name('whatsapps.index');

});

Route::group(["prefix"=>'countries'],function(){
    Route::get('/', [CountryController::class, 'index'])->name('countries.index');
    Route::get('create', [CountryController::class, 'create'])->name('countries.create');
    Route::post('store', [CountryController::class, 'store'])->name('countries.store');
    Route::get('edit/{id}', [CountryController::class, 'edit'])->name('countries.edit');
    Route::patch('update/{id}', [CountryController::class, 'update'])->name('countries.update');
    Route::delete('delete', [CountryController::class, 'destroy'])->name('countries.delete');
});

Route::group(["prefix"=>'cities'],function(){
    Route::get('/', [StateController::class, 'index'])->name('cities.index');
    Route::get('create', [StateController::class, 'create'])->name('cities.create');
    Route::post('store', [StateController::class, 'store'])->name('cities.store');
    Route::get('edit/{id}', [StateController::class, 'edit'])->name('cities.edit');
    Route::patch('update/{id}', [StateController::class, 'update'])->name('cities.update');
    Route::delete('delete', [StateController::class, 'destroy'])->name('cities.delete');
});

Route::group(["prefix"=>'wharehouses'],function(){
    Route::get('/', [WharehouseController::class, 'index'])->name('wharehouses.index');
    Route::get('create', [WharehouseController::class, 'create'])->name('wharehouses.create');
    Route::post('store', [WharehouseController::class, 'store'])->name('wharehouses.store');
    Route::get('edit/{id}', [WharehouseController::class, 'edit'])->name('wharehouses.edit');
    Route::patch('update/{id}', [WharehouseController::class, 'update'])->name('wharehouses.update');
    Route::delete('delete', [WharehouseController::class, 'destroy'])->name('wharehouses.delete');
});

Route::group(["prefix"=>'national_rates'],function(){
    Route::get('/', [NationalRateController::class, 'index'])->name('national_rates.index');
    Route::get('create',[NationalRateController::class, 'create'])->name('national_rates.create');
    Route::post('store', [NationalRateController::class, 'store'])->name('national_rates.store');
    Route::get('edit/{id}', [NationalRateController::class, 'edit'])->name('national_rates.edit');
    Route::patch('update/{id}', [NationalRateController::class, 'update'])->name('national_rates.update');
    Route::delete('delete', [NationalRateController::class, 'destroy'])->name('national_rates.delete');
});

Route::group(["prefix"=>'international_rates'],function(){
    Route::get('/', [InternationalRateController::class, 'index'])->name('international_rates.index');
    Route::get('create',[InternationalRateController::class, 'create'])->name('international_rates.create');
    Route::post('store', [InternationalRateController::class, 'store'])->name('international_rates.store');
    Route::get('edit/{id}', [InternationalRateController::class, 'edit'])->name('international_rates.edit');
    Route::patch('update/{id}', [InternationalRateController::class, 'update'])->name('international_rates.update');
    Route::delete('delete', [InternationalRateController::class, 'destroy'])->name('international_rates.delete');
});


Route::group(["prefix"=>'delivery_companies'],function(){
    Route::get('/', [DeliveryCompanyController::class, 'index'])->name('delivery_companies.index');
    Route::get('create',[DeliveryCompanyController::class, 'create'])->name('delivery_companies.create');
    Route::post('store', [DeliveryCompanyController::class, 'store'])->name('delivery_companies.store');
    Route::get('edit/{id}', [DeliveryCompanyController::class, 'edit'])->name('delivery_companies.edit');
    Route::patch('update/{id}', [DeliveryCompanyController::class, 'update'])->name('delivery_companies.update');
    Route::delete('delete', [DeliveryCompanyController::class, 'destroy'])->name('delivery_companies.delete');
});

Route::group(["prefix"=>'carriers'],function(){
    Route::get('/', [CarrierController::class, 'index'])->name('carriers.index');
    Route::get('create',[CarrierController::class, 'create'])->name('carriers.create');
    Route::post('store', [CarrierController::class, 'store'])->name('carriers.store');
    Route::get('edit/{id}', [CarrierController::class, 'edit'])->name('carriers.edit');
    Route::patch('update/{id}', [CarrierController::class, 'update'])->name('carriers.update');
    Route::delete('delete', [CarrierController::class, 'destroy'])->name('carriers.delete');
});

Route::group(["prefix"=>'type_of_goods'],function(){
    Route::get('/', [TypeOfGoodsController::class, 'index'])->name('type_of_goods.index');
    Route::get('create',[TypeOfGoodsController::class, 'create'])->name('type_of_goods.create');
    Route::post('store', [TypeOfGoodsController::class, 'store'])->name('type_of_goods.store');
    Route::get('edit/{id}', [TypeOfGoodsController::class, 'edit'])->name('type_of_goods.edit');
    Route::patch('update/{id}', [TypeOfGoodsController::class, 'update'])->name('type_of_goods.update');
    Route::delete('delete', [TypeOfGoodsController::class, 'destroy'])->name('type_of_goods.delete');
});

Route::group(["prefix"=>'type_of_packagings'],function(){
    Route::get('/', [TypeOfPackagingsController::class, 'index'])->name('type_of_packagings.index');
    Route::get('create', [TypeOfPackagingsController::class, 'create'])->name('type_of_packagings.create');
    Route::post('store', [TypeOfPackagingsController::class, 'store'])->name('type_of_packagings.store');
    Route::get('edit/{id}', [TypeOfPackagingsController::class, 'edit'])->name('type_of_packagings.edit');
    Route::patch('update/{id}', [TypeOfPackagingsController::class, 'update'])->name('type_of_packagings.update');
    Route::delete('delete', [TypeOfPackagingsController::class, 'destroy'])->name('type_of_packagings.delete');
});

Route::group(["prefix"=>'package_status'],function(){
    Route::get('/', [PackageStatusController::class, 'index'])->name('package_status.index');
    Route::get('create', [PackageStatusController::class, 'create'])->name('package_status.create');
    Route::post('store', [PackageStatusController::class, 'store'])->name('package_status.store');
    Route::get('edit/{id}', [PackageStatusController::class, 'edit'])->name('package_status.edit');
    Route::patch('update/{id}', [PackageStatusController::class, 'update'])->name('package_status.update');
    Route::delete('delete', [PackageStatusController::class, 'destroy'])->name('package_status.delete');
});


Route::group(["prefix"=>'agents'],function(){
    Route::get('/', [AgentController::class, 'index'])->name('agents.index');
    Route::get('create', [AgentController::class, 'create'])->name('agents.create');
    Route::post('store', [AgentController::class, 'store'])->name('agents.store');
    Route::get('edit/{id}', [AgentController::class, 'edit'])->name('agents.edit');
    Route::patch('update/{id}', [AgentController::class, 'update'])->name('agents.update');
    Route::delete('delete', [AgentController::class, 'destroy'])->name('agents.delete');
});

Route::group(["prefix"=>'packages'],function(){
    Route::get('index', [PackageController::class, 'index'])->name('packages.index');
    Route::get('create/{id?}', [PackageController::class, 'create'])->name('packages.create');
    Route::post('store', [PackageController::class, 'store'])->name('packages.store');
    Route::get('tracking/{tracking?}', [PackageController::class, 'createByTracking'])->name('packages.createByTracking');
    
    Route::get('client/{id_client}/{id_package?}', [PackageController::class, 'createWithClient'])->name('packages.createWithClient');
    Route::get('select/client/{id_package?}', [PackageSelectController::class, 'selectClient'])->name('packages.selectClient');

    Route::post('update/{id}', [PackageController::class, 'update'])->name('packages.update');
});

Route::group(["prefix"=>'packages_lumps'],function(){
    Route::post('store', [PackageLumpController::class, 'store'])->name('packages_lumps.store');
    Route::get('edit/{id}', [PackageLumpController::class, 'edit'])->name('packages_lumps.edit');
    Route::patch('update/{id}', [PackageLumpController::class, 'update'])->name('packages_lumps.update');
    Route::delete('delete', [PackageLumpController::class, 'destroy'])->name('packages_lumps.delete');
});

Route::group(["prefix"=>'packages_type_of_goods'],function(){
    Route::post('store', [PackageTypeOfGoodController::class, 'store'])->name('packages_type_of_goods.store');
    Route::get('edit/{id}', [PackageTypeOfGoodController::class, 'edit'])->name('packages_type_of_goods.edit');
    Route::patch('update/{id}', [PackageTypeOfGoodController::class, 'update'])->name('packages_type_of_goods.update');
    Route::delete('delete', [PackageTypeOfGoodController::class, 'destroy'])->name('packages_type_of_goods.delete');
});

Route::group(["prefix"=>'tulas'],function(){
    Route::get('index', [TulaController::class, 'index'])->name('tulas.index');
    Route::get('create/{id?}', [TulaController::class, 'create'])->name('tulas.create');
    Route::post('store', [TulaController::class, 'store'])->name('tulas.store');
    Route::post('update/{id}', [TulaController::class, 'update'])->name('tulas.update');
    Route::post('storePackage', [TulaController::class, 'storePackage'])->name('tulas.storePackage');
});

Route::group(["prefix"=>'master_guides'],function(){
    Route::get('index', [MasterGuideController::class, 'index'])->name('master_guides.index');
    Route::get('create/{id?}', [MasterGuideController::class, 'create'])->name('master_guides.create');
    Route::post('store', [MasterGuideController::class, 'store'])->name('master_guides.store');
    Route::post('update/{id}', [MasterGuideController::class, 'update'])->name('master_guides.update');
    
    Route::post('storeTula', [MasterGuideController::class, 'storeTula'])->name('master_guides.storeTula');
});

Route::group(["prefix"=>'paddles'],function(){
    Route::get('index', [PaddleController::class, 'index'])->name('paddles.index');
    Route::get('create/{id?}', [PaddleController::class, 'create'])->name('paddles.create');
    Route::post('store', [PaddleController::class, 'store'])->name('paddles.store');
    Route::post('update/{id}', [PaddleController::class, 'update'])->name('paddles.update');
    Route::post('storePackage', [PaddleController::class, 'storePackage'])->name('paddles.storePackage');
});

Route::group(["prefix"=>'pre_alerts'],function(){
    Route::get('index', [PreAlertController::class, 'index'])->name('pre_alerts.index');
    Route::get('create/{id?}', [PreAlertController::class, 'create'])->name('pre_alerts.create');
    Route::post('store', [PreAlertController::class, 'store'])->name('pre_alerts.store');
    Route::post('update/{id}', [PreAlertController::class, 'update'])->name('pre_alerts.update');
});


Route::group(["prefix"=>'consolidados'],function(){
    Route::get('index', [ConsolidadoController::class, 'index'])->name('consolidados.index');
    Route::post('aerial', [ConsolidadoController::class, 'aerial'])->name('consolidados.aerial');
    Route::post('maritime', [ConsolidadoController::class, 'maritime'])->name('consolidados.maritime');
});


Route::group(["prefix"=>'historial_status'],function(){
    Route::get('viewPackage/{id_package}', [HistorialStatusController::class, 'viewPackage'])->name('historial_status.viewPackage');
    Route::post('store', [HistorialStatusController::class, 'store'])->name('historial_status.store');
    Route::get('edit/{id}', [HistorialStatusController::class, 'edit'])->name('historial_status.edit');
    Route::post('update/{id}', [HistorialStatusController::class, 'update'])->name('historial_status.update');
    Route::delete('delete', [HistorialStatusController::class, 'destroy'])->name('historial_status.delete');
});


/* CLIENTS */
Route::group(["prefix"=>'client_recipients'],function(){
    Route::get('/index', [ClientRecipientController::class, 'index'])->name('client_recipients.index');
    Route::get('/register', [ClientRecipientController::class, 'create'])->name('client_recipients.create');
    Route::post('/store', [ClientRecipientController::class, 'store'])->name('client_recipients.store');
    Route::get('edit/{id}', [ClientRecipientController::class, 'edit'])->name('client_recipients.edit');
    Route::patch('update/{id}', [ClientRecipientController::class, 'update'])->name('client_recipients.update');
    Route::delete('delete', [ClientRecipientController::class, 'destroy'])->name('client_recipients.delete');
});
Route::group(["prefix"=>'calculations'],function(){
    Route::get('index', [CalculationController::class, 'index'])->name('calculations.index');
    Route::post('store', [CalculationController::class, 'store'])->name('calculations.store');
});
/*------------------------- */