    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <script>
      $(document).ready(function() {
        $('#dataTable').DataTable({
          scrollY: 700,
          scrollX: true,
          scrollCollapse: true,
          paging: true
        });


      });

      $(document).on("click", "#editpenilaian", function() {
        let foto = $(this).data('foto');
        $(" #modal-edit #foto").attr("src", "../img/penilaian/" + foto);

      });
    </script>

    <script>
      $(document).ready(function() {
        var living = document.getElementById('living');
        var waktu = new Date();
        var hari = waktu.getDay();
        var bulan = waktu.getMonth();
        // alert(hari)

        if (hari == 0) {
          living.style.display = 'blok';
        } else {
          living.style.display = 'none';
        }
      });
    </script>
    <!-- <script>
      $(document).ready(function() {
        var living = document.getElementById('jurnal');
        var waktu = new Date();
        var menit = waktu.getMinutes();
        var jam = waktu.getHours();


        if (jam == 20) {
          jurnal.style.display = 'none';
        } else if (jam == 21) {
          jurnal.style.display = 'none';
        } else if (jam == 22) {
          jurnal.style.display = 'none';
        } else if (jam == 23) {
          jurnal.style.display = 'none';
        } else if (jam == 01) {
          jurnal.style.display = 'none';
        } else if (jam == 02) {
          jurnal.style.display = 'none';
        } else if (jam == 03) {
          jurnal.style.display = 'none';
        } else if (jam == 04) {
          jurnal.style.display = 'none';
        } else if (jam == 05) {
          jurnal.style.display = 'none';
        } else if (jam == 06) {
          jurnal.style.display = 'none';
        } else {
          jurnal.style.display = 'blok';
        }
      });
    </script> -->