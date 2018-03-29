$(function () {
    $('#modal1').modal();
    $(document).ready(function () {
        $('select').formSelect();
    });
    $('.sidenav').sidenav();
    $("#crearpais").click(function () {
        if ($("#name_pais").val()) {
            $.ajax({
                method: "POST",
                url: urlpais,
                dataType: "json",
                data: {'name': $("#name_pais").val()},
                success: function (data) {
                    if (data[0].nombre) {
                        console.log("entra");
                        $("#name_pais").val("");
                        $("#select-pais").append('<option value="' + data[0].id + '">' + data[0].nombre + '</option>');
                        $(document).ready(function () {
                            $('select').formSelect();
                        });
                        modal("se ha creado el pais " + data[0].nombre + ".", "Pais creado con exito");
                    }
                }
            });
        } else {
            modal("Debe Digitar un nombre de pais.", "IMPORTANTE!!!");
        }
    });
    $("#creardepartamento").click(function () {
        if ($("#name_departamento").val() && $('#select-pais').val()) {
            $.ajax({
                url: urldpto,
                method: "POST",
                data: {"name": $("#name_departamento").val(), "pais": $('#select-pais').val()},
                dataType: "json",
                success: function (data) {
                    if (data[0].nombre) {
                        $("#name_departamento").val("");
                        $("#select-departamento").append('<option value="' + data[0].id + '">' + data[0].nombre + '</option>');
                        $(document).ready(function () {
                            $('select').formSelect();
                        });
                        modal("se ha creado el departamento " + data[0].nombre + ".", "Departamento creado con exito");
                    }
                }
            });
        } else {
            if (!$("#name_departamento").val()) {
                modal("Debe Digitar un nombre de departamento.", "IMPORTANTE!!!");
            } else if (!$('#select-pais').val()) {
                modal("Debe Seleccionar un pais.", "IMPORTANTE!!!");
            }
        }
    });
    function modal(msj, title) {
        $('#mensaje').html(msj);
        $('#titulo').html(title);
        $('.modal').modal('open');
    }
});
