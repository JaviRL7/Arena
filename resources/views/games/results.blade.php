@extends('layouts.plantilla')
@section('title', 'result games')

@section('content')
    <div class="flex justify-between">
        <div class="flex justify-between">
            <!-- Tabla 1 -->
            <table class="table-auto  mr-5">
                </thead>
                <tbody>
                    <tr class="align-middle">
                        <th>
                            <div class="flex items-center">
                                <img src="{{ asset('roles_icons/TOP.png') }}" alt="TOP" class="w-auto h-12">
                                <img src="{{ asset($game->team_blue->getToplaner->first()->photo) }}"
                                    alt="{{ $game->team_blue->getToplaner->first()->photo }}"
                                    class="w-36 h-36 object-cover rounded-full">
                            </div>
                        </th>
                        <th>
                            <div class="mx-4">{{ $game->team_blue->getToplaner->first()->nick }}<br><span
                                    class="text-gray-500">{{ $game->team_blue->getToplaner->first()->name }}
                                    {{ $game->team_blue->getToplaner->first()->lastname1 }}</span></div>
                        </th>
                        <th>
                            <div class="mx-4"><img
                                    src="{{ asset($game->team_blue->getToplaner->first()->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                    alt="" class="w-16 h-16 object-cover rounded-full"></div>
                        </th>
                        <th>
                            <div class="mx-4">
                                {{ $game->team_blue->getToplaner->first()->games->where('id', $game->id)->first()->pivot->kills }}
                                /{{ $game->team_blue->getToplaner->first()->games->where('id', $game->id)->first()->pivot->deaths }}
                                /{{ $game->team_blue->getToplaner->first()->games->where('id', $game->id)->first()->pivot->assists }}
                            </div>
                        </th>
                    </tr>
                    <tr class="align-middle">
                        <th>
                            <div class="flex items-center">
                                <img src="{{ asset('roles_icons/Jungler.png') }}" alt="Jungler" class="w-auto h-12">
                                <img src="{{ asset($game->team_blue->getJungler->first()->photo) }}"
                                    alt="{{ $game->team_blue->getJungler->first()->photo }}"
                                    class="w-36 h-36 object-cover rounded-full">
                            </div>
                        </th>
                        <th>
                            <div class="mx-4">{{ $game->team_blue->getJungler->first()->nick }}<br><span
                                    class="text-gray-500">{{ $game->team_blue->getJungler->first()->name }}
                                    {{ $game->team_blue->getJungler->first()->lastname1 }}</span></div>
                        </th>
                        <th>
                            <div class="mx-4"><img
                                    src="{{ asset($game->team_blue->getJungler->first()->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                    alt="" class="w-16 h-16 object-cover rounded-full"></div>
                        </th>
                        <th>
                            <div class="mx-4">
                                {{ $game->team_blue->getJungler->first()->games->where('id', $game->id)->first()->pivot->kills }}
                                /{{ $game->team_blue->getJungler->first()->games->where('id', $game->id)->first()->pivot->deaths }}
                                /{{ $game->team_blue->getJungler->first()->games->where('id', $game->id)->first()->pivot->assists }}
                            </div>
                        </th>
                    </tr>
                    <tr class="align-middle">
                        <th>
                            <div class="flex items-center">
                                <img src="{{ asset('roles_icons/MID.png') }}" alt="Jungler" class="w-auto h-12">
                                <img src="{{ asset($game->team_blue->getMidlaner->first()->photo) }}"
                                    alt="{{ $game->team_blue->getMidlaner->first()->photo }}"
                                    class="w-36 h-36 object-cover rounded-full">
                            </div>
                        </th>
                        <th>
                            <div class="mx-4">{{ $game->team_blue->getMidlaner->first()->nick }}<br><span
                                    class="text-gray-500">{{ $game->team_blue->getMidlaner->first()->name }}
                                    {{ $game->team_blue->getMidlaner->first()->lastname1 }}</span></div>
                        </th>
                        <th>
                            <div class="mx-4"><img
                                    src="{{ asset($game->team_blue->getMidlaner->first()->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                    alt="{{ $game->team_blue->getMidlaner->first()->games->first()->pivot->champion->name }}"
                                    class="w-16 h-16 object-cover rounded-full"></div>
                        </th>
                        <th>
                            <div class="mx-4">
                                {{ $game->team_blue->getMidlaner->first()->games->where('id', $game->id)->first()->pivot->kills }}
                                /{{ $game->team_blue->getMidlaner->first()->games->where('id', $game->id)->first()->pivot->deaths }}
                                /{{ $game->team_blue->getMidlaner->first()->games->where('id', $game->id)->first()->pivot->assists }}
                            </div>
                        </th>
                    </tr>
                    <tr class="align-middle">
                        <th>
                            <div class="flex items-center">
                                <img src="{{ asset('roles_icons/ADC.png') }}" alt="Jungler" class="w-auto h-12">
                                <img src="{{ asset($game->team_blue->getADC->first()->photo) }}"
                                    alt="{{ $game->team_blue->getADC->first()->photo }}"
                                    class="w-36 h-36 object-cover rounded-full">
                            </div>
                        </th>
                        <th>
                            <div class="mx-4">{{ $game->team_blue->getADC->first()->nick }}<br><span
                                    class="text-gray-500">{{ $game->team_blue->getADC->first()->name }}
                                    {{ $game->team_blue->getADC->first()->lastname1 }}</span></div>
                        </th>
                        <th>
                            <div class="mx-4"><img
                                    src="{{ asset($game->team_blue->getADC->first()->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                    alt="{{ $game->team_blue->getADC->first()->games->first()->pivot->champion->name }}"
                                    class="w-16 h-16 object-cover rounded-full"></div>
                        </th>
                        <th>
                            <div class="mx-4">
                                {{ $game->team_blue->getADC->first()->games->where('id', $game->id)->first()->pivot->kills }}
                                /{{ $game->team_blue->getADC->first()->games->where('id', $game->id)->first()->pivot->deaths }}
                                /{{ $game->team_blue->getADC->first()->games->where('id', $game->id)->first()->pivot->assists }}
                            </div>
                        </th>
                    </tr>
                    <tr class="align-middle">
                        <th>
                            <div class="flex items-center">
                                <img src="{{ asset('roles_icons/Support.png') }}" alt="support" class="w-auto h-12">
                                <img src="{{ asset($game->team_blue->getSupport->first()->photo) }}"
                                    alt="{{ $game->team_blue->getSupport->first()->photo }}"
                                    class="w-36 h-36 object-cover rounded-full">
                            </div>
                        </th>
                        <th>
                            <div class="mx-4">{{ $game->team_blue->getSupport->first()->nick }}<br><span
                                    class="text-gray-500">{{ $game->team_blue->getSupport->first()->name }}
                                    {{ $game->team_blue->getSupport->first()->lastname1 }}</span></div>
                        </th>
                        <th>
                            <div class="mx-4"><img
                                    src="{{ asset($game->team_blue->getSupport->first()->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                    alt="{{ $game->team_blue->getSupport->first()->games->first()->pivot->champion->name }}"
                                    class="w-16 h-16 object-cover rounded-full"></div>
                        </th>
                        <th>
                            <div class="mx-4">
                                {{ $game->team_blue->getSupport->first()->games->where('id', $game->id)->first()->pivot->kills }}
                                /{{ $game->team_blue->getSupport->first()->games->where('id', $game->id)->first()->pivot->deaths }}
                                /{{ $game->team_blue->getSupport->first()->games->where('id', $game->id)->first()->pivot->assists }}
                            </div>
                        </th>
                    </tr>
                </tbody>
            </table>

            <!-- Tabla 2 -->
            <!-- Tabla 2 -->
            <table class="table-auto ml-5">
                </thead>
                <tbody>
                    <tr class="align-middle">
                        <th>
                            <div class="mx-4">
                                {{ $game->team_red->getToplaner->first()->games->first()->pivot->kills }}/{{ $game->team_red->getToplaner->first()->games->first()->pivot->deaths }}/{{ $game->team_red->getToplaner->first()->games->first()->pivot->assists }}
                            </div>
                        </th>
                        <th>
                            <div class="mx-4"><img
                                    src="{{ asset($game->team_red->getToplaner->first()->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                    alt="{{ $game->team_red->getToplaner->first()->games->first()->pivot->champion->name }}"
                                    class="w-16 h-16 object-cover rounded-full"></div>
                        </th>
                        <th>
                            <div class="mx-4">{{ $game->team_red->getToplaner->first()->nick }}<br><span
                                    class="text-gray-500">{{ $game->team_red->getToplaner->first()->name }}
                                    {{ $game->team_red->getToplaner->first()->lastname1 }}</span></div>
                        </th>
                        <th>
                            <div class="flex items-center">
                                <img src="{{ asset($game->team_red->getToplaner->first()->photo) }}"
                                    alt="{{ $game->team_red->getToplaner->first()->photo }}"
                                    class="w-36 h-36 object-cover rounded-full">
                                <img src="{{ asset('roles_icons/TOP.png') }}" alt="TOP" class="w-auto h-12">
                            </div>
                        </th>
                    </tr>
                    <tr class="align-middle">
                        <th>
                            <div class="mx-4">
                                {{ $game->team_red->getJungler->first()->games->where('id', $game->id)->first()->pivot->kills }}
                                /{{ $game->team_red->getJungler->first()->games->where('id', $game->id)->first()->pivot->deaths }}
                                /{{ $game->team_red->getJungler->first()->games->where('id', $game->id)->first()->pivot->assists }}
                            </div>
                        </th>
                        <th>
                            <div class="mx-4"><img
                                    src="{{ asset($game->team_red->getJungler->first()->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                    alt="{{ $game->team_red->getJungler->first()->games->where('id', $game->id)->first()->pivot->champion->name }}"
                                    class="w-16 h-16 object-cover rounded-full"></div>
                        </th>
                        <th>
                            <div class="mx-4">{{ $game->team_red->getJungler->first()->nick }}<br><span
                                    class="text-gray-500">{{ $game->team_red->getJungler->first()->name }}
                                    {{ $game->team_red->getJungler->first()->lastname1 }}</span></div>
                        </th>
                        <th>
                            <div class="flex items-center">
                                <img src="{{ asset($game->team_red->getJungler->first()->photo) }}"
                                    alt="{{ $game->team_red->getJungler->first()->photo }}"
                                    class="w-36 h-36 object-cover rounded-full">
                                <img src="{{ asset('roles_icons/Jungler.png') }}" alt="jungler" class="w-auto h-12">
                            </div>
                        </th>
                    </tr>
                    <tr class="align-middle">
                        <th>
                            <div class="mx-4">
                                {{ $game->team_blue->getMidlaner->first()->games->where('id', $game->id)->first()->pivot->kills }}
                                /{{ $game->team_blue->getMidlaner->first()->games->where('id', $game->id)->first()->pivot->deaths }}
                                /{{ $game->team_blue->getMidlaner->first()->games->where('id', $game->id)->first()->pivot->assists }}
                            </div>
                        </th>
                        <th>
                            <div class="mx-4"><img
                                    src="{{ asset($game->team_red->getMidlaner->first()->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                    alt="{{ $game->team_red->getMidlaner->first()->games->first()->pivot->champion->name }}"
                                    class="w-16 h-16 object-cover rounded-full"></div>
                        </th>
                        <th>
                            <div class="mx-4">{{ $game->team_red->getMidlaner->first()->nick }}<br><span
                                    class="text-gray-500">{{ $game->team_red->getMidlaner->first()->name }}
                                    {{ $game->team_red->getMidlaner->first()->lastname1 }}</span></div>
                        </th>
                        <th>
                            <div class="flex items-center">
                                <img src="{{ asset($game->team_red->getMidlaner->first()->photo) }}"
                                    alt="{{ $game->team_red->getMidlaner->first()->photo }}"
                                    class="w-36 h-36 object-cover rounded-full">
                                <img src="{{ asset('roles_icons/MID.png') }}" alt="TOP" class="w-auto h-12">
                            </div>
                        </th>
                    </tr>
                    <tr class="align-middle">
                        <th>
                            <div class="mx-4">
                                {{ $game->team_red->getADC->first()->games->where('id', $game->id)->first()->pivot->kills }}
                                /{{ $game->team_red->getADC->first()->games->where('id', $game->id)->first()->pivot->deaths }}
                                /{{ $game->team_red->getADC->first()->games->where('id', $game->id)->first()->pivot->assists }}
                            </div>
                        </th>
                        <th>
                            <div class="mx-4"><img
                                    src="{{ asset($game->team_red->getADC->first()->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                    alt="{{ $game->team_red->getADC->first()->games->where('id', $game->id)->first()->pivot->champion->name }}"
                                    class="w-16 h-16 object-cover rounded-full">
                            </div>
                        </th>
                        <th>
                            <div class="mx-4">{{ $game->team_red->getADC->first()->nick }}<br><span
                                    class="text-gray-500">{{ $game->team_red->getADC->first()->name }}
                                    {{ $game->team_red->getADC->first()->lastname1 }}</span></div>
                        </th>
                        <th>
                            <div class="flex items-center">
                                <img src="{{ asset($game->team_red->getADC->first()->photo) }}"
                                    alt="{{ $game->team_red->getADC->first()->photo }}"
                                    class="w-36 h-36 object-cover rounded-full">
                                <img src="{{ asset('roles_icons/ADC.png') }}" alt="ADC" class="w-auto h-12">
                            </div>
                        </th>
                    </tr>
                    <tr class="align-middle">
                        <th>
                            <div class="mx-4">
                                {{ $game->team_red->getSupport->first()->games->where('id', $game->id)->first()->pivot->kills }}
                                /{{ $game->team_red->getSupport->first()->games->where('id', $game->id)->first()->pivot->deaths }}
                                /{{ $game->team_red->getSupport->first()->games->where('id', $game->id)->first()->pivot->assists }}
                            </div>
                        </th>
                        <th>
                            <div class="mx-4"><img
                                    src="{{ asset($game->team_red->getSupport->first()->games->where('id', $game->id)->first()->pivot->champion->square) }}"
                                    alt="" class="w-16 h-16 object-cover rounded-full"></div>
                        </th>
                        <th>
                            <div class="mx-4">{{ $game->team_red->getSupport->first()->nick }}<br><span
                                    class="text-gray-500">{{ $game->team_red->getSupport->first()->name }}
                                    {{ $game->team_red->getSupport->first()->lastname1 }}</span></div>
                        </th>
                        <th>
                            <div class="flex items-center">
                                <img src="{{ asset($game->team_red->getSupport->first()->photo) }}"
                                    alt="{{ $game->team_red->getSupport->first()->photo }}"
                                    class="w-36 h-36 object-cover rounded-full">
                                <img src="{{ asset('roles_icons/Support.png') }}" alt="TOP" class="w-auto h-12">
                            </div>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>

    @endsection
