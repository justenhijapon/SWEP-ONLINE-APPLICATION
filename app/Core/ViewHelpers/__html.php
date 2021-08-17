<?php

namespace App\Core\ViewHelpers;

use URL;
use Input;
use Auth;
use __static;


class __html{



    public static function modal($id, $header, $message){

       return '<div class="modal fade" id="'. $id .'" data-backdrop="static">
			      <div class="modal-dialog">
			        <div class="modal-content">
			          <div class="modal-header">
			            <button class="close" data-dismiss="modal">
			              <span aria-hidden="true">&times;</span>
			            </button>
			            <h4 class="modal-title">'. $header .'</h4>

			          </div>
			          <div class="modal-body">
			            <p style="font-size: 17px;">'. $message .'</p>
			          </div>
			          <div class="modal-footer">
			            <button class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
			          </div>
			        </div>
			      </div>
			    </div>';
			    
    }



    public static function modal_delete($id){

       return '<div class="modal fade" id="'. $id .'" data-backdrop="static">
			    <div class="modal-dialog">
			      <div class="modal-content">
			        <div class="modal-header">
			          <button class="close" data-dismiss="modal">
			            <span aria-hidden="true">&times;</span>
			          </button>
			          <h4 class="modal-title"><i class="fa fa-exclamation-circle "></i> Delete ?</h4>
			        </div>
			        <div class="modal-body" id="delete_body">
			          <form method="POST" id="form">
			            '. csrf_field() .'
			            <input name="_method" value="DELETE" type="hidden">
			            <p style="font-size: 17px;">Are you sure, you want to delete this record?</p>
			          </div>
			          <div class="modal-footer">
			            <button class="btn btn-default" data-dismiss="modal">Close</button>
			            <button type="submit" class="btn btn-danger">Delete</button>
			          </form>
			        </div>
			      </div>
			    </div>
			  </div>';
			    
    }




    public static function modal_print($id, $header, $message, $print_route){

       return '<div class="modal fade" id="'. $id .'">
			    <div class="modal-dialog">
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			            <span aria-hidden="true">&times;</span></button>
			          <h4 class="modal-title">'. $header .'</h4>
			        </div>
			        <div class="modal-body">
			          <p><p style="font-size: 17px;">'. $message .'</p></p>
			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			          <a href="'. $print_route .'" type="button" class="btn btn-success">Print</a>
			        </div>
			      </div>
			    </div>
			  </div>';
			    
    }




    public static function alert($type, $header, $message){

       return '<div class="alert alert-'. $type .' alert-dismissible">
	              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	              <h4>'. $header .'</h4>
	              '. $message .'
	            </div>';

    }
    



    /** Wrappers **/

    public static function table_search($refresh_route){

    	$string = "'";

    	$seach_button_id = 'table_search_button';

     	$option_50 = Input::old('e') == '50' ? 'selected' : '';
     	$option_100 = Input::old('e') == '100' ? 'selected' : '';

       return '<div class="box-title">  
                <div class="input-group input-group-sm" style="width: 300px;">
                  <input name="q" class="form-control pull-right" placeholder="Search" type="text" value="'. old("q") .'">
                  <div class="input-group-btn">
                    <button id="'. $seach_button_id .'" type="submit" class="btn btn-default btn-md"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>

              <div></div>

              <div class="box-tools" style="margin-top:5px;">
              	<div class="col-md-3" style="margin-top:6px;">
              		Entries:
              	</div>
              	<div class="col-md-4">
			        <select id="e" class="form-control input-sm" name="e" onchange="document.getElementById('.$string.''. $seach_button_id .''.$string.').click()">
			          <option value="">20</option>
			          <option value="50" '. $option_50 .'>50</option>
			          <option value="100" '. $option_100 .'>100</option>
			        </select>
              	</div>
              	<div class="col-md-5">
              		<a href="'. $refresh_route .'" class="btn btn-sm btn-default">Refresh Data &nbsp;<i class="fa fa-refresh"></i></a>
              	</div>
              </div>';

    }




    public static function table_highlighter($slug, $sessions = []){

       foreach($sessions as $data){
       		if($slug == $data){
       			return 'style="background-color: #D5F5E3;"';
       		}
    	}

    }





    public static function table_counter($obj){

    	$first_item = $obj->firstItem() > 0 ? $obj->firstItem() : 0;
    	$last_item = $obj->lastItem() > 0 ? $obj->lastItem() : 0;

        return '<strong>Displaying '. $first_item .' - '.  $last_item .' out of '. $obj->total() .' Records</strong>';

    }





