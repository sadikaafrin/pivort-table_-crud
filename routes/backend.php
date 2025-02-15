<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\BlogController;
use App\Http\Controllers\Web\Backend\ProductController;
use App\Http\Controllers\Web\Backend\CategoryController;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\BlogCategoryController;
use App\Http\Controllers\Web\Backend\CmsHeroSectionController;
use App\Http\Controllers\Web\Backend\CmsWorkSectionController;
use App\Http\Controllers\Web\Backend\OurProcessController;
use App\Http\Controllers\Web\Backend\WhyChooseController;
use App\Http\Controllers\Web\Backend\CmsWhatWeOfferController;
use App\Http\Controllers\Web\Backend\VersionController;
use App\Http\Controllers\Web\Backend\AvailableBalanceController;
use App\Http\Controllers\Web\Backend\LanguageController;


Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/lang/{lan}', [LanguageController::class, 'change'])->name("change.lang");

Route::controller(BlogCategoryController::class)->group(function () {
    Route::get('/blog-category', 'index')->name('admin.blog.categories.index');
    Route::post('/blog-category/store', 'store')->name('admin.blog.categories.store');
    Route::get('/blog-category/edit/{id}', 'edit')->name('admin.blog.categories.edit');
    Route::post('/blog-category/update', 'update')->name('admin.blog.categories.update');
    Route::delete('/blog-category/destroy/{id}', 'destroy')->name('admin.blog.categories.destroy');
    Route::post('/blog-category/status/{id}', 'status')->name('admin.blog.categories.status');
});

Route::controller(BlogController::class)->group(function () {
    Route::get('/blog', 'index')->name('admin.blogs.index');
    Route::get('/blog/create', 'create')->name('admin.blogs.create');
    Route::post('/blog/store', 'store')->name('admin.blogs.store');
    Route::get('/blog/edit/{id}', 'edit')->name('admin.blogs.edit');
    Route::post('/blog/update/{id}', 'update')->name('admin.blogs.update');
    Route::delete('/blog/delete/{id}', 'destroy')->name('admin.blogs.delete');
    Route::post('/blog/status/{id}', 'status')->name('admin.blogs.status');
});

Route::controller(VersionController::class)->group(function () {
    Route::get('/version', 'index')->name('admin.version.index');
    Route::post('/version/store', 'store')->name('admin.version.store');
    Route::get('/version/edit/{id}', 'edit')->name('admin.version.edit');
    Route::post('/version/update', 'update')->name('admin.version.update');
    Route::delete('/version/destroy/{id}', 'destroy')->name('admin.version.destroy');
    Route::post('/version/status/{id}', 'status')->name('admin.version.status');
});

Route::controller(AvailableBalanceController::class)->group(function () {
    Route::get('/available/balance', 'index')->name('admin.available.balance.index');
    Route::post('/available/balance/store', 'store')->name('admin.available.balance.store');
    Route::get('/available/balance/edit/{id}', 'edit')->name('admin.available.balance.edit');
    Route::post('/available/balance/update', 'update')->name('admin.available.balance.update');
    Route::delete('/available/balance/destroy/{id}', 'destroy')->name('admin.available.balance.destroy');
    Route::post('/available/balance/status/{id}', 'status')->name('admin.available.balance.status');
});



Route::controller(ProductController::class)->group(function () {
    Route::get('/product', 'index')->name('admin.product.index');
    Route::post('/product/store', 'store')->name('admin.product.store');
    Route::get('/product/create', 'create')->name('admin.product.create');
    Route::get('/product/edit/{id}', 'edit')->name('admin.product.edit');
    Route::post('/product/update/{id}', 'update')->name('admin.product.update');
    Route::delete('/product/destroy/{id}', 'destroy')->name('admin.product.destroy');
    Route::get('/product/status/{id}', 'status')->name('admin.product.status');
});




