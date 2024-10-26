<?php

namespace App\Http\Controllers;

use App\Http\Helper\ApiCode;
use App\Http\Requests\BasePolicyPostRequest;
use App\Http\Requests\BasePolicyPutRequest;
use App\Models\BasePolicy;
use Illuminate\Http\Request;
use App\Http\Helper\ResponseBuilder as RSB;

class BasePolicyController extends PolicyController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->page)){
            return RSB::success(BasePolicy::orderBy('created_at', 'desc')->paginate(config('query.pagging.per_page')));
        }

        return RSB::success(BasePolicy::all());
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BasePolicyPostRequest $request)
    {
        $policy = new BasePolicy($request->toArray());       

        if ($policy->save()){
            return RSB::asCreateSuccess(['last_insert_id' => $policy->id]);
        }
        return RSB::error(ApiCode::FAILURE_ON_ADD_ITEM);        
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $policy = BasePolicy::find($id);
        if (!empty($policy)){
            return RSB::success($policy);
        }

        return RSB::asNotFoundError();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BasePolicyPutRequest $request, $id)
    {
        $policy = BasePolicy::findOrFail($id);
     
        $policy->fill($request->toArray());

      
        if ($policy->save()){
            return RSB::success(['last_insert_id' => $policy->id]);
        }
        return RSB::success(['last_insert_id' => $id]);
    }

}
