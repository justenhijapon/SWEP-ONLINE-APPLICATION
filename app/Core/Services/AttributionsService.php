<?php

namespace App\Core\Services;

use App\Core\Helpers\GlobalHelpers;
use File;
use App\Core\Interfaces\AttributionsInterface;
use App\Core\BaseClasses\BaseService;
use Symfony\Component\Finder\Glob;


class AttributionsService extends BaseService{


    protected $attributions_repo;



    public function __construct(AttributionsInterface $attributions_repo, ){

        $this->attributions_repo = $attributions_repo;
        parent::__construct();

    }

    public function test(){
        return $this->attributions_repo->test();
    }
    public function fetch($request){
        $attributionss = $this->attributions_repo->fetch($request);
        $request->flash();
        return view('dashboard.attributions.index')->with('attributionss', $attributionss);

    }


    public function store($request){
        $request->merge([
            'utilized_fund' => GlobalHelpers::sanitize_autonum($request->utilized_fund)
        ]);

        $filename = $request->title .'-'. $this->str->random(8);

        $filename = $this->filterReservedChar($filename);



        $attributions = $this->attributions_repo->store($request, $filename);

        if(!empty($request->row)){
            foreach ($request->row as $row) {
                $attributions_speaker = $this->attributions_speaker_repo->store($row, $attributions);
            }
        }

//        $this->event->fire('attributions.store');

        return json_encode(array('result' => 1, 'slug'=> $attributions->slug));

    }





    public function fetchTable(){

        return $this->attributions_repo->fetchTable();
    }


    public function viewAttendanceSheet($slug){

        $attributions = $this->attributions_repo->findbySlug($slug);

        if(!empty($attributions->attendance_sheet_filename)){
            $path = $this->__static->archive_dir() .'/'. $attributions->attendance_sheet_filename;


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
        $attributions = $this->attributions_repo->findbySlug($slug);

        if(!empty($attributions->attendance_sheet_filename)){
            $path = $this->__static->archive_dir() .'/'. $attributions->attendance_sheet_filename;

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

        $attributions = $this->attributions_repo->findbySlug($slug);

        if(!empty($attributions->attendance_sheet_filename)){
            $path = $this->__static->archive_dir() .'/'. $attributions->attendance_sheet_filename;

            if (!File::exists($path)) { return "Cannot Detect File!"; }

            return response()->download($path) ;
        }

        return abort(404);


    }


    public function edit($slug){

        return $this->attributions_repo->findbySlug($slug);

    }



    public function show($slug){
        return $this->attributions_repo->findbySlug($slug);

    }


    public function update($request, $slug){
        $request->merge([
            'utilized_fund' => GlobalHelpers::sanitize_autonum($request->utilized_fund)
        ]);

        $attributions = $this->attributions_repo->findBySlug($slug);
        $filename = $this->filename($request, $attributions);

        $old_filename = $attributions->attendance_sheet_filename;
        $new_filename = $this->filterReservedChar($filename);

        // If theres new file upload
        if(!is_null($request->file('doc_file'))){

            if ($this->storage->disk('local')->exists($old_filename)) {

                $this->storage->disk('local')->delete($old_filename);

            }

            $request->file('doc_file')->storeAs('', $new_filename);

        }else{

            if ($request->title != $attributions->title && $this->storage->disk('local')->exists($old_filename)) {

                $this->storage->disk('local')->move($old_filename, $new_filename);

            }

        }

        $attributions = $this->attributions_repo->update($request, $filename, $attributions);

        if(!empty($request->row)){
            foreach ($request->row as $row) {
                $attributions_speaker = $this->attributions_speaker_repo->store($row, $attributions);
            }
        }

        $this->event->fire('attributions.update', $attributions);

        return json_encode(array('result' => 1 , 'slug' => $attributions->slug));

    }






    public function destroy($slug){

        $attributions = $this->attributions_repo->destroy($slug);

        if(!is_null($attributions->attendance_sheet_filename)){

            if ($this->storage->disk('local')->exists($attributions->attendance_sheet_filename)) {
                $this->storage->disk('local')->delete($attributions->attendance_sheet_filename);
            }

        }



        return $attributions;

    }





    private function filename($request, $attributions){

        $filename = $attributions->attendance_sheet_filename;

        if($request->title != $attributions->title){
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

        $attributions = $this->attributions_repo->findBySlug($slug);

        return $attributions;
    }


}