//CMS
Route::controller(CmsHeroSectionController::class)->group(function () {
    Route::get('/cms-hero-section', 'index')->name('admin.cms.hero_section.index');
    Route::post('/cms-hero-section/update', 'update')->name('admin.cms.hero_section.update');

    //About us
    Route::get('/cms-about-section', 'aboutUs')->name('admin.cms.about_section.index');
    Route::post('/cms-about-section/update', 'aboutSectionUpdate')->name('admin.cms.about_section.update');

    //Our story
    Route::get('/cms-our-story-section', 'ourStory')->name('admin.cms.our_story.index');
    Route::post('/cms-our-story-section/update', 'ourStoryUpdate')->name('admin.cms.our_story.update');

    //Our mission
    Route::get('/cms-our-mission-section', 'ourMission')->name('admin.cms.our_mission.index');
    Route::post('/cms-our-mission-section/update', 'ourMissionUpdate')->name('admin.cms.our_mission.update');

    //Our mission
    Route::get('/cms-our-vision-section', 'ourVision')->name('admin.cms.our_vision.index');
    Route::post('/cms-our-vision-section/update', 'ourVisionUpdate')->name('admin.cms.our_vision.update');

    // //What we offer
    // Route::get('/cms-what-we-offer', 'weOffer')->name('admin.cms.what_we_offer.index');
    // Route::post('/cms-what-we-offer/update', 'offerUpdate')->name('admin.cms.what_we_offer.update');


    //why choose us
    Route::get('/cms-why-choose-us', 'whyChooseUs')->name('admin.cms.why_choose_us.index');
    Route::post('/cms-why-choose-us/update', 'whyChooseUsUpdate')->name('admin.cms.why_choose_us.update');
});

Route::controller(CmsWorkSectionController::class)->group(function () {
    Route::get('/cms-work-section', 'index')->name('admin.cms.how_it_works.index');
    Route::post('/cms-work-step-1/update', 'step1')->name('admin.cms.work_step_1.update');
    Route::post('/cms-work-step-2/update', 'step2')->name('admin.cms.work_step_2.update');
    Route::post('/cms-work-step-3/update', 'step3')->name('admin.cms.work_step_3.update');
    Route::post('/cms-work-step-4/update', 'step4')->name('admin.cms.work_step_4.update');
});


Route::controller(CmsWhatWeOfferController::class)->group(function () {
    Route::get('/offer-section', 'index')->name('admin.cms.offer-section.index');
    Route::post('/custom-package/update', 'customPackage')->name('admin.cms.custom_package.update');
    Route::post('/stock-option/update', 'stockOption')->name('admin.cms.stock_option.update');
    Route::post('/sustainable-choice/update', 'sustainableChoicestockOption')->name('admin.cms.sustainable_choice.update');
});

// why choose items
Route::controller(WhyChooseController::class)->group(function () {
    Route::get('/cms-why-choose-items', 'index')->name('admin.cms.why_choose_items.index');
    Route::get('/cms-why-choose-items/create', 'create')->name('admin.cms.why_choose_items.create');
    Route::post('/cms-why-choose-items/store', 'store')->name('admin.cms.why_choose_items.store');
    Route::get('/cms-why-choose-items/edit/{id}', 'edit')->name('admin.cms.why_choose_items.edit');
    Route::post('/cms-why-choose-items/update/{id}', 'update')->name('admin.cms.why_choose_items.update');
    Route::delete('/cms-why-choose-items/destroy/{id}', 'destroy')->name('admin.cms.why_choose_items.destroy');
    Route::post('/cms-why-choose-items/status/{id}', 'status')->name('admin.cms.why_choose_items.status');
});

//our process
Route::controller(OurProcessController::class)->group(function () {
    Route::get('/cms-our-process', 'index')->name('admin.cms.our_process.index');
    Route::post('/cms-process-1/update', 'process1')->name('admin.cms.process_1.update');
    Route::post('/cms-process-2/update', 'process2')->name('admin.cms.process_2.update');
    Route::post('/cms-process-3/update', 'process3')->name('admin.cms.process_3.update');
    Route::post('/cms-process-finel/update', 'processFinal')->name('admin.cms.process_final.update');
});
