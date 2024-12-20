<div x-init="window.scrollTo({ top: 0, behavior: 'smooth' })">

    <h4 class="text-sm/6 font-semibold text-gray-900">Seleccionar sucursal de retiro</h4>

    <ul>
        @foreach (session('rates_results.dropoff_rates') as $rate)
            <li> {{ $rate->label }} </li>   
            <li> @dump($rate->branches) </li>
        @endforeach
    </ul>

</div>