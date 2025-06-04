// scripts/users.js
import UserService from "../services/userService.js";

const userService = new UserService();

$(document).ready(function () {
    // Cargar usuarios al abrir la página
    userService.getUsers().then((users) => {
        $("#users-table").DataTable({
            data: users.data,
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

    // Ejemplo: manejar creación de usuario con formulario
    $("#formCreateUser").submit(function (e) {
        e.preventDefault();

        const userData = {
            name: $("#name").val(),
            email: $("#email").val(),
            // otros campos...
        };

        userService
            .createUser(userData)
            .done((response) => {
                alert("Usuario creado");
                // recargar lista o actualizar tabla
            })
            .fail((err) => {
                alert("Error al crear usuario");
            });
    });
});
