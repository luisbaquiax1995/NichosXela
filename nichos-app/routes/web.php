<?php

use App\Http\Controllers\BoletaController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UsuarioController;
use \App\Http\Controllers\EmpleadoController;
use \App\Http\Controllers\EncargadoController;
use \App\Http\Controllers\OcupanteController;
use \App\Http\Controllers\NichoController;
use \App\Http\Controllers\FotosNichoController;
use \App\Http\Controllers\InformesController;
use \App\Http\Controllers\InformeOcupantesControl;
use \App\Http\Controllers\NotificacionController;
use \App\Http\Controllers\ExhumacionController;

Route::get('/', function () {
    return view('login');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});

//control usuario
Route::post('/user-register', [UsuarioController::class, 'register'])->name('user.register');
Route::post('/user-login', [UsuarioController::class, 'login'])->name('user.login');
Route::get('/user-logout', [UsuarioController::class, 'logout'])->name('user.logout');
Route::get('/users', [UsuarioController::class, 'users'])->name('user.users');
//update-user
Route::get('/update-state-user/{id}/{estado}', [UsuarioController::class, 'updateStateEmployee'])->name('user.update.state.employee');

//edit-empleado
Route::get('/edit-user/{id}', [EmpleadoController::class, 'editUser'])->name('edit.user');
Route::post('/update-employee/{id_user}/{id_persona}', [EmpleadoController::class, 'updateEmployee'])->name('user.editing');

// control encargados
Route::get('/encargados', [EncargadoController::class, 'encargados'])->name('user.encargados');
Route::get('/edit-encargado/{id}', [EncargadoController::class, 'editEncargado'])->name('edit.encargado');
Route::post('user-edit-encargado/{id_user}/{id_persona}/{id_encargado}', [EncargadoController::class, 'updateEncargado'])->name('user.edit.encargado');

//control ocupantes
Route::get('/ocupantes', [OcupanteController::class, 'ocupantes'])->name('user.ocupantes');
Route::get('/ocupantesEliminados',[OcupanteController::class, 'ocupantesEliminados'])->name('ocupante.eliminados');
Route::get('/form/ocupante',[OcupanteController::class, 'formOcupante'])->name('form.ocupante');
Route::get('/ocupante-delete/{id}', [OcupanteController::class, 'deleteOcupante'])->name('ocupante.delete');
Route::get('/edit-ocupante/{id}', [OcupanteController::class, 'editOcupante'])->name('edit.ocupante');
Route::post('/add-ocupante', [OcupanteController::class, 'addOcupante'])->name('add.ocupante');
Route::post('/update-ocupante/{id}', [OcupanteController::class, 'updateOcupante'])->name('update.ocupante');

//control nichos
Route::get('/nichos/{estado}', [NichoController::class, 'nichos'])->name('nicho.nichos');
Route::get('/nichos-filtrar-codigo', [NichoController::class, 'nichosPorCodigo'])->name('nicho.porCodigo');
Route::get('/nichos-filtrar-calle', [NichoController::class, 'nichosPorCalle'])->name('nicho.porCalle');
Route::get('/nichos-filtrar-calle1', [NichoController::class, 'nichosPorCalle1'])->name('nicho.porCalle1');
Route::post('/add-nicho', [NichoController::class, 'addNicho'])->name('nicho.add');
Route::post('/nicho.edit/{id}', [NichoController::class, 'updateNicho'])->name('nicho.edit');
Route::get('/nicho-nuevo', function (){
    return view('admin.register-nicho');
});
Route::get('/editar-nicho/{id}', [NichoController::class, 'editarNicho'])->name('editar.nicho');

//control municipios
Route::get('/municipios/{id}', [MunicipioController::class, 'getByDepartamento'])->name('municipios.getByDepartamento');
//admin
Route::get('/home-admin', function () {
    return view('admin.home');
});
//encargado
Route::get('/home-encargado', function () {
    return view('encargado.home');
});
Route::get('/admin-register', function () {
    return view('admin.register-user');
});

