/**
 * Función para mostrar la modal de editar el empleado
 */
async function editarEmpleado(idEmpleado) {
  try {
    // Ocultar la modal si está abierta
    const existingModal = document.getElementById("editarEmpleadoModal");
    if (existingModal) {
      const modal = bootstrap.Modal.getInstance(existingModal);
      if (modal) {
        modal.hide();
      }
      existingModal.remove(); // Eliminar la modal existente
    }

    const response = await fetch("modales/modalEditar.php");
    if (!response.ok) {
      throw new Error("Error al cargar la modal de editar el empleado");
    }
    const modalHTML = await response.text();

    // Crear un elemento div para almacenar el contenido de la modal
    const modalContainer = document.createElement("div");
    modalContainer.innerHTML = modalHTML;

    // Agregar la modal al documento actual
    document.body.appendChild(modalContainer);

    // Mostrar la modal
    const myModal = new bootstrap.Modal(
      modalContainer.querySelector("#editarEmpleadoModal")
    );
    myModal.show();

    await cargarDatosEmpleadoEditar(idEmpleado);
  } catch (error) {
    console.error(error);
  }
}

/**
 * Función buscar información del empleado seleccionado y cargarla en la modal
 */
async function cargarDatosEmpleadoEditar(idEmpleado) {
  try {
    const response = await axios.get(
      `Verificacion/detallesEmpleado.php?id=${idEmpleado}`
    );
    if (response.status === 200) {
      const { id, nombre, apellido, nomina, fecha, estado, equipo, cargo, checklist } =
        response.data;

      console.log(id, nombre, apellido, nomina, fecha, estado, equipo, cargo, checklist);
      document.querySelector("#idempleado").value = id;
      document.querySelector("#nombre").value = nombre;
      document.querySelector("#apellido").value = apellido;
      document.querySelector("#nomina").value = nomina;
      document.querySelector("#fecha").value = fecha;
      document.querySelector("#estado").value = estado;
      document.querySelector("#equipo").value = equipo;
      document.querySelector("#cargo").value = cargo;
      document.querySelector("#checklist").value = checklist;

      // Seleccionar el estado correspondiente
      seleccionarEstado(estado);

      // Obtener el elemento <select> de cargo
      seleccionarCargo(cargo);


    } else {
      console.log("Error al cargar el empleado a editar");
    }
  } catch (error) {
    console.error(error);
    alert("Hubo un problema al cargar los detalles del empleado");
  }
}
/**
 * Función para seleccionar el cargo del empleado de acuedo al cargo actual
 */
function seleccionarCargo(cargoEmpleado) {
  const selectCargo = document.querySelector("#cargo");
  selectCargo.value = cargoEmpleado;

}

/**
 * Función para seleccionar el cargo del empleado de acuedo al cargo actual
 */
function seleccionarEstado(estadoEmpleado) {
  const selectestado = document.querySelector("#estado");
  selectestado.value = estadoEmpleado;
}

async function actualizarEmpleado(event) {
  try {
    event.preventDefault();

    const formulario = document.querySelector("#formularioEmpleadoEdit");
    // Crear un objeto FormData para enviar los datos del formulario
    const formData = new FormData(formulario);

    // Imprimir los datos que se envían
    console.log("Datos enviados:");
    for (let [key, value] of formData.entries()) {
      console.log(key, value);
    }

    // Enviar los datos del formulario al backend usando Axios
    const response = await axios.post("Verificacion/updateEmpleado.php", formData);

    // Verificar la respuesta del backend
    if (response.status === 200) {
      console.log("Empleado actualizado exitosamente");

      //Llamar a la función para mostrar un mensaje de éxito
      if (window.toastrOptions) {
        toastr.options = window.toastrOptions;
        toastr.success("¡El empleado se actualizo correctamente!.");
      }

      setTimeout(() => {
        $("#editarEmpleadoModal").css("opacity", "");
        $("#editarEmpleadoModal").modal("hide");
      }, 600);
    } else {
      console.error("Error al actualizar el empleado");
    }
  } catch (error) {
    console.error("Error al enviar el formulario", error);
  }
}

