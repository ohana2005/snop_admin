<div class="delete-occupancy">
    <div><?php echo __('Are you sure want to delete?') ?></div>
    <form method="post" action="<?php echo url_for('room_category/deleteOccupancy'); ?>">
        <input type="hidden" name="entityId" value="<?php echo $entityId; ?>" >
        <button class="btn btn-danger"><?php echo __('Delete') ?></button>
    </form>
</div>