<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Consts;
use App\Region;
use App\Http\Services\ContentService;
use App\Http\Services\PageBuilderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class IntroduceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->responseView('frontend.pages.introduce.index');
    }
}