    public static function filter_open(){

       return '<div class="box '. self::collapsed_filter() .'">
		            <div class="box-header with-border" data-widget="collapse">
		                <h3 class="box-title">Advance Filters</h3>
		                <div class="box-tools pull-right">
		                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		                </div> 
		            </div>
		            <div class="box-body">';

    }



    public static function filter_close($id){

       return '</div>
            <button type="submit" id="'. $id .'" style="display:none;">Filter</button>
        </div>';

    }



    public static function back_button($route = []){

    	foreach($route as $data){
	    	if(self::previous_route() == $data){
	        	return '<a href="'. URL::previous() .'" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>';
	    	}
    	}


     }




    /** UTILITY METHODS **/
    public static function collapsed_filter(){

       return Input::except('q', 'e', 'page', 'sort', 'direction') ? '' : 'collapsed-box';

    }



    public static function previous_route(){

       return app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();

    }

    public static function timestamp($obj, $class){

        if(!empty($obj->updater)){
            $updated_by  = $obj->updater->firstname.' '.$obj->updater->lastname;
            $updated_by_time = date("M. d, Y | h:i A",strtotime($obj->updated_at));
        }else{
            $updated_by  = 'N/A';
            $updated_by_time = 'N/A';
        }

    	return '<div class="col-md-'.$class.'">
			<div class="stamps">
				<small class="no-margin">
					Encoded by: 
					<b>
						'.$obj->creator->firstname.' '.$obj->creator->lastname.'
					</b> 
				</small>
				<br>
				<small class="no-margin">
					Timestamp: 
					<b>
						'.date("M. d, Y | h:i A",strtotime($obj->created_at)).'
					</b> 
				</small>
			</div>
		</div>
		<div class="col-md-'.$class.'">

			<div class="stamps">
				<small class="no-margin">
					Last updated by: 
					<b>
						'.$updated_by.'
					</b> 
				</small>
				<br>
				<small class="no-margin">
					Timestamp: 
					<b>
						'.$updated_by_time.'
					</b> 
				</small>
			</div>
		</div>';
    }




    public static function timestamps($creator, $creator_timestamp, $editor, $editor_timestamp, $class){

    	return '<div class="col-md-'.$class.'">
			<div class="stamps">
				<small class="no-margin">
					Encoded by: 
					<b>
						'.$creator.'
					</b> 
				</small>
				<br>
				<small class="no-margin">
					Timestamp: 
					<b>
						'.date("F d, Y | h:i A",strtotime($creator_timestamp)).'
					</b> 
				</small>
			</div>
		</div>
		<div class="col-md-'.$class.'">
			<div class="stamps">
				<small class="no-margin">
					Last updated by: 
					<b>
						'.$editor.'
					</b> 
				</small>
				<br>
				<small class="no-margin">
					Timestamp: 
					<b>
						'.date("F d, Y | h:i A",strtotime($editor_timestamp)).'
					</b> 
				</small>
			</div>
		</div>';
    }


    public static function check_null($var){
		if($var == ""){
			return "N/A";
		}else{
			return $var;
		}
	}

	public static function blank_modal($id, $size, $padding = null){
		if(is_numeric($size)){
			return '<div class="modal fade" id="'.$id.'">
				    <div class="modal-dialog" style="width:'.$size.'%; padding-top:'.$padding.'">
				      <div class="modal-content">
				        </div>
				    </div>
				  </div>';
		}else{
			return '<div class="modal fade" id="'.$id.'">
				    <div class="modal-dialog modal-'.$size.'" style="padding-top:'.$padding.'">
				      <div class="modal-content">
				        </div>
				    </div>
				  </div>';
		}
		
	}
	public static function modal_loader(){
		return '<div style="display: none;">
				    <div id="modal_loader">
				      <center>
				        <img style="width: 70px; margin: 40px 0;" src="'.__static::loader(Auth::user()->color).'">
				      </center>
				    </div>
				  </div>';
	}

	public static function sex($sex){
		if($sex == "MALE"){
            return '<span class="label bg-green col-md-12"><i class="fa fa-male"></i> '.$sex.'</span>';
        }elseif($sex == "FEMALE"){
            return '<span class="label bg-maroon col-md-12"><i class="fa fa-female"></i> '.$sex.'</span>';
        }else{
            return $sex;
        }
	}

	public static function label_int($int){
		if($int > 0){
			return '<span class="label label-success">'.$int.'</span>';
		}
		else{
			return '<span class="label label-warning">'.$int.'</span>';
		}
	}

	public static function check_img($filename){

		if($filename != ''){
			if(file_exists('images/profile_images/'.$filename)){
				return asset('images/profile_images/'.$filename);			
			}
		}
		return asset('images/avatar.jpeg');
	}
}