<?php

namespace App\Http\Controllers\Admin;

use App\Consts;
use App\Http\Services\ContentService;
use App\Models\CmsPost;
use App\Models\CmsTaxonomy;
use App\Models\Language;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CmsPostController extends Controller
{
    private $cmsPost;
    public function __construct(CmsPost $cmsPost)
    {
        $this->cmsPost = $cmsPost;
        $this->routeDefault  = 'cms_posts';
        $this->viewPart = 'admin.pages.cms_posts';
        $this->responseData['module_name'] = __('Post Management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $params['is_type'] = Consts::POST_TYPE['post'];
        // Get list post with filter params
        $rows = ContentService::getCmsPost($params)->paginate(Consts::DEFAULT_PAGINATE_LIMIT);
        $paramTaxonomys['status'] = Consts::TAXONOMY_STATUS['active'];
        $paramTaxonomys['taxonomy'] = Consts::TAXONOMY['post'];
        $this->responseData['parents'] = ContentService::getCmsTaxonomy($paramTaxonomys)->get();

        $this->responseData['rows'] =  $rows;
        $this->responseData['params'] = $params;
        $this->responseData['booleans'] = Consts::TITLE_BOOLEAN;
        $this->responseData['postStatus'] = Consts::STATUS;

        return $this->responseView($this->viewPart . '.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paramTaxonomys['status'] = Consts::TAXONOMY_STATUS['active'];
        $paramTaxonomys['taxonomy'] = Consts::TAXONOMY['post'];
        $this->responseData['parents'] = ContentService::getCmsTaxonomy($paramTaxonomys)->get();

        $paramTaxonomys['taxonomy'] = Consts::TAXONOMY['tags'] ?? '';
        $this->responseData['tags'] = ContentService::getCmsTaxonomy($paramTaxonomys)->get();

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
            'taxonomy_id' => 'required|max:255',
        ]);

        $params = $request->all();
        $params['alias'] = Str::slug($params['alias'] ?? $params['title']);

        $params['is_type'] = Consts::POST_TYPE['post'];
        $params['admin_created_id'] = Auth::guard('admin')->user()->id;
        $params['admin_updated_id'] = Auth::guard('admin')->user()->id;

        CmsPost::create($params);

        return redirect()->route($this->routeDefault . '.index')->with('successMessage', __('Add new successfully!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CmsPost  $cmsPost
     * @return \Illuminate\Http\Response
     */
    public function show(CmsPost $cmsPost)
    {
        // Do not use this function
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CmsPost  $cmsPost
     * @return \Illuminate\Http\Response
     */
    public function edit(CmsPost $cmsPost)
    {
        $paramTaxonomys['status'] = Consts::TAXONOMY_STATUS['active'];
        $paramTaxonomys['taxonomy'] = Consts::TAXONOMY['post'];
        $this->responseData['parents'] = ContentService::getCmsTaxonomy($paramTaxonomys)->get();
        $this->responseData['detail'] = $cmsPost;

        $this->responseData['relateds'] = ContentService::getCmsPost([
            'related_post' => $cmsPost->json_params->related_post ?? [""],
            'order_by' => 'id'
        ])->get();

        $paramTaxonomys['taxonomy'] = Consts::TAXONOMY['tags'] ?? '';
        $this->responseData['tags'] = ContentService::getCmsTaxonomy($paramTaxonomys)->get();

        return $this->responseView($this->viewPart . '.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CmsPost  $cmsPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CmsPost $cmsPost)
    {
        $request->validate([
            'title' => 'required|max:255',
            'taxonomy_id' => 'required|max:255',
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
        if ($cmsPost->json_params != "") {
            foreach ($cmsPost->json_params as $key => $val) {
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

        $cmsPost->fill($arr_insert);
        $cmsPost->save();

        return redirect()->back()->with('successMessage', __('Successfully updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CmsPost  $cmsPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(CmsPost $cmsPost)
    {
        // check is type post
        if ($cmsPost->is_type != Consts::POST_TYPE['post']) {
            return redirect()->back()->with('errorMessage', __('Permission denied!'));
        }

        $cmsPost->status = Consts::STATUS_DELETE;
        $cmsPost->save();

        return redirect()->route($this->routeDefault . '.index')->with('successMessage', __('Delete record successfully!'));
    }

    public function search(Request $request)
    {
        try {
            $params = $request->all();
            $params['order_by'] = 'id';
            // Get list post with filter params
            $rows = ContentService::getCmsPost($params)->get();

            if (count($rows) > 0) {
                return $this->sendResponse($rows, 'success');
            }

            return $this->sendResponse('', __('No records available!'));
        } catch (Exception $ex) {
            // throw $ex;
            abort(422, __($ex->getMessage()));
        }
    }

    public function addTag(Request $request)
    {
        try {
            $tags = $request->get('tags');
            $detail = CmsTaxonomy::where('taxonomy', Consts::TAXONOMY['tags'])->where('title', $tags)->first();

            $data = [];
            if ($detail) {
                $data['exist'] = true;
                $data['id'] = $detail->id;
                $data['title'] = $detail->title;
            } else {
                $params['taxonomy'] = Consts::TAXONOMY['tags'];
                $params['status'] = Consts::TAXONOMY_STATUS['active'];
                $params['title'] = $tags;
                $params['admin_created_id'] = Auth::user()->id;
                $params['admin_updated_id'] = Auth::user()->id;

                $detail = CmsTaxonomy::create($params);
                $data['exist'] = false;
                $data['id'] = $detail->id;
                $data['title'] = $detail->title;
            }

            return $this->sendResponse($data, 'success');
        } catch (Exception $ex) {
            // throw $ex;
            abort(422, __($ex->getMessage()));
        }
    }
    public function loadStatus($id)
    {
        // dd($this->cmsPost);
        $cmsPost   =  $this->cmsPost->find($id);
        $status = $cmsPost->status;
        if ($status=="active") {
            $statusUpdate = 'deactive';
        } else {
            $statusUpdate = 'active';
        }
        $updateResult =  $cmsPost->update([
            'status' => $statusUpdate,
        ]);
        // dd($updateResult);
        $cmsPost   =  $this->cmsPost->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-status', ['data' => $cmsPost, 'type' => 'bản ghi'])->render(),
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
        $cmsPost  =  $this->cmsPost->find($id);
        $is_featured = $cmsPost->is_featured;

        if ($is_featured) {
            $is_featuredUpdate = 0;
        } else {
            $is_featuredUpdate = 1;
        }
        $updateResult =  $cmsPost->update([
            'is_featured' => $is_featuredUpdate,
        ]);

        $cmsPost   =  $this->cmsPost->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-is_featured', ['data' => $cmsPost, 'type' => 'bản ghi'])->render(),
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
