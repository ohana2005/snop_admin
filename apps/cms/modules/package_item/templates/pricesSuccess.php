<div id="sf_admin_container">
    <div class="page-heading animated fadeInDownBig">

        <h1>Manage prices</h1>
    </div>



    <div id="sf_admin_header">
    </div>



    <div>
        <div class="box-info full">
            <h2><strong>Prices for packages</strong></h2>


            <div id="sf_admin_content">
                <div id="occupancyManager">
                    <div id="dates_filter">
                        <form method="post" action="<?php echo url_for('package_item/filterDates'); ?>">
                            <table cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>
                                        <input type="text" name="date_from" class="datepckr" value="<?php echo date('d.m.Y', strtotime($date_from)); ?>" >
                                    </td>
                                    <td>
                                        <input type="text" name="date_to" class="datepckr" value="<?php echo  date('d.m.Y', strtotime($date_to)); ?>" >
                                    </td>
                                    <td>
                                        <button>Change</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div id="occupancyDates">
                        <table cellpadding="0" cellspacing="0" class="occupancyTable">
                            <tr class="years">
                                <th rowspan="3">Item</th>
                                <?php foreach($period['years'] as $year): ?>
                                    <td colspan="<?php echo $year['span']; ?>"><?php echo $year['year']; ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <tr class="months">
                                <?php foreach($period['months'] as $month): ?>
                                    <td colspan="<?php echo $month['span']; ?>"><?php echo $month['month']; ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <tr class="days">
                                <?php foreach($period['days'] as $day): ?>
                                    <td><?php echo $day['day']; ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <?php foreach($PackageItems as $pi): ?>
                                <tr class="room" data-roomid="<?php echo $pi->id; ?>">
                                    <th class="room-cat-name"><?php echo $pi->name; ?></th>
                                    <?php foreach($period['days'] as $i => $day): ?>
                                        <?php $price = $pi->getDayPrice($day['fulldate']); ?>
                                        <td class="occupancy">
                                            <div class="occupancy-holder">
                                                <div class="occupancy-hover occupancy-hover-<?php echo $i; ?>" data-num="<?php echo $i; ?>" data-fulldate="<?php echo $day['fulldate']; ?>" data-dateformatted="<?php echo date('d.m.Y', strtotime($day['fulldate'])); ?>" data-itemid="<?php echo $pi->id; ?>"><?php echo $price ? $price : ''; ?></div>
                                            </div>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div id="priceControls">
                        <div id="displayDateFrom">Date from: <span></span></div>
                        <div id="displayDateTo">Date to: <span></span></div>
                        <div class="buttons">
                            <button id="addPriceButton">Set price</button>
                        </div>
                    </div>
                </div>
                <div class="sf_admin_actions">
                    <a class="btn btn-default" href="<?php echo url_for('price_item/index'); ?>">Back to list</a>
                </div>
            </div>
        </div>

    </div>


</div>
<script type="text/javascript" src="/js/occupancy.js"></script>
<script type="text/javascript" >
    var URL_changePrice = "<?php echo url_for('package_item/setPrice'); ?>";

</script>
