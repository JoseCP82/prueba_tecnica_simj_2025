// scripts/users.js
import UserService from '../services/userService.js';

const userService = new UserService();

$(document).ready(function() {
  // Cargar usuarios al abrir la página
  userService.getUsers()
    .done(users => {
      console.log('Usuarios:', users);
      // Aquí código para renderizar en la tabla o lista...
    })
    .fail(err => {
      console.error('Error al cargar usuarios:', err);
    });

  // Ejemplo: manejar creación de usuario con formulario
  $('#formCreateUser').submit(function(e) {
    e.preventDefault();

    const userData = {
      name: $('#name').val(),
      email: $('#email').val(),
      // otros campos...
    };

    userService.createUser(userData)
      .done(response => {
        alert('Usuario creado');
        // recargar lista o actualizar tabla
      })
      .fail(err => {
        alert('Error al crear usuario');
      });
  });
});
