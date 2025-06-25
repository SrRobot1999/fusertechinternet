"use strict";
let languageEs = {
  sProcessing: "Procesando...",
  sLengthMenu: "Mostrar _MENU_ registros",
  sZeroRecords: "No se encontraron resultados",
  sEmptyTable: "Ning\xfAn dato disponible en esta tabla",
  sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  sInfoEmpty:
    "Mostrando registros del 0 al 0 de un total de 0 registros",
  sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
  sInfoPostFix: "",
  sSearch: "Buscar:",
  sUrl: "",
  sInfoThousands: ",",
  sLoadingRecords: "Cargando...",
  oPaginate: {
    sFirst: "Primero",
    sLast: "Último",
    sNext: "Siguiente",
    sPrevious: "Anterior",
  },
  oAria: {
    sSortAscending:
      ": Activar para ordenar la columna de manera ascendente",
    sSortDescending:
      ": Activar para ordenar la columna de manera descendente",
  },
};

$("[data-checkboxes]").each(function () {
  var me = $(this),
    group = me.data('checkboxes'),
    role = me.data('checkbox-role');

  me.change(function () {
    var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
      checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
      dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
      total = all.length,
      checked_length = checked.length;

    if (role == 'dad') {
      if (me.is(':checked')) {
        all.prop('checked', true);
      } else {
        all.prop('checked', false);
      }
    } else {
      if (checked_length >= total) {
        dad.prop('checked', true);
      } else {
        dad.prop('checked', false);
      }
    }
  });
});

$("#table-1").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [2, 3] }
  ],
  language: languageEs,
});
$("#table-2").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [0, 2, 3] }
  ],
  language: languageEs,
  order: [[1, "asc"]] //column indexes is zero based

});
$('#save-stage').DataTable({
  "scrollX": true,
  stateSave: true,
  language: languageEs
});
$('#tableExport').DataTable({
  dom: 'Bfrtip',
  buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
  ],
  language: languageEs
});


$(".table-general").dataTable({
  "columnDefs": [{
    "sortable": false,
    "targets": [2, 5]
  }],
  language: languageEs
});



