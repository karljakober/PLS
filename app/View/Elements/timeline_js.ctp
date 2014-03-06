<?php if (isset($upcominglan) && count($upcominglan)) { ?>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" src="/js/timeline.js"></script>
<link rel="stylesheet" type="text/css" href="/css/timeline.css">
<script type="text/javascript">
    google.load("visualization", "1");

    var data = undefined;
    var timeline = undefined;

    // Set callback to run when API is loaded
    google.setOnLoadCallback(drawVisualization);

    // Called when the Visualization API is loaded.
    function drawVisualization() {
        // Create and populate a data table.
        data = new google.visualization.DataTable();
        data.addColumn('datetime', 'start');
        data.addColumn('datetime', 'end');
        data.addColumn('string', 'content');
        data.addRows([
          [new Date(<?php echo date_timestamp_get(date_create($upcominglan['Lan']['start_time'])); ?> * 1000), , "<?php echo $upcominglan['Lan']['name']; ?>"],
        ]);

        // specify options
        var options = {
            'showCustomTime': false
        };

        // Instantiate our timeline object.
        timeline = new links.Timeline(document.getElementById('timeline'));

        // Draw our timeline with the created data and options
        timeline.draw(data, options);
        var start = new Date((new Date()).getTime() - 2 * 60 * 1000 * 60 * 24);
        var end   = new Date(<?php echo date_timestamp_get(date_create($upcominglan['Lan']['end_time'])); ?> * 1000 + 3 * 60 * 1000 * 60 * 24);
        timeline.setVisibleChartRange(start, end);
    }
</script>
<?php } ?>