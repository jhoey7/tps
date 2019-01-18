<div class="col-md-9">
  <div class="panel">
    <div class="panel-body nav-tabs-animate">
      <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
        <li class="active" role="presentation"><a data-toggle="tab" href="#activities" aria-controls="activities" role="tab">DASHBOARD</a></li>
        <li role="presentation"><a data-toggle="tab" href="#profile" aria-controls="profile" role="tab">ACTIVITIES</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active animation-slide-left" id="activities" role="tabpanel">
        	<div class="page-content padding-30 container-fluid">
              <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="col-xlg-12 col-md-12"> 
                  <!-- Widget Current Chart -->
                  <div class="widget widget-shadow" id="widgetContChart">
                    <div class="padding-30 white bg-blue-500">
                      <div class="font-size-20 margin-bottom-20">COARRI CODECO KEMASAN IN A WEEK</div>
                      <div class="ct-chart height-200"> </div>
                    </div>
                  </div>
                  <!-- End Widget Current Chart --> 
                </div>
              </div>
            </div>
        </div>
        <div class="tab-pane animation-slide-left" id="profile" role="tabpanel">
          <ul class="list-group">
          	<?php foreach($arr_hist as $hist): ?>
            <li class="list-group-item">
              <div class="media media-lg">
                <div class="media-left">
                  <a class="avatar" href="javascript:void(0)">
                  	<img class="img-responsive" src="<?php echo ($this->session->userdata('PATH')!="")?base_url().$this->session->userdata('PATH'):base_url().'assets/images/user.png'; ?>" alt="...">
                  </a>
                </div>
                <div class="media-body">
                  <h4 class="media-heading"><?php echo $hist['NM_LENGKAP']; ?></h4>
                  <small><?php echo $hist['WK_REKAM']; ?></small>
                  <div class="profile-brief">
                    <div class="media">
                      <div class="media-body">
                        <h4 class="media-heading">DESKRIPSI</h4>
                        <p><?php echo $hist['DESKRIPSI']; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="widget widget-shadow text-center page-profile">
    <div class="widget-header">
      <div class="widget-header-content">
        <a class="avatar avatar-100" href="javascript:void(0)">
          <img src="<?php echo ($this->session->userdata('PATH')!="")?base_url().$this->session->userdata('PATH'):base_url().'assets/images/user.png'; ?>" alt="...">
        </a>
        <h4 class="profile-user"><?php echo $this->session->userdata('NM_LENGKAP'); ?></h4>
        <p class="profile-job"><?php echo strtoupper($this->session->userdata('USERLOGIN')); ?></p>
        <p><?php echo strtoupper($this->session->userdata('KETERANGAN')); ?></p>
        <!--<button type="button" class="btn btn-primary">DETAIL</button>-->
      </div>
    </div>
    <div class="widget-footer">
      <div class="row no-space">
        <div class="col-xs-6">
          <strong class="profile-stat-count"><?php echo $this->session->userdata('KD_TPS'); ?></strong>
          <span>KODE TPS</span>
        </div>
        <div class="col-xs-6">
          <strong class="profile-stat-count"><?php echo $this->session->userdata('KD_GUDANG'); ?></strong>
          <span>KODE GUDANG</span>
        </div>
      </div>
      <div class="row no-space">
        <div class="col-xs-12">
          <strong class="profile-stat-count"><?php echo validate($this->session->userdata('LAST_LOGIN'),'DATETIME'); ?></strong>
          <span>LAST LOGIN</span>
        </div>
      </div>
    </div>
  </div>
</div>   
<script>
$(document).ready(function() {
	Site.run();
	new Chartist.Bar("#widgetContChart .ct-chart", {
		labels: ["GATE IN IMP", "GATE OUT IMP", "GATE IN EXP", "GATE OUT EXP"],
		series: [
			[<?php echo $disc_pack; ?>, <?php echo $load_pack; ?>, <?php echo $in_pack; ?>, <?php echo $out_pack; ?>],
			[<?php echo $disc_pack+10; ?>, <?php echo $load_pack+10; ?>, <?php echo $in_pack+10; ?>, <?php echo $out_pack+10; ?>]
		]
	}, {
		stackBars: 1,
		fullWidth: 1,
		seriesBarDistance:0,
		axisX:{
			showLabel: !0,
			showGrid: !1,
			offset: 30
		},
		axisY: {
			showLabel: !0,
			showGrid: !1,
			offset: 30,
			labelOffset: {
				x: 0,
				y: 15
			}
		}
	});
});
</script>