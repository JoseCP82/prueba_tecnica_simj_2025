// scripts/users.js
import UserService from "../services/userService.js";

const userService = new UserService();

$(document).ready(function () {
    $("#btn-add-user").on("click", () => {
        $("#user-id").val("");
        $("#user-form")[0].reset();
        $("#userModalLabel").text("Nuevo Usuario");
        $("#user-modal").modal("show");
    });

    // Cargar usuarios al abrir la página
    userService.getUsers().then((users) => {
        $("#users-table").DataTable({
            data: users.data,
            order: [[0, "desc"]],
            columns: [
                { data: "id", title: "ID" },
                { data: "name", title: "Nombre" },
                { data: "email", title: "Email" },
                {
                    data: "is_admin",
                    title: "¿Admin?",
                    render: (isAdmin) => (isAdmin ? "Sí" : "No"),
                },
                {
                    data: null,
                    title: "Acciones",
                    render: function (data, type, row) {
                        return `
                            <button class="btn btn-sm btn-info edit-user" data-id="${row.id}">
                              <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger delete-user" data-id="${row.id}">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                        `;
                    },
                },
            ],
        });
    });

    // Guardar usuario
    $("#user-form").on("submit", function (e) {
        e.preventDefault();

        const id = $("#user-id").val();
        const formData = {
            name: $("#name").val(),
            email: $("#email").val(),
            password: $("#password").val(),
            password_confirmation: $("#password_confirmation").val(),
            is_admin: $("#is_admin").is(":checked") ? 1 : 0,
        };

        const request = id
            ? userService.updateUser(id, formData)
            : userService.createUser(formData);

        request
            .then((res) => {
                $("#user-modal").modal("hide");

                mostrarSwal(true, "Usuario guardado correctamente");

                const table = $("#users-table").DataTable();
                const user = res.data;

                if (id) {
                    // Si es edición: buscar y actualizar la fila
                    const rowIndex = table
                        .rows()
                        .indexes()
                        .toArray()
                        .find((i) => table.row(i).data().id === parseInt(id));

                    if (rowIndex !== undefined) {
                        table.row(rowIndex).data(user).draw(false);
                    }
                } else {
                    // Si es nuevo: añadir a la tabla
                    table.row.add(user).draw(false);
                }
            })
            .catch((error) => {
                mostrarSwal(false, "Error al guardar el usuario");
                console.error(error);
            });
    });

    // Editar usuario
    $(document).on("click", ".edit-user", function () {
        const userId = $(this).data("id");

        userService
            .getUser(userId)
            .then((response) => {
                const user = response.data;

                $("#user-id").val(user.id);
                $("#name").val(user.name);
                $("#email").val(user.email);
                $("#password").val(""); // no mostramos la contraseña actual
                $("#is_admin").prop("checked", user.is_admin == 1);

                $("#userModalLabel").text("Editar Usuario");
                $("#user-modal").modal("show");
            })
            .catch((error) => {
                mostrarSwal(false, "Error al obtener el usuario");
                console.error(error);
            });
    });

    // Delegamos el evento porque los botones se cargan dinámicamente
    $("#users-table").on("click", ".delete-user", function () {
        const userId = $(this).data("id");
        Swal.fire({
            title: "¿Estás seguro?",
            text: "¿Deseas eliminar este usuario?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                userService
                    .deleteUser(userId)
                    .then(() => {
                        const table = $("#users-table").DataTable();

                        mostrarSwal(true, "Usuario eliminado correctamente");

                        // Buscar la fila por ID
                        const rowIndex = table
                            .rows()
                            .indexes()
                            .toArray()
                            .find(
                                (i) =>
                                    table.row(i).data().id === parseInt(userId)
                            );

                        if (rowIndex !== undefined) {
                            table.row(rowIndex).remove().draw(false);
                        }
                    })
                    .catch((error) => {
                        mostrarSwal(false, "Error al eliminar el usuario");
                        console.error(error);
                    });
            }
        });
    });

    // Muestra un alert indicando exito o no al realizar una acción
    function mostrarSwal(estado, mensaje) {
        Swal.fire({
            icon: estado ? "success" : "error",
            title: estado ? "¡Listo!" : "Error",
            text: mensaje,
            timer: 2000,
            showConfirmButton: false,
        });
    }
});
