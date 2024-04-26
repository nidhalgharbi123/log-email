@extends('layouts.dash')

@section('content')
    @livewireStyles
</head>
<body>
    <div>
        <!-- Autres éléments de votre page -->
    
        <!-- Intégration du composant Livewire Calendar -->
        <livewire:calendar/>
    
        <!-- Autres éléments de votre page -->
    </div>
    @livewireScripts
    @stack('scripts')
</body>
@endsection