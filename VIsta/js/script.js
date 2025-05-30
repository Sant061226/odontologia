function insertarPaciente() {
  queryString = $("#agregarPaciente").serialize();
  url = "index.php?accion=ingresarPaciente&" + queryString;
  $("#paciente").load(url);
  $("#frmPaciente").dialog("close");
}
function insertarTratamiento() {
  queryString = $("#agregarTratamiento").serialize();
  url = "index.php?accion=guardarTratamiento&" + queryString;
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
function mostrarFormulario() {
  documento = "" + $("#asignarDocumento").val();
  $("#PacDocumento").attr("value", documento);
  $("#frmPaciente").dialog("open");
}
function mostrarFormularioTrat() {
  var documento = $("#asignarDocumento").val();
  $("#PacDocumento").val(documento);
  $("#frmTratamiento").dialog("open");
}
function insertarPaciente() {
  queryString = $("#agregarPaciente").serialize();
  url = "index.php?accion=ingresarPaciente&" + queryString;
  $("#paciente").load(url);
  alert(queryString);
  $("#frmPaciente").dialog("close");
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
            $("#paciente").html(data);
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
  $("#editTraDescripcion").val(fila.find("td").eq(1).text());
  $("#editTraFechaInicio").val(fila.find("td").eq(2).text());
  $("#editTraFechaFin").val(fila.find("td").eq(3).text());
  $("#editTraObservaciones").val(fila.find("td").eq(4).text());
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