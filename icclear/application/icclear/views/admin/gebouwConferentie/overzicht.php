<script type="text/javascript">
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>
    
    <?php foreach ($conferentiedagen as $dag) { ?>
<p><?php $dag->datum ?></p>
<?php } ?> 