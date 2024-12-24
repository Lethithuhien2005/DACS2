<?php

use Illuminate\Support\Facades\Route;

//Fontend
use App\Http\Controllers\HomeHandle;
Route::get('/', [HomeHandle::class, 'index']);
Route::get('/homepage', [HomeHandle::class, 'index']);
Route::get('/aboutus', [HomeHandle::class, 'showAboutus']);
Route::get('/contact', [HomeHandle::class, 'showContact']);

use App\Http\Controllers\MenuHandle;
Route::get('/menu', [MenuHandle::class, 'showMenu']);
Route::get('/menu/{cart_id}', [MenuHandle::class, 'showMenuPage']);

use App\Http\Controllers\BlogHandle;
Route::get('/blog', [BlogHandle::class, 'showBlog']);

use App\Http\Controllers\ReservationHandle;
Route::get('/reservation', [ReservationHandle::class, 'showReservation']);
Route::post('/book-table', [ReservationHandle::class, 'save_reservation']);
Route::get('/list-of-reservations/{type_user}', [ReservationHandle::class, 'show_list_reservations']);
Route::get('/eating/{res_id}', [ReservationHandle::class, 'show_status_eating']);
Route::get('/completed/{res_id}', [ReservationHandle::class, 'show_status_completed']);
Route::get('/cart-items/{cart_id}', [ReservationHandle::class, 'show_cart_user']);
Route::post('/add-to-cart-res-id/{cart_id}', [ReservationHandle::class, 'add_to_cart_res_id']);
Route::get('/delete_item_cart_res_id/{cart_id}', [ReservationHandle::class, 'delete_cart_item']);
Route::get('/delete_item_cart_res_id/{cart_id}', [ReservationHandle::class, 'delete_cart_item']);
Route::get('/my-reservation/{user_id}', [ReservationHandle::class, 'show_my_reservation']);
Route::get('/edit-reservation/{res_id}', [ReservationHandle::class, 'edit_reservation']);
Route::post('/update-reservation/{res_id}', [ReservationHandle::class, 'update_reservation']);
Route::get('/cancel-reservation/{res_id}', [ReservationHandle::class, 'show_status_cancel']);
Route::post('/search-reservation/{type_user}', [ReservationHandle::class, 'search']);


use App\Http\Controllers\UserHandle;
Route::get('/login', [UserHandle::class, 'show_login']);
Route::get('/logup', [UserHandle::class, 'show_logup']);
Route::get('/login_checkout', [UserHandle::class, 'login_checkout']);
Route::post('/log-in', [UserHandle::class, 'login']);
Route::post('/log-up', [UserHandle::class, 'save_user']);
Route::get('/logout', [UserHandle::class, 'logout']);
Route::get('/profile/{user_id}', [UserHandle::class, 'showProfile']);
Route::post('/update-user-information/{user_id}', [UserHandle::class, 'update_user']);
Route::post('/search-user', [UserHandle::class, 'search']);

use App\Http\Controllers\AdminHandle;
Route::get('/dashboard/{type_user}', [AdminHandle::class, 'showDashboard']);
Route::get('/list-of-users', [AdminHandle::class, 'show_list_user']);
Route::get('/add-user', [AdminHandle::class, 'add_user']);
Route::post('/save-user', [AdminHandle::class, 'save_user']);
Route::get('/edit-user/{user_id}', [AdminHandle::class, 'edit_user']);
Route::post('/update-user/{user_id}', [AdminHandle::class, 'update_user']);
Route::get('/delete-user/{user_id}', [AdminHandle::class, 'delete_user']);


use App\Http\Controllers\CategoryHandle;
Route::get('/add-category', [CategoryHandle::class, 'add_category']);
Route::post('/add_category_pr', [CategoryHandle::class, 'save_category']);
Route::get('/list-of-category', [CategoryHandle::class, 'display_list']);
Route::get('/edit_category/{category_id}', [CategoryHandle::class, 'edit_category']);
Route::post('/update_category/{category_id}', [CategoryHandle::class, 'update_category']);
Route::get('/delete_category/{category_id}', [CategoryHandle::class, 'delete_category']);
Route::post('/search-category', [CategoryHandle::class, 'search']);

use App\Http\Controllers\DishHandle;
Route::get('/add-dish', [DishHandle::class, 'add_dish']);
Route::post('/add_dish', [DishHandle::class, 'save_dish']);
Route::get('/list-of-dishes', [DishHandle::class, 'display_dishes']);
Route::get('/hidden-dish/{dish_id}', [DishHandle::class, 'hidden']);
Route::get('/display-dish/{dish_id}', [DishHandle::class, 'display']);
Route::get('/edit_dish/{dish_id}', [DishHandle::class, 'edit_dish']);
Route::post('/update_dish/{dish_id}', [DishHandle::class, 'update_dish']);
Route::get('/delete_dish/{dish_id}', [DishHandle::class, 'delete_dish']);
Route::get('/detail_dish/{dish_id}', [DishHandle::class, 'show_detail_dish']);
Route::get('/detail_dish_cart_id/{dish_id}', [DishHandle::class, 'show_detail_dish_cart_id']);
Route::post('/search-dish', [DishHandle::class, 'search']);

use App\Http\Controllers\CartHandle;
Route::post('/add-to-cart', [CartHandle::class, 'add_to_cart']);
Route::get('/show-cart', [CartHandle::class, 'show_cart']);
Route::post('/update-price-shoppingcart', [CartHandle::class, 'update_shoppingcart']);
Route::post('/update-price-cartmodel', [CartHandle::class, 'update_cartmodel']);
Route::get('/delete_item_shoppingcart', [CartHandle::class, 'delete_item_shoppingcart']);

use App\Http\Controllers\OrderHandle;
Route::get('list-of-orders/{type_user}', [OrderHandle::class, 'show_list_order']);
Route::get('/order-items/{order_id}', [OrderHandle::class, 'show_order_item']);
Route::get('/paid/{order_id}', [OrderHandle::class, 'convert_to_paid']);
Route::get('/unpaid/{order_id}', [OrderHandle::class, 'convert_to_unpaid']);
Route::post('/search-order/{type_user}', [OrderHandle::class, 'search']);


use App\Http\Controllers\FeedbackHandle;
Route::post('/send-feedback/{order_item_id}', [FeedbackHandle::class, 'send_feedback']);
Route::get('/list-of-feedbacks', [FeedbackHandle::class, 'show_list_feedback']);
Route::post('/search-feedback', [FeedbackHandle::class, 'search']);

use App\Http\Controllers\ContactHandle;
Route::post('/send-contact', [ContactHandle::class, 'save_contact']);
Route::get('/list-of-contacts', [ContactHandle::class, 'show_list_contact']);
