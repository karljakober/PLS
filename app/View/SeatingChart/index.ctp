<script>
$(function () {
    $('[data-toggle="popover"]').popover();
    $('[data-toggle="popover"]').click(function () {
         $('[data-toggle="popover"]').not(this).popover('hide');
    });
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
<style>
    #grid-source { position: absolute; }
    #grid-overlay { position: relative; }
    
    .hover { background-color: rgba(0,0,0,0.1) !important; }
    .selected { background-color: none; }
    
    .eraser { background-color: rgba(0,0,0,0.5); }
    .seat { background-color: #D9EDF7; border: 1px solid black; }
    .execseat { background-color: orange; border: 1px solid black; }
    .seattaken { background-color: purple; border: 1px solid black; }

    .wall { background-color: black; }
    .trash { background-color: red; }
    .floor { background-color: #FCF8E3; }

</style>
<div class="container">
    <div class="col-lg-8 col-lg-offset-2" style="margin-top:20px;">
        <table>
            <tbody>
                <tr>
                <?php 
                $row = 0;
                foreach($seatingChartTiles as $tile) {
                    if ($row != $tile['SeatingChartTile']['x']) { ?>
                        </tr><tr>
                    <?php }
                    $seat = false;
                    $row = $tile['SeatingChartTile']['x'];
                    //tile is a seat
                    if (isset($tile['SeatingChartTile']['seat_number']) && $tile['SeatingChartTile']['seat_number'] != "") {
                        if (isset($tile['UserSeating'])) {
                            //There is someone sitting down ?>
                            <td class="<?php if ($tile['SeatingChartTile']['tile_id'] == 'execseat') { echo 'execseattaken'; } else { echo 'seattaken'; } ?>" style="width: 16px; height: 16px; font-size: 50%; text-align: center;" data-container="body" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?php echo $tile['User']['username']; ?> is sitting here!"><?php echo $tile['SeatingChartTile']['seat_number']; ?>
                        <?php
                        } else {
                        //no one sitting down ?>
                            <td class="<?php echo $tile['SeatingChartTile']['tile_id']; ?>" style="width: 16px; height: 16px; font-size: 50%; text-align: center;" data-container="body" data-toggle="popover" data-placement="left" data-content="No one is currently sitting here. Would you like to Sit down?"><?php echo $tile['SeatingChartTile']['seat_number']; ?>
                        <?php
                        }
                    } else { ?>
                        <td class="<?php echo $tile['SeatingChartTile']['tile_id']; ?>" style="width: 16px; height: 16px; font-size: 50%; text-align: center;"></td>
                    <?php
                    } 
                } ?>
            </tbody>
        </table>
    </div>
</div>