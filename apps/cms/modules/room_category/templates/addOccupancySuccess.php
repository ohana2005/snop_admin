<div class="set-price">
    <form method="post" action="<?php echo url_for('room_category/addOccupancy'); ?>">
        <?php foreach($dates as $date): ?>
            <input type="hidden" name="dates[]" value="<?php echo $date; ?>" >
        <?php endforeach; ?>
        <?php if($typeid == RoomOccupancyEntity::OCC_RESERVATION): ?>
        <input type="text" name="occ[first_name]" value="" placeholder="<?php echo __('First Name') ?>" > <br >
        <input type="text" name="occ[last_name]" value="" placeholder="<?php echo __('Last Name') ?>" > <br >
        <?php elseif($typeid == RoomOccupancyEntity::OCC_LASTMINUTE): ?>
            <input type="text" name="occ[price]" value="" placeholder="<?php echo __('Price') ?>" > <br >
        <?php elseif($typeid == RoomOccupancyEntity::OCC_OFFER): ?>
            <input type="text" name="occ[first_name]" value="" placeholder="<?php echo __('First Name') ?>" > <br >
            <input type="text" name="occ[last_name]" value="" placeholder="<?php echo __('Last Name') ?>" > <br >
            <input type="text" name="occ[email]" value="" placeholder="<?php echo __('Email') ?>" > <br >
            <input type="text" name="occ[price]" value="" placeholder="<?php echo __('Price') ?>" > <br >
            <textarea name="offertext" placeholder="<?php echo __('Text of the Offer') ?>"></textarea><br >
        <?php endif; ?>
        <input type="hidden" name="save" value="1" >
        <input type="hidden" name="typeid" value="<?php echo $typeid; ?>" >
        <input type="hidden" name="roomid" value="<?php echo $Room->id; ?>" >
        <button class="btn btn-default"><?php echo __('Create') ?></button>
    </form>
</div>