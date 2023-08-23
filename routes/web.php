<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TrainerAllocationController;
use App\Http\Controllers\CompilerController;
use App\Http\Controllers\CodingAnswerController;



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



Route::post('/store-coding-answer', [CodingAnswerController::class, 'store']);
Route::get('/get-coding-answer/{studentId}/{questionId}', [CodingAnswerController::class, 'getAnswerAndOutput']);






Route::get('/', function () {
    return view('auth.home');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/ulogin', function () {
    return view('auth.ulogin');
});

// Route::get('/student', function () {
//     return view('auth.student');
// });
Route::post('/register', [DepartmentController::class, 'register']);
Route::post('/login', [DepartmentController::class, 'login'])->name('login');
Route::match(['GET', 'POST'], '/logout', [DepartmentController::class, 'logout'])->name('logout');

Route::post('/ulogin', [DepartmentController::class, 'ulogin'])->name('ulogin');
// Route::get('/students/{id}', [DepartmentController::class, 'show'])->name('student.show');
// Route::get('/students', [DepartmentController::class, 'show']);
Route::middleware(['auth', 'students'])->group(function () {
    Route::get('/students', [DepartmentController::class, 'show']);
    Route::get('/viewcourse', [DepartmentController::class, 'viewcourse']);
    Route::get('/testquestions/{subtopicid}', [DepartmentController::class, 'testquestions'])->name('testquestions');
   Route::get('/mcqtest/{subtopic_id}', [DepartmentController::class, 'mcqtest'])->name('');
    Route::get('/coursedetails/{course_id}', [DepartmentController::class, 'coursedetails'])->name('coursedetails');
    Route::get('/get-questions/{subtopic_id}', [DepartmentController::class, 'getQuestions'])->name('getQuestions');
    Route::post('/compiler', [DepartmentController::class, 'compile'])->name('compiler.compile');
    Route::post('/store-coding-answer', [DepartmentController::class, 'storeCodingAnswer'])->name('store-coding-answer');
});


//department
Route::get('/department',[DepartmentController::class,'department'])->name('department');
Route::post('store',[DepartmentController::class,'store'])->name('store');

//batch
Route::get('batch',[DepartmentController::class,'batch'])->name('batch');
Route::post('batchstore',[DepartmentController::class,'batchstore'])->name('batchstore');

//section
Route::post('secstore',[DepartmentController::class,'secstore'])->name('secstore');
Route::get('/section',[DepartmentController::class,'section'])->name('section');

//course
Route::get('/course',[DepartmentController::class,'course'])->name('course');
Route::post('cstore',[DepartmentController::class,'cstore'])->name('cstore');

//department crud
Route::get('edit/{id}',[DepartmentController::class,'edit'])->name('edit');
Route::post('dupdate/{id}',[DepartmentController::class,'dupdate'])->name('dupdate');
Route::get('delete/{id}',[DepartmentController::class,'destroy'])->name('delete');

//section crud
Route::get('section/edit/{id}',[DepartmentController::class,'editSection'])->name('section.edit');
Route::put('section/update/{id}', [DepartmentController::class,'updateSection'])->name('section.update');
Route::get('section/delete/{id}', [DepartmentController::class,'deleteSection'])->name('section.delete');

//batch crud
Route::get('bedit/{id}',[DepartmentController::class,'bedit'])->name('bedit');
Route::post('bdupdate/{id}',[DepartmentController::class,'bupdate'])->name('bupdate');
Route::get('bdelete/{id}',[DepartmentController::class,'bdestroy'])->name('bdelete');

//upload student details
Route::get('/uploadstudent', [UserController::class, 'uploads'])->name('uploads');
Route::post('/import-user', [UserController::class, 'import_user'])->name('import_user');
Route::get('/export-user', [UserController::class, 'export_user'])->name('export_user');

//Student Crud
Route::get('studentedit/{id}', [UserController::class, 'studentedit'])->name('studentedit');
Route::post('studentupdate/{id}', [UserController::class, 'studentupdate'])->name('studentupdate');
Route::get('studentdelete/{id}', [UserController::class, 'studentdelete'])->name('studentdelete');

