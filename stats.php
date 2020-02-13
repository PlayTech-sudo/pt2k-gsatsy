
<?php 
  include 'process/operations/stats_data.php'; 
?>


<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-info card-header-icon">
        <div class="card-icon">
          <i class="material-icons">arrow_downward</i>
        </div>
        <p class="card-category">Inside</p>
        <h3 class="card-title"><?php echo $in[0]; ?></h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">warning</i>
          <span>Checked In Cylinders</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-success card-header-icon">
        <div class="card-icon">
          <i class="material-icons">call_missed_outgoing</i>
        </div>
        <p class="card-category">Outside</p>
        <h3 class="card-title"><?php echo $out[0]; ?></h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">warning</i>
          <span>Checked Out Cylinders</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-danger card-header-icon">
        <div class="card-icon">
          <i class="material-icons">format_color_fill</i>
        </div>
        <p class="card-category">Filled</p>
        <h3 class="card-title"><?php echo $filled[0]; ?></h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">warning</i>
          <span>Filled Cylinders</span>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-warning card-header-icon">
        <div class="card-icon">
          <i class="material-icons">hourglass_empty</i>
        </div>
        <p class="card-category">Empty</p>
        <h3 class="card-title"><?php echo $empty[0]; ?></h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">warning</i>
          <span>Empty Cylinders</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-danger card-header-icon">
        <div class="card-icon">
          <i class="material-icons">weekend</i>
        </div>
        <p class="card-category">Damage</p>
        <h3 class="card-title"><?php echo $damage[0]; ?></h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">warning</i>
          <span>Damaged Cylinders</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-success card-header-icon">
        <div class="card-icon">
          <i class="material-icons">autorenew</i>
        </div>
        <p class="card-category">Total</p>
        <h3 class="card-title"><?php echo $total[0]; ?></h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">warning</i>
          <span>Total Cylinders</span>
        </div>
      </div>
    </div>
  </div>
</div>