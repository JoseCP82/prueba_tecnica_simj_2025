// services/userService.js
export default class UserService {
    constructor() {
        this.baseUrl = "/api/users";
    }

    // Get all users
    getUsers() {
        return $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: this.baseUrl,
            method: "GET",
            dataType: "json",
            xhrFields: {
                withCredentials: true,
            },
        });
    }

    // Create a new user
    createUser(userData) {
        return $.ajax({
            url: this.baseUrl,
            method: "POST",
            data: userData,
            dataType: "json",
        });
    }

    // Update an existing user
    updateUser(userId, userData) {
        return $.ajax({
            url: `${this.baseUrl}/${userId}`,
            method: "PUT",
            data: userData,
            dataType: "json",
        });
    }

    // Delete a user
    deleteUser(userId) {
        return $.ajax({
            url: `${this.baseUrl}/${userId}`,
            method: "DELETE",
            dataType: "json",
        });
    }
}
