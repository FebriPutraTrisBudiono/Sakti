<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\Api\LoginController as ApiLoginController;
use App\Http\Controllers\Api\PostController as ApiPostController;
use App\Http\Controllers\Api\CategoryController as ApiCategoryController;
use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Http\Controllers\Api\KelurahanController as ApiKelurahanController;
use App\Http\Controllers\Api\PageController as ApiPageController;
use App\Http\Controllers\Backs\AboutController as BacksAboutController;
use App\Http\Controllers\Backs\CallToActionController as BacksCallToActionController;
use App\Http\Controllers\Backs\CategoryController as BacksCategoryController;
use App\Http\Controllers\Backs\CKEditorController as BacksCKEditorController;
use App\Http\Controllers\Backs\CommentController as BacksCommentController;
use App\Http\Controllers\Backs\KelurahanController as BacksKelurahanController;
use App\Http\Controllers\Backs\UserKelurahanController as BacksUserKelurahanController;
use App\Http\Controllers\Backs\LevelController as BacksLevelController;
use App\Http\Controllers\Backs\LinkController as BacksLinkController;
use App\Http\Controllers\Backs\LoginController as BacksLoginController;
use App\Http\Controllers\Backs\MenuController as BacksMenuController;
use App\Http\Controllers\Backs\PageController as BacksPageController;
use App\Http\Controllers\Backs\PostController as BacksPostController;
use App\Http\Controllers\Backs\ProfileController as BacksProfileController;
use App\Http\Controllers\Backs\SectionController as BacksSectionController;
use App\Http\Controllers\Backs\ServiceController as BacksServiceController;
use App\Http\Controllers\Backs\SettingController as BacksSettingController;
use App\Http\Controllers\Backs\SliderController as BacksSliderController;
use App\Http\Controllers\Backs\TagController as BacksTagController;
use App\Http\Controllers\Backs\TestimonialController as BacksTestimonialController;
use App\Http\Controllers\Backs\UserController as BacksUserController;
use App\Http\Controllers\Fronts\ContactController;
use App\Http\Controllers\Fronts\HomeController;
use App\Http\Controllers\Fronts\KelurahanController;
use App\Http\Controllers\Fronts\PageController;
use App\Http\Controllers\Fronts\PostController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/data/desa', [HomeController::class, 'kelurahans']);
Route::get('/data/desa/{kelurahan:id}', [HomeController::class, 'kelurahan']);
Route::get('/desa/{kelurahan:slug}', [KelurahanController::class, 'show']);
Route::get('/desa', [KelurahanController::class, 'index']);
// Route::get('/ppid', [PostController::class, 'ppid']);
Route::get('/berita-ppid', [PostController::class, 'ppid']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post:slug}', [PostController::class, 'show']);
Route::post('/comment', [PostController::class, 'postcomment']);
Route::get('/pages/{page:slug}', [PageController::class, 'show']);
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact/sendmessage', [ContactController::class, 'sendmessage']);

Route::group(['middleware' => ['guest']], function () {
    Route::get('/auth', [BacksLoginController::class, 'index'])->name('login');
    Route::post('/auth/login', [BacksLoginController::class, 'login']);
    Route::get('/auth/forgot', [BacksLoginController::class, 'forgot']);
    Route::post('/auth/reset', [BacksLoginController::class, 'reset']);
    Route::get('/auth/confirm', [BacksLoginController::class, 'confirm']);
    Route::put('/auth/newpassword', [BacksLoginController::class, 'newpassword']);
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/auth/logout', [BacksLoginController::class, 'logout']);
    Route::get('/dashboard', fn () => view('dashboard.index', [
        'title_bar'         => 'Dashboard',
        'totalPages'        => Page::count(),
        'totalPosts'        => auth()->user()->level_id === 1 ? Post::count() : Post::where('user_id', auth()->user()->id)->count(),
        'totalCategories'   => Category::count(),
        'totalUsers'        => User::count()
    ]));
    Route::get('/dashboard/users/createUsername', [BacksUserController::class, 'createUsername']);
    Route::post('/ckeditor/upload', [BacksCKEditorController::class, 'upload'])->name('image-upload');
});

Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::resource('/dashboard/about', BacksAboutController::class);
    Route::post('/dashboard/about/upload', [BacksAboutController::class, 'upload']);
    Route::resource('/dashboard/callToAction', BacksCallToActionController::class);
    Route::post('/dashboard/callToAction/upload', [BacksCallToActionController::class, 'upload']);
    Route::resource('/dashboard/categories', BacksCategoryController::class);
    Route::resource('/dashboard/comments', BacksCommentController::class);
    Route::resource('/dashboard/levels', BacksLevelController::class);
    Route::resource('/dashboard/links', BacksLinkController::class);
    Route::resource('/dashboard/menus', BacksMenuController::class);
    Route::resource('/dashboard/pages', BacksPageController::class);
    Route::post('/dashboard/pages/upload', [BacksPageController::class, 'upload']);
    Route::resource('/dashboard/posts', BacksPostController::class);
    Route::post('/dashboard/posts/upload', [BacksPostController::class, 'upload']);
    Route::resource('/dashboard/sections', BacksSectionController::class);
    Route::resource('/dashboard/services', BacksServiceController::class);
    Route::resource('/dashboard/settings', BacksSettingController::class);
    Route::resource('/dashboard/sliders', BacksSliderController::class);
    Route::resource('/dashboard/tags', BacksTagController::class);
    Route::resource('/dashboard/testimonials', BacksTestimonialController::class);
    Route::resource('/dashboard/desas', BacksKelurahanController::class);
    Route::get('/dashboard/desa', [BacksUserKelurahanController::class, 'index']);
    Route::put('/dashboard/desa/{kelurahan:id}', [BacksUserKelurahanController::class, 'update']);
    Route::resource('/dashboard/users', BacksUserController::class);
    Route::get('/dashboard/profile', [BacksProfileController::class, 'index']);
    Route::put('/dashboard/profile/{user:id}', [BacksProfileController::class, 'update']);
});

// API
Route::post('/api/auth', [ApiLoginController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/api/auth/logout', [ApiLoginController::class, 'logout']);
    Route::get('/api/posts', [ApiPostController::class, 'index']);
    Route::get('/api/posts/{post:id}', [ApiPostController::class, 'show']);
    Route::get('/api/categories', [ApiCategoryController::class, 'index']);
    Route::get('/api/categories/{category:id}', [ApiCategoryController::class, 'show']);
    Route::get('/api/users', [ApiUserController::class, 'index']);
    Route::get('/api/users/{user:id}', [ApiUserController::class, 'show']);
    Route::get('/api/desa', [ApiKelurahanController::class, 'index']);
    Route::get('/api/desa/{kelurahan:id}', [ApiKelurahanController::class, 'show']);
    Route::get('/api/pages', [ApiPageController::class, 'index']);
    Route::get('/api/pages/{page:id}', [ApiPageController::class, 'show']);
});

// menjalankan symbolic link artisan di hosting
Route::get('symlink', fn () => Artisan::call('storage:link'));
