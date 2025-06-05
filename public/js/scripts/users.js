// scripts/users.js
import UserService from "../services/userService.js";

const userService = new UserService();

$(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

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
            is_admin: $("#is_admin").is(":checked") ? 1 : 0,
        };

        const request = id
        ? userService.updateUser(id, formData)
        : userService.createUser(formData);
        
        request
            .then(() => {
                $("#user-modal").modal("hide");
                $("#users-table").DataTable().ajax.reload(null, false); // recarga sin reiniciar la paginación
            })
            .catch((error) => {
                alert("Error al guardar el usuario");
                console.error(error);
            });
    });
});
