<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Tres tablas</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
          
          
          <li class="nav-item active">
              <a class="nav-link" href="{{ route('inicio') }}">Inicio</a>
          </li>

          
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownShoppings" role="button" 
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Gestionar tareas
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownShoppings">
                  <a class="dropdown-item" href="{{ route('tasks.list') }}">Listado</a>
              </div>
          </li>
          
      </ul>
  </div>
</nav>
