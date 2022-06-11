</div>
<!-- /#page-content-wrapper -->
</div>

<?php flasher::flash(); ?>
<script src="<?= BASEURL ?>js/jquery_3.6.0/jquery.js"></script>

<script src="<?= BASEURL ?>js/adminlte/bootstrap.bundle.min.js"></script>

<script src="<?= BASEURL ?>js/datatables/jquery.dataTables.min.js"></script>
<?php if (isset($data['table'])) { ?>
    <script src="<?= BASEURL ?>js/datatables-bs4/dataTables.bootstrap4.min.js"></script>
    <script src="<?= BASEURL ?>js/datatables-responsive/dataTables.responsive.min.js"></script>
<?php } ?>
<?php if (isset($data['button'])) { ?>
    <script src="<?= BASEURL ?>js/datatables-buttons/dataTables.buttons.min.js"></script>
    <script src="<?= BASEURL ?>js/datatables-buttons/buttons.bootstrap4.min.js"></script>
<?php } ?>
<script src="<?= BASEURL ?>js/adminlte/adminlte.js"></script>

<script src="<?= BASEURL ?>js/script.js"></script>
<script src="<?= BASEURL ?>js/onload.js"></script>
</body>

</html>