<x-app-layout>
    <div class="bg-slate-100 min-h-screen justify-center items-center w-full flex">
        <form id="storeRoomForm" class="bg-white rounded-xl shadow scroll-p-12">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="input input-bordered" required>
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow focus:outline-none">
                    Save
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

<script>
    const jwtToken = "{{ $token }}";

    $(document).ready(function() {
        $('#storeRoomForm').on('submit', function(e) {
            e.preventDefault();

            const formData = {
                name: $('#name').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                room_id: $('#room').val()
            };

            $.ajax({
                url: "{{ route('room.store') }}",
                type: 'POST',
                contentType: 'application/json',
                headers: {
                    'Authorization': `Bearer ${jwtToken}`
                },
                data: JSON.stringify(formData),
                success: function(data) {
                    if (data.status == 201) {
                        alert('Data saved successfully');
                        window.location.href = '/dashboard';
                    } else {
                        alert('Save failed: ' + data.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred: ' + JSON.stringify(JSON.parse(xhr
                        .responseText).error));
                }
            });
        });
    });
</script>
