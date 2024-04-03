@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Dashboard</h1>
</section>

<section class="content">
	
	<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>000</h3>

              <p>Approved Budget</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>0.1<sup style="font-size: 20px">%</sup></h3>

              <p>Sample Data</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>Sample Data</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Sample Data</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    <div class="row">
      <div class="col-md-4">
        <div class="panel">
          <div class="panel-body">
            <center>
              <label>Scholars</label>  
            </center>
            <hr class="no-margin">
            <canvas id="scholars_m_f" width="400" height="250"></canvas>
            <center>

            </center>
          </div>
        </div>
      </div>
   {{--  </div>

     <div class="row"> --}}
      <div class="col-md-8">
        <div class="panel">
          <div class="panel-body">
            <center>
              <label>Seminars Conducted (Example data)</label>  
            </center>
            <hr class="no-margin">
            <canvas id="seminars_line" width="400" height="118"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
     	<div class="col-md-8">
     		<div class="panel">
     			<div class="panel-body">
            <center>
              <label>Sample Data</label>  
            </center>
            <hr class="no-margin">
     				<canvas id="scholars" width="400" height="118"></canvas>
     			</div>
     		</div>
     	</div>
     </div>
</div>
</section>

@endsection


