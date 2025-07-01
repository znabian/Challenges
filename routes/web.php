<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\CloudController;
use App\Http\Controllers\GoldChallController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\PanelController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('/support')->group(function () {
Route::get('/login',[LoginController::class,'suppport_index'])->name('sup.Login');
Route::post('/login',[LoginController::class,'suppport_login'])->name('sup.login');
Route::post('/forget',[LoginController::class,'suppport_forget'])->name('sup.login.forget');
});

Route::get('/login',[LoginController::class,'index'])->name('Login');
Route::post('/login',[LoginController::class,'login'])->name('login');
Route::post('/forget',[LoginController::class,'forget'])->name('login.forget');

Route::middleware('Logined')->group(function () {
Route::get('/',[PanelController::class,'index'])->name('home');
Route::post('/mywallet',[PanelController::class,'MyWallet'])->name('user.wallet');
Route::get('/notifications',[NotifController::class,'index'])->name('notif.index');
Route::post('/notifications/reg',[NotifController::class,'insert'])->name('notif.reg');
Route::post('/notifications/seen',[NotifController::class,'seen'])->name('notif.seen');
Route::post('/notifications/ajax',[NotifController::class,'ajaxNotif'])->name('notif.ajax');
Route::get('/history',[PanelController::class,'history'])->name('history');
Route::get('/details/{chall}',[PanelController::class,'details'])->name('chall.details');
Route::post('/challdetails',[ChatController::class,'ajaxDetailes'])->name('chall.get');
Route::post('/chall-answer',[ChatController::class,'ajaxSetAnswer'])->name('chall.answer');
Route::post('/chall-buy',[PanelController::class,'buyChall'])->name('chall.buy');
Route::prefix('/chat')->group(function () {
    Route::get('/{chall}',[ChatController::class,'index'])->name('chat.index');
    Route::post('/send_message', [ChatController::class,'send_message'])->name('chat.send');
    Route::post('/edit_message', [ChatController::class,'edit_message'])->name('chat.update');
    Route::post('/delete_message', [ChatController::class,'delete_message'])->name('chat.delete');
    Route::post('/close', [ChatController::class,'close_chat'])->name('chat.close');
    Route::post('/{chat}/Read', [ChatController::class,'read_chat'])->name('chat.read'); 
    Route::post('/{chat}/All', [ChatController::class,'All_chat'])->name('chat.all');  
   
    Route::post('/send_quiz', [ChatController::class,'send_quiz'])->name('chat.send.quiz');  
    });
    Route::prefix('/cloud')->group(function () {
    Route::get('/index',[CloudController::class,'index'])->name('cloud.index');
    Route::post('/create-folder', [CloudController::class,'create_folder'])->name('cloud.folder.new');
    Route::get('/folders/{name}', [CloudController::class,'folder_show'])->name('cloud.file.show');
    Route::post('/uplode', [CloudController::class,'create_file'])->name('cloud.file.new');
    Route::post('/caption-edit', [CloudController::class,'caption_update'])->name('cloud.file.caption.edit');
    Route::post('/delete-file', [CloudController::class,'file_delete'])->name('cloud.file.del');
    Route::post('/move-file', [CloudController::class,'file_move'])->name('cloud.file.move');
    //Route::post('/delete-folder', [CloudController::class,'delete_message'])->name('cloud.del.folder');
    });

    Route::prefix('/message')->group(function () {
        Route::get('/',[ChatController::class,'Direct_index'])->name('direct.index');
        Route::post('/send_message', [ChatController::class,'Direct_send_message'])->name('direct.send');
        Route::post('/edit_message', [ChatController::class,'Direct_edit_message'])->name('direct.update');
        Route::post('/delete_message', [ChatController::class,'Direct_delete_message'])->name('direct.delete');
        Route::post('/Read', [ChatController::class,'Direct_read_chat'])->name('direct.read'); 
        Route::post('/{Resiver}/All', [ChatController::class,'Direct_All_chat'])->name('direct.all');  
       
        });
        Route::prefix('/Gold')->group(function () {
        Route::get('/reset',[GoldChallController::class,'reset'])->name('gold.reset');
        Route::get('/index',[GoldChallController::class,'landing'])->name('gold.landing');
        Route::get('/',[GoldChallController::class,'index'])->name('gold.index');
        Route::get('/supervisor',[GoldChallController::class,'mySupervisor'])->name('gold.supervisor');
        Route::post('/set-supervisor',[GoldChallController::class,'setSupervisor'])->name('gold.supervisor.set');
        Route::get('{castle}/headers',[GoldChallController::class,'AppHeader'])->name('gold.header');
        Route::get('{header}/subjects',[GoldChallController::class,'HeaderSubject'])->name('gold.subject');
        Route::post('select-subject',[GoldChallController::class,'SelectSubject'])->name('gold.subject.select');
        Route::get('/challs',[GoldChallController::class,'GoldChall'])->name('gold.chall');
        Route::get('/play/{vid}',[GoldChallController::class,'PlayVideo'])->name('gold.chall.paly');
        Route::post('/chall/unlock',[GoldChallController::class,'ChallDone'])->name('gold.chall.unlock');
        Route::post('/chall/setpage',[GoldChallController::class,'setPage'])->name('gold.chall.setPage');
        Route::post('/chall/reset/platform',[GoldChallController::class,'reset_platform'])->name('gold.chall.reset.platform');
       
        });
        Route::prefix('/Rank')->group(function () {
        Route::get('/',[PanelController::class,'MyRank'])->name('rank.index');
       
        });
        Route::get('/FirstCalss-abstract',[PanelController::class,'abstractList'])->name('abstract');
        Route::get('/FirstCalss-abstract/{id}',[PanelController::class,'abstractShow'])->name('abstract.show');

        Route::get('/FirstCalss-Offline',[PanelController::class,'OfflineList'])->name('Offline');
        Route::get('/FirstCalss-Offline/{id}',[PanelController::class,'OfflineShow'])->name('Offline.show');

        Route::prefix('/work')->group(function () {
            Route::get('/',[PanelController::class,'Work_index'])->name('work.index');
            Route::post('/reservation',[PanelController::class,'Work_reserve'])->name('work.res');
            Route::post('/reservation-cancel',[PanelController::class,'Work_reserve_cancel'])->name('work.res.cancel');
            Route::post('/MyReservation',[PanelController::class,'Work_Myreserve'])->name('work.get');
           
            });
        

});
