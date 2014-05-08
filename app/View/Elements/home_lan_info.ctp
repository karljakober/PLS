<div class="col-lg-6" style="margin-top: 30px;">
  <div class="col-lg-offset-3 panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><?php if ($this->Time->isPast($activeLan['Lan']['end_time'])) { echo 'Previous'; } else if ($this->Time->isPast($activeLan['Lan']['start_time']) && $this->Time->isFuture($activeLan['Lan']['end_time'])) { echo 'Current'; } else if ($this->Time->isFuture($activeLan['Lan']['start_time'])) { echo 'Upcoming'; } ?> Lan</h3>
    </div>
    <div class="panel-body">
      <h3><?php echo $activeLan['Lan']['name']; ?></h3>
      <!-- TODO -->
      <p>October 4th (Friday) from 4pm to the 6th (Sunday) at 4PM (48 hours)</p> 
      <p>19 days, 11 hours, 43 mins, 11 secs</p>
      <p>Early setup Friday at 12pm!</p>
      <!-- Registration opens September 10th. -->
      <button type="button" onclick="location.href='/SeatingChart'" class="btn btn-primary">Reserve your seat!</a>
    </div>
  </div>
</div>