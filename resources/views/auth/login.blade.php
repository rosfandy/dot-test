<x-app-layout>
    <div class=" bg-slate-100 min-h-screen">
        <div class="flex justify-center items-center min-h-screen">
            <form action="{{ route('auth.admin.login') }}" method="post"
                class="flex flex-col gap-y-4 bg-white p-12 rounded-xl shadow-md">
                @csrf
                <h1 class="text-2xl font-semibold">Login Form</h1>
                <div class="flex flex-col gap-y-2">
                    <span class="label-text">Email</span>
                    <input required name="email" type="email" placeholder="Your email"
                        class="input input-bordered w-[25em]" />
                </div>
                <div class="flex flex-col gap-y-2">
                    <span class="label-text">Password</span>
                    <input required name="password" type="password" placeholder="Password"
                        class="input input-bordered w-[25em]" />
                </div>
                <button type="submit" class="btn bg-[#3F87E5] text-white hover:bg-[#1f4593]">Login</button>
            </form>
        </div>
    </div>
</x-app-layout>
