// services/userService.js
export default class UserService {
    constructor() {
        this.baseUrl = "/users";        
    }

    // Get all users
    getUsers() {
        return $.ajax({
            url: `${this.baseUrl}/list`,
            method: "GET",
            dataType: "json",            
        });
    }

    // Get all users
    getUser(userId) {
        return $.ajax({
            url: `${this.baseUrl}/${userId}`,
            method: "GET",
            dataType: "json",            
        });
    }

    // Create a new user
    createUser(userData) {
        return $.ajax({
            url: `${this.baseUrl}`,
            method: 'POST',
            data: userData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            dataType: 'json'
        });
    }

    // Update an existing user
    updateUser(userId, userData) {
        return $.ajax({
            url: `${this.baseUrl}/${userId}`,
            method: "PUT",
            data: userData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            dataType: "json",
        });
    }

    // Delete a user
    deleteUser(userId) {
        return $.ajax({
            url: `${this.baseUrl}/${userId}`,
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            dataType: "json",
        });
    }
}
