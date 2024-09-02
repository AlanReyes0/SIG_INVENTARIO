/**
 * Función para mostrar la modal de detalles del empleado
 */
async function verDetallesEmpleado(idEmpleado) {
  try {
    // Ocultar la modal si está abierta
    const existingModal = document.getElementById("detalleEmpleadoModal");
    if (existingModal) {
      const modal = bootstrap.Modal.getInstance(existingModal);
      if (modal) {
        modal.hide();
      }
      existingModal.remove(); // Eliminar la modal existente
    }

    // Buscar la Modal de Detalles
    const response = await fetch("modales/modalDetalles.php");
    if (!response.ok) {
      throw new Error("Error al cargar la modal de detalles del empleado");
    }
    // response.text() es un método en programación que se utiliza para obtener el contenido de texto de una respuesta HTTP
    const modalHTML = await response.text();

    // Crear un elemento div para almacenar el contenido de la modal
    const modalContainer = document.createElement("div");
    modalContainer.innerHTML = modalHTML;

    // Agregar la modal al documento actual
    document.body.appendChild(modalContainer);

    // Mostrar la modal
    const myModal = new bootstrap.Modal(
      modalContainer.querySelector("#detalleEmpleadoModal")
    );
    myModal.show();

    await cargarDetalleEmpleado(idEmpleado);
  } catch (error) {
    console.error(error);
  }
}

/**
 * Función para cargar y mostrar los detalles del empleado en la modal
 */
async function cargarDetalleEmpleado(idEmpleado) {
  try {
    const response = await axios.get(
      `Verificacion/detallesEmpleado.php?id=${idEmpleado}`
    );
    if (response.status === 200) {
      console.log(response.data);
      const { nombre, apellido, nomina, fecha, estado, equipo, cargo, checklist} =
        response.data;

      // Limpiar el contenido existente de la lista ul

      const ulDetalleEmpleado = document.querySelector(
        "#detalleEmpleadoContenido ul"
      );

      ulDetalleEmpleado.innerHTML = ` 
        <li class="list-group-item"><b>Nombre:</b> 
          ${nombre ? nombre : "No disponible"}
        </li>
        <li class="list-group-item"><b>Apellido:</b> 
          ${apellido ? apellido : "No disponible"}
        </li>
         <li class="list-group-item"><b>Apellido:</b> 
          ${nomina ? nomina : "No disponible"}
        </li>
        <li class="list-group-item"><b>Fecha:</b> 
          ${fecha ? fecha : "No disponible"}
          </li>
        <li class="list-group-item"><b>Estado:</b>
          ${estado ? estado : "No disponible"}
        </li>
        <li class="list-group-item"><b>Marca:</b>
         ${equipo ? equipo : "No disponible"}
        </li>
        <li class="list-group-item"><b>Cargo:</b> 
          ${cargo ? cargo : "No disponible"}
        </li>
        <li class="list-group-item"><b>Descripcion:</b> ${
         checklist ?checklist : "No disponible"
        }
      `;
    } else {
      alert(`Error al cargar los detalles del empleado con ID ${idEmpleado}`);
    }
  } catch (error) {
    console.error(error);
    alert("Hubo un problema al cargar los detalles del empleado");
  }
}
