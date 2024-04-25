@extends('layouts.admin-master')
@section('content')

<section class="content-header" style="padding-top: 70px">
  <h1>Dashboard</h1>
</section>

<section class="content">
	<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $sp->count() }}</h3>
              <p>Number of Shipping Permit</p>
            </div>
            <div class="icon">
              <i class="fa fa-archive"></i>
            </div>
            <a href="{{ route('dashboard.shipping_permits.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
{{--              <h3>{{ $totalor }}</h3>--}}
              <h3>N/A</h3>
              <p>Number Of Official Reciept</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-text"></i>
            </div>
            <a href="{{ route('dashboard.official_reciepts.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{ $sp->where('sp_status', 'SHIPPED')->count() }}</h3>

            <p>Total Product Shipped</p>
          </div>
          <div class="icon">
            <i class="fa fa-truck"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $users->count() }}</h3>

              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('dashboard.user.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="box" style="max-height: 500px;">
          <div class="box-header with-border">
            <h3 class="box-title">Amount Utilized</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <p class="text-center">

                  <strong>From {{ $sp->first()->sp_date }}- To {{ $lastSpDate }}  </strong>
                </p>
                <div class="chart">
                  <canvas id="salesChart" style="height: 180px; width: 859px;" height="180" width="859"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
          <div class="box box-default" style="max-height: 500px;">
          <div class="box-header with-border">
            <h3 class="box-title">Permits Statistics</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="chart-responsive">
                  <canvas id="pieChart" height="170" width="257" style="width: 257px; height: 175px;"></canvas>
                </div>
              </div>
            </div>
          </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Shipped<span class="pull-right text-red">{{ $sp->where('sp_status', 'SHIPPED')->count() }}</span></a></li>
                <li><a href="#">Pending <span class="pull-right text-green">{{ $sp->where('sp_status', 'PENDING')->count() }}</a>
                </li>
                <li><a href="#">Cancelled<span class="pull-right text-yellow">{{ $sp->where('sp_status', 'CANCELLED')->count() }}</span></a></li>
              </ul>
            </div>

        </div>
      </div>
      <div class="col-md-4">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Latest Members</h3>
            <div class="box-tools pull-right">
              <span class="label label-danger">{{ $users->count() }} Members</span>
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>

          <div class="box-body" style="max-height: 400px; overflow-y: auto;">
            <ul class="users-list clearfix" id="latest-members-list">
              @foreach($users as $user)
                <li>
                    @if( $user->image == null)
                      <img style="width: 100px; height: 100px; object-fit: cover;" src="{{ asset('images/avatar.jpeg') }}" alt="User Image">
                    @else
                      <img style="width: 100px; height: 100px; object-fit: cover;" src="{!! __html::check_img(Auth::user()->image) !!}" alt="User Image">
                    @endif
                    <div>
                      <a class="users-list-name">{{ $user->firstname }} {{ $user->lastname }}</a>
                      <span class="users-list-date">Created at: {{ \Carbon\Carbon::parse($user->created_at)->format('m-d-Y') }}</span>
                      <span class="users-list-date">Last Login Date: {{ \Carbon\Carbon::parse($user->last_login_time)->format('m-d-Y') }}</span>

                      <div style="display: inline;">
                        @if( $user->is_online == 1)
                          <span class="label label-success">Online</span>
                        @else
                          <span class="label label-danger">Offline</span>
                        @endif

                        @if( $user->is_active == 1)
                          <span class="label label-success">Active</span>
                        @else
                          <span class="label label-danger">Inactive</span>
                        @endif
                      </div>

                    </div>
                </li>
              @endforeach


            </ul>
          </div>
          <div class="box-footer text-center">
            <a href="{{ route('dashboard.user.index') }}" class="uppercase">View All Users</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h4 class="box-title">Shipping Permits Status</h4>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="box-group" id="accordion">
            <div class="panel box box-primary">
              <div class="box-header with-border">
                <h4 class="box-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
                    Pending Shipping Permit
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" style="">
                <div class="box-body">
                  <div class="row">
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                          <tr>
                            <th>Shipping permit No.</th>
                            <th>OR NO</th>
                            <th>EDD/ETD</th>
                            <th>EDA/ATA</th>
                            <th>Status</th>
                          </tr>
                          </thead>
                          <tbody>

                          @foreach($pendingsp as $sp)
                            <tr>
                              <td>{{$sp->sp_no}}</td>
                              <td>{{$sp->sp_or_no}}</td>
                              <td>{{$sp->sp_edd_etd}}</td>
                              <td>{{$sp->sp_eda_eta}}</td>
                              <td><span class="label label-warning">Pending</span></td>
                            </tr>
                          @endforeach

                          </tbody>
                        </table>
                      </div>

                    </div>

                    <div class="box-footer clearfix">
                      <a href="{{route('dashboard.shipping_permits.index')}}" class="btn btn-sm btn-info btn-flat pull-right" >View All Permits</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="panel box box-primary">
              <div class="box-header with-border">
                <h4 class="box-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse2023" class="collapsed" aria-expanded="false">
                    Cancelled Shipping Permit
                  </a>
                </h4>
              </div>
              <div id="collapse2023" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                <div class="box-body">
                  <div class="row">
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                          <tr>
                            <th>Shipping permit No.</th>
                            <th>OR NO</th>
                            <th>EDD/ETD</th>
                            <th>EDA/ATA</th>
                            <th>Status</th>
                          </tr>
                          </thead>
                          <tbody>

                          @foreach($totalspcancelled as $sp)
                            <tr>
                              <td>{{$sp->sp_no}}</td>
                              <td>{{$sp->sp_or_no}}</td>
                              <td>{{$sp->sp_edd_etd}}</td>
                              <td>{{$sp->sp_eda_eta}}</td>
                              <td><span class="label label-danger">cancelled</span></td>
                            </tr>
                          @endforeach

                          </tbody>
                        </table>
                      </div>

                    </div>

                    <div class="box-footer clearfix">
                      <a href="{{route('dashboard.shipping_permits.index')}}" class="btn btn-sm btn-info btn-flat pull-right" >View All Permits</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>


  </div>
</section>

@endsection
@section('scripts')
  <script type="text/javascript">

    // JavaScript to render the pie chart
    var data = {
      labels: ['Shipped', 'Pending', 'Cancelled'],
      datasets: [{
        data: [{{ $sp->where('sp_status', 'SHIPPED')->count() }}, {{ $sp->where('sp_status', 'PENDING')->count() }}, {{ $sp->where('sp_status', 'CANCELLED')->count() }}],
        backgroundColor: ['#4CAF50', '#FFC107', '#F44336'],
      }]
    };

    var ctx = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(ctx, {
      type: 'pie',
      data: data,
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });

  </script>

  <script>
    // Assuming $sp is an array of objects containing sp_date and sp_amount properties

    // Extracting labels and data from $sp
    var labels = [];
    var data = [];

    // Loop through each object in $sp and extract sp_date as labels and sp_amount as data
    @foreach($spAmount as $items)
    data.push('{{ $items }}');
    @endforeach
    @foreach($spDates as $item)
    labels.push('{{ $item }}');
    @endforeach


    // Data object for the chart
    var salesData = {
      labels: labels,
      datasets: [{
        label: 'Sales',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: data
      }]
    };

    // Get the canvas element
    var ctx = document.getElementById('salesChart').getContext('2d');

    // Create the chart
    var salesChart = new Chart(ctx, {
      type: 'line',
      data: salesData,
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          xAxes: [{
            gridLines: {
              display: false
            }
          }],
          yAxes: [{
            gridLines: {
              display: true,
              color: '#f0f3f3'
            }
          }]
        }
      }
    });
  </script>
@endsection



