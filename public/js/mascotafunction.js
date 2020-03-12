$(function () {

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var table = $('#tPet').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: '/mascota/new',
      type: "GET"
    },
    columns: [
      { data: 'mascota_id', name: 'mascota_id' },
      { data: 'nombre', name: 'nombre' },
      { data: 'raza', name: 'raza' },
      { data: 'fecha_nacimiento', name: 'fecha_nacimiento' },       
      {
        data: 'foto',        
        render: function (data, type, row, meta) {
          var imgsrc = 'data:image/png;jpg;gif;jpeg;svg;base64,' + data;
          return '<img class="img-responsive" src="' + imgsrc + '" alt="_Sin Imagen" height="100px" width="100px">';
        }
      },     
      { data: 'action', name: 'action', orderable: false, searchable: false },
    ]

  });

  $('body').on('click', '.editPet', function () {
    var mascota_id = $(this).data('id');       
    $.get('/mascota/' + mascota_id + '/edit', function (data) {      
      $('#modelHeading').html("EditPet");
      $('#saveBtn').val("edit-user");
      $('#ajaxModel').modal('show');
      $('#mascota_id').val(data.mascota_id);
      $('#nombre').val(data.nombre);    
      $('#raza_id').val(data.raza_id);
      $('#raza').val([data.raza_id]);      
      $('#raza2').val([data.raza_id]);      
      $('#fecha_nacimiento').val(data.fecha_nacimiento);            
    })
  });

  $('#saveBtn').click(function (e) {
    e.preventDefault();
    var formData = new FormData(); // Currently empty    
    formData.append('mascota_id', $("#mascota_id").val());
    formData.append('nombre', $("#nombre").val());
    formData.append('raza', $("#raza").val());
    formData.append('fecha_nacimiento', $("#fecha_nacimiento").val());       
    formData.append("foto", $("#foto")[0].files[0]);
    $(this).html('SAVE CHANGES');
    $.ajax({
      data: formData,
      processData: false, 
      contentType: false, 
      url: '/mascota/update',
      type: "POST",
      dataType: 'json',
      success: function (data) {},
      error: function (data) {
        if(data.status == 200){
          $('#productForm').trigger("reset");
          $('#ajaxModel').modal('hide');    
          alert('El registro fue actualizado con exito');         
          table.draw();                 
        }       
      }
    });
  });

  $('body').on('click', '.deletePet', function () {
    var mascota_id = $(this).data("id");
    var opcion = confirm("Estas seguro que deseas eliminar el registro seleccionado?.");
    if (opcion == true) {
      $.ajax({
        type: "POST",
        url: "/mascota/delete/" + mascota_id,
        success: function (data) {
          alert('Registro Eliminado exitosamente.');          
          table.draw();
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
    } else {

    }

  });
  
});