Route::get('/admin-register-encargado', function () {
    return view('admin.register-encargado');
});

//control contratos
Route::get('/contratos', [ContratoController::class, 'listaContratos'])->name('contratos.getByEstado');
Route::get('/contrato-detalle/{id}', [ContratoController::class, 'detalleContrato'])->name('contrato.detalle');
Route::get('/contratos-por-encargado', [ContratoController::class, 'listaContratosPorEncargado'])->name('contratos.getByEstado1');
Route::get('/historico-contratos-nichos', [ContratoController::class, 'historicoNichosContratos'])->name('historico.contratos');
Route::get('/actualizar-contrato/{id}/{estado}',[ContratoController::class, 'actualizarContrato'])->name('actualizar.contrato');
Route::get('/form-nuevo-contrato', function (){
    return view('ayudante.form-contrato');
});
Route::get('/contrato-nuevo', [ContratoController::class, 'nuevoContrato'])->name('contrato.nuevo');
Route::post('/enviar.contrato', [ContratoController::class, 'enviarContrato'])->name('enviar.contrato');

//control boletas
Route::get('/boleta-solicitar/{idContrato}',[BoletaController::class, 'solicitarBoleta'])->name('boleta.solicitar');
Route::get('/solicitud-boletas', [BoletaController::class, 'solicitudesBoletas'])->name('solicitud.boletas');
Route::get('/actualizar-boleta/{id}/{estado}', [BoletaController::class, 'updatePaymentOrder'])->name('actualizar.boleta');
Route::get('/detalle-boleta/{correlativo}', [BoletaController::class, 'verDetalleBoleta'])->name('detalle.boleta');
Route::get('/boleta-por-encargado', [BoletaController::class, 'boletasPorEncargado'])->name('boleta.encargado');
Route::get('/descargar-boleta/{id}', [BoletaController::class, 'descargarBoleta'])->name('descargar.boleta');
Route::get('/subir-comprobante/{correlativo}', [BoletaController::class, 'subirComprobante'])->name('subir.comprobante');
Route::post('/archivo-boleta', [BoletaController::class, 'archivoBoleta'])->name('archivo.boleta');
Route::get('/pendintes-de-pago', [BoletaController::class, 'boletasPendientesDePago'])->name('pendintes.pago');
//control persona
Route::get('/persona-searchByDpi', [PersonaController::class, 'searchByDpi'])->name('persona.searchByDpi');

//control fotos
Route::get('/foto-nicho/{id}', [FotosNichoController::class, 'verFotosNicho'])->name('foto.nicho');

//control informes
Route::get('/dinero-recaudado', [InformesController::class, 'dineroRecaudado'])->name('dinero.recaudado');
Route::get('/dinero-recaudado-fecha', [InformesController::class, 'dineroRecaudadoPorFecha'])->name('dinero.recaudadoFecha');

//informe ocupante control
Route::get('/informe-ocupantes', [InformeOcupantesControl::class, 'reporteOcupantes'])->name('informe.ocupantes');

//control notificacion
Route::get('/ver-notificaciones', [NotificacionController::class, 'verNotificaciones'])->name('ver.notificaciones');

//control exhumaciones
Route::get('/form-solicitud-exhumacion',function(){
    return view('encargado.solicitud-exhumacion');
});
Route::get('/exhumacion-solicitudes-encargado', [ExhumacionController::class, 'solicitudesEncaragdo'])->name('exhumacion.solicitudesEncargado');
Route::get('/exhumacion-solicitudes-admin', [ExhumacionController::class, 'solicitudesAdmin'])->name('exhumacion.solicitudesAdmin');
Route::post('/solicitar-exhumacion', [ExhumacionController::class, 'solictarExhumacion'])->name('solicitar.exhumacion');
Route::get('/update-solictud-exhumacion/{id}/{estado}', [ExhumacionController::class, 'actualizarExhumacion'])->name('actualizar.exhumacion');
