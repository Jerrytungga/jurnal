   <!-- Bootstrap core JavaScript-->
   <script src="../vendor/jquery/jquery.min.js"></script>
   <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- Core plugin JavaScript-->
   <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
   <!-- Custom scripts for all pages-->
   <script src="../js/sb-admin-2.min.js"></script>
   <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
   <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
   <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
   <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
   <script>
      $(document).ready(function() {
         $('#dataTable').DataTable({
            scrollY: 800,
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            lengthMenu: [
               [7, 10, 25, 50, -1],
               [7, 10, 25, 50, "All"]
            ],

         });
      });


      $(document).ready(function() {
         $('#example').DataTable({
            scrollY: 800,
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            lengthMenu: [
               [-1],
               ["All"]
            ],
            initComplete: function() {
               this.api().columns().every(function() {
                  var column = this;
                  var select = $('<select><option value=""></option></select>')
                     .appendTo($(column.footer()).empty())
                     .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                           $(this).val()
                        );

                        column
                           .search(val ? '^' + val + '$' : '', true, false)
                           .draw();
                     });

                  column.data().unique().sort().each(function(d, j) {
                     select.append('<option value="' + d + '">' + d + '</option>')
                  });
               });
            }
         });
      });
   </script>