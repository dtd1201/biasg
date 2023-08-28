<?php

namespace App\Http\Controllers\Admin;

use App\Consts;
use App\Http\Services\ContentService;
use App\Models\CmsTaxonomy;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CmsTaxonomyController extends Controller
{
    private $cmsTaxonomy;
    public function __construct(CmsTaxonomy $cmsTaxonomy)
    {
        $this->cmsTaxonomy = $cmsTaxonomy;
        $this->routeDefault  = 'cms_taxonomys';
        $this->viewPart = 'admin.pages.cms_taxonomys';
        $this->responseData['module_name'] = __('CMS Taxonomy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $this->responseData['params'] = $params;
        $this->responseData['rows'] =  ContentService::getCmsTaxonomy($params)->get();

        return $this->responseView($this->viewPart . '.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get all taxonomy is active
        $params['status'] = Consts::TAXONOMY_STATUS['active'];
        $this->responseData['taxonomys'] = ContentService::getCmsTaxonomy($params)->get();

        return $this->responseView($this->viewPart . '.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'taxonomy' => 'required|max:255',
        ]);

        $lang = Language::where('is_default', 1)->first()->lang_code ?? App::getLocale();
        $params = $request->all();
        if (isset($params['lang'])) {
            $lang = $params['lang'];
            unset($params['lang']);
        }
        $params['alias'] = Str::slug($params['alias'] ?? $params['title']);

        $params['admin_created_id'] = Auth::guard('admin')->user()->id;
        $params['admin_updated_id'] = Auth::guard('admin')->user()->id;
        $params['json_params']['title'][$lang] = $request['title'];

        CmsTaxonomy::create($params);

        return redirect()->route($this->routeDefault . '.index')->with('successMessage', __('Add new successfully!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CmsTaxonomy  $cmsTaxonomy
     * @return \Illuminate\Http\Response
     */
    public function show(CmsTaxonomy $cmsTaxonomy)
    {
        // Do not use this function
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CmsTaxonomy  $cmsTaxonomy
     * @return \Illuminate\Http\Response
     */
    public function edit(CmsTaxonomy $cmsTaxonomy)
    {
        // Get all parents which have status is active
        $params['status'] = Consts::TAXONOMY_STATUS['active'];
        $params['different_id'] = $cmsTaxonomy->id;
        $this->responseData['taxonomys'] = ContentService::getCmsTaxonomy($params)->get();
        $this->responseData['detail'] = $cmsTaxonomy;

        return $this->responseView($this->viewPart . '.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CmsTaxonomy  $cmsTaxonomy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CmsTaxonomy $cmsTaxonomy)
    {
        $request->validate([
            'title' => 'required|max:255',
            'taxonomy' => 'required|max:255',
        ]);

        $lang = Language::where('is_default', 1)->first()->lang_code ?? App::getLocale();
        $params = $request->all();
        if (isset($params['lang'])) {
            $lang = $params['lang'];
            unset($params['lang']);
        }
        $params['alias'] = Str::slug($params['alias'] ?? $params['title']);
        $params['admin_updated_id'] = Auth::guard('admin')->user()->id;
        $params['json_params']['title'][$lang] = $params['title'];

        $arr_insert = $params;
        // cập nhật lại arr_insert['json_params'] từ dữ liệu mới và cũ
       
        if ($cmsTaxonomy->json_params != "") {
            foreach ($cmsTaxonomy->json_params as $key => $val) {
                if (isset($arr_insert['json_params'][$key])) {
                    if ($arr_insert['json_params'][$key] != null) {
                        if (isset($arr_insert['json_params'][$key])) {
                            if (!is_array($params['json_params'][$key])) {
                                $arr_insert['json_params'][$key] = $params['json_params'][$key];
                            } else {

                                $arr_insert['json_params'][$key] = array_merge((array)$val, $params['json_params'][$key]);
                            }
                        } else {
                            $arr_insert['json_params'][$key] = $val;
                        }
                    }
                }
            }
        }

        $cmsTaxonomy->fill($arr_insert);
        $cmsTaxonomy->save();

        return redirect()->back()->with('successMessage', __('Successfully updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CmsTaxonomy  $cmsTaxonomy
     * @return \Illuminate\Http\Response
     */
    public function destroy(CmsTaxonomy $cmsTaxonomy)
    {
        $cmsTaxonomy->status = Consts::STATUS_DELETE;
        $cmsTaxonomy->save();

        // Update delete status sub
        CmsTaxonomy::where('parent_id', '=', $cmsTaxonomy->id)->update(['status' => Consts::STATUS_DELETE]);

        return redirect()->back()->with('successMessage', __('Delete record successfully!'));
    }
    public function loadStatus($id)
    {
        // dd($this->cmsTaxonomy);
        $cmsTaxonomy   =  $this->cmsTaxonomy->find($id);
        $status = $cmsTaxonomy->status;
        if ($status=="active") {
            $statusUpdate = 'deactive';
        } else {
            $statusUpdate = 'active';
        }
        $updateResult =  $cmsTaxonomy->update([
            'status' => $statusUpdate,
        ]);
        // dd($updateResult);
        $cmsTaxonomy   =  $this->cmsTaxonomy->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-status', ['data' => $cmsTaxonomy, 'type' => 'danh mục'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }
    public function loadIs_featured($id)
    {
        $cmsTaxonomy   =  $this->cmsTaxonomy->find($id);
        $is_featured = $cmsTaxonomy->is_featured;

        if ($is_featured) {
            $is_featuredUpdate = 0;
        } else {
            $is_featuredUpdate = 1;
        }
        $updateResult =  $cmsTaxonomy->update([
            'is_featured' => $is_featuredUpdate,
        ]);

        $cmsTaxonomy   =  $this->cmsTaxonomy->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-is_featured', ['data' => $cmsTaxonomy, 'type' => 'danh mục'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }
}
