@props(['title', 'data' => []])

<div class="bg-white shadow p-8 rounded-xl">
    <div class="flex justify-between items-center pb-8">
        <div class="font-semibold pb-4">Data {{ $title }}</div>
        @if ($title == 'Rooms')
            <a href="{{ route('pages.room.store') }}">
                <button class="btn bg-[#3F87E5] text-white"><i class="fas fa-plus"></i></button>
            </a>
        @elseif($title == 'Students')
            <a href="{{ route('pages.student.store') }}">
                <button class="btn bg-[#3F87E5] text-white"><i class="fas fa-plus"></i></button>
            </a>
        @endif
    </div>
    <div class="overflow-auto max-h-[30vh] ">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>#</th>
                    @if ($title == 'Rooms')
                        <th>Room Name</th>
                        <th>Action</th>
                    @elseif($title == 'Students')
                        <th>Name</th>
                        <th>Email</th>
                        <th>Room</th>
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        @if ($title == 'Rooms')
                            <td>{{ $item->name }}</td>
                            <td>
                                <div class="flex gap-x-2 cursor-pointer">
                                    <a href="{{ route('pages.room.edit', ['id' => $item->id]) }}">
                                        <i class="fas fa-pen"></i>
                                        <div>Edit</div>
                                    </a>
                                </div>
                            </td>
                        @elseif($title == 'Students')
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->room->name ?? 'N/A' }}</td>
                            <td>
                                <div class="flex gap-x-2 cursor-pointer">
                                    <a href="{{ route('pages.student.edit', ['id' => $item->id]) }}">
                                        <i class="fas fa-pen"></i>
                                        <div>Edit</div>
                                    </a>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
