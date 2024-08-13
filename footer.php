</div><!-- /.main-content -->
<?php
if (is_single()) {
    get_template_part('templates/entry-content-related');
}
?>
<?php get_template_part('templates/footer-widgets'); ?>

<?php get_template_part('templates/bottom'); ?>

</div><!-- /#page -->
</div><!-- /#wrapper -->

<?php wp_footer(); ?>

</body>

</html>