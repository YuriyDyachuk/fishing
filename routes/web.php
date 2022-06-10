<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\Report\MediaReportController;
use App\Http\Controllers\Admin\Report\ReportController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Sites\AboutUsController;
use App\Http\Controllers\Sites\MainController;
use App\Http\Controllers\Sites\Report\CommentController;
use App\Http\Controllers\Sites\Report\CommentLikeController;
use App\Http\Controllers\Sites\Report\ReportingController;
use App\Http\Controllers\User\ChatController;
use App\Http\Controllers\User\MediaProfileController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SubscribeController;
use Illuminate\Support\Facades\Route;

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

############################## [AUTH SECTION] ##############################

Route::prefix('signup')->group(function () {
    Route::get('preview', [AuthController::class, 'index'])->name('preview');

    Route::prefix('new-customer')->group(function () {
        Route::get('', [AuthController::class, 'customRegister'])->name('new.customer');
        Route::post('', [AuthController::class, 'register'])->name('new.customer.register');

        Route::get('verify', [VerifyEmailController::class, 'verify'])->name('new.customer.verify');

        Route::prefix('verify-email')->group(function () {
            Route::get('', [VerifyEmailController::class, 'verifyEmail'])->name('new.customer.verifyEmail');
            Route::middleware('user.verifyEmail')->group(function () {
                Route::post('', [VerifyEmailController::class, 'verifySendEmail'])->name('new.customer.verifySendEmail');
            });
            Route::get('{id}/{token}', [VerifyEmailController::class, 'verifySendEmailToken'])->name('new.customer.verifySendEmailToken');
        });
    });

    Route::prefix('login')->group(function () {
        Route::get('', [AuthController::class, 'customLogin'])->name('login');
        Route::post('', [AuthController::class, 'login'])->name('new.customer.login');
    });
    Route::prefix('password-reset')->group(function () {
        Route::get('', [PasswordResetController::class, 'customPassReset'])->name('password.reset');
        Route::post('', [PasswordResetController::class, 'passwordReset'])->name('new.password.reset');
    });
});

############################## [MAIN SECTION] ##############################

Route::get('/', [MainController::class, 'index'])->name('main');
Route::get('about', [AboutUsController::class, 'index'])->name('about.us');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

############################## [REPORTING SECTION] ##############################

Route::prefix('reports')->group(function () {
    Route::get('search', [MainController::class, 'search'])->name('reporting.search');
    Route::get('load', [\App\Http\Controllers\Sites\ReportLoadMoreController::class, 'loadMore'])->name('reporting.load');
    Route::get('', [ReportingController::class, 'index'])->name('reporting.index');
    Route::get('create', [ReportingController::class, 'create'])->name('reporting.create')->middleware('auth');
    Route::post('', [ReportingController::class, 'store'])->name('reporting.store')->middleware('auth');

    Route::prefix('{id}')->group(function () {
        Route::get('', [ReportingController::class, 'show'])->name('reporting.show');
    });

    Route::middleware('auth')->prefix('comment')->group(function () {
        Route::post('', [CommentController::class, 'store'])->name('customer.comment.store');
        Route::post('reply', [CommentController::class, 'replyStore'])->name('customer.comment.reply');
        Route::post('like', [CommentLikeController::class, 'store'])->name('customer.comment.like-add');
    });
});

