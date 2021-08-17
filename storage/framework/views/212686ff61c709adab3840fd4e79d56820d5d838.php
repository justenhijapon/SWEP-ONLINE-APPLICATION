<?php $__env->startSection('content'); ?>
                                                                                                                                                                                                                            
  <section class="content-header">
      <h1>Block Farm Members</h1>
  </section>

  <section class="content">
    <div class="box">

      <div class="box-header with-border">
        <h3 class="box-title">List of Block Farm Members</h3>
        <div class="pull-right">
          <button type="button" class="btn <?php echo __static::bg_color(Auth::user()->color); ?>" data-toggle="modal" data-target="#add_bf_member_modal"><i class="fa fa-plus"></i> Add new</button>
        </div>
      </div>
      <div class="box-body">
        <div id="bf_member_table_container" style="display: none">
          
        
          <table class="table table-bordered table-striped table-hover" id="bf_member_table" style="width: 100% !important; font-size: 14px">
            <thead>
              <tr class="<?php echo __static::bg_color(Auth::user()->color); ?>">
                <th>Slug</th>
                <th>Fullname</th>
                <th>Block Farm</th>
                <th>Birthday</th>
                <th class="th-10">Age</th>
                <th>Civil Status</th>
                <th class="th-10">Sex</th>
                <th class="action">Action</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>

        </div>
      </div>
      <div id="tbl_loader">
        <center>
          <img style="width: 100px" src="<?php echo __static::loader(Auth::user()->color); ?>">
        </center>
      </div>

    </div>
  </div>
  </section>   

<?php $__env->stopSection(); ?> 

