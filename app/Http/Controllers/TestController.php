<?php

namespace App\Http\Controllers;

use App\Core\Repositories\testRepository;
use App\Core\Services\TestService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\test;



class testController extends Controller
{
    protected $test;
    protected $test_repo;

    public function __construct(TestRepository $test_repo){

//        $this->test = $test;
        $this->test_repo = $test_repo;
    }

    public function index(Request $request){


        //return $this->seminar->test();

        if($request->ajax())
        {
            $test = Test::query();

            return \DataTables::of($test)

                // para sa actions buttons
                ->addColumn('action',function($data){
                    $button = '<div class="btn-group">';
                    $button = $button.'
                                <button type="button" data="'.$data->id.'" class="btn btn-default btn-sm edit_other_btn" data-toggle="modal" data-target="#edit_test_modal" title="Edit" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                
                            </div>';
                    return $button;
                })
                // end sang button actions

                ->setRowId('id')
                ->make();
        }

        return view('dashboard.test.index');
    }

    public function store(Request $request){
        $test = new Test();
        $test -> firstname = $request ->firstname; // database -> method parameter sa function -> sa index nga name or id
        $test -> lastname = $request ->lastname;
        $test -> birthday = $request -> birthday;
        $test -> save();

        dd($request -> all());
    }

    public function edit($id){
        $test = $this->test_repo->findByid($id);
        return view('dashboard.test.edit')->with(['test'=>$test]);
    }



}
