<?php // example: simple angled module ?>
<div class="module <?php echo $style; ?> <?php echo $color; ?> <?php echo $yootools; ?> <?php echo $first; ?> <?php echo $last; ?>">

	<?php echo $badge; ?>

	<?php if ($showtitle) : ?>
	<h3 class="header"><span class="header-2"><span class="header-3"><span class="header-4"><?php echo $title; ?></span></span></span></h3>
	<?php endif; ?>
		
	<div class="box-1 deepest <?php if ($showtitle) echo 'with-header'; ?>">
		<?php echo $content; ?>
	</div>
		
</div>