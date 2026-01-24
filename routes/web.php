<?php

use App\Http\Controllers\CenterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UniformityController;
use App\Http\Controllers\UniformityRenovationController;
use App\Http\Controllers\CommentsTrackingController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\GeneralSearchController;
use App\Http\Controllers\GeneralServiceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RRHHTopicController;
use App\Http\Controllers\RRHHTrackingController;
use App\Http\Controllers\RRHHDocsController;
use App\Http\Controllers\CenterDocumentsController;
use App\Http\Controllers\ComplementaryServiceController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ExternalContactController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MaintenanceTrackingController;
use App\Http\Controllers\MaintenanceDocsController;
use App\Http\Controllers\MaintenanceCommentController;
use App\Http\Controllers\UserDocsController;
use App\Http\Controllers\AccidentabiliteController;
use App\Http\Controllers\AccidentabiliteCommentController;
use Illuminate\Support\Facades\Auth;



// Al login solo se puede acceder si el usuario no ha iniciado session
Route::middleware("guest")->group(function () {
    Route::get("/login", [UserController::class, "showLoginForm"])->name("login");
    Route::post("/login", [UserController::class, "login"]);
});



Route::middleware("auth")->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name("dashboard");

    // Cursos
    // Primero se establece el /courses/exportAll porque sino da problemas con la ruta /courses/show (se supoerpone)
    Route::middleware("setCenterContext")->group(function () {
        Route::get("/courses/exportAll", [CourseController::class, "exportAllCourses"])->name('courses.exportAll');
        Route::resource("courses", CourseController::class);
        Route::patch("/courses/{course}/deactivate", [CourseController::class, "deactivate"])->name('courses.deactivate');
        Route::patch("/courses/{course}/activate", [CourseController::class, "activate"])->name('courses.activate');
        Route::get("/courses/{course}/users/", [CourseController::class, "showCourseUsers"])->name('courses.users');
        Route::patch("/courses/{course}/{user}/giveCertificate", [CourseController::class, "giveCertificate"])->name('courses.giveCertificate');
        Route::patch("/courses/{course}/{user}/removeCertificate", [CourseController::class, "removeCertificate"])->name('courses.removeCertificate');
        Route::post("/courses/search", [CourseController::class, "search"])->name("courses.search");
    });


    //Usuarios
    Route::middleware("setCenterContext")->group(function () {
        Route::resource("users", UserController::class);
        Route::patch('/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
        Route::patch('/users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
        Route::post("/users/search", [UserController::class, "search"])->name('users.search');
        Route::post("/users/update-profile-photo/{user}", [UserController::class, "updateProfilePhoto"])->name('users.updateProfilePhoto');
        Route::post("/switch-center", [UserController::class, "switchCenter"])->name("users.switchCenter");
        // Uniformes
        Route::get("/users/{user}/uniformities/edit", [UniformityController::class, "edit"])->name('user.uniformity.edit');
        Route::patch("/users/{user}/uniformities/update", [UniformityController::class, "update"])->name('user.uniformity.update');
    });
    Route::post("/logout", [UserController::class, "logout"])->name("users.logout");
    Route::get("/logout", function () {
        if (Auth::check()) {return redirect()->route("dashboard");}
        return redirect()->route("login");
    });

    // Centros
    Route::middleware("checkMagnamentOrAdministration")->group(function () {
        Route::resource("centers", CenterController::class)->except("destroy");
        Route::patch("/centers/{center}/deactivate", [CenterController::class, "deactivate"])->name("centers.deactivate");
        Route::patch("/centers/{center}/activate", [CenterController::class, "activate"])->name("centers.activate");
        Route::post("/centers/search", [CenterController::class, "search"])->name("centers.search");
    });


    // Proyectos
    Route::middleware("setCenterContext")->group(function () {
        Route::resource('projects', ProjectController::class);
        Route::patch('/projects/{project}/deactivate', [ProjectController::class, 'deactivate'])->name('projects.deactivate');
        Route::patch('/projects/{project}/activate', [ProjectController::class, 'activate'])->name('projects.activate');
        Route::post("/projects/search", [ProjectController::class, "search"])->name("projects.search");
        Route::delete('/project-documents/{document}', [ProjectController::class, 'deleteDocument'])->name('project-documents.destroy');
    });

    // Exportacion de taquillas
    Route::get("/exportAllLockers", [UserController::class, "exportAllLockers"])->name("exportAllLockers");
    Route::get("/exportLocker/{userId}", [UserController::class, "exportLocker"])->name("exportLocker");

    // Exportacion de uniformes
    Route::get("/exportAllUniformity", [UniformityController::class, "exportAllUniformity"])->name("exportAllUniformity");
    Route::get("/exportUniformity/{userId}", [UniformityController::class, "exportUniformity"])->name("exportUniformity");

    // Exportacion de uniformes
    Route::get("/exportAllUniformityRenovation", [UniformityRenovationController::class, "exportAllUniformityRenovation"])->name("exportAllUniformityRenovation");
    Route::get("/exportUniformityRenovation/{userId}", [UniformityRenovationController::class, "exportUniformityRenovation"])->name("exportUniformityRenovation");

    // Seguimiento de profesionales
    Route::get("/users/{user}/trackings", [TrackingController::class, "index"])->name("trackings.index");
    Route::get("/users/{user}/trackings/{tracking}", [TrackingController::class, "show"])->name("trackings.show");
    Route::post("/users/{user}/trackings/store", [TrackingController::class, "store"])->name("trackings.store");
    Route::patch('/users/{user}/trackings/{tracking}/deactivate', [TrackingController::class, 'deactivate'])->name('trackings.deactivate');

    // acidentabilidad
    Route::get("/users/{user}/accidentabilites", [AccidentabiliteController::class, "index"])->name("accidentabilites.index");
    Route::get("/users/{user}/accidentabilites/{tracking}", [AccidentabiliteController::class, "show"])->name("accidentabilites.show");
    Route::post("/users/{user}/accidentabilites/store", [AccidentabiliteController::class, "store"])->name("accidentabilites.store");

    // Comentarios accidentabilidad profesionales
    Route::post("/users/{user}/accidentabilites/{tracking}/store", [AccidentabiliteCommentController::class, "store"])->name("accidentabilites.comments.store");

    // Comentarios seguimiento profesionales
    Route::post("/users/{user}/trackings/{tracking}/store", [CommentsTrackingController::class, "store"])->name("trackings.comments.store");

    // Evaluacion de profesionales
    Route::get("/users/{user}/evaluations", [EvaluationController::class, "index"])->name("evaluations.index");
    Route::get("/users/{user}/evaluations/create", [EvaluationController::class, "create"])->name("evaluations.create");
    Route::post("/users/{user}/evaluations/store", [EvaluationController::class, "store"])->name("evaluations.store");

    // Servicios generales
    Route::middleware("setCenterContext")->group(function () {
        Route::middleware("checkMagnamentOrAdministration")->group(function () {
            Route::resource("general-services", GeneralServiceController::class);
            Route::patch("/general-services/{generalService}/deactivate", [GeneralServiceController::class, "deactivate"])->name('general-services.deactivate');
            Route::patch("/general-services/{generalService}/activate", [GeneralServiceController::class, "activate"])->name('general-services.activate');
            Route::patch("/general-services/{generalService}/deactivate", [GeneralServiceController::class, "deactivate"])->name('general-services.deactivate');
            Route::post("/general-services/{generalService}/add-observation", [GeneralServiceController::class, "addObservation"])->name("general-services.add-observation");
            Route::post("/general-services/search", [GeneralServiceController::class, "search"])->name("general-services.search");
        });    });

    //  Buscador
    Route::get("/general-search", [GeneralSearchController::class, "generalSearch"])->name("general-search");
    Route::post("/general-search", [GeneralSearchController::class, "generalSearch"])->name("general-search.index");

    // Contactos externos
    Route::middleware("setCenterContext")->group(function () {
        Route::resource("external-contacts", ExternalContactController::class);
        Route::patch("/external-contacts/{externalContact}/deactivate", [ExternalContactController::class, "deactivate"])->name("external-contacts.deactivate");
        Route::patch("/external-contacts/{externalContact}/activate", [ExternalContactController::class, "activate"])->name("external-contacts.activate");
        Route::post("/external-contacts/search", [ExternalContactController::class, "search"])->name("external-contacts.search");
    });

    // Documents
    Route::middleware("setCenterContext")->group(function () {
        Route::resource("documents", DocumentController::class);
        Route::post("/documents/search", [DocumentController::class, "search"])->name("documents.search");
        Route::get("/documents/download/{path}", [DocumentController::class, "download"])->where('path', '.*')->name("documents.download");
    });


    // Documentos del centro
    Route::middleware("checkMagnament")->group(function() {
        Route::get("/centers/{center}/documents", [CenterDocumentsController::class, "index"])->name("centers.documents");
        Route::post("/centers/{center}/documents/store", [CenterDocumentsController::class, "store"])->name("centers.documents.store");
    });

    // Servicios complementarios
    Route::middleware("setCenterContext")->group(function () {
        Route::resource("complementary-services", ComplementaryServiceController::class);
        Route::patch("/complementary-services/{complementaryService}/activate", [ComplementaryServiceController::class, "activate"])->name('complementary-services.activate');
        Route::patch("/complementary-services/{complementaryService}/deactivate", [ComplementaryServiceController::class, "deactivate"])->name('complementary-services.deactivate');
        Route::post("/complementary-services/search", [ComplementaryServiceController::class, "search"])->name("complementary-services.search");
        Route::post("/complementary-services/{complementaryService}/upload-file", [ComplementaryServiceController::class, "uploadFile"])->name("complementary-services.documents.store");
        Route::get("/complementary-services/documents/{baseName}/", [ComplementaryServiceController::class, "downloadFile"])->name("complementary-services.documents.download");
    });


    // Temas RRHH
    Route::middleware("setCenterContext")->group(function () {
        Route::middleware("checkMagnament")->group(function () {
            Route::resource("rrhh", RRHHTopicController::class)->except(["destroy","update","edit"]);
            Route::get("rrhh/{rrhh}/tracking", [RRHHTrackingController::class, "index"])->name('rrhh.tracking');
            Route::post("rrhh/{rrhh}/tracking/store", [RRHHTrackingController::class, "store"])->name('rrhh.tracking.store');
            Route::get("rrhh/{rrhh}/docs", [RRHHDocsController::class, "index"])->name('rrhh.docs');
            Route::post("rrhh/{rrhh}/docs/store", [RRHHDocsController::class, "Store"])->name('rrhh.docs.store');
            Route::post("/rrhh/search", [RRHHTopicController::class, "search"])->name("rrhh.search");
            Route::patch("/rrhh/{rrhh}/deactivate", [RRHHTopicController::class, "deactivate"])->name("rrhh.deactivate");
            Route::patch("/rrhh/{rrhh}/activate", [RRHHTopicController::class, "activate"])->name("rrhh.activate");
        });
    });

    // mantenimiento
    Route::middleware("setCenterContext")->group(function () {
        Route::middleware("checkMagnamentOrAdministration")->group(function () {
            Route::resource("maintenance", MaintenanceController::class)->except(["destroy","update","edit"]);
            Route::get("maintenance/{maintenance}/tracking", [MaintenanceTrackingController::class, "index"])->name('maintenance.tracking');
            Route::post("maintenance/{maintenance}/tracking/store", [MaintenanceTrackingController::class, "store"])->name('maintenance.tracking.store');

            Route::get("maintenance/{maintenance}/tracking/{tracking}", [MaintenanceTrackingController::class, "show"])->name('maintenance.tracking.show');
            Route::post("maintenance/{maintenance}/tracking/{tracking}/store", [MaintenanceCommentController::class, "store"])->name('maintenance.comment.store');

            Route::get("maintenance/{maintenance}/docs", [MaintenanceDocsController::class, "index"])->name('maintenance.docs');
            Route::post("maintenance/{maintenance}/docs/store", [MaintenanceDocsController::class, "Store"])->name('maintenance.docs.store');
            Route::post("/maintenance/search", [MaintenanceController::class, "search"])->name("maintenance.search");
            Route::patch("/maintenance/{maintenance}/deactivate", [MaintenanceController::class, "deactivate"])->name("maintenance.deactivate");
            Route::patch("/maintenance/{maintenance}/activate", [MaintenanceController::class, "activate"])->name("maintenance.activate");
        });
    });



    // documentos usuario
    Route::get("users/{user}/docs", [UserDocsController::class, "index"])->name('user.docs');
    Route::post("users/{user}/docs/store", [UserDocsController::class, "Store"])->name('user.docs.store');

    // accidentabilidad



    // documentos
    Route::get('documents/download/{baseName}', [DocumentController::class, 'download'])->name('doc.download');
});