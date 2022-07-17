<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeesRequest;
use App\Repository\FeesRepositoryInterface;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    protected $Fees;

    public function __construct(FeesRepositoryInterface $Fees)
    {
        $this->Fees = $Fees;
    }
    public function index()
    {
        return $this->Fees->index();
    }


    public function create()
    {
        return $this->Fees->create();
    }


    public function store(StoreFeesRequest  $request)
    {
        return $this->Fees->store($request);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return $this->Fees->edit($id);
    }


    public function update(StoreFeesRequest  $request)
    {
        return $this->Fees->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->Fees->destroy($request);
    }
}
