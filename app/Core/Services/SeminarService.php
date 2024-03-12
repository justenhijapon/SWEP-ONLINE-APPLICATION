<?php
 
namespace App\Core\Services;

use App\Core\Helpers\GlobalHelpers;
use File;
use App\Core\Interfaces\SeminarInterface;
use App\Core\Interfaces\SeminarSpeakerInterface;
use App\Core\BaseClasses\BaseService;
use Symfony\Component\Finder\Glob;


class SeminarService extends BaseService{


    protected $seminar_repo;
    protected $seminar_speaker_repo;



    public function __construct(SeminarInterface $seminar_repo, SeminarSpeakerInterface $seminar_speaker_repo){

        $this->seminar_repo = $seminar_repo;
        $this->seminar_speaker_repo = $seminar_speaker_repo;
        parent::__construct();

    }

    public function test(){
        return $this->seminar_repo->test();
    }
    public function fetch($request){
        $seminars = $this->seminar_repo->fetch($request);
        $request->flash();
        return view('dashboard.seminar.index')->with('seminars', $seminars);

    }


    public function store($request){
        $request->merge([
            'utilized_fund' => GlobalHelpers::sanitize_autonum($request->utilized_fund)
        ]);

        $filename = $request->title .'-'. $this->str->random(8);

        $filename = $this->filterReservedChar($filename);


       
        $seminar = $this->seminar_repo->store($request, $filename);
            
        if(!empty($request->row)){
            foreach ($request->row as $row) {
                $seminar_speaker = $this->seminar_speaker_repo->store($row, $seminar);
            }
        }

//        $this->event->fire('seminar.store');

        return json_encode(array('result' => 1, 'slug'=> $seminar->slug));

    }





    public function fetchTable(){

        return $this->seminar_repo->fetchTable();
    }


    public function viewAttendanceSheet($slug){

        $seminar = $this->seminar_repo->findbySlug($slug);

        if(!empty($seminar->attendance_sheet_filename)){
            $path = $this->__static->archive_dir() .'/'. $seminar->attendance_sheet_filename;
            

            if (!File::exists($path)) { return "Cannot Detect File!"; }

            $file = File::get($path);
            $type = File::mimeType($path);
            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);

            return $response;

        }

        return abort(404);
        

    }

    
    public function getFileDetails($slug){
        $seminar = $this->seminar_repo->findbySlug($slug);

        if(!empty($seminar->attendance_sheet_filename)){
            $path = $this->__static->archive_dir() .'/'. $seminar->attendance_sheet_filename;

            $exists = 'false';
            $size = 0;
            if (File::exists($path)) {
                $exists = 'true'; 
                $size = $this->convert_byte(File::size($path));
            }



            return [
                'path' => $path, 
                'exists' => $exists, 
                'size' => $size
            ] ;

            
        }
    }

    public function convert_byte($int){
        if($int > 999){
            //KB
            return number_format($int/1000) . " KB" ;
        }elseif ($int > 9999) {
            // MB
            return number_format($int/1000000) . " MB";
        }elseif ($int > 999999999) {
           // GB
            return number_format($int/1000000000) . " GB";
        }else{
            return 0 . " BYTES";
        }
    }

    public function downloadAttendanceSheet($slug){

        $seminar = $this->seminar_repo->findbySlug($slug);

        if(!empty($seminar->attendance_sheet_filename)){
            $path = $this->__static->archive_dir() .'/'. $seminar->attendance_sheet_filename;

            if (!File::exists($path)) { return "Cannot Detect File!"; }

            return response()->download($path) ;
        }
       
        return abort(404);


    }


    public function edit($slug){

        return $this->seminar_repo->findbySlug($slug);

    }



    public function show($slug){
        return $this->seminar_repo->findbySlug($slug);
        
    }


    public function update($request, $slug){
        $request->merge([
            'utilized_fund' => GlobalHelpers::sanitize_autonum($request->utilized_fund)
        ]);

        $seminar = $this->seminar_repo->findBySlug($slug);    
        $filename = $this->filename($request, $seminar);

        $old_filename = $seminar->attendance_sheet_filename;
        $new_filename = $this->filterReservedChar($filename);

        // If theres new file upload
        if(!is_null($request->file('doc_file'))){

            if ($this->storage->disk('local')->exists($old_filename)) {

                $this->storage->disk('local')->delete($old_filename);

            }
            
            $request->file('doc_file')->storeAs('', $new_filename);

        }else{

            if ($request->title != $seminar->title && $this->storage->disk('local')->exists($old_filename)) {

                $this->storage->disk('local')->move($old_filename, $new_filename);

            }

        }

        $seminar = $this->seminar_repo->update($request, $filename, $seminar);

        if(!empty($request->row)){
            foreach ($request->row as $row) {
                $seminar_speaker = $this->seminar_speaker_repo->store($row, $seminar);
            }
        }

        $this->event->fire('seminar.update', $seminar);

        return json_encode(array('result' => 1 , 'slug' => $seminar->slug));

    }






    public function destroy($slug){

        $seminar = $this->seminar_repo->destroy($slug);

        if(!is_null($seminar->attendance_sheet_filename)){

            if ($this->storage->disk('local')->exists($seminar->attendance_sheet_filename)) {
                $this->storage->disk('local')->delete($seminar->attendance_sheet_filename);
            }

        }

        
        
        return $seminar;

    }





    private function filename($request, $seminar){

        $filename = $seminar->attendance_sheet_filename;
        
        if($request->title != $seminar->title){
            $filename = $request->title .'-'. $this->str->random(8);
        }

        return $this->filterReservedChar($filename);

    }



    private function filterReservedChar($filename){

        $filename = str_replace('.pdf', '', $filename);
        $filename = $this->str->limit($filename, 150);
        $filename = str_replace(['?', '%', '*', ':', ';', '|', '"', '<', '>', '.', '//', '/'], '', $filename);
        $filename = stripslashes($filename);

        return $filename .'.pdf';

    }



    public function participant($slug){

        $seminar = $this->seminar_repo->findBySlug($slug);

        return $seminar;
    }


}