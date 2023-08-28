<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminMenu;
use App\Models\Block;
use App\Models\BlockContent;
use App\Models\CmsPost;
use App\Models\CmsTaxonomy;
use App\Models\CmsProduct;
use App\Models\Menu;
use App\Models\Module;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use App\Models\Language;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Http\Services\AdminService;
use App\Http\Services\ContentService;
use stdClass;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    private $adminMenu;
    private $block;
    private $blockContent;
    private $cmsPost;
    private $cmsProduct;
    private $cmsTaxonomy;
    private $menu;
    private $module;
    private $page;
    private $role;
    private $user;
    public function __construct(
        AdminMenu $adminMenu,
        Block $block,
        BlockContent $blockContent,
        CmsPost $cmsPost,
        CmsTaxonomy $cmsTaxonomy,
        CmsProduct $cmsProduct,
        Menu $menu,
        Module $module,
        Page $page,
        Role $role,
        User $user
    ) {
        // $this->middleware('auth:admin');
        $this->adminMenu = $adminMenu;
        $this->block = $block;
        $this->blockContent = $blockContent;
        $this->cmsTaxonomy = $cmsTaxonomy;
        $this->cmsProduct = $cmsProduct;
        $this->cmsPost = $cmsPost;
        $this->menu = $menu;
        $this->module = $module;
        $this->page = $page;
        $this->role = $role;
        $this->user = $user;
    }
    // Part to views for Controller
    protected $viewPart;
    // Route default for Controller
    protected $routeDefault;
    // Data response to view
    protected $responseData = [];

    /**
     * Xử lý các thông tin hệ thống trước khi đổ ra view
     * @author: ThangNH
     * @created_at: 2021/10/01
     */

    protected function responseView($view)
    {
        // Get all global system params
        $options = ContentService::getOption();
        if ($options) {
            $this->web_information = new stdClass();
            foreach ($options as $option) {
                $this->web_information->{$option->option_name} = json_decode($option->option_value);
            }
            $this->responseData['web_information'] = $this->web_information;
        }

        $this->responseData['admin_auth'] = Auth::guard('admin')->user();

        /**
         * Get all access menu to show in the sidebar by role of current User 
         */
        $this->responseData['accessMenus'] = AdminService::getAccessMenu();

        // App::setLocale('en');
         // Set locale to use mutiple languages
         $languages = Language::orderBy('iorder')->get();
         $this->responseData['languages'] = $languages;
         $languageDefault = $languages->first(function ($item, $key) {
             return $item->is_default;
         });
         $this->responseData['languageDefault'] = $languageDefault;
         $locale = request()->cookie('locale_admin') ?? $languageDefault->lang_locale ?? App::getLocale();
         App::setLocale($locale);

        return view($view, $this->responseData);
    }

    protected function sendResponse($data, $message = '')
    {
        $response = [
            'data' => $data,
            'message' => $message
        ];

        return response()->json($response);
    }

    public function loadOrderVeryModel($table, $id, Request $request)
    {

        switch ($table) {
            case 'modules':
                $model = $this->module;
                break;
            case 'blocks':
                $model = $this->block;
                break;
            case 'cms_taxonomys':
                $model = $this->cmsTaxonomy;
                break;
            case 'cms_posts':
                $model = $this->cmsPost;
                break;
            case 'cms_products':
                $model = $this->cmsProduct;
                break;
            case 'pages':
                $model = $this->page;
                break;
            case 'block_contents':
                $model = $this->blockContent;
                break;
            case 'roles':
                $model = $this->role;
                break;
            case 'menus':
                $model = $this->menu;
                break;
            case 'admin_menus':
                $model = $this->adminMenu;
                break;
            default:
                $model = null;
                break;
        }
        //   dd($table);
        if ($model) {
            try {
                DB::beginTransaction();

                $dataUpdate = [
                    "iorder" => $request->input('order'),
                    "admin_updated_id" => auth()->guard('admin')->id()
                ];
                $model->find($id)->update($dataUpdate);
                DB::commit();
                return response()->json([
                    "code" => 200,
                    "html" => 'Sửa số thứ tự thành công',
                    "message" => "success"
                ], 200);
            } catch (\Exception $exception) {
                // dd($exception);
                DB::rollBack();
                Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
                return response()->json([
                    "code" => 500,
                    "message" => "fail"
                ], 500);
            }
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }
}
