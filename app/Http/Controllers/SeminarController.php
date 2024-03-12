<?php

namespace App\Http\Controllers;


use App\Core\Helpers\Helpers;
use App\Core\Services\SeminarService;
use App\Core\Services\SeminarParticipantService;
use App\Http\Requests\Seminar\SeminarFormRequest;
use App\Http\Requests\Seminar\SeminarFilterRequest;
use App\Http\Requests\SeminarParticipant\SeminarParticipantCreateFormRequest;
use App\Http\Requests\SeminarParticipant\SeminarParticipantEditFormRequest;
use App\Core\Services\MillDistrictService;
use App\Models\Seminar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Str;


class SeminarController extends Controller{

	protected $seminar;
    protected $seminar_participant;
    protected $mill_district;

    public function __construct(SeminarService $seminar, SeminarParticipantService $seminar_participant, MillDistrictService $mill_district){
        
        $this->seminar = $seminar;
        $this->seminar_participant = $seminar_participant;
        $this->mill_district = $mill_district;
    }
    
    public function index(Request $request){
        if($request->ajax())
        {
            $seminar = Seminar::query();
            return datatables()->of($seminar)
            ->addColumn('action', function($data){
                return view('dashboard.seminar.dtActions')->with([
                    'data' => $data,
                ]);
            })
            ->editColumn('date_covered', function($data){
               if($data->date_covered_from == $data->date_covered_to ){
                return date("M. d, Y",strtotime($data->date_covered_from));
               }else{
                return date("M. d, Y",strtotime($data->date_covered_from)).' - '.date("M. d, Y",strtotime($data->date_covered_to));
               }
            })
            ->rawColumns(['action'])
            ->setRowId('slug')
            ->make();
        }

        return view('dashboard.seminar.index')->with([
            'mill_districts_list' => $this->mill_district->mills(),
        ]);
    }

    public function seminarList(){


    }

    

    public function create(){
        
        return view('dashboard.seminar.create');

    }

   

    public function store(SeminarFormRequest $request){


        $seminar = new Seminar();
        $seminar->slug = Str::random(16);
        $seminar->title = $request->title;
        $seminar->sponsor = $request->sponsor;
        $seminar->venue = $request->venue;
        $seminar->mill_district = $request->mill_district;
        $seminar->date_covered_from = Carbon::parse($request->date_covered_from)->format('Y-m-d');
        $seminar->date_covered_to = Carbon::parse($request->date_covered_to)->format('Y-m-d');

        if(!empty($request->file('doc_file'))){
            $filename = $request->title .'-'. Str::random(8).'.'.$request->file('doc_file')->getClientOriginalExtension();
            if(!is_null($request->file('doc_file'))){
                $request->file('doc_file')->storeAs('', $filename);
            }
            $seminar->attendance_sheet_filename = $filename;
        }


        $seminar->project_code = $request->project_code;
        $seminar->block_farm = $request->block_farm;
        $seminar->item = $request->item;
        $seminar->utilized_fund = Helpers::sanitizeAutonum($request->utilized_fund);
        $seminar->created_at = Carbon::now();
        $seminar->updated_at = Carbon::now();
        $seminar->ip_created = $request->ip();
        $seminar->ip_updated = $request->ip();
        if($seminar->save()){
            return $seminar->only('slug');
        }
    }
    

    public function show($slug){
        $seminar = $this->seminar->show($slug);
        $file_details = $this->seminar->getFileDetails($slug);

        return view('dashboard.seminar.show')->with([
            'seminar'=>$seminar, 
            'file_details'=> $file_details
        ]);
    }



    public function edit($slug){
        
        $seminar = Seminar::query()
            ->where('slug', $slug)
            ->first();
        $seminar ?? abort(404,'Seminar not found.');
        return view('dashboard.seminar.edit')->with([
            'seminar'=>$seminar,
            'mill_districts_list' => $this->mill_district->mills()
        ]);
    }




    public function viewAttendanceSheet($slug){

       return $this->seminar->viewAttendanceSheet($slug); 

    }

    public function downloadAttendanceSheet($slug){

        return $this->seminar->downloadAttendanceSheet($slug); 

    }


    public function update(SeminarFormRequest $request, $slug){


        $seminar = Seminar::query()
            ->where('slug', $slug)
            ->first();
        $seminar ?? abort(404,'Seminar not found.');
        $seminar->title = $request->title;
        $seminar->sponsor = $request->sponsor;
        $seminar->venue = $request->venue;
        $seminar->mill_district = $request->mill_district;
        $seminar->date_covered_from = Carbon::parse($request->date_covered_from)->format('Y-m-d');
        $seminar->date_covered_to = Carbon::parse($request->date_covered_to)->format('Y-m-d');
        if(!empty($request->file('doc_file'))){
            $filename = $request->title .'-'. Str::random(8).'.'.$request->file('doc_file')->getClientOriginalExtension();
            if(!is_null($request->file('doc_file'))){
                $request->file('doc_file')->storeAs('', $filename);
            }
            $seminar->attendance_sheet_filename = $filename;
        }

        $seminar->project_code = $request->project_code;
        $seminar->block_farm = $request->block_farm;
        $seminar->item = $request->item;
        $seminar->utilized_fund = Helpers::sanitizeAutonum($request->utilized_fund);
        if($seminar->update()){
            return $seminar->only('slug');
        }

    }

    


    public function destroy($slug){

        $seminar = Seminar::query()
            ->where('slug', $slug)
            ->first();
        $seminar ?? abort(404,'Seminar not found.');
        if($seminar->delete()){
            return 1;
        }
    }



    /** Seminar participant **/
    public function participant($slug){

        $seminar = $this->seminar->participant($slug);

        return view('dashboard.seminar.participants')->with(['seminar' => $seminar]);

    }

    public function participantEdit(Request $request){
        $slug = $request->slug;
        $participant = $this->seminar_participant->edit($slug);
        return view("dashboard.seminar.edit_participant")->with([
            'participant' => $participant
        ]);
    }


    public function participantStore(SeminarParticipantCreateFormRequest $request, $slug){

        $participant = $this->seminar_participant->store($request, $slug);
        $participant->sex = $this->sex($participant->sex);

        return $participant;

    }




    public function participantUpdate(SeminarParticipantCreateFormRequest $request, $sem_slug){

        $participant = $this->seminar_participant->update($request, $sem_slug); 
        $participant->sex = $this->sex($participant->sex);

        return $participant;
    } 




    public function participantDestroy($slug){
        
        return $this->seminar_participant->destroy($slug);

    }





    /** Seminar participant **/

    public function speaker($slug){

        return $slug;

    }

    
    public function sex($sex){
        if($sex == "MALE"){
            return '<span class="label bg-green col-md-12"><i class="fa fa-male"></i> MALE</span>';
        }if($sex == "FEMALE"){
            return '<span class="label bg-maroon col-md-12"><i class="fa fa-female"></i> FEMALE</span>';
        }
    }
    
}
