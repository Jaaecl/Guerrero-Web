<link href="../assets/plugins/datatables/DataTables/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
<link href="../assets/plugins/datatables/Buttons/css/buttons.bootstrap4.min.css" rel="stylesheet"/>
<script src="../assets/plugins/datatables/JSZip/jszip.min.js"></script>
<script src="../assets/plugins/datatables/pdfmake/pdfmake.min.js"></script>
<script src="../assets/plugins/datatables/pdfmake/vfs_fonts.js"></script>
<script src="../assets/plugins/datatables/DataTables/js/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/DataTables/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables/Buttons/js/dataTables.buttons.min.js"></script>
<script src="../assets/plugins/datatables/Buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables/Buttons/js/buttons.html5.min.js"></script>
<script src="../assets/plugins/datatables/Buttons/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {    
    $('#example').DataTable({        
        language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
           },
           "sProcessing":"Procesando...",
            },
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
      {
        extend:    'excelHtml5',
        text:      '<i class="fas fa-file-excel"></i> ',
        titleAttr: 'Exportar a Excel',
        className: 'btn btn-success'
      },
      {
        extend:    'pdfHtml5',
        text:      '<i class="fas fa-file-pdf"></i> ',
        titleAttr: 'Exportar a PDF',
        className: 'btn btn-danger'
      },
      {
        extend:    'print',
        text:      '<i class="fa fa-print"></i> ',
        titleAttr: 'Imprimir',
        className: 'btn btn-info'
      },
    ]         
    });     
});
</script>