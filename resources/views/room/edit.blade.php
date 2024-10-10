<x-app-layout>
    <div class="bg-slate-100 min-h-screen justify-center items-center w-full flex">
        <form id="updateRoomForm" class="bg-white rounded-xl shadow scroll-p-12 p-12">
            <h1 class="text-2xl font-semibold pb-4">Edit Room</h1>
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $data->name) }}"
                    class="input input-bordered w-[20em]">
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow focus:outline-none">
                    Update
                </button>
                <button id="deleteButton" type="button"
                    class="px-4 py-2 bg-red-600 text-white font-semibold rounded-md shadow focus:outline-none">
                    Delete
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
<script>
    const jwtToken = "{{ $token }}";

    $(document).ready(function() {
        $('#updateRoomForm').on('submit', function(e) {
            e.preventDefault();

            const formData = {
                name: $('#name').val(),
            };

            $.ajax({
                url: "{{ route('room.update', ['id' => $data->id]) }}",
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

        $('#deleteButton').on('click', function() {
            if (confirm('Are you sure you want to delete this room?')) {
                $.ajax({
                    url: "{{ route('room.destroy', ['id' => $data->id]) }}",
                    type: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${jwtToken}`
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            alert('Delete successful');
                            window.location.href = '/dashboard';
                        } else {
                            alert('Delete failed: ' + data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('An error occurred: ' + error);
                    }
                });
            }
        });
    });
</script>
