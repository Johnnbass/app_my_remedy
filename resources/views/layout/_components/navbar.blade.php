<nav class="navbar navbar-expand-lg navbar-dark bg-info rounded">
    <button 
      class="navbar-toggler" 
      type="button" 
      data-toggle="collapse" 
      data-target="#navbar" 
      aria-controls="navbar"
      aria-expanded="false" 
      aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
            <li @if ($current == 'home') class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/">Home </a>
            </li>
            <li @if ($current == 'pessoas') class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/pessoas">Pessoas</a>
            </li>
            <li @if ($current == 'horarios') class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/horarios">Horários </a>
            </li>
            <li @if ($current == 'medicamentos') class="nav-item active" @else class="nav-item" @endif>
              <a class="nav-link" href="/medicamentos">Medicamentos </a>
          </li>
        </ul>
    </div>
</nav>