<?php $__env->startSection('modals'); ?>
  <div id="add_bf_member_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form id="add_bf_member_form">
          <?php echo csrf_field(); ?>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add new block farm member</h4>
          </div>
          <div class="modal-body">
            <div class="row">

              <div class="col-md-8">
                <label>Block Farm *</label>
                <div class="input-group block_farm except">
                  <input autocomplete="off" name="block_farm" placeholder="Block Farm the farmer belongs to" type="text" class="form-control block_farm_search add">
                  <span class="input-group-btn">
                    <button  type="button" class="btn btn-warning btn-flat clear_btn" data= "add">
                      <i class="fa fa-times"></i>
                    </button>
                  </span>
                </div>
              </div>
              

              <?php
                $start = date("Y", strtotime(date("Y-m-d")."- 15 years")); 
                $end = date("Y", strtotime(date("Y-m-d")."+ 2 years"));
                $years = [];

                for ($i = $start; $i < $end; $i++){
                  $years[$i] = $i;
                }
              ?>

              <?php echo __form::select_static(
                '4 crop_year', 'crop_year', 'Crop Year *', date('Y'), $years, $errors->has('is_menu'), $errors->first('is_menu'), '', ''
              ); ?>

            </div>

            <div class="block_farm_details_container" style="display: none">
              
            </div>
     
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Farmer's Info</a></li>
                <li><a href="#tab_2" data-toggle="tab">Family Members</a></li>
                <li><a href="#tab_3" data-toggle="tab">Farm and Business</a></li>                  
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="row">
                    <?php echo __form::textbox(
                      '3 lastname', 'lastname', 'text', 'Last Name', 'Last Name', old('title'), '' , $errors->first('title'), ''
                    ); ?>


                    <?php echo __form::textbox(
                      '3 firstname', 'firstname', 'text', 'First Name', 'First Name', old('title'), '' , $errors->first('title'), ''
                    ); ?>


                    <?php echo __form::textbox(
                      '3 middlename', 'middlename', 'text', 'Middle Name', 'Middle Name', old('title'), '' , $errors->first('title'), ''
                    ); ?>


                    <?php echo __form::datepicker(
                      '3 bday', 'bday',  'Birthday *', old('date_covered_from') ? old('date_covered_from') : Carbon::now()->format('m/d/Y'), '', $errors->first('date_covered_from')
                    ); ?>

                  </div>
                  <div class="row">
                    <?php echo __form::select_static(
                      '2 sex', 'sex', 'Sex*', '', 
                      [
                        "MALE" => "MALE",
                        "FEMALE" => "FEMALE"
                      ]
                      , $errors->has('is_menu'), $errors->first('is_menu'), '', ''
                    ); ?>


                    <?php echo __form::select_static(
                      '2 civil_status', 'civil_status', 'Civil Status*', old('is_menu'), [
                        'Single' => 'Single',
                        'Married' => 'Married',
                        'Divorced' => 'Divorced',
                        'Separated' => 'Separated',
                        'Widowed' => 'Widowed'               
                      ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
                    ); ?>


                    <?php echo __form::select_static(
                      '3 educ_att', 'educ_att', 'Educational Attainment*', old('is_menu'), [
                        'Doctoral Degree' => 'Doctoral Degree', 
                        'Masteral Degree' => 'Masteral Degree', 
                        'College Graduate' => 'College Graduate', 
                        'College Level' => 'College Level', 
                        'High School Graduate' => 'High School Graduate', 
                        'High School Level' => 'High School Level',
                        'Elementary Graduate' => 'Elementary Graduate',
                        'Pre-Elementary' => 'Pre-Elementary',
                        'None' => 'None'
                        
                      ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
                    ); ?>


                    <?php echo __form::textbox(
                      '3 years_sugarcane_farming', 'years_sugarcane_farming', 'number', 'Years in Sugarcane Farming', 'No. of Years in Sugarcane Farming', old('title'), $errors->has('title'), $errors->first('title'), ''
                    ); ?>


                    <?php echo __form::select_static(
                      '2 tenurial', 'tenurial', 'Tenurial Status*', old('is_menu'), [
                        'Private-leased' => 'Private-leased', 
                        'Owned and Individually managed' => 'Owned and Individually managed', 
                        'CLOA Holder and lessee' => 'CLOA Holder and lessee', 
                        'CLOA on process' => 'CLOA on process', 
                        'Others' => 'Others'
                        
                      ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
                    ); ?>



                  </div>
                </div>
                <div class="tab-pane" id="tab_2">
                  <div class="row" style="margin-bottom: 15px">
                    <div class="col-sm-12">
                      <button type="button" data-toggle="modal" data-target="#add_family_modal" class="btn btn-sm bg-purple pull-right">
                        <i class="fa fa-plus"></i> Add family member
                      </button>
                    </div>
                  </div>

                  <table class="table table-bordered table-striped table-hover" id="family_table" style="width: 100% !important; font-size: 14px;">
                    <thead>
                      <tr>
                        <th>Data</th>
                        <th>Name</th>
                        <th class="th-10">Sex</th>
                        <th>Birthday</th>
                        <th>Education</th>
                        <th>Civil | Economic status</th>
                        <th class="th-10">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="tab_3">
                  <table class="6-9-tbl table-bordered x-tbl"  style="background-color: #dfccff87 !important">
                    <thead>
                      <tr >
                        <th></th>
                        <th class="text-center">
                          Sugarcane crop <i class="fa fa-question-circle" title="PC = Plant Cane | RC = Ratoon Cane"></i>
                        </th>
                        <th class="text-center">
                          Total farm area <i class="fa fa-question-circle" title="in ha."></i>
                        </th>
                        <th class="text-center">Variety Planted</th>
                        <th class="text-center">Total TC</th>
                        <th class="text-center">Total LKg</th>
                        <th class="text-center">Molasses</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>a.</td>
                        <td>
                          <input type='text' class='editable'>
                        </td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                      </tr>
                      <tr>
                        <td>b.</td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                      </tr>
                      <tr>
                        <td>c.</td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                      </tr>
                      <tr>
                        <td>d.</td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                      </tr>
                    </tbody>
                  </table>
                  <br>
                  <div class="row">
                    <?php echo __form::textbox(
                      '3 sugar_per_bag', 'sugar_per_bag', 'text', 'Price of sugar per bag', 'Price of sugar per bag', old('title'), 'sugar_per_bag', $errors->first('title'), ''
                    ); ?>


                    <?php echo __form::textbox(
                      '3 molasses_per_kg', 'molasses_per_kg', 'text', 'Price of mollases/kg', 'Price of mollases/kg', old('title'), 'molasses_per_kg', $errors->first('title'), ''
                    ); ?>


                    <?php echo __form::textbox(
                      '3 planter_miller', 'planter_miller', 'text', 'Planter-Miller Sharing', 'Planter-Miller Sharing', old('title'), '', $errors->first('title'), ''
                    ); ?>


                    <?php echo __form::textbox(
                      '3 income_sugarcane', 'income_sugarcane', 'text', 'Total income from sugarcane', 'Total income from sugarcane', old('title'), 'income_sugarcane', $errors->first('title'), ''
                    ); ?>


                  </div>

                  <table class="14-19-tbl table-bordered"  style="background-color: #dfccff87 !important">
                    <thead>
                      <tr >
                        <th></th>
                        <th class="text-center">Other crops planted</th>
                        <th class="text-center">
                          Total farm area <i class="fa fa-question-circle" title="in ha."></i>
                        </th>
                        <th class="text-center">Annual Income</th>
                        <th class="text-center">Livestock Raised</th>
                        <th class="text-center">No of heads</th>
                        <th class="text-center">Annual Income</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>a.</td>
                        <td><input type='text' name="wala" class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable autonum'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable autonum'></td>
                      </tr>
                      <tr>
                        <td>b.</td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable autonum'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable autonum'></td>
                      </tr>
                      <tr>
                        <td>c.</td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable autonum'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable autonum'></td>
                      </tr>
                      <tr>
                        <td>d.</td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable autonum'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable'></td>
                        <td><input type='text' class='editable autonum'></td>
                      </tr>
                    </tbody>
                  </table>


                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn <?php echo __static::bg_color(Auth::user()->color); ?>"><i class="fa fa-save"></i> Save</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  <div id="add_family_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog pop-up" role="document">
      <div class="modal-content">
        <form id="add_family_form">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add family member</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <?php echo __form::textbox(
                '4 lastname', 'lastname', 'text', 'Last Name', 'Last Name', old('title'), '' , $errors->first('title'), ''
              ); ?>


              <?php echo __form::textbox(
                '4 firstname', 'firstname', 'text', 'First Name', 'First Name', old('title'), '' , $errors->first('title'), ''
              ); ?>


              <?php echo __form::textbox(
                '4 middlename', 'middlename', 'text', 'Middle Name', 'Middle Name', old('title'), '' , $errors->first('title'), ''
              ); ?>


              <?php echo __form::select_static(
                '4 sex', 'sex', 'Sex*', '', 
                [
                  "MALE" => "MALE",
                  "FEMALE" => "FEMALE"
                ]
                , $errors->has('is_menu'), $errors->first('is_menu'), '', ''
              ); ?>


              <?php echo __form::datepicker(
                '4 bday', 'bday',  'Birthday *', old('date_covered_from') ? old('date_covered_from') : Carbon::now()->format('m/d/Y'), $errors->has('date_covered_from'), $errors->first('date_covered_from')
              ); ?>




              <?php echo __form::select_static(
                '4 civil_status', 'civil_status', 'Civil Status*', old('is_menu'), [
                  'Single' => 'Single',
                  'Married' => 'Married',
                  'Divorced' => 'Divorced',
                  'Separated' => 'Separated',
                  'Widowed' => 'Widowed'               
                ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
              ); ?>


              <?php echo __form::select_static(
                '4 educ_att', 'educ_att', 'Educational Attainment*', old('is_menu'), [
                  'Doctoral Degree' => 'Doctoral Degree', 
                  'Masteral Degree' => 'Masteral Degree', 
                  'College Graduate' => 'College Graduate', 
                  'College Level' => 'College Level', 
                  'High School Graduate' => 'High School Graduate', 
                  'High School Level' => 'High School Level',
                  'Elementary Graduate' => 'Elementary Graduate',
                  'Pre-Elementary' => 'Pre-Elementary',
                  'None' => 'None'
                  
                ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
              ); ?>


              <?php echo __form::select_static_group(
                '4 eco_status', 'eco_status', 'Economic Status*', '1', [
                  'Economically inactive' => [
                    'Student' => 'Student',
                    'Retired Employee' => 'Retired Employee',
                    'Aged/Sicked' => 'Aged/Sicked',
                    'House help' => 'House help',
                    'Others' => 'Others',
                  ],
                  'Economically active' => [
                    'On-farm'=>'On-farm',
                    'Off-farm'=> 'Off-farm'
                  ]
          
                ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
              ); ?>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div id="edit_family_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog pop-up" role="document">
      <div class="modal-content">
        <form id="edit_family_form">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit family member</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div style="display:none">
              <?php echo __form::textbox(
                '4 id', 'id', 'text', 'ID', 'ID', old('title'), '' , $errors->first('title'), ''
              ); ?>

            </div>

              <?php echo __form::textbox(
                '4 lastname', 'lastname', 'text', 'Last Name', 'Last Name', old('title'), '' , $errors->first('title'), ''
              ); ?>


              <?php echo __form::textbox(
                '4 firstname', 'firstname', 'text', 'First Name', 'First Name', old('title'), '' , $errors->first('title'), ''
              ); ?>


              <?php echo __form::textbox(
                '4 middlename', 'middlename', 'text', 'Middle Name', 'Middle Name', old('title'), '' , $errors->first('title'), ''
              ); ?>


              <?php echo __form::select_static(
                '4 sex', 'sex', 'Sex*', '', 
                [
                  "MALE" => "MALE",
                  "FEMALE" => "FEMALE"
                ]
                , $errors->has('is_menu'), $errors->first('is_menu'), '', ''
              ); ?>

              <?php echo __form::datepicker(
                '4 bday', 'bday',  'Birthday *', old('date_covered_from') ? old('date_covered_from') : Carbon::now()->format('m/d/Y'), $errors->has('date_covered_from'), $errors->first('date_covered_from')
              ); ?>




              <?php echo __form::select_static(
                '4 civil_status', 'civil_status', 'Civil Status*', old('is_menu'), [
                  'Single' => 'Single',
                  'Married' => 'Married',
                  'Divorced' => 'Divorced',
                  'Separated' => 'Separated',
                  'Widowed' => 'Widowed'               
                ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
              ); ?>


              <?php echo __form::select_static(
                '4 educ_att', 'educ_att', 'Educational Attainment*', old('is_menu'), [
                  'Doctoral Degree' => 'Doctoral Degree', 
                  'Masteral Degree' => 'Masteral Degree', 
                  'College Graduate' => 'College Graduate', 
                  'College Level' => 'College Level', 
                  'High School Graduate' => 'High School Graduate', 
                  'High School Level' => 'High School Level',
                  'Elementary Graduate' => 'Elementary Graduate',
                  'Pre-Elementary' => 'Pre-Elementary',
                  'None' => 'None'
                  
                ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
              ); ?>


              <?php echo __form::select_static_group(
                '4 eco_status', 'eco_status', 'Economic Status*', '1', [
                  'Economically inactive' => [
                    'Student' => 'Student',
                    'Retired Employee' => 'Retired Employee',
                    'Aged/Sicked' => 'Aged/Sicked',
                    'House help' => 'House help',
                    'Others' => 'Others',
                  ],
                  'Economically active' => [
                    'On-farm'=>'On-farm',
                    'Off-farm'=> 'Off-farm'
                  ]
          
                ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
              ); ?>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

  <?php echo __html::blank_modal('edit_bf_member_modal','lg'); ?>

  

  <div id='add_family_modal_edit' class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog pop-up" role="document">
      <div class="modal-content">
        <form id="add_family_form_edit">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add family member</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <?php echo __form::textbox(
                '4 lastname', 'lastname', 'text', 'Last Name', 'Last Name', old('title'), '' , $errors->first('title'), ''
              ); ?>


              <?php echo __form::textbox(
                '4 firstname', 'firstname', 'text', 'First Name', 'First Name', old('title'), '' , $errors->first('title'), ''
              ); ?>


              <?php echo __form::textbox(
                '4 middlename', 'middlename', 'text', 'Middle Name', 'Middle Name', old('title'), '' , $errors->first('title'), ''
              ); ?>


              <?php echo __form::select_static(
                '4 sex', 'sex', 'Sex*', '', 
                [
                  "MALE" => "MALE",
                  "FEMALE" => "FEMALE"
                ]
                , $errors->has('is_menu'), $errors->first('is_menu'), '', ''
              ); ?>


              <?php echo __form::datepicker(
                '4 bday', 'bday',  'Birthday *', old('date_covered_from') ? old('date_covered_from') : Carbon::now()->format('m/d/Y'), $errors->has('date_covered_from'), $errors->first('date_covered_from')
              ); ?>




              <?php echo __form::select_static(
                '4 civil_status', 'civil_status', 'Civil Status*', old('is_menu'), [
                  'Single' => 'Single',
                  'Married' => 'Married',
                  'Divorced' => 'Divorced',
                  'Separated' => 'Separated',
                  'Widowed' => 'Widowed'               
                ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
              ); ?>


              <?php echo __form::select_static(
                '4 educ_att', 'educ_att', 'Educational Attainment*', old('is_menu'), [
                  'Doctoral Degree' => 'Doctoral Degree', 
                  'Masteral Degree' => 'Masteral Degree', 
                  'College Graduate' => 'College Graduate', 
                  'College Level' => 'College Level', 
                  'High School Graduate' => 'High School Graduate', 
                  'High School Level' => 'High School Level',
                  'Elementary Graduate' => 'Elementary Graduate',
                  'Pre-Elementary' => 'Pre-Elementary',
                  'None' => 'None'
                  
                ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
              ); ?>


              <?php echo __form::select_static_group(
                '4 eco_status', 'eco_status', 'Economic Status*', '1', [
                  'Economically inactive' => [
                    'Student' => 'Student',
                    'Retired Employee' => 'Retired Employee',
                    'Aged/Sicked' => 'Aged/Sicked',
                    'House help' => 'House help',
                    'Others' => 'Others',
                  ],
                  'Economically active' => [
                    'On-farm'=>'On-farm',
                    'Off-farm'=> 'Off-farm'
                  ]
          
                ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
              ); ?>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  <div id="edit_family_modal_edit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog pop-up" role="document">
      <div class="modal-content">
        <form id="edit_family_form_edit">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit family member</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div style="display:none">
              <?php echo __form::textbox(
                '4 id', 'id', 'text', 'ID', 'ID', old('title'), '' , $errors->first('title'), ''
              ); ?>

            </div>

              <?php echo __form::textbox(
                '4 lastname', 'lastname', 'text', 'Last Name', 'Last Name', old('title'), '' , $errors->first('title'), ''
              ); ?>


              <?php echo __form::textbox(
                '4 firstname', 'firstname', 'text', 'First Name', 'First Name', old('title'), '' , $errors->first('title'), ''
              ); ?>


              <?php echo __form::textbox(
                '4 middlename', 'middlename', 'text', 'Middle Name', 'Middle Name', old('title'), '' , $errors->first('title'), ''
              ); ?>


              <?php echo __form::select_static(
                '4 sex', 'sex', 'Sex*', '', 
                [
                  "MALE" => "MALE",
                  "FEMALE" => "FEMALE"
                ]
                , $errors->has('is_menu'), $errors->first('is_menu'), '', ''
              ); ?>

              <?php echo __form::datepicker(
                '4 bday', 'bday',  'Birthday *', old('date_covered_from') ? old('date_covered_from') : Carbon::now()->format('m/d/Y'), $errors->has('date_covered_from'), $errors->first('date_covered_from')
              ); ?>




              <?php echo __form::select_static(
                '4 civil_status', 'civil_status', 'Civil Status*', old('is_menu'), [
                  'Single' => 'Single',
                  'Married' => 'Married',
                  'Divorced' => 'Divorced',
                  'Separated' => 'Separated',
                  'Widowed' => 'Widowed'               
                ], $errors->has('is_menu'), $errors->first('is_menu'), '', ''
              ); ?>


              <?php echo __form::select_static(
                '4 educ_att', 'educ_att', 'Educational Attainment*', old('is_menu'), [
                  'Doctoral Degree' => 'Doctoral Degree', 
                  'Masteral Degree' => 'Masteral Degree', 
                  'College Graduate' => 'College Graduate', 
                  'College Level' => 'College Level', 
                  'High School Graduate' => 'High School Graduate', 
                  'High School Level' => 'High School Level',
                  'Elementary Graduate' => 'Elementary Graduate',
                  'Pre-Elementary' => 'Pre-Elementary',
                  'None' => 'None'
                  
                ], '', $errors->first('is_menu'), '', ''
              ); ?>


              <?php echo __form::select_static_group(
                '4 eco_status', 'eco_status', 'Economic Status*', '1', [
                  'Economically inactive' => [
                    'Student' => 'Student',
                    'Retired Employee' => 'Retired Employee',
                    'Aged/Sicked' => 'Aged/Sicked',
                    'House help' => 'House help',
                    'Others' => 'Others',
                  ],
                  'Economically active' => [
                    'On-farm'=>'On-farm',
                    'Off-farm'=> 'Off-farm'
                  ]
          
                ], '', $errors->first('is_menu'), '', ''
              ); ?>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>





  <?php echo __html::blank_modal('show_bf_member_modal','lg'); ?>

  





<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
  $(document).ready(function(){
    form = $("#add_bf_member_form");
    form.find(".nav-tabs-custom input").attr('disabled','disabled');
    form.find(".nav-tabs-custom select").attr('disabled','disabled');



  })

  function markNew($table, $tr){
    $($table+" tr").each(function(){
      $(this).removeClass('success');
    })
    $($tr).addClass('success');
  }

  function on_select_typeahead(result,target_modal,type){
    if(type == 'add'){
      chosen_bf = result.value;
    }if(type == 'edit'){
      chosen_bf_edit = result.value;
    }
    $.ajax({
      url: "<?php echo e(route('dashboard.bf_member.index')); ?>?get_block_farm_id="+result.value,
      type: 'GET',
      success: function(response){
        cont = $(target_modal+" .block_farm_details_container");
        cont.html('');
        cont.html(response);
        cont.slideDown();
        $(target_modal+" #crop_year").focus();
        $(target_modal+" .block_farm_search").parent('div').addClass('has-success');
        $(target_modal+" .block_farm_search").attr('readonly','readonly');
        $(target_modal+" .block_farm_search").parent('div').removeClass('has-error');
        form = $(target_modal+' .clear_btn').parents('form');
        form.find(".nav-tabs-custom input").removeAttr('disabled');
        form.find(".nav-tabs-custom select").removeAttr('disabled');
      },
      error: function(response){

      }
    })
  }

  function dt_draw(){
    bf_member_tbl.draw(false);
  }



</script>
<script type="text/javascript">
// $(".6-9-tbl").exceltable();
// $(".14-19-tbl").exceltable();
// autonumeric
<?php echo __js::modal_loader(); ?>



autonum_settings = {
  currencySymbol : ' ₱',
  decimalCharacter : '.',
  digitGroupSeparator : ',',
};

new AutoNumeric('#sugar_per_bag', autonum_settings);
new AutoNumeric('#molasses_per_kg', autonum_settings);
new AutoNumeric('#income_sugarcane', autonum_settings);

$(".autonum").each(function(){
  new AutoNumeric(this, autonum_settings);
})


active = '';
bf_member_tbl = $("#bf_member_table").DataTable({
  'dom' : 'lBfrtip',
  "processing": true,
  "serverSide": true,
  "ajax" : '<?php echo e(route("dashboard.bf_member.index")); ?>',
  "columns": [
      { "data": "slug" },
      { "data": "fullname" },
      { "data": "block_farm_details" },
      { "data": "bday" },
      { "data": "age" },
      { "data": "civil_status" },
      { "data": "sex" },
      { "data": "action" }
  ],
  "buttons": [
      <?php echo __js::dt_buttons(); ?>

  ],
  "columnDefs":[
    {
      "targets" : 0,
      "visible" : false
    },

    {
      "targets" : [ 1 , 2 , 3],
      "visible" : true
    },
    {
      "targets" : 6,
      "orderable" : false,
      "class" : 'w-6p'
    },
    {
      "targets" : 7,
      "orderable" : false,
      "class" : 'action-8p'
    },
    {
      "targets": 4, 
      // "render" : $.fn.dataTable.render.moment( 'MMMM D, YYYY' )
    }
  ],
  "responsive": false,
  "initComplete": function( settings, json ) {
      $('#tbl_loader').fadeOut(function(){
        $("#bf_member_table_container").fadeIn();
        search_for = "<?php echo e($search); ?>";
        if(search_for != ''){
          bf_member_tbl.search(search_for).draw();
          active = search_for;
          setTimeout(function(){
            active = '';
          },3000);
        }
      });
    },
  "language": 
    {          
      "processing": "<center><img style='width: 70px' src='<?php echo __static::loader(Auth::user()->color); ?>'></center>",
    },
  "drawCallback": function(settings){
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="modal"]').tooltip();
    if(active != ''){
       $("#bf_member_table #"+active).addClass('success');
    }
  }
});

 //Search Bar Styling
style_datatable('#bf_member_table');

//Need to press enter to search
$('#bf_member_table_filter input').unbind();
$('#bf_member_table_filter input').bind('keyup', function (e) {
    if (e.keyCode == 13) {
        bf_member_tbl.search(this.value).draw();
    }
});


family_tbl = $("#family_table").DataTable({
  "columnDefs":[
    {
      "targets" : 0,
      "visible" : false
    }
  ]
});

//STORE FAMILY MEMBER - ADD
$("#add_family_form").submit(function(e){
  e.preventDefault();
  form = $(this);
  form_data = form.serializeArray();
  data = {};
  $.each(form_data, function(i,item){
    data[item.name] = item.value;
  })
  f_member_id ='member-'+makeid(16);
  var memberNode = family_tbl
    .row.add( [ 
      {
        "data": {
          'id' : f_member_id,
          'lastname': data.lastname,
          'firstname': data.firstname,
          'middlename': data.middlename,
          'bday': data.bday,
          'sex': data.sex,
          'civil_status' :data.civil_status,
          'educ_att' :data.educ_att,
          'eco_status' : data.eco_status,
        }
      }, 
      data.lastname+", "+data.firstname+" "+data.middlename.charAt(0)+".",
      data.sex, 
      data.bday,
      data.educ_att, 
      data.civil_status+" | "+data.eco_status,
      '<div class="btn-group">'+
          '<button type="button" data="'+f_member_id+'" class="btn btn-default btn-sm edit_family_btn" data-toggle="modal" data-target="" title="" data-placement="top" data-original-title="Edit">'+
              '<i class="fa fa-edit"></i>'+
          '</button>'+
          '<button type="button" data="" class="btn btn-sm btn-danger remove_member " data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete">'+
              '<i class="fa fa-trash"></i>'+
          '</button>'+
      '</div>',
    ] )
    .draw()
    .node().id = f_member_id;

  markNew("#family_table", "#"+f_member_id);

  form.get(0).reset();
  //console.log(memberNode);
});

//UPDATE FAMILY MEMBER - ADD
$("#edit_family_form").submit(function(e) {
  e.preventDefault();
  form = $(this).serializeArray();
  data = {};
  $.each(form, function(i,item){
    data[item.name] = item.value;
  })

  var oTable = $('#family_table').dataTable();
  oTable.fnUpdate([
    {
        "data": {
          'id' : data.id,
          'lastname': data.lastname,
          'firstname': data.firstname,
          'middlename': data.middlename,
          'bday': data.bday,
          'sex': data.sex,
          'civil_status' :data.civil_status,
          'educ_att' :data.educ_att,
          'eco_status' : data.eco_status,
        }
    },
    data.lastname+", "+data.firstname+" "+data.middlename.charAt(0)+".",
    data.sex, 
    data.bday,
    data.educ_att, 
    data.civil_status+" | "+data.eco_status,
    '<div class="btn-group">'+
          '<button type="button" data="'+data.id+'" class="btn btn-default btn-sm edit_family_btn" data-toggle="modal" data-target="" title="" data-placement="top" data-original-title="Edit">'+
              '<i class="fa fa-edit"></i>'+
          '</button>'+
          '<button type="button" data="" class="btn btn-sm btn-danger remove_member " data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete">'+
              '<i class="fa fa-trash"></i>'+
          '</button>'+
      '</div>',

    ], $("#"+data['id']));

  $("#edit_family_modal").modal('hide');
  markNew("#family_table", "#"+data.id);
});

//STORE FAMILY MEMBER - EDIT
$("#add_family_form_edit").submit(function(e){
  e.preventDefault();
  form = $(this);
  form_data = form.serializeArray();
  data = {};
  $.each(form_data, function(i,item){
    data[item.name] = item.value;
  })
  f_member_id ='member-'+makeid(16);
  var memberNode = family_tbl_edit
    .row.add( [ 
      {
        "data": {
          'id' : f_member_id,
          'lastname': data.lastname,
          'firstname': data.firstname,
          'middlename': data.middlename,
          'bday': data.bday,
          'sex': data.sex,
          'civil_status' :data.civil_status,
          'educ_att' :data.educ_att,
          'eco_status' : data.eco_status,
        }
      }, 
      data.lastname+", "+data.firstname+" "+data.middlename.charAt(0)+".",
      data.sex, 
      data.bday,
      data.educ_att, 
      data.civil_status+" | "+data.eco_status,
      '<div class="btn-group">'+
          '<button type="button" data="'+f_member_id+'" class="btn btn-default btn-sm edit_family_btn_edit" data-toggle="modal" data-target="#edit_family_modal_edit" title="" data-placement="top" data-original-title="Edit">'+
              '<i class="fa fa-edit"></i>'+
          '</button>'+
          '<button type="button" data="" class="btn btn-sm btn-danger remove_member_edit" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete">'+
              '<i class="fa fa-trash"></i>'+
          '</button>'+
      '</div>',
    ] )
    .draw()
    .node().id = f_member_id;

  markNew("#family_table_edit", "#"+f_member_id);

  form.get(0).reset();
  //console.log(memberNode);
});

//UPDATE FAMILY MEMBER - EDIT
$("#edit_family_form_edit").submit(function(e) {
  e.preventDefault();
  form = $(this).serializeArray();
  data = {};
  $.each(form, function(i,item){
    data[item.name] = item.value;
  })

  var pTable = $('#family_table_edit').dataTable();
  pTable.fnUpdate([
    {
        "data": {
          'id' : data.id,
          'lastname': data.lastname,
          'firstname': data.firstname,
          'middlename': data.middlename,
          'bday': data.bday,
          'sex': data.sex,
          'civil_status' :data.civil_status,
          'educ_att' :data.educ_att,
          'eco_status' : data.eco_status,
        }
    },
    data.lastname+", "+data.firstname+" "+data.middlename.charAt(0)+".",
    data.sex, 
    data.bday,
    data.educ_att, 
    data.civil_status+" | "+data.eco_status,
    '<div class="btn-group">'+
          '<button type="button" data="'+data.id+'" class="btn btn-default btn-sm edit_family_btn_edit" data-toggle="modal" data-target="#edit_family_modal_edit" title="" data-placement="top" data-original-title="Edit">'+
              '<i class="fa fa-edit"></i>'+
          '</button>'+
          '<button type="button" data="" class="btn btn-sm btn-danger remove_member_edit" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete">'+
              '<i class="fa fa-trash"></i>'+
          '</button>'+
      '</div>',

    ], $("#"+data['id']));

  $("#edit_family_modal_edit").modal('hide');
  markNew("#family_table_edit", "#"+data.id);
});

//CLICK edit button
$("body").on("click",".edit_family_btn", function(){
  m_id = $(this).attr('data');
  d = family_tbl.rows().data();
  console.log(d);
  $("#edit_family_form").get(0).reset();
  edit_data = {};
  $.each(d, function(a, b){
    if(b[0]['data']['id'] == m_id){
      edit_data = b[0]['data'];
    }
    edit_modal = $("#edit_family_modal");
    $("#edit_family_form option").each(function(){
      $(this).removeAttr('selected');
    })
    $.each(edit_data, function(c, d){
      $("#edit_family_form").find("input[name='"+c+"']").val(d);
      $("."+c+" option[value='"+d+"']").attr('selected','selected');
    })
    edit_modal.modal('show');
  });
  $("#edit_family_modal .modal-title").html(edit_data.lastname+", "+edit_data.firstname);
  console.log(edit_data);
})
$("body").on("click",".edit_family_btn_edit", function(){
  m_id_edit = '';
  m_id_edit = $(this).attr('data');
  d = family_tbl_edit.rows().data();
  
  edit_data_edit = {};
  $.each(d, function(a, b){
    if(b[0]['data']['id'] == m_id_edit){
      edit_data_edit = b[0]['data'];
    }
  });


  edit_modal_edit = $("#edit_family_modal_edit");
  $("#edit_family_form_edit option").each(function(){
    $(this).removeAttr('selected');
  })

  $("#edit_family_form_edit").get(0).reset();
  $.each(edit_data_edit, function(c, d){
    //console.log(c);
    $("#edit_family_form_edit").find("input[name='"+c+"']").val(d);

    $("#edit_family_form_edit ."+c+" option[value='"+d+"']").attr('selected','selected');
  })

  $("#edit_family_modal_edit .modal-title").html(edit_data_edit.lastname+", "+edit_data_edit.firstname);
  // console.log(edit_data);
})





$("body").on("click",".edit_family_btn", function(){
  m_id = $(this).attr('data');
  d = family_tbl.rows().data();
  console.log(d);
  edit_data = {};
  $.each(d, function(a, b){
    if(b[0]['data']['id'] == m_id){
      edit_data = b[0]['data'];
    }
    edit_modal = $("#edit_family_modal");
    $("#edit_family_form option").each(function(){
      $(this).removeAttr('selected');
    })
    $.each(edit_data, function(c, d){
      $("#edit_family_form").find("input[name='"+c+"']").val(d);
      $("."+c+" option[value='"+d+"']").attr('selected','selected');
    })
    edit_modal.modal('show');
  });
  $("#edit_family_modal .modal-title").html(edit_data.lastname+", "+edit_data.firstname);
  console.log(edit_data);
})




$('body').on( 'click', '.remove_member', function () {
  family_tbl
    .row( $(this).parents('tr') )
    .remove()
    .draw();
});

$('body').on( 'click', '.remove_member_edit', function () {
  family_tbl_edit
    .row( $(this).parents('tr') )
    .remove()
    .draw();
});


chosen_bf = '';
$('#add_bf_member_modal .block_farm_search').typeahead({
    ajax : "<?php echo e(route('dashboard.bf_member.index')); ?>",
    onSelect:function (result) {
      on_select_typeahead(result, '#add_bf_member_modal','add');
    },
});


//STORE BLOCK FARM MEMBER FORM
$("#add_bf_member_form").submit(function(e) {
  form = $(this);
  loading_btn(form);
  e.preventDefault();
  form_data = $(this).serializeArray();
  family_data = family_tbl.rows().data();
  family_data_array = {};
  form_data_array = {};
  $.each(family_data, function(a,b){
    if($.isNumeric(a)){
      
      family_data_array[b[0]['data']['id']] = b[0]['data'];
    }
  });
 // console.log(family_data_array);

  $.each(form_data , function(c,d){
    form_data_array[form_data[c]['name']] = form_data[c]['value'];
  })

  form_data_array['family_members'] = family_data_array;
  form_data_array['chosen_bf'] = chosen_bf;

  $.ajax({
    url: "<?php echo e(route('dashboard.bf_member.store')); ?>",
    data: form_data_array,
    type: 'POST',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response){
      succeed(form,true,false);
      family_tbl.clear().draw();
      $("#add_bf_member_modal .clear_btn").click();
      notify("Blockfarm member has beed added successfully.","success");
      bf_member_tbl.draw(false);
      active = response.slug;
    },
    error: function(response){
      errored(form,response);
      if (typeof response.responseJSON.errors.chosen_bf !== 'undefined') {
        notify("You need to select block farm.",'warning');
        $("#add_bf_member_form .block_farm").addClass('has-error');
      }else{
        $("#add_bf_member_form .block_farm").removeClass('has-error');
      }
    }
  })
});


//UDPATE BLOCK FARM MEMBER
$("body").on("submit", "#edit_bf_member_form", function(e){
  e.preventDefault();
  form = $(this);
  loading_btn(form);
  form_data = $(this).serializeArray();
  family_data = family_tbl_edit.rows().data();
  family_data_array = {};
  form_data_array = {};
  $.each(family_data, function(a,b){
    if($.isNumeric(a)){
      
      family_data_array[b[0]['data']['id']] = b[0]['data'];
    }
  });

  $.each(form_data , function(c,d){
    form_data_array[form_data[c]['name']] = form_data[c]['value'];
  })

  form_data_array['family_members'] = family_data_array;
  form_data_array['chosen_bf'] = chosen_bf_edit;

  uri = "<?php echo e(route('dashboard.bf_member.update','slug')); ?>";
  uri = uri.replace('slug', $(this).attr('data'));

  $.ajax({
    url: uri,
    data: form_data_array,
    type: 'PUT',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response){ 
      succeed(form,true,true);
      notify("Blockfarm member has beed added successfully.","success");
      bf_member_tbl.draw(false);
      active = response.slug;
    },
    error: function(response){
      errored(form,response);
      if (typeof response.responseJSON.errors.chosen_bf !== 'undefined') {
        notify("You need to select block farm.",'warning');
        $("#edit_bf_member_form .block_farm").addClass('has-error');
      }else{
        $("#edit_bf_member_form .block_farm").removeClass('has-error');
      }
    }
  })



  //console.log(form_data_array);
})


//CLEAR BUTTON
$("body").on('click', '.clear_btn',function(){
  form = $(this).parents('form');
  form.find(".block_farm_search").removeAttr('readonly');
  form.find(".block_farm_search").focus();
  form.find(".block_farm_search").parent('div').removeClass('has-success');

  if($(this).attr('data') == 'add'){
    chosen_bf = '';
  }if($(this).attr('data') == 'edit'){
    chosen_bf_edit = '';
  }
  cont = $(this).parents('.modal-body').find(".block_farm_details_container");
  cont.slideUp(function() {
   cont.html(''); 
  });
  form.find(".nav-tabs-custom input").attr('disabled','disabled');
  form.find(".nav-tabs-custom select").attr('disabled','disabled');
  $(this).parents('.block_farm').find(".block_farm_search").val('');
})

//SHOW BLOCK FARM MEMBER
$("body").on('click','.show_bf_member_btn', function(){
  id = $(this).attr('data');

  load_modal('#show_bf_member_modal');
  uri = "<?php echo e(route('dashboard.bf_member.show','slug')); ?>";
  uri = uri.replace('slug',id);
  $.ajax({
    url: uri,
    type: 'GET',
    success: function(response){
      populate_modal('#show_bf_member_modal',response);
    },
    error: function(response){
      notify("Error!","danger");
    }
  })
})
u = '<?php echo e(route('dashboard.bf_member.index')); ?>';
$("a[href='"+u+"']").closest('ul').css('display','block');
$("a[href='"+u+"']").closest('.treeview').addClass('menu-open active');

//EDIT BLOCK FARM MEMBER
$("body").on("click",".edit_bf_member_btn", function(){
  load_modal("#edit_bf_member_modal");
  id = $(this).attr('data');
  uri = "<?php echo e(route('dashboard.bf_member.edit','slug')); ?>";
  uri = uri.replace('slug',id);
  $.ajax({
    url : uri,
    type: 'GET',
    success: function(response){
      populate_modal("#edit_bf_member_modal",response);
      setTimeout(function(){
        $('#edit_bf_member_modal .block_farm_search').typeahead({
            ajax : "<?php echo e(route('dashboard.bf_member.index')); ?>",
            onSelect:function (result) {
              on_select_typeahead(result, '#edit_bf_member_modal','edit');
            },
        });
        family_tbl_edit = $("#family_table_edit").DataTable({
          "columnDefs":[
            {
              "targets" : 0,
              "visible" : false 
            }
          ]
        });
        
        $("body").on("click", ".final", function(){
          console.log(family_tbl_edit.rows().data());
        });

        family_tbl_edit.rows().every(function(){
            d = this.data();
            d[0]= {'data': JSON.parse(d[0])};
            // console.log(d);
            //this.invalidate();
        });


        $("body").on('click','.get_datas', function(){
          

        });

      },500);



    },
    error: function(response){
      console.log(response);
      notify("Error", "danger");
    }
  });
});

$("body").on('click','.delete_bf_member_btn', function(e){
  id = $(this).attr('data');
  confirm("<?php echo e(route('dashboard.bf_member.destroy', 'slug')); ?>", id);
})


</script>

    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>