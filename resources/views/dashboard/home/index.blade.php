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
              <h3>{{ $totalsp }}</h3>

              <p>Number of Shipping Permit</p>
            </div>
            <div class="icon">
              <i class="fa fa-files-o"></i>
            </div>
            <a href="{{ route('dashboard.shipping_permits.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $totalor }}</h3>

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
            <h3>{{$totalspdone}}</h3>

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
              <h3>{{ $totaluser }}</h3>

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
      <div class="col-md-6">
          <div class="box box-default">
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
                  <canvas id="pieChart" height="170" width="257" style="width: 257px; height: 170px;"></canvas>
                </div>
              </div>
            </div>
          </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Shipped<span class="pull-right text-red">{{ $shipped }}</span></a></li>
                <li><a href="#">Pending <span class="pull-right text-green">{{ $pending }}</a>
                </li>
                <li><a href="#">Cancelled<span class="pull-right text-yellow">{{ $cancelled }}</span></a></li>
              </ul>
            </div>

        </div>
        </div>
      <div class="col-md-6">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Latest Members</h3>
            <div class="box-tools pull-right">
              <span class="label label-danger">{{ $users->count() }} Members</span>
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
              </button>
            </div>
          </div>

          <div class="box-body no-padding">
            <ul class="users-list clearfix">
              @foreach($users as $user)
                <li>
                  @if( $user->image = null)
                  <img src="{{ $user->image }}" alt="User Image">
                  @else
                  <img src="{!! __html::check_img(Auth::user()->image) !!}" alt="User Image">
                  @endif
                  <a class="users-list-name">{{ $user->firstname }} {{ $user->lastname }}</a>
                  <span class="users-list-date">{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</span>
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
        <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Pending Shipping Permits</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>

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
    <div class="row">
    <div class="col-lg-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Cancelled Shipping Permits</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>

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

</section>

@endsection
@section('scripts')
  <script type="text/javascript">

    // JavaScript to render the pie chart
    var data = {
      labels: ['Shipped', 'Pending', 'Cancelled'],
      datasets: [{
        data: [{{ $shipped }}, {{ $pending }}, {{ $cancelled }}],
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
@endsection



