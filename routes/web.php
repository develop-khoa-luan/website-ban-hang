<?php

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

// Front-end

Route::get('/','HomeController@index' );

Route::get('/trang-chu', 'HomeController@index'  );

Route::get('/price-home-asc', 'HomeController@price_home_asc'  );

Route::get('/price-home-desc', 'HomeController@price_home_desc'  );


Route::post('/tim-kiem', 'HomeController@search'  );

Route::get('/contact', 'HomeController@contact'  );

// Category Index page
Route::get('/danh-muc-san-pham/{category_id}', 'CategoryProduct@show_category_home'  );

// Brand Index page
Route::get('/thuong-hieu-san-pham/{brand_id}', 'BrandProduct@show_brand_home'  );

Route::get('/chi-tiet-san-pham/{product_id}', 'ProductController@details_product'  );

// Back-end

Route::get('/admin', 'AdminController@index');

Route::get('/dashboard', 'AdminController@show_dashboard');

// login Admin Management
Route::post('/admin-dashboard', 'AdminController@dashboard');

// logout Admin Management
Route::get('/logout', 'AdminController@logout');

// CategoryProduct

Route::get('/add-category-product','CategoryProduct@add_category_product' );
Route::get('/all-category-product','CategoryProduct@all_category_product' );
Route::post('/save-category-product','CategoryProduct@save_category_product' );

Route::get('/unactive-category-product/{category_product_id}','CategoryProduct@unactive_category_product' );
Route::get('/active-category-product/{category_product_id}','CategoryProduct@active_category_product' );

//edit category product
Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_product' );
Route::post('/update-category-product/{category_product_id}','CategoryProduct@update_category_product' );
//delete category product
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_product' );


// BrandProduct

Route::get('/add-brand-product','BrandProduct@add_brand_product' );
Route::get('/all-brand-product','BrandProduct@all_brand_product' );
Route::post('/save-brand-product','BrandProduct@save_brand_product' );

Route::get('/unactive-brand-product/{brand_product_id}','BrandProduct@unactive_brand_product' );
Route::get('/active-brand-product/{brand_product_id}','BrandProduct@active_brand_product' );

//edit brand product
Route::get('/edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_product' );
Route::post('/update-brand-product/{brand_product_id}','BrandProduct@update_brand_product' );
//delete brand product
Route::get('/delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_product' );

// Product
Route::get('/add-product','ProductController@add_product' );
Route::get('/all-product','ProductController@all_product' );
Route::post('/save-product','ProductController@save_product' );
Route::get('/unactive-product/{product_id}','ProductController@unactive_product' );
Route::get('/active-product/{product_id}','ProductController@active_product' );
//edit product
Route::get('/edit-product/{product_id}','ProductController@edit_product' );
Route::post('/update-product/{product_id}','ProductController@update_product' );
//delete product
Route::get('/delete-product/{product_id}','ProductController@delete_product' );


// Cart Product
Route::post('/save-cart','CartController@save_cart' );
Route::post('/save-cart-with-size','CartController@save_cart_with_size' );
Route::get('/show-cart','CartController@show_cart' );

Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart' );

Route::post('/update-cart-quanlity','CartController@update_cart_quanlity' );

// Cart Product Checkout
Route::get('/login-checkout','CheckoutController@login_checkout' );
Route::get('/logout-checkout','CheckoutController@logout_checkout' );
Route::post('/login-customer','CheckoutController@login_customer' );
// add customer
Route::post('/add-customer','CheckoutController@add_customer' );
Route::get('/checkout','CheckoutController@checkout' );
Route::get('/payment','CheckoutController@payment' );
Route::post('/order-place','CheckoutController@order_place' );

// input delivery info
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer' );

// manage order
Route::get('/manage-order','CheckoutController@manage_order' );
Route::get('/view-order/{order_id}','CheckoutController@view_order' );
Route::post('/update-order/{order_id}','CheckoutController@update_order' );

//manage images
Route::get('all-image','ImageUploadController@allImage');
Route::get('add-image','ImageUploadController@fileCreate');
Route::post('image/upload/store','ImageUploadController@fileStore');
Route::get('image/delete/{filename}','ImageUploadController@fileDestroy');

//manage gallery for ckeditor and choose picture for products
Route::get('gallery','ImageUploadController@gallery');
Route::get('add-gallery','ImageUploadController@add_gallery');

//API for website
Route::get('/count-cart', 'APIController@count_cart'  );
Route::get('/get-quantity', 'APIController@get_quantity'  );
Route::get('/get-product-detail', 'APIController@get_product_detail'  );
Route::get('/get-product', 'APIController@get_product'  );



//delete order 
Route::get('/delete-order/{order_id}','CheckoutController@delete_order' );


// add-update coupon code management

Route::get('/add-coupon','CouponController@add_coupon' );
Route::get('/all-coupon','CouponController@all_coupon' );
Route::post('/save-coupon','CouponController@save_coupon' );

Route::get('/unactive-coupon/{coupon_id}','CouponController@unactive_coupon' );
Route::get('/active-coupon/{coupon_id}','CouponController@active_coupon' );

    //edit coupon

Route::get('/edit-coupon/{coupon_id}','CouponController@edit_coupon' );
Route::post('/update-coupon/{coupon_id}','CouponController@update_coupon' );

    //delete coupon
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon' );

    //apply coupon

Route::post('/apply-coupon','CouponController@apply_coupon' );

//Apriori Algorithm

Route::get('run-apriori','AprioriController@run_apriori');
Route::get('apriori','AprioriController@apriori');
Route::post('save-apriori','AprioriController@save_apriori');


//view info customer -- Admin Management

Route::get('/all-customer','CustomerController@all_customer' );

Route::get('/view-customer/{customer_id}','CustomerController@view_customer' );

Route::get('/view-customer-order-detail/{order_id}','CustomerController@view_customer_order_detail' );


// contact page

    //add cotact info from customer

    Route::post('/save-contact-info','ContactController@save_contact_info' );

    //view all contact info

    Route::get('/all-contact-info','ContactController@all_contact_info' );
    
    // Route::get('/get-contact-info', 'APIController@get_contact_info'  );

// slide management

    // add slide - insert DB
    Route::get('/add-slide','SlideController@add_slide' );
    Route::post('/save-slide','SlideController@save_slide' );

    // slide list

    Route::get('/all-slide','SlideController@all_slide' );
    Route::get('/unactive-slide/{slide_id}','SlideController@unactive_slide' );
    Route::get('/active-slide/{slide_id}','SlideController@active_slide' );

    // delete slide

    Route::get('/delete-slide/{slide_id}','SlideController@delete_slide' );


//Blog page
Route::get('/blogs','BlogController@blogs' );
Route::get('/blog/{id}','BlogController@blog_detail' );

//Blog manager
Route::get('/all-blog','BlogController@all_blog' );
Route::get('/edit-blog-detail/{id}','BlogController@get_edit_blog_detail' );
Route::get('/add-blog','BlogController@get_add_blog' );
Route::post('/save-blog-detail/{id}','BlogController@post_edit_blog_detail' );
Route::post('/save-blog','BlogController@post_add_blog' );
Route::get('/unactive-blog/{id}','BlogController@unactive_blog' );
Route::get('/active-blog/{id}','BlogController@active_blog' );
Route::get('/delete-blog/{id}','BlogController@delete_blog' );

//Report page
Route::get('/reports','ReportController@reports' );
Route::post('/reports-detail','ReportController@reports_detail' );