Route::middleware('auth')->group(function () {

    ############################## [PROFILE SECTION] ##############################
    Route::prefix('profile')->group(function () {

        Route::get('reports', [\App\Http\Controllers\Sites\ReportLoadMoreController::class, 'loadMoreReport'])->name('customer.load.report');
        Route::get('followers', [\App\Http\Controllers\Sites\ReportLoadMoreController::class, 'loadMoreFollowers'])->name('customer.load.follower');

        Route::prefix('{id}')->group(function () {
            Route::get('', [ProfileController::class, 'show'])->name('customer.profile.show');

            Route::post('subscription', [SubscribeController::class, 'store'])->name('customer.subscription.contact');
            Route::post('unsubscribe', [SubscribeController::class, 'destroy'])->name('customer.unsubscribe.contact');
            Route::patch('ban', [SubscribeController::class, 'banned'])->name('customer.subscription.ban');

            Route::middleware('user.id')->group(function () {
                Route::prefix('subscriber')->group(function () {
                    Route::get('', [SubscribeController::class, 'index'])->name('customer.profile.subscribers');
                    Route::patch('{followId}/apply', [SubscribeController::class, 'apply'])->name('customer.profile.subscriber.apply');
                    Route::delete('{followId}/cancel', [SubscribeController::class, 'cancel'])->name('customer.profile.subscriber.cancel');
                });
                Route::patch('', [ProfileController::class, 'update'])->name('customer.profile.update');
                Route::post('media', [MediaProfileController::class, 'store'])->name('customer.profile.media');
            });

            ############################## [CHAT SECTION] ##############################
            Route::prefix('chats')->group(function () {

                Route::get('', [ChatController::class, 'index'])->name('customer.chats.index');
                Route::post('', [ChatController::class, 'store'])->name('customer.chats.store');

                Route::prefix('{chatId}')->group(function () {
                    Route::get('', [ChatController::class, 'show'])->name('customer.chats.show');
                    Route::delete('', [ChatController::class, 'destroy'])->name('customer.chats.destroy');
                });

            });
        });
    });

    Route::get('region/{id}', [RegionController::class, 'index'])->name('region');
});


############################## [ADMIN SECTION] ##############################

Route::middleware(['auth', 'admin'])->group(function () {

    Route::prefix('admin')->group(function () {

        Route::get('/', [AdminController::class, 'index'])->name('admin.index');

        Route::prefix('reports')->group(function () {
            Route::get('not-published', [ ReportController::class, 'published'])->name('admin.reports.not.published');
            Route::get('', [ReportController::class, 'index'])->name('admin.reports.index');
            Route::get('create', [ReportController::class, 'create'])->name('admin.reports.create');
            Route::post('', [ReportController::class, 'store'])->name('admin.reports.store');

            Route::prefix('{id}')->group(function () {
                Route::get('', [ReportController::class, 'show'])->name('admin.reports.show');

                Route::middleware(['report.blocking.check', 'report.blocking'])->group(function () {
                    Route::get('edit', [ReportController::class, 'edit'])->name('admin.reports.edit');
                });

                Route::patch('', [ReportController::class, 'update'])->name('admin.reports.update');
                Route::delete('', [ReportController::class, 'destroy'])->name('admin.reports.destroy');

                Route::delete('media/{uuid}', [MediaReportController::class, 'destroy'])->name('admin.reports.media.delete');

                Route::delete('comment/{commentId}/delete', [\App\Http\Controllers\Admin\Report\CommentController::class, 'destroy'])->name('admin.reports.comment.destroy');

                // Sortable media report
                Route::post('media', [MediaReportController::class, 'sortable'])->name('admin.report.media.position');
            });
        });

        Route::prefix('users')->group(function () {

            Route::get('', [UserController::class, 'index'])->name('admin.users.index');
            Route::get('moderat', [UserController::class, 'moderation'])->name('admin.users.moderat')->middleware('admin.custom');
            Route::get('create', [UserController::class, 'create'])->name('admin.users.create');
            Route::post('', [UserController::class, 'store'])->name('admin.users.store');

            Route::prefix('{id}')->group(function () {
                Route::get('', [UserController::class, 'show'])->name('admin.users.show');
                Route::get('edit', [UserController::class, 'edit'])->name('admin.users.edit');
                Route::patch('', [UserController::class, 'update'])->name('admin.users.update');
                Route::delete('', [UserController::class, 'destroy'])->name('admin.users.destroy')->middleware('user.id');
                /**
                 *
                 * Ban user [ Moderation and Customer ]
                 */
            });

        });
    });
});