Route::get('sections/{department_id}', [DropdownController::class, 'getSections'])->name('get_sections');
Route::get('batches/{section_id}', [DropdownController::class, 'getBatches'])->name('get_batches');

//course crud
Route::get('cedit/{id}',[DepartmentController::class,'cedit'])->name('cedit');
Route::post('cupdate/{id}',[DepartmentController::class,'cupdate'])->name('cupdate');
Route::get('cdelete/{id}',[DepartmentController::class,'cdestroy'])->name('cdelete');

//topic crud
Route::get('/topic',[DepartmentController::class,'topic'])->name('topic');
Route::post('tstore',[DepartmentController::class,'tstore'])->name('tstore');
Route::get('tedit/{id}',[DepartmentController::class,'tedit'])->name('tedit');
Route::post('tdupdate/{id}',[DepartmentController::class,'tupdate'])->name('tupdate');
Route::get('tdelete/{id}',[DepartmentController::class,'tdestroy'])->name('tdelete');

//subtopic crud
Route::get('/subtopic',[DepartmentController::class,'subtopic'])->name('subtopic');
Route::post('ststore',[DepartmentController::class,'ststore'])->name('ststore');
Route::get('stedit/{id}',[DepartmentController::class,'stedit'])->name('stedit');
Route::post('stdupdate/{id}',[DepartmentController::class,'stupdate'])->name('stupdate');
Route::get('stdelete/{id}',[DepartmentController::class,'stdestroy'])->name('stdelete');
Route::get('topics/{course_id}/get-topics', [DepartmentController::class, 'getTopics'])->name('getTopics');

//Trainer
Route::get('/trainer',[DepartmentController::class,'trainer'])->name('trainer');
Route::post('trainerstore',[DepartmentController::class,'trainerstore'])->name('trainerstore');
Route::get('traineredit/{id}',[DepartmentController::class,'traineredit'])->name('traineredit');
Route::post('trainerupdate/{id}',[DepartmentController::class,'trainerupdate'])->name('trainerupdate');
Route::get('trainerdelete/{id}',[DepartmentController::class,'trainerdestroy'])->name('trainerdelete');

//allocate
Route::get('/allocate',[DepartmentController::class,'allocate'])->name('allocate');

Route::post('/get-sections', [SectionController::class, 'getSections'])->name('get-sections');


// Route for storing TrainerAllocation data
Route::post('/astore', [DepartmentController::class, 'astore'])->name('astore');

Route::get('aedit/{id}', [DepartmentController::class, 'aedit'])->name('aedit');
Route::post('aupdate/{id}', [DepartmentController::class, 'aupdate'])->name('aupdate');
Route::delete('adelete/{id}', [DepartmentController::class, 'adestroy'])->name('adelete');

//ide
Route::get('/idepage', [DepartmentController::class, 'idepage'])->name('idepage');
Route::get('/gettopicside', [DepartmentController::class, 'gettopicside'])->name('gettopicside');
Route::post('/idestore', [DepartmentController::class, 'idestore'])->name('idestore');

Route::get('/coding/edit/{id}', [DepartmentController::class, 'editCoding'])->name('coding.edit');
Route::put('/coding/update/{id}', [DepartmentController::class, 'updateCoding'])->name('coding.update');
Route::delete('/coding/destroy/{id}', [DepartmentController::class, 'destroyCoding'])->name('coding.destroy');



//mcq page route
Route::get('/mcqpage', [DepartmentController::class, 'mcqpage'])->name('mcqpage');
Route::post('/mcqstore', [DepartmentController::class, 'mcqstore'])->name('mcqstore');
Route::get('/mcq', [DepartmentController::class, 'showMcqPage'])->name('mcq.page');

Route::get('/mcq/edit/{id}', [DepartmentController::class, 'editMcq'])->name('mcq.edit');
Route::put('/mcq/update/{id}', [DepartmentController::class, 'updateMcq'])->name('mcq.update');
Route::delete('/mcq/destroy/{id}', [DepartmentController::class, 'destroyMcq'])->name('mcq.destroy');







