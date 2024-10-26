<?php

namespace App\Http\Controllers;

use App\Http\Helper\ApiCode;
use App\Models\Policy as ModelsPolicy;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder as RB;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\BaseApiCodes;

class PolicyController extends Controller
{
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
