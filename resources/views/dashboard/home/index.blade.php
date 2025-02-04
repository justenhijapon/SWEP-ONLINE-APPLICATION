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
    </div>




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
      type: 'doughnut',
      data: data,
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });

    $(document).ready(function() {
      // Initialize DataTables with no features
      var dataTableOptions = {
        paging: true,
        searching: true,
        ordering: true,
        info: true
        // Add any other options you want to customize here
      };

      // Initialize DataTable for the first table
      $('#dataTable').DataTable(dataTableOptions);

      // Initialize DataTable for the second table
      $('#dataTableC').DataTable(dataTableOptions);
    });

  </script>

  <script>
    {{--var spAmountP = @json($spAmountP);--}}
    {{--var spAmountC = @json($spAmountC);--}}
    var spAmount = @json($spAmount);
    var labels = @json($spDates);

    var salesData = {
      labels: labels,
      datasets: [
        // {
        //   label: 'Pending',
        //   backgroundColor: 'rgba(255, 193, 7, 0.9)',
        //   borderColor: 'rgba(255, 193, 7, 0.8)',
        //   pointRadius: false,
        //   pointColor: '#3b8bba',
        //   pointStrokeColor: 'rgba(60,141,188,1)',
        //   pointHighlightFill: '#fff',
        //   pointHighlightStroke: 'rgba(60,141,188,1)',
        //   data: spAmountP
        // },
        // {
        //   label: 'Cancelled',
        //   backgroundColor: 'rgba(210, 70, 90, 0.9)',
        //   borderColor: 'rgba(210, 70, 90, 0.8)',
        //   pointRadius: false,
        //   pointColor: '#d2465a',
        //   pointStrokeColor: 'rgba(210, 70, 90, 1)',
        //   pointHighlightFill: '#fff',
        //   pointHighlightStroke: 'rgba(210, 70, 90, 1)',
        //   data: spAmountC
        // },
        {
          label: 'Gross Income',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: true,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: spAmount
        }
      ]
    };

    var ctx = document.getElementById('salesChart').getContext('2d');

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

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var events = [];
      // Iterate through the arrays and create events
      @foreach($sp as $sp)
      events.push({
        title: 'No:{{ $sp->sp_no }} EDA/ETA {{ $sp->sp_eda_eta }}',
        start: '{{ $sp->sp_eda_eta }}',
        end: '{{ $sp->sp_eda_eta }}',
        color: 'red'
      });
      @endforeach

      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: events
      });

      calendar.render();
    });
  </script>




@endsection



