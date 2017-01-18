@extends('layouts.app')
@section('content')

<script src="https://raw.githubusercontent.com/nnnick/Chart.js/master/dist/Chart.bundle.js"></script>

<script>
    var year = ['2013','2014','2015', '2016'];
    var data_viewer = <?php echo $data; ?>;
    var barChartData = {

        labels: year,
        datasets: [{
            label: 'Anime',
            backgroundColor: "rgba(151,187,205,0.5)",
            data: data_viewer
        }]
    };
    
    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: 'rgb(0, 255, 0)',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,

                title: {
                    display: true,
                    text: 'Popular Anime'
                }
            }
        });
    };

</script>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <canvas id="canvas" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
