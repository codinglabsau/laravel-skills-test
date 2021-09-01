

<?php $__env->startSection('content'); ?>

<h1> Form </h1>

<hr>

<form action="submit" method="POST">
<?php echo csrf_field(); ?>
    
<b>Name</b>
<input type="text" name="name"><br><br>

<b>Description</b>
<input type="text" name="description"><br><br>

<button type="submit"> Submit </button>

</form>

<hr>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-skills-test\resources\views/home.blade.php ENDPATH**/ ?>