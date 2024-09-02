// Define la función globalmente adjuntándola al objeto window
window.insertEmpleadoTable = async function () {
  try {
    const response = await axios.get(`../Verificacion/getUltimoEmpleado.php`);
    if (response.status === 200) {
      const infoEmpleado = response.data; // Obtener los datos del empleado desde la respuesta
      let tableBody = document.querySelector("#table_empleados tbody");

      let tr = document.createElement("tr");
      tr.id = `empleado_${infoEmpleado.id}`;
      tr.innerHTML = `
        <th class="dt-type-numeric sorting_1" scope="row">${
          infoEmpleado.id
        }</th>
        <td>${infoEmpleado.nombre}</td>
        <td>${infoEmpleado.apellido}</td>
        <td>${infoEmpleado.fecha}</td>
        <td>${infoEmpleado.estado}</td>
        <td>${infoEmpleado.responsable}</td>
        <td>${infoEmpleado.marca}</td>
        <td>${infoEmpleado.cargo}</td>
        <td>${infoEmpleado.descripcion}</td>
        <td>
        <td>
          <a title="Ver detalles del empleado" href="#" onclick="verDetallesEmpleado(${
            infoEmpleado.id
          })" class="btn btn-success"><i class="bi bi-binoculars"></i></a>
          <a title="Editar datos del empleado" href="#" onclick="editarEmpleado(${
            infoEmpleado.id
          })" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
          <a title="Eliminar datos del empleado" href="#" onclick="eliminarEmpleado(${
            infoEmpleado.id
          }, '${
        infoEmpleado.avatar || ""
      }')" class="btn btn-danger"><i class="bi bi-trash"></i></a>
        </td>
      `;

      // Insertar el nuevo elemento al final de la tabla
      tableBody.appendChild(tr);
    }
  } catch (error) {
    console.error("Error al obtener la información del empleado", error);
  }
};
