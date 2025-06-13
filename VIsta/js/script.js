function insertarPaciente() {
  queryString = $("#agregarPaciente").serialize();
  url = "index.php?accion=ingresarPaciente&" + queryString;
  $("#paciente").load(url);
  $("#frmPaciente").dialog("close");
}
function insertarPaciente1() {
  queryString = $("#agregarPaciente1").serialize();
  url = "index.php?accion=ingresarPaciente1&" + queryString;
  $("#paciente").load(url);
  $("#frmPaciente1").dialog("close");
}
function insertarTratamiento() {
  queryString = $("#agregarTratamiento").serialize();
  url = "index.php?accion=guardarTratamiento" + queryString;
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
  $("#frmPaciente1").dialog({
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
  $("#frmPaciente2").dialog({
    autoOpen: false,
    height: 310,
    width: 400,
    modal: true,
    buttons: {
      Insertar: editarPaciente,
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
$(document).ready(function () {
  $("#frminsertarMedico").dialog({
    autoOpen: false,
    height: 310,
    width: 400,
    modal: true,
    buttons: {
      Insertar: insertarMedico,
      Cancelar: cancelar,
    },
  });
});
$(document).ready(function () {
  $("#frmEditarMedico").dialog({
    autoOpen: false,
    height: 310,
    width: 400,
    modal: true,
    buttons: {
      Insertar: editarMedico,
      Cancelar: cancelar,
    },
  });
});
function consultarPaciente() {
  var url =
    "index.php?accion=ConsultarPaciente&documento=" +
    $("#asignarDocumento").val();
  $("#paciente").load(url, function (response) {
    if (response.indexOf("<!--EXISTE-->") !== -1) {
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
function consultarTratamientoPaciente() {
  var url =
    "index.php?accion=ConsultarTratamientosPaciente&documento=" +
    $("#asignarDocumento").val();
  $("#paciente").load(url);
}
function mostrarFormulario() {
  documento = "" + $("#asignarDocumento").val();
  $("#PacDocumento").attr("value", documento);
  $("#frmPaciente").dialog("open");
}
function mostrarFormulario1() {
  $("#frmPaciente1").dialog("open");
}
function mostrarFormularioTrat() {
  var documento = $("#asignarDocumento").val();
  $("#PacDocumento").val(documento);
  $("#frmTratamiento").dialog("open");
}
function mostrarFormularioMed() {
  $("#frminsertarMedico").dialog("open");
}
function insertarMedico() {
  var queryString = $("#insertarMedico").serialize();
  $.post("index.php?accion=agregarMedico", queryString, function () {
    $("#frminsertarMedico").dialog("close");
    alert(queryString);

    window.location.href = "index.php?accion=medicos";
  });
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
  url = "index.php?accion=guardarTratamiento" + queryString;
  $("#paciente").load(url);
  url = "index.php?accion=guardarTratamiento&" + queryString;
  $("#paciente").load(url);
  alert(queryString);
  $("#frmTratamiento").dialog("close");
}
function cancelar() {
  $(this).dialog("close");
}
function mostrarModal(id, nombre, apellido) {
  $("#frmEditarMedico").dialog("open");
  document.getElementById("editMedIdentificacion").value = id;
  document.getElementById("editMedNombres").value = nombre;
  document.getElementById("editMedApellidos").value = apellido;
}
function editarMedico() {
  var queryString = $("#EditarMedico").serialize();
  $.post("index.php?accion=actualizarMedico", queryString, function () {
    $("#frmEditarMedico").dialog("close");
    window.location.href = "index.php?accion=medicos";
  });
}
function cargarHoras() {
  if ($("#medico").val() == -1 || $("#fecha").val() == "") {
    $("#hora").html(
      "<option value='-1' selected='selected'>--Seleccione la hora </option>"
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
function consultarCitaMedico() {
  $.get("index.php?accion=consultarCitaMedico", function (data) {
    $("#paciente2").html(data);
  });
}
function consultarCitaPaciente() {
  $.get("index.php?accion=consultarCitaPaciente", function (data) {
    $("#paciente2").html(data);
  });
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
function cancelarCitaPaciente() {
  $.get(
    "index.php?accion=cancelarCitaPaciente&cancelarDocumento",
    function (data) {
      $("#paciente3").html(data);
    }
  );
}
function cancelarCitaMedico() {
  $.get(
    "index.php?accion=cancelarCitaPaciente&cancelarDocumento",
    function (data) {
      $("#paciente3").html(data);
    }
  );
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
function confirmarCancelarTrat(numero) {
  if (confirm("Esta seguro de cancelar el tratamiento " + numero)) {
    $.get(
      "index.php",
      { accion: "confirmarCancelarTrat", numero: numero },
      function (mensaje) {
        alert(mensaje);
        var docPaciente = $("table")
          .first()
          .find("tr")
          .eq(1)
          .find("td")
          .first()
          .text()
          .trim();
        if (!docPaciente) {
          docPaciente = $("#asignarDocumento").val();
        }
        $("#paciente").load(
          "index.php?accion=ConsultarTratamientos&documento=" + docPaciente
        );
      }
    );
  }
  $("#cancelarConsultar").trigger("click");
}
$(document).ready(function () {
  $("#frmEditarTratamiento").dialog({
    autoOpen: false,
    height: 350,
    width: 400,
    modal: true,
    buttons: {
      Guardar: function () {
        var queryString = $("#editarTratamiento").serialize();
        $.post(
          "index.php?accion=EditarTratamientos",
          queryString,
          function (data) {
            $("#paciente").load(url);
          }
        );
        $("#frmEditarTratamiento").dialog("close");
      },
      Cancelar: function () {
        $(this).dialog("close");
      },
    },
  });
});
function confirmarEditarTrat(numero, docPaciente) {
  var fila = $("td")
    .filter(function () {
      return $(this).text() == numero;
    })
    .closest("tr");

  $("#editTraNumero").val(numero);
  $("#editPacDocumento").val(docPaciente);
  $("#editTraFechaAsinado").val(fila.find("td").eq(1).text());
  $("#editTraDescripcion").val(fila.find("td").eq(2).text());
  $("#editTraFechaInicio").val(fila.find("td").eq(3).text());
  $("#editTraFechaFin").val(fila.find("td").eq(4).text());
  $("#editTraObservaciones").val(fila.find("td").eq(5).text());
  $("#frmEditarTratamiento").dialog("open");
}
$(document).ready(function () {
  var btn = document.getElementById("btnMostrarEliminar");
  var form = document.getElementById("formEliminar");
  if (btn && form) {
    btn.onclick = function () {
      form.style.display = "inline";
      this.style.display = "none";
    };
  }
});
$(document).ready(function () {
  var btnAgregar = document.getElementById("btnAgregarConsultorio");
  var formAgregar = document.getElementById("formAgregarConsultorio");
  if (btnAgregar && formAgregar) {
    btnAgregar.onclick = function () {
      formAgregar.style.display = "block";
      btnAgregar.style.display = "none";
    };
  }
});
document.getElementById("btnAgregarConsultorio").onclick = function () {
  var form = document.getElementById("formAgregarConsultorio");
  form.classList.add("show");
  this.style.display = "none";
};
document.getElementById("btnCancelarAgregar").onclick = function () {
  var form = document.getElementById("formAgregarConsultorio");
  form.classList.remove("show");
  document.getElementById("btnAgregarConsultorio").style.display =
    "inline-block";
};

function mostrarModalPac(
  id,
  nombres,
  apellidos,
  fechaNacimiento,
  sexo,
  correo
) {
  $("#editPacDocumento").val(id);
  $("#editPacNombres").val(nombres);
  $("#editPacApellidos").val(apellidos);
  $("#editPacFechaNacimiento").val(fechaNacimiento);
  $("#editPacSexo").val(sexo);
  $("#editPacCorreo").val(correo);
  $("#frmPaciente2").dialog("open");
}
function editarPaciente() {
  var queryString = $("#EditarPaciente").serialize();
  $.post("index.php?accion=actualizarPaciente", queryString, function () {
    $("#frmPaciente2").dialog("close");
    alert(queryString);
    window.location.href = "index.php?accion=pacientes";
  });
}
function eliminarPaciente(id) {
  if (confirm("¿Está seguro que desea eliminar este paciente?")) {
    $.get(
      "index.php?accion=eliminarPaciente&id=" + encodeURIComponent(id),
      function () {
        location.reload();
      }
    );
  }
}
function confirmarDescarga(event) {
  event.preventDefault();
  if (confirm("¿Desea descargar el archivo Excel con todas las citas?")) {
    window.location.href = "index.php?accion=descargarExcelCitas";
  }
}
