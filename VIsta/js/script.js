function insertarPaciente() {
  queryString = $("#agregarPaciente").serialize();
  url = "index.php?accion=ingresarPaciente&" + queryString;
  $("#paciente").load(url);
  $("#frmPaciente").dialog("close");
}
function insertarTratamiento() {
  queryString = $("#agregarTratamiento").serialize();
  url = "index.php?accion=ingresarTratamiento&" + queryString;
  $("#paciente").load(url);
  $("#frmTratamiento").dialog("close");
}
function cancelar() {
  $(this).dialog("close");
}
$(document).ready(function () {
  $("#frmPaciente").dialog({
    autoOpen: false,
    height: 310,
    width: 400,
    modal: true,
    buttons: {
      Insertar: insertarPaciente,
      Cancelar: cancelar,
    },
  });
});
$(document).ready(function () {
  $("#frmTratamiento").dialog({
    autoOpen: false,
    height: 350,
    width: 400,
    modal: true,
    buttons: {
      Insertar: insertarTratamiento,
      Cancelar: cancelar,
    },
  });
});
function consultarPaciente() {
  var url =
    "index.php?accion=ConsultarPaciente&documento=" +
    $("#asignarDocumento").val();
  $("#paciente").load(url, function (response) {
    if (response.indexOf("<!--EXISTE-->") !== -1){
      $("#asignarEnviar").prop("disabled", false);
    } else {
      $("#asignarEnviar").prop("disabled", true);   
    }
  });
}
function consultarTratamiento() {
  var url =
    "index.php?accion=ConsultarTratamientos&documento=" +
    $("#asignarDocumento").val();
  $("#paciente").load(url);
}
function mostrarFormulario() {
  documento = "" + $("#asignarDocumento").val();
  $("#PacDocumento").attr("value", documento);
  $("#frmPaciente").dialog("open");
}
function mostrarFormularioTrat() {
  documento = "" + $("#asignarDocumento").val();
  $("#TratDocumento").attr("value", documento);
  $("#frmTratamiento").dialog("open");
}
function insertarPaciente() {
  queryString = $("#agregarPaciente").serialize();
  url = "index.php?accion=ingresarPaciente&" + queryString;
  $("#paciente").load(url);
  alert(queryString);
  $("#frmPaciente").dialog("close");
}
function insertarTratamiento() {
  queryString = $("#agregarTratamiento").serialize();
  url = "index.php?accion=ingresarTratamiento&" + queryString;
  alert(queryString);
  $("#paciente").load(url);
  $("#frmTratamiento").dialog("close");
}
function cancelar() {
  $(this).dialog("close");
}
function cargarHoras() {
  if ($("#medico").val() == -1 || $("#fecha").val() == "") {
    $("#hora").html(
      "<option value='-1' selected='selected'>--Selecione la hora </option>"
    );
  } else {
    queryString =
      "medico=" + $("#medico").val() + "&fecha=" + $("#fecha").val();
    url = "index.php?accion=consultarHora&" + queryString;
    $("#hora").load(url);
  }
}
function seleccionarHora() {
  if ($("#medico").val() == -1) {
    alert("Debe seleccionar un médico");
  } else if ($("#fecha").val() == "") {
    alert("Debe seleccionar una fecha");
  } else if ($("#consultorio").val() == -1) {
    alert("Debe seleccionar un consultorio");
  }
}
function enviar() {
  if ($("#medico").val() == -1) {
    alert("Debe seleccionar un médico");
  } else if ($("#fecha").val() == "") {
    alert("Debe seleccionar una fecha");
  } else if ($("#consultorio").val() == -1) {
    alert("Debe seleccionar un consultorio");
  } else if ($("#hora").val() == -1) {
    alert("Debe seleccionar una hora");
  }
}
function consultarCita() {
  url =
    "index.php?accion=consultarCita&consultarDocumento=" +
    $("#consultarDocumento").val();
  $("#paciente2").load(url);
}
function consultarTratamientodisponible() {
  url =
    "index.php?accion=ConsultarTratamientos&consultarDocumento=" +
    $("#consultarDocumento").val();
  $("#paciente2").load(url);
}
function cancelarCita() {
  url =
    "index.php?accion=cancelarCita&cancelarDocumento=" +
    $("#cancelarDocumento").val();
  $("#paciente3").load(url);
}
function confirmarCancelar(numero) {
  if (confirm("Esta seguro de cancelar la cita " + numero)) {
    $.get(
      "index.php",
      { accion: "confirmarCancelar", numero: numero },
      function (mensaje) {
        alert(mensaje);
        cancelarCita();
      }
    );
  }
  $("#cancelarConsultar").trigger("click");
}
