<?php
    $OnlineUsers = Panel::listOnlineUsers();

    $takeTotalVisits = MySql::connect()->prepare("SELECT * FROM `tb_admin.visits`");
    $takeTotalVisits->execute();

    $takeTotalVisits = $takeTotalVisits->rowCount();

    $takeVisitsToday = MySql::connect()->prepare("SELECT * FROM `tb_admin.visits` WHERE day = ?");
    $takeVisitsToday->execute(array(date('Y-m-d')));

    $takeVisitsToday = $takeVisitsToday->rowCount();

?>
<div class="box-content w100">
    <h2><i class="fa fa-home"></i> Control Panel - <?php echo NAME_COMPANY ?></h2>

    <div class="box-metrics">
        <div class="box-metric-single">
            <div class="box-metric-wraper">
                <h2>Online Users</h2>
                <p><?php echo count($OnlineUsers); ?></p>
            </div><!--box-metric-wraper-->
        </div><!--div-metric-single-->
        <div class="box-metric-single">
            <div class="box-metric-wraper">
                <h2>Total visits</h2>
                <p><?php echo $takeTotalVisits ?></p>
            </div><!--box-metric-wraper-->
        </div><!--div-metric-single-->
        <div class="box-metric-single">
            <div class="box-metric-wraper">
                <h2>Visits today</h2>
                <p><?php echo $takeVisitsToday ?></p>
            </div><!--box-metric-wraper-->
        </div><!--div-metric-single-->
        <div class="clear"></div>
    </div><!--box-metrics-->

</div><!--box-content-->

<div class="box-content w100 left">
    <h2><i class="fa fa-rocket" aria-hidden="true"></i> Online Users on Site</h2>
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <span>IP</span>
            </div><!--col-->
            <div class="col">
                <span>Last Action</span>
            </div><!--col-->
            <div class="clear"></div>
        </div><!--row-->

        <?php
            foreach($OnlineUsers as $key => $value) {
        ?>

        <div class="row">
            <div class="col">
                <span><?php echo $value['ip'] ?></span>
            </div><!--col-->
            <div class="col">
                <span><?php echo date('d/m/Y H:i:s',strtotime($value['last_action'])) ?></span>
            </div><!--col-->
            <div class="clear"></div>
        </div><!--row-->
        <?php } ?>
    </div><!--table-responsive-->
</div><!--box-content-->

<div class="box-content w100 right">
    <h2><i class="fa fa-rocket" aria-hidden="true"></i> Panel Users</h2>
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <span>Name</span>
            </div><!--col-->
            <div class="col">
                <span>Office</span>
            </div><!--col-->
            <div class="clear"></div>
        </div><!--row-->

        <?php
            $panelUsers = MySql::connect()->prepare("SELECT * FROM `tb_admin.users`");
            $panelUsers->execute();
            $panelUsers = $panelUsers->fetchAll();
            foreach($panelUsers as $key => $value) {
        ?>

        <div class="row">
            <div class="col">
                <span><?php echo $value['user'] ?></span>
            </div><!--col-->
            <div class="col">
                <span><?php echo takeOffice($value['office']); ?></span>
            </div><!--col-->
            <div class="clear"></div>
        </div><!--row-->
        <?php } ?>
    </div><!--table-responsive-->
</div><!--box-content-->

<div class="clear"></div><!--clear-->
