<x-app-layout>
    <div class=" bg-slate-100 min-h-screen ">
        <div class="flex flex-col w-full items-center p-8">
            <h1 class="font-semibold text-3xl">Dashboard</h1>
            <div class="flex flex-col gap-y-8 w-1/2 my-4 p-4">
                <x-table title="Rooms" :data="$rooms"></x-table>
                <x-table title="Students" :data="$students"></x-table>
            </div>
            <form action="{{ route('auth.admin.logout') }}" method="POST" class="my-4">
                @csrf
                <button type="submit" class="btn bg-[#3F87E5] text-white">
                    <i class="fas fa-right-from-bracket"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
