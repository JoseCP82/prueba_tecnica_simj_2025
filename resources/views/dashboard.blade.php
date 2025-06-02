@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
  <div class="container-fluid">
    <h1 class="mb-4">Bienvenido, {{ Auth::user()->name }}</h1>

    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>5</h3>
            <p>Proyectos activos</p>
          </div>
          <div class="icon">
            <i class="fas fa-project-diagram"></i>
          </div>
          <a href="#" class="small-box-footer">Ver proyectos <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </div>
@endsection

