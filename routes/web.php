<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;



Route::view('admin_login','admin-login');
Route::post('admin_login',[AdminController::class,'adminLogin']);
//middleware
Route::middleware('CheckadminAuth')->group(function(){
    Route::get('admin_dashboard',[AdminController::class,'adminDashboard']);
    Route::get('admin_category',[AdminController::class,'adminCategory']);
Route::get('delete_category/{id}',[AdminController::class,'deleteCategory']);
Route::post('admin_category',[AdminController::class,'addCategory']);
Route::get('admin_logout',[AdminController::class,'adminLogout']);
Route::get('admin_logout',[AdminController::class,'adminLogout']);
Route::get('add_quiz',[AdminController::class,'addQuiz']);
Route::post('add_mcq',[AdminController::class,'addMCQ']);
Route::get('end_quiz',[AdminController::class,'endQuiz']);
Route::get('show_quiz/{id}/{quizName}',[AdminController::class,'showQuiz']);
Route::get('quiz_list/{id}/{category}',[AdminController::class,'quizList']);
Route::get('admin_users',[AdminController::class,'adminUsers']);
Route::get('export_users',[AdminController::class,'exportUsers']);
Route::get('admin_all_categories',[AdminController::class,'adminAllCategories']);
Route::get('admin_all_quizzes',[AdminController::class,'adminAllQuizzes']);
Route::get('admin_all_mcqs',[AdminController::class,'adminAllMcqs']);
Route::get('delete_quiz/{id}',[AdminController::class,'deleteQuiz']);
Route::get('delete_mcq/{id}',[AdminController::class,'deleteMcq']);
});

// user
Route::get('/',[UserController::class,'welcome']);
route::get('show-category',[UserController::class,'showCategory']);
Route::get('user-quiz-list/{id}/{category}',[UserController::class,'QuizPage']);
Route::get('start-quiz/{id}/{name}',[UserController::class,'startQuiz']);
Route::get('user_signup',[UserController::class,'userSignup']);
Route::post('user_signup',[UserController::class,'getSignup']);
Route::get('user_logout',[UserController::class,'userLogout']);
Route::get('user_signup_quiz',[UserController::class,'getSignupQuiz']);
Route::get('user_login',[UserController::class,'loginPage']);
Route::post('user_login',[UserController::class,'userLogin']);
Route::get('user_login_quiz',[UserController::class,'userLoginquiz']);
Route::get('quiz-search',[UserController::class,'QuizSearch']);
Route::get('verify-email/{email}',[UserController::class,'verifyEmail']);
Route::get('forget-password',[UserController::class,'forgetPassword']);
Route::post('forget-password',[UserController::class,'userForgetPassword']);
Route::get('verify-forget-password/{email}',[UserController::class,'verifyForgetPassword']);
Route::post('set-forget-password',[UserController::class,'setForgetPassword']);
Route::get('about',[UserController::class,'about']);

Route::middleware('checkUserAuth')->group(function(){
Route::get('attempt-mcq/{id}/{name}',[UserController::class,'mcqPage']);
Route::post('submit-next/{id}',[UserController::class,'submitNext']);
Route::get('user-details',[UserController::class,'userDetails']);
Route::get('certificate',[UserController::class,'certificate']);
Route::get('download-certificate',[UserController::class,'downloadCertificate']);
Route::get('download-excel',[UserController::class,'downloadExcel']);



});


