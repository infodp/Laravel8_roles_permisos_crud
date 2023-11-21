<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CiudadanoController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\PostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('agenda', 'AgendaController');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('agenda/eliminar/{id}',[AgendaController::class, 'eliminar'])->name('agenda.eliminar');

Route::post('agenda/actualizar/',[AgendaController::class, 'actualizar'])->name('agenda.actualizar');

Route::post('agenda/drag_drop/',[AgendaController::class, 'drag_drop'])->name('agenda.drag_drop');

Route::post('ciudadanos/eliminarId/{id}',[CiudadanoController::class, 'eliminarId'])->name('ciudadanos.eliminar');

Route::post('cargos/eliminar/{id}',[CargoController::class, 'eliminar'])->name('cargos.eliminar');

Route::post('inscripcion/eliminar/{id}',[InscripcionController::class, 'eliminar'])->name('inscripciones.eliminar');

Route::post('mark-as-read',[AgendaController::class, 'markNotificacion'])->name('markNotificacion');

// Route::post('/mark-as-read', 'AgendaController@markNotificacion')->name('markNotificacion');

Route::get('inscribir/{ciudadano}', [App\Http\Controllers\InscripcionController::class, 'inscribir'])->name('inscribir');
Route::post('inscribir/{ciudadano}', [App\Http\Controllers\InscripcionController::class, 'store'])->name('store');
Route::post('calificar/{inscripcion}', [App\Http\Controllers\CalificacionController::class, 'update'])->name('calificaciones.update');
//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('agenda', AgendaController::class);
    Route::resource('ciudadanos', CiudadanoController::class);
    Route::resource('cargos', CargoController::class);
    Route::resource('inscripcion', InscripcionController::class);
    Route::resource('calificacion', CalificacionController::class);
    Route::resource('post', PostController::class);
});

//Ruta para marcar una notificacion como leída
Route::get('marcarunanoti/{id}', [App\Http\Controllers\PostController::class, 'markone_as_read'])->name('marcarunanoti');

// Ruta para marcar como leída las notificaciones
Route::get('mark_as_read', [App\Http\Controllers\PostController::class, 'mark_as_read'])->name('mark_as_read');

// Ruta para eliminar todas sus notifications leídas
Route::get('destroyNotifications', [App\Http\Controllers\PostController::class, 'delet_full_notify_read'])->name('destroyNotifications');


// Ruta para eliminar todas sus notifications ->IMPLEMENTAR SOLO SI ES NECESARIO.............
// Route::get('destroyNotificationsss', function (){
//     app(PostController::class)->delete_todas_noti();
//     return redirect()->back();//te retorna a la misma vista
// })->name('destroyNotificationsss');
