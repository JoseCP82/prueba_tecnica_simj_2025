@extends('layouts.admin')

@section('content')
    <!-- Header de la página -->
    <section class="content-header">
        <div class="container-fluid">
            <h1>Gestión de Usuarios</h1>
        </div>
    </section>

    <!-- Contenido principal -->
    <section class="content">
        <div class="container-fluid">
            <!-- Tabla de usuarios -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Usuarios</h3>
                    <button class="btn btn-primary float-right" id="btn-add-user">
                        <i class="fas fa-plus"></i> Nuevo Usuario
                    </button>
                </div>
                <div class="card-body">
                    <table id="users-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>¿Admin?</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Se llenará con JS -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal para crear/editar usuario -->
            <div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="user-form">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="userModalLabel">Nuevo Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="user-id" name="user_id" value="">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" id="name" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo</label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" id="password" name="password" class="form-control">
                                    <small class="form-text text-muted">Opcional al editar</small>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" id="is_admin" name="is_admin" class="form-check-input">
                                    <label class="form-check-label" for="is_admin">Administrador</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Guardar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/scripts/users.js') }}" defer></script>
@endpush
