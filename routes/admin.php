<?php

use App\Http\Controllers\FrontEnd\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
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

/**
 * For check roles (permission access) for each route (function_code),
 * required each route have to a name which used to the
 * check in middleware permission and this is defined in Module, Function Management
 * @author: ThangNH
 * @created_at: 2021/10/01
 */
/**---------------------------------------------------------------------------------------------------------------------------
 *                          ADMIN USER ROLE MANAGE
 * ----------------------------------------------------------------------------------------------------------------------------*/
Route::group(['namespace' => 'Admin'], function () {
    // Login
    Route::get('/login', 'LoginController@index')->name('admin.login');
    Route::post('/login', 'LoginController@login')->name('admin.login.post');

    // Update info user and change or forget password
    Route::get('forgot-password', 'AdminController@forgotPasswordForm')->name('admin.password.forgot.get');
    Route::post('forgot-password', 'AdminController@forgotPassword')->name('admin.password.forgot.post');
    Route::get('reset-password/{token}', 'AdminController@resetPasswordForm')->name('admin.password.reset.get');
    Route::post('reset-password', 'AdminController@resetPassword')->name('admin.password.reset.post');

    Route::get('remove/{id}',[ReviewController::class, 'removeReview'])->name('admin.remove.review');

    // Authentication middleware
    Route::group(['middleware' => ['auth:admin']], function () {
        // Logout
        Route::get('/logout', 'LoginController@logout')->name('admin.logout');
        // Dashboard
        Route::get('/', 'HomeController@index')->name('admin.home');
        // Update account
        Route::get('account', 'AdminController@changeAccountForm')->name('admin.account.change.get');
        Route::post('change-account', 'AdminController@changeAccount')->name('admin.account.change.post');

        Route::group(['middleware' => ['permission']], function () {
            // All route in admin system CRUD
            Route::resources([
                'admins' => 'AdminController',
                'admin_menus' => 'AdminMenuController',
                'modules' => 'ModuleController',
                'module_functions' => 'ModuleFunctionController',
                'roles' => 'RoleController',
                'blocks' => 'BlockController',
                'block_contents' => 'BlockContentController',
                'pages' => 'PageController',
                'menus' => 'MenuController',
                'options' => 'OptionController',
                'widgets' => 'WidgetController',
                'components' => 'ComponentController',
                'component_configs' => 'ComponentConfigController',
                'widget_configs' => 'WidgetConfigController',
                'language' => 'LanguageController',
                'cms_taxonomys' => 'CmsTaxonomyController',
                'cms_services' => 'CmsServiceController',
                'cms_resources' => 'CmsResourceController',
                'cms_doctors' => 'CmsDoctorController',
                'cms_posts' => 'CmsPostController',
                'cms_products' => 'CmsProductController',
                'contacts' => 'ContactController',
                'bookings' => 'BookingController',
                'popups' => 'PopupController',
                'users' => 'UserController',
                'branchs' => 'BranchController',
            ]);
            Route::post('languages/set-language-default', 'LanguageController@setLanguageIsDefault')->name('languages.set_default');
            // Order services
            Route::get('order_services', 'OrderController@listOrderService')->name('order_services.index');
            Route::get('order_services/{order}', 'OrderController@showOrderService')->name('order_services.show');
            Route::put('order_services/{order}', 'OrderController@update')->name('order_services.update');
            Route::delete('order_services/{order}', 'OrderController@destroy')->name('order_services.destroy');
            // Order Products
            Route::get('order_products', 'OrderController@listOrderProduct')->name('order_products.index');
            Route::get('order_products/{order}', 'OrderController@showOrderProduct')->name('order_products.show');
            Route::put('order_products/{order}', 'OrderController@update')->name('order_products.update');
            Route::delete('order_products/{order}', 'OrderController@destroy')->name('order_products.destroy');
            Route::put('order_details/{orderDetail}', 'OrderDetailController@update')->name('order_details.update');
            Route::delete('order_details', 'OrderDetailController@destroy')->name('order_details.destroy');
            // Call request
            Route::get('call_request', 'ContactController@listCallRequest')->name('call_request.index');
            Route::get('call_request/{contact}', 'ContactController@showCallRequest')->name('call_request.show');
            Route::put('call_request/{contact}', 'ContactController@update')->name('call_request.update');
            Route::delete('call_request/{contact}', 'ContactController@destroy')->name('call_request.destroy');

            // Update information web to Option table
            Route::put('web/update/{id}', 'OptionController@webUpdate')->name('web.update');
            Route::get('web_information', 'OptionController@webInformation')->name('web.information');
            Route::put('web_information/update/{id}', 'OptionController@webUpdate')->name('web.information.update');
            Route::get('web_image', 'OptionController@webImage')->name('web.image');
            Route::put('web_image/update/{id}', 'OptionController@webUpdate')->name('web.image.update');
            Route::get('web_social', 'OptionController@webSocial')->name('web.social');
            Route::put('web_social/update/{id}', 'OptionController@webUpdate')->name('web.social.update');
            Route::get('web_source', 'OptionController@webSource')->name('web.source');
            Route::put('web_source/update/{id}', 'OptionController@webUpdate')->name('web.source.update');

            
        });

        /**
         * All route is not define to permission
         */
        // Get params block for update Page management
        Route::get('get_block_params', 'BlockController@getBlockParams')->name('blocks.params');
        Route::get('get_block_contents_by_template', 'BlockContentController@getBlockContentsByTemplate')->name('block_contents.get_by_template');
        // Sort menu in module update menu public
        Route::post('menus/update_sort', 'MenuController@updateSort')->name('menus.update_sort');
        Route::post('menus/delete', 'MenuController@delete')->name('menus.delete');
        // For related and tags
        Route::get('search_post', 'CmsPostController@search')->name('cms_posts.search');
        Route::post('add_tag', 'CmsPostController@addTag')->name('cms_posts.add_tag');

        Route::get('/blocks-update-status/{id}', "BlockController@loadStatus")->name("admin.blocks.load.status");
        Route::get('/blockContents-update-status/{id}', "BlockContentController@loadStatus")->name("admin.block_contents.load.status");
        Route::get('/admin-update-status/{id}', "AdminController@loadStatus")->name("admin.admins.load.status");
        Route::get('/adminMenus-update-status/{id}', "AdminMenuController@loadStatus")->name("admin.admin_menus.load.status");
        Route::get('/cmsTaxonomy-update-status/{id}', "CmsTaxonomyController@loadStatus")->name("admin.cms_taxonomys.load.status");
        Route::get('/cmsPost-update-status/{id}', "CmsPostController@loadStatus")->name("admin.cms_posts.load.status");
        Route::get('/cmsProduct-update-status/{id}', "CmsProductController@loadStatus")->name("admin.cms_products.load.status");
        Route::get('/role-update-status/{id}', "RoleController@loadStatus")->name("admin.roles.load.status");
        Route::get('/module-update-status/{id}', "ModuleController@loadStatus")->name("admin.modules.load.status");
        Route::get('/page-update-status/{id}', "PageController@loadStatus")->name("admin.pages.load.status");
        Route::get('/menu-update-status/{id}', "MenuController@loadStatus")->name("admin.menus.load.status");

        Route::get('/cmsTaxonomy-update-is-featured/{id}', "CmsTaxonomyController@loadIs_featured")->name("admin.cms_taxonomys.load.isFeatured");
        Route::get('/cmsPost-update-is-featured/{id}', "CmsPostController@loadIs_featured")->name("admin.cms_posts.load.isFeatured");
        Route::get('/cmsProduct-update-is-featured/{id}', "CmsProductController@loadIs_featured")->name("admin.cms_products.load.isFeatured");
        Route::get('/load-order/{table}/{id}', "Controller@loadOrderVeryModel")->name("admin.loadOrderVeryModel");
        // Config to use laravel-filemanager
        Route::group(['prefix' => 'filemanager'], function () {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });


        // Test export excel
        Route::get('export', 'ExportController@export')->name('export');
        Route::post('block_contents/update_sort', 'BlockContentController@updateSort')->name('blocks.update_sort');
    });
});
