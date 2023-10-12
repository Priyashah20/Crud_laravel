<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\NewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\MyMailController;
use App\Http\Controllers\BrowserController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FrontLoginController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
/*-------------------------------Dashboard----------------------------------------------------*/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*-------------------------------Users--------------------------------------------------------*/
Route::get('/users/changeStatus',[App\Http\Controllers\UserController::class,'changeStatus'])->name('users.changeStatus');
Route::resource('users', UserController::class)->middleware('is_Admin');
Route::get('users/{id}/delete', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
Route::post('validate_email', [UserController::class, 'email']);
Route::get('validate_email', [UserController::class, 'email']);
Route::get('image/{id?}', [UserController::class, 'getFile'])->name('getfile');

/*-------------------------------UpdateUser----------------------------------------------------*/
Route::get('/admin/profiles', [UpdateController::class, 'index'])->name('new.edit')->middleware('is_Admin');
Route::post('/admin/profiles/update', [App\Http\Controllers\UpdateController::class, 'update'])->name('user.update');
Route::post('validate_email', [UpdateController::class, 'email']);

/*-------------------------------ChangePassword------------------------------------------------*/
Route::get('/admin/settings', [App\Http\Controllers\ChangePasswordController::class, 'showChangePasswordGet'])->name('changePasswordGet');
Route::post('/admin/settings', [App\Http\Controllers\ChangePasswordController::class, 'changePasswordPost'])->name('changePasswordPost');

/*-------------------------------Product--------------------------------------------------------*/
Route::get('/products/changeStatus',[App\Http\Controllers\ProductController::class,'changeStatus'])->name('products.changeStatus');
Route::resource('products', ProductController::class)->middleware('is_Admin');
Route::get('products/{id}/delete', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');
Route::get('products/image/{id}', [App\Http\Controllers\ProductController::class, 'delete'])->name('products.deleteimage');
Route::get('products/get-product/{id}', [ProductController::class, 'getProduct']);
Route::get('products/get-image/{id}', [ProductController::class, 'getImage']);
Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('product/{product}', [ProductController::class,'show'])->name('product.show');

/*-------------------------------Category-------------------------------------------------------*/
Route::resource('categories', CategoryController::class)->middleware('is_Admin');
Route::get('categories/{id}/delete', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('phone/{id}', [SiteController::class, 'getPhone']);
Route::get('user/{id}', [SiteController::class, 'getUser']);

Route::get('send-email', [SendEmailController::class, 'index']);
Route::get('send-mail',[MailController::class, 'myTestMail']);
Route::get('send-sms-notification', [SmsController::class, 'sendSmsNotificaition']);
Route::get('generate-pdf', [PDFController::class, 'generatePDF']);
Route::get('mymail',[MyMailController::class, 'myMail']);
Route::get('browser-usage', [BrowserController::class, 'index']);

/*-------------------------------Students--------------------------------------------------------*/
Route::get('student-list/', [StudentsController::class,'index'])->name('students.index')->middleware('is_Admin');
Route::get('students/create', [StudentsController::class,'create'])->name('students.create');
Route::post('students/store',[StudentsController::class,'store'])->name('students.store');
Route::get('students/edit/{id?}', [StudentsController::class,'edit'])->name('students.edit');
Route::post('students/update/{id?}', [StudentsController::class,'update'])->name('students.update');
Route::get('students/image/{id?}', [StudentsController::class, 'getFile'])->name('students.getfile');
Route::post('validate_email', [StudentsController::class, 'email']);
Route::post('students/delete', [StudentsController::class, 'destroy'])->name('students.destroy');
Route::post('getDepartment',[StudentsController::class,'getDepartment'])->name('departmentlist');

/*-------------------------------Teacher---------------------------------------------------------*/
Route::get('teacher-list',[TeacherController::class,'index'])->name('teacher.index')->middleware('is_Admin');
Route::get('teacher/create', [TeacherController::class,'create'])->name('teacher.create');
Route::post('teacher/store',[TeacherController::class,'store'])->name('teacher.store');
Route::post('teacher/edit', [TeacherController::class,'edit'])->name('teacher.edit');
Route::post('teacher/update', [TeacherController::class,'update'])->name('teacher.update');
Route::get('teacher/image/{id?}', [TeacherController::class, 'getFile'])->name('teacher.getfile');
Route::post('validate_email', [TeacherController::class, 'email'])->name('teacher.email');
Route::post('teacher/delete', [TeacherController::class, 'destroy'])->name('teacher.destroy');

/*-------------------------------Department--------------------------------------------------------*/
Route::get('department-list',[DepartmentController::class,'index'])->name('department.index')->middleware('is_Admin');
Route::get('department/create', [DepartmentController::class,'create'])->name('department.create');
Route::post('department/store',[DepartmentController::class,'store'])->name('department.store');
Route::get('department/edit/{id?}', [DepartmentController::class,'edit'])->name('department.edit');
Route::post('department/update/{id?}', [DepartmentController::class,'update'])->name('department.update');
Route::post('department/delete', [DepartmentController::class, 'destroy'])->name('department.destroy');

/*-------------------------------Front-------------------------------------------------------------*/
Route::get('shop/home',[FrontController::class,'index'])->name('front.index');
Route::post('categorylist',[FrontController::class,'category_list'])->name('front.category_list');
Route::post('search',[FrontController::class,'search'])->name('front.search');
Route::post('price',[FrontController::class,'price'])->name('front.price');

/*-------------------------------Cart--------------------------------------------------------------*/
Route::get('cart/list',[CartController::class,'index'])->name('cart.index');
Route::get('cartlist/{id}',[CartController::class,'addToCart'])->name('cart.list');
Route::post('cartlist/update',[CartController::class,'update'])->name('cart.update');
Route::get('cartlist/delete/{id?}',[CartController::class,'destroy'])->name('cart.destroy');
Route::post('cartlist/empty/{id?}',[CartController::class,'empty'])->name('cart.empty');

/*-------------------------------Order-------------------------------------------------------------*/
Route::get('checkout',[OrderController::class,'index'])->name('order.index');
Route::post('order/store',[OrderController::class,'order'])->name('order.store');

/*-------------------------------FrontLogin--------------------------------------------------------*/
Route::get('frontlogin',[FrontLoginController::class,'index'])->name('login.index');
Route::post('frontsignUp',[FrontLoginController::class,'signUp'])->name('signUp.store');
Route::post('loginuser',[FrontLoginController::class,'login'])->name('login.store');

/*------------------------------Admin--------------------------------------------------------------*/
Route::get('admin',[AdminController::class,'index'])->name('admin.index');
Route::post('admin/dologin',[AdminController::class,'adminLogin'])->name('admin.login');
Route::post('admin/signup',[AdminController::class,'adminSignUp'])->name('admin.signup');
Route::any('admin/logout',[AdminController::class,'logout'])->name('admin.logout');
