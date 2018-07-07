<?php if($package->getPackageItems()->count()): ?>
<ul>
    <?php foreach($package->getPackageItems() as $Item): ?>
        <li><?php echo $Item; ?></li>
        <?php endforeach; ?>
</ul>

<?php endif; ?>
