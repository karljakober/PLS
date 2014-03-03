<style>
    #grid-source { position: absolute; }
    #grid-overlay { position: relative; }
    
    .hover { background-color: rgba(0,0,0,0.1) !important; }
    .selected { background-color: none; }
    
    .eraser { background-color: rgba(0,0,0,0.5); }
    .seat { background-color: #D9EDF7; border: 1px solid black; }
    .execseat { background-color: orange; border: 1px solid black; }

    .wall { background-color: black; }
    .trash { background-color: red; }
    .floor { background-color: #FCF8E3; }

</style>
<div class="container">
  <div class="row">
    <div class="page-header">
      <h1 id="Users">Create new Seating Chart (be sure to save!)</h1>
    </div>
    <div class="page-content">
      <div class="col-lg-12">
        <?php echo $this->Session->flash(); ?>
        <div class="col-lg-4">
          <div class="list-group">
            <a href="#" class="list-group-item active">
              Tileset
            </a>
            <a href="#" id="seat" class="list-group-item">Seat</a>
            <a href="#" id="execseat" class="list-group-item">Exec Seat</a>
            <a href="#" id="wall" class="list-group-item">Wall</a>
            <a href="#" id="floor"  class="list-group-item">Floor</a>
            <a href="#" id="trash" class="list-group-item">Trash Bin</a>
            <a href="#" id="eraser" class="list-group-item">Eraser</a>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Details</h3>
            </div>
            <div class="panel-body">
              <form class="bs-example form-horizontal">
                <fieldset>
                  <div class="form-group">
                    <label for="inputChartName" class="col-lg-4 control-label">Chart Name</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control" id="inputChartName" placeholder="General Seating Chart">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-12">
                      <div class="input-group">
                        <span class="input-group-addon">Width</span>
                        <input type="text" class="form-control" value="32" id="inputWidth">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="button" id="setWidth">Set Width</button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-12">
                      <div class="input-group">
                        <span class="input-group-addon">Height</span>
                        <input type="text" class="form-control" value="32" id="inputHeight">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="button" id="setHeight">Set Height</button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-2">
                      <button type="button" class="btn btn-primary" id="saveChart">Save Seating Chart</button> 
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div id="grid-source"></div>
        </div>
      </div>
    </div>
  </div>
</div>
