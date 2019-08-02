@extends('layouts.app')

@section('body-data')
  <div class="container">
  <div class="row">
    <p>
      The data count is {{$status}}
    </p>
  </div>

  <div class="row">
  <div class="col-md-6">
    @if ($status>0)
      <table class="table">
        <thead>
        <tr>
          <th>macAddress</th>
          <th>f1</th>
          <th>f2</th>
          <th>f3</th>
          <th>status</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($data as $dataSet)
          <tr>
          <td>{{$dataSet->device}}</td>
          <td>{{$dataSet->f1}}</td>
          <td>{{$dataSet->f2}}</td>
          <td>{{$dataSet->f3}}</td>
          <td>{{$dataSet->state}}</td>
          </tr>
      @endforeach
    </tbody>
      </table>
    @endif
  </p>
</div>
  <div class="col-md-6">
    {!! $LineChart->container() !!}
  </div>
</div>
</div>

<div class="container">
<div class="row">
<div class="col-md-6">
  {!! $LineChart1->container() !!}
</div>
<div class="col-md-6">
  <div id="chart_div" style="width: 400px; height: 120px;"></div>
  </div>
</div>
</div>
</div>




<script>
var ajax_call = function() {
    // var original_api_url = {{ $LineChart1->id }}getChartData;
    {{ $LineChart1->id }}_refresh('/getChartData');
};

var interval = 1000 * 10;

setInterval(ajax_call, interval);
</script>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <script type="text/javascript">
    google.charts.load('current', {'packages':['gauge']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Label', 'Value'],
        ['F1', 80],
        ['F2', 80],
        ['F3', 80],
        ['F4', 80]
      ]);

      var options = {
        width: 400, height: 120,
        redFrom: 90, redTo: 100,
        yellowFrom:75, yellowTo: 90,
        minorTicks: 5
      };
      var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
      chart.draw(data, options);

                    setInterval(function() {
                      data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
                      chart.draw(data, options);
                    }, 13000);
                    setInterval(function() {
                      data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
                      chart.draw(data, options);
                    }, 5000);
                    setInterval(function() {
                      data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
                      chart.draw(data, options);
                    }, 26000);
                    setInterval(function() {
                      data.setValue(3, 1, 60 + Math.round(20 * Math.random()));
                      chart.draw(data, options);
                    }, 600);


    }
  </script>

  {!! $LineChart->script() !!}
  {!! $LineChart1->script() !!}

@endsection
