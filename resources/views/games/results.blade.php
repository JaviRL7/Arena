@extends('layouts.plantilla')
@section('title', 'result games')

@section('content')
<div class="flex justify-between">
    <div class="flex justify-between">
        <!-- Tabla 1 -->
        <table class="table-auto">
          <thead>
            <tr>
              <th><img src="{{ asset($game->team_blue->logo) }}" alt="{{ $game->team_blue->name }}" class="w-auto h-10"></th>
              <th>{{ $game->getToplaner->nick }}</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <img class="w-18 h-auto rounded-full" src="ruta/a/tu/imagen.jpg" alt="Descripción de la imagen">
              </td>
              <td class="flex flex-col items-end">
                <span class="text-sm">Nick</span>
                <span>Nombre</span>
              </td>
            </tr>
          </tbody>
        </table>
      
        <!-- Tabla 2 -->
        <table class="table-auto">
          <thead>
            <tr>
              <th>Imagen</th>
              <th>Información</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <img class="w-18 h-auto rounded-full" src="ruta/a/tu/imagen.jpg" alt="Descripción de la imagen">
              </td>
              <td class="flex flex-col items-end">
                <span class="text-sm">Nick</span>
                <span>Nombre</span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
@endsection
