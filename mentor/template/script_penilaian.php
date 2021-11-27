  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable({
        scrollY: 400,
        scrollX: true,
        scrollCollapse: true,
        paging: true
      });
    });

    $(document).on("click", "#editpenilaian", function() {

      let nis = $(this).data('nis');
      let efata = $(this).data('efata');
      let jarak = $(this).data('jarak');
      let posisi = $(this).data('posisi');
      let tinggirendah = $(this).data('tinggirendah');
      let rapi = $(this).data('rapi');
      let bersih = $(this).data('bersih');
      let raib = $(this).data('raib');
      let foto = $(this).data('foto');
      let date = $(this).data('date');
      let catatan = $(this).data('cttn');
      $(" #modal-edit #nis").val(nis);
      $(" #modal-edit #efata").val(efata);
      $(" #modal-edit #jarak").val(jarak);
      $(" #modal-edit #posisi").val(posisi);
      $(" #modal-edit #tinggirendah").val(tinggirendah);
      $(" #modal-edit #rapi").val(rapi);
      $(" #modal-edit #bersih").val(bersih);
      $(" #modal-edit #date").val(date);
      $(" #modal-edit #raib").val(raib);
      $(" #modal-edit #catatan").val(catatan);
      $(" #modal-edit #foto").attr("src", "../img/penilaian/" + foto);

    });
  </script>