<div class="delete-occupancy">
    <div>Are you sure want to delete?</div>
    <form method="post" action="<?php echo url_for('room_category/deleteOccupancy'); ?>">
        <input type="hidden" name="entityId" value="<?php echo $entityId; ?>" >
        <button class="btn btn-danger">Delete</button>
    </form>
</div>