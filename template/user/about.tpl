<div class="col l12 m12 s12">
    <div class="card user-about-section">
        <?php if(!is_null($item['birthday'])): ?>
            <h6>Birthday : </h6><p><?php echo $item['birthday'] ?></p><br>
        <?php endif; ?>
        <?php if(!is_null($item['about']) && strlen($item['about']) > 0): ?>
            <h6>About : </h6><p><?php echo $item['about'] ?></p><br>
        <?php endif; ?>
        <?php if(!is_null($item['city']) && !is_null($item['country']) && strlen($item['city']) > 0 && strlen($item['country']) > 0): ?>
            <h6>Hometown : </h6><p><?php echo $item['city'] ?></p><br>
        <?php endif; ?>
    </div>
</div>