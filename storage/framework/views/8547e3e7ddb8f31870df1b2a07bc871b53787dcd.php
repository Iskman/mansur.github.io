<!DOCTYPE html>
			<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			<h3 class="text-muted">ПОПУЛЯРНОЕ (статьи с наиболшим количеством просмотров)</h3>
			<ul class="list-unstyled">
				<?php $__currentLoopData = $popular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li><font class="text-muted">[<?php echo e($loop->index+1); ?>]</font>&nbsp;<a href="ajax/<?php echo e($prs->id); ?>" class='ajax'><?php echo e($prs->title); ?></a></li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
			<h3 class='text-muted'>ВСЕ НОВОСТИ</h3>
			<ul class="list-unstyled">
				<?php $__currentLoopData = $parsing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li><a href="post/<?php echo e($prs->id); ?>"><?php echo e($prs->title); ?></a><p><?php echo e($prs->dsc); ?></p></li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
			<?php echo e($parsing->links()); ?>

		</div>
    </body>
</html>
<?php /**PATH C:\OpenServer\OSPanel\domains\pgu-parser.kz\resources\views/welcome.blade.php ENDPATH**/ ?>