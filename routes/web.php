<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use Illuminate\Support\Facades\Auth;

/*
| ------------------------------------------------- -------------------------
| Rutas web
| ------------------------------------------------- -------------------------
|
| Aquí es donde puede registrar rutas web para su aplicación. Estas
| RouteServiceProvider carga las rutas dentro de un grupo que
| contiene el grupo de middleware "web". ¡Ahora crea algo genial!
|
*/

// Route::get('/', function () {
    // return view('welcome');
// });

// URL::forceRootUrl('http://192.168.17.77/portal');

Route::redirect('/', 'login');

Auth::routes();

// grupo para evitar mostrar informacion guarda en el navegador
Route::group(['middleware' => ['PreventBackButton','auth']], function(){

    // rutas Inicio
    Route::get('/home', 'inicioController@inicio')->name('inicio');

    // rutas Contacto
    Route::get('contacto', 'contactoController@contacto')->name('contacto'); //Esta opcion es funcional, pero no la encuentro en la vista de home
    Route::post('contactar', 'contactoController@contactar')->name('contactar');

    // rutas Cambio de contraseña
    Route::get('password', 'cambiopasswordController@password')->name('password'); //Vista para el cambio de contraseña
    Route::post('changePassword','cambiopasswordController@changePassword')->name('changePassword'); //Funcion para el cambio de contraseña

    // Rutas Calificaciones
    Route::get('calificaciones-parciales', 'bimestreactualController@parciales')->name('parciales'); //Muestra calificaciones parciales (solo funciona para MACU 'MAESTRIA CUH')
    Route::get('calificaciones-boleta', 'bimestreactualController@boleta')->name('boleta'); //Muestra la ultima boleta que a llevado el alumno
    Route::get('bimestreactual-boletaPDF', 'bimestreactualController@boletaPDF')->name('boletaPDF'); //Permite descargar la boleta en pdf (para eso tiene que haber una boleta que mostrar)

    // Rutas Servicios Escolares
    Route::get('serviciosescolares-datospersonales', 'serviciosescolaresController@datospersonales')->name('datospersonales'); //Muestra los datos personales del alumno
    Route::get('serviciosescolares-kardex', 'serviciosescolaresController@kardex')->name('kardex'); //Muestra las materias con sus calificaciones que tiene en el momento de consultar esta ruta
    Route::get('boleta-individual/{id}', 'bimestreactualController@boletaPDFindividual')->name('boletaPDFindividual');

    // Route::get('serviciosescolares-constanciaconafe', 'serviciosescolaresController@constanciaconafe')->name('constanciaconafe');
    Route::get('serviciosescolares-serviciosocial', 'serviciosescolaresController@serviciosocial')->name('serviciosocial'); //Muestra los datos referente al servicio social
    
    // Rutas Finanzas
    Route::get('finanzas-adeudos', 'finanzasController@estadodecuenta')->name('estadodecuenta'); //Muestra el estado de cuenta del alumno
    Route::get('finanzas-reinscripcion', 'finanzasController@reinscripcion')->name('reinscripcion'); //Muestra la inscripcion del alumno
    Route::get('finanzas-datosfiscales', 'finanzasController@datosfiscales')->name('datosfiscales'); //Muestra un error 500 (ya se corrigio, tube que poner un if en los contadores de registros que se tienen, dependiendo del numero de los contadores (tienen que ser mayor a '0' para mostrar la vista correcta) se les muestra una vista)
    Route::post('creardatosfiscales','finanzasController@creardatosfiscales')->name('creardatosfiscales'); //Se relaciona con la opcion de datos fiscales
    Route::put('editardatosfiscales','finanzasController@editardatosfiscales')->name('editardatosfiscales'); //Se relaciona con la opcion de datos fiscales
    Route::post('solicitarfactura','finanzasController@solicitarfactura')->name('solicitarfactura'); //Se relaciona con la opcion de datos fiscales

    // Rutas Administracion
    // Solicitud
    Route::get('administracion-beca-solicitud', 'administracionController@becasolicitud')->name('becasolicitud'); //Vista para administrar la beca o becas que se tengan
    Route::post('solicitarbeca','administracionController@solicitarbeca')->name('solicitarbeca'); //Funcion para solicitar la beca del alumno
    Route::get('administracion-beca-constanciaobPDF', 'administracionController@constanciaobPDF')->name('constanciaobPDF');  //Permite descargar la solicitud de otorgamiento de beca (si es que se solicito)

    // Reactivacion
    Route::get('administracion-beca-reactivacion', 'administracionController@becareactivacion')->name('becareactivacion'); //Esto apenas estaba en construccion 
    Route::post('reactivacion','administracionController@reactivacionbeca')->name('reactivacionbeca'); //Forma parte de 'administracion-beca-reactivacion' (estaba en construccion)
    Route::get('administracion-beca-constanciarbPDF', 'administracionController@constanciarbPDF')->name('constanciarbPDF'); //Forma parte de 'administracion-beca-reactivacion' (estaba en construccion)

    // Renovacion Anual
    Route::get('administracion-beca-renovacion', 'administracionController@becarenovacion')->name('becarenovacion'); //Trae la vista de renovacion de beca 
    Route::post('renovarbeca','administracionController@renovarbeca')->name('renovarbeca'); //Funcion para solicitar la renovacion de la beca 
    Route::get('administracion-beca-constanciaPDF', 'administracionController@constanciaPDF')->name('constanciaPDF'); //Funcion que llena y descarga una constancia de la solicitud de renovacion anual de beca
    Route::put('subiarchivo','administracionController@subiarchivo')->name('subiarchivo');

    // Rutas Direccion academica
    Route::get('direccionacademica-cargaacademica', 'direccionacademicaController@cargaacademica')->name('cargaacademica'); //Muestra la vista de la carga academica

    // Rutas Biblioteca
    Route::get('biblioteca-digital', 'bibliotecaController@digital')->name('digital'); //Muestra la vista de una introduccion a la biblioteca digital.
    Route::get('biblioteca-librosenprestamo', 'bibliotecaController@librosenprestamo')->name('librosenprestamo'); //Esto apenas estaba en construccion
    Route::get('biblioteca-consultabibliografia', 'bibliotecaController@consultabibliografia')->name('consultabibliografia'); //Esto apenas estaba en construccion

    // Rutas Vacunación
    Route::get('vacunacion-registro', 'vacunacionController@registro')->name('registro'); //Muestra la vista del registro de vacunacion 
    Route::post('vacunacion-registrar', 'vacunacionController@registrar')->name('vacunacion-registrar'); //Permite registrarse para lo de la vacunacion 
    Route::get('vacunacion-comprobante', 'vacunacionController@comprobante')->name('comprobante'); //Muestra la vista del comprobante de vacunacion
    Route::put('vacunacion-subircomprobante','vacunacionController@subircomprobante')->name('vacunacion-subircomprobante'); //Permite subir el comprobante de vacunacion

    // Rutas Buzon de sugerencia
    Route::get('buzondesugerencias-dejanostucomentario', 'buzondesugerenciasController@dejanostucomentario')->name('dejanostucomentario'); //--> No existe esta ruta del controlador 

    //Ruta de descarga de documentos
    Route::get('estudiosocioeconomico-descargar', 'serviciosescolaresController@estudiosocioeconomico')->name('descargarestudiosocioeconomico'); //descargar documento
    Route::get('titulaciones', 'serviciosescolaresController@titulaciones')->name('titulaciones');

    Route::post('statustabla','administracionController@statustabla')->name('statustabla');

    // Aviso de privacidad
    Route::get('privacidad/estado', [InicioController::class, 'estadoPrivacidad'])->name('privacidad.estado');
    Route::post('privacidad/aceptar', [InicioController::class, 'aceptarPrivacidad'])->name('privacidad.aceptar');


    // Vista de Aviso de privacidad
    Route::get('aviso-privacidad', function () {return view('privacidad.documentos');})->name('avisoPrivacidad');

});