<div id="sf_admin_container">
    <div class="page-heading animated fadeInDownBig">

        <h1>Manage occupancy</h1>
    </div>



    <div id="sf_admin_header">
    </div>



    <div>
        <div class="box-info full">
            <h2><strong><?php echo $RoomCategory; ?></strong></h2>


            <div id="sf_admin_content">
                <div id="occupancyManager">
                    <div id="dates_filter">
                        <form method="post" action="<?php echo url_for('room_category/filterDates'); ?>">
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
                                <th rowspan="3">Room</th>
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
                            <?php foreach($RoomCategory->getRooms() as $Room): ?>
                            <tr  class="room" data-roomid="<?php echo $Room->id; ?>">
                                <th><?php echo $Room->number; ?></th>
                                <?php foreach($period['days'] as $i => $day): ?>
                                    <?php $occupancy = $Room->getOccupancy($day['fulldate']); ?>
                                    <?php if(!$occupancy): ?>
                                        <td class="occupancy occupancy-free">
                                            <div class="occupancy-holder">
                                                <div class="occupancy-hover occupancy-hover-<?php echo $i; ?>" data-num="<?php echo $i; ?>" data-fulldate="<?php echo $day['fulldate']; ?>" data-dateformatted="<?php echo date('d.m.Y', strtotime($day['fulldate'])); ?>" data-itemid="<?php echo $Room->id; ?>"></div>
                                            </div>
                                        </td>
                                    <?php else: ?>
                                        <td class="occupancy occupancy-occupied">
                                            <div class="occupancy-holder">
                                            <?php foreach($occupancy as $ro): ?>
                                                <div class="occupancy-item <?php echo $ro['cssClass']; ?>" title="<?php echo $ro['info']; ?>" data-entityid="<?php echo $ro['room_occupancy_entity_id']; ?>"></div>
                                            <?php endforeach; ?>
                                                <div class="occupancy-hover occupancy-hover-<?php echo $i; ?>" data-num="<?php echo $i; ?>" data-fulldate="<?php echo $day['fulldate']; ?>" data-dateformatted="<?php echo date('d.m.Y', strtotime($day['fulldate'])); ?>" data-itemid="<?php echo $Room->id; ?>"></div>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div id="priceControls">
                        <div id="displayDateFrom">Date from: <span></span></div>
                        <div id="displayDateTo">Date to: <span></span></div>
                        <div class="buttons">
                            <button class="addOccupancyButton" data-typeid="<?php echo RoomOccupancyEntity::OCC_RESERVATION; ?>">Add reservation</button>
                            <button id="closeRoomButton">Close room</button>
                            <button class="addOccupancyButton" data-typeid="<?php echo RoomOccupancyEntity::OCC_OFFER; ?>">Add offer</button>
                            <button class="addOccupancyButton" data-typeid="<?php echo RoomOccupancyEntity::OCC_LASTMINUTE; ?>">Add lastminute</button>
                        </div>
                    </div>
                </div>
                <div class="sf_admin_actions">
                    <a class="btn btn-default" href="<?php echo url_for('room_category/index'); ?>">Back to list</a>
                </div>
            </div>
        </div>

    </div>


</div>
<script type="text/javascript" src="/js/occupancy.js"></script>
<script type="text/javascript" >
    var URL_changePrice = "<?php echo url_for('room_category/setPrice'); ?>";
    var URL_closeRoom = "<?php echo url_for('room_category/closeRoom'); ?>";
    var URL_addOccupancy = "<?php echo url_for('room_category/addOccupancy'); ?>";
    var URL_deleteOccupancy = "<?php echo url_for('room_category/deleteOccupancy'); ?>";
</script>
