<!DOCTYPE html>
			<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			<?php $__currentLoopData = $parsing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<h3><?php echo e($prs->title); ?></h3><p><?php echo $prs->body; ?></p>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<h4 class='text-muted'>Просмотров: <?php echo e($vc); ?></h4>
		</div>
    </body>
</html>
<?php /**PATH C:\OpenServer\OSPanel\domains\pgu-parser.kz\resources\views/post.blade.php ENDPATH**/ ?>