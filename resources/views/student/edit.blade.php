<x-app-layout>
    <div class="bg-slate-100 min-h-screen justify-center items-center w-full flex">
        <form id="updateStudentForm" class="bg-white rounded-xl shadow scroll-p-12">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $data->name) }}"
                    class="input input-bordered">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $data->email) }}"
                    class="input input-bordered">
            </div>

            <div class="mb-4">
                <label for="room" class="block text-sm font-medium text-gray-700">Room</label>
                <select name="room_id" id="room" class="select select-bordered">
                    <option disabled {{ is_null(old('room', $data->room->id ?? null)) ? 'selected' : '' }}>Pilih Ruangan
                    </option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}"
                            {{ old('room', $data->room->id ?? null) == $room->id ? 'selected' : '' }}>
                            {{ $room->name }}
                        </option>
                    @endforeach
                </select>

            </div>

            <div class="mt-6">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow focus:outline-none">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
<script>
    const jwtToken = "{{ $token }}";

    $(document).ready(function() {
        $('#updateStudentForm').on('submit', function(e) {
            e.preventDefault();

            const formData = {
                name: $('#name').val(),
                email: $('#email').val(),
                room_id: $('#room').val()
            };

            $.ajax({
                url: "{{ route('student.update', ['id' => $data->id]) }}",
                type: 'PUT',
                contentType: 'application/json',
                headers: {
                    'Authorization': `Bearer ${jwtToken}`
                },
                data: JSON.stringify(formData),
                success: function(data) {
                    if (data.status == 200) {
                        alert('Update successful');
                        window.location.href = '/dashboard';
                    } else {
                        alert('Update failed: ' + data.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred: ' + error);
                }
            });
        });
    });
</script>
