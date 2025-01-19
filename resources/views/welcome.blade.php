<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('/assets/edit.svg') }}" type="image/x-icon">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/main.js'])
</head>
<body class="bg-slate-200">
    <header class="px-4 py-5 shadow-lg fixed w-full z-10 bg-slate-100">
        <h2 class="text-2xl font-bold text-violet-600">TodoApp</h2>
    </header>
    <main class="pt-24 px-4 blur-container">
        @if (session('success'))  
            @php
                $message = session('success');
                $messageType = strpos($message, 'berhasil dihapus') !== false ? 'error' : 'success';
                $bgClass = $messageType === 'error' ? 'bg-red-200' : 'bg-green-200';
            @endphp
            
            <section class="{{ $bgClass }} rounded-md px-3 pt-4 pb-2 mb-3 messageMdl">
                <div class="flex justify-between">
                    <p class="font-semibold text-lg">{{ $message }}</p>
                    <button class="font-bold closeMsg">X</button>
                </div>
                <div class="w-full">
                    <div class="bg-black w-0 h-1 rounded-md animate-loading" id="progressBar"></div>
                </div>
            </section>
        @endif

    
        
        <div class="flex flex-col gap-2">
            <h3 class="font-lg font-semibold">Create New Todo</h3>
            <form action="{{route('todo.post')}}" method="POST" class="border p-1 border-gray-500 rounded-md flex justify-between">
                @csrf
                <input type="text" name="todo" class="w-full outline-none bg-transparent px-3" placeholder="Your todo...">
                <button type="submit" class="bg-violet-600 text-white rounded-md font-semibold px-5 py-1">Submit</button>
            </form>
            <div class="w-full h-[0.1rem] bg-gray-500 mt-3"></div>
        </div>
        <section class="py-4">
            <h2 class="font-semibold text-xl">Your Todo</h2>
            <div class="flex flex-col gap-4 mt-4">
                @foreach ($data as $item)
                <div class="flex justify-between">
                    <p class="font-semibold text-lg cursor-pointer">{{$item->todo}}</p>
                    <form class="flex gap-2" method="POST" action="{{route('todo.destroy', ['id' => $item->id])}}">
                        @csrf
                        @method('delete')
                        <span class="editBtn" data-id="{{$item->id}}">
                            <img src="{{asset('/assets/edit.svg')}}" alt="" class="bg-yellow-500 w-10 p-2 rounded-md">
                        </span>
                        <button type="submit" onclick="return confirm('You sure?')">
                            <img src="{{asset('/assets/trash.svg')}}" alt="" class="bg-red-600 w-10 p-2 rounded-md">
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>
    </main> 
    @foreach ($data as $item)
        <section class="modal absolute hidden w-[90%]" data-id="{{$item->id}}">
            <div class="px-4 flex-col gap-2 bg-white rounded-md py-5">
                <h3 class="font-lg font-semibold">Edit Todo</h3>
                <form action="{{route('todo.update', ['id' => $item->id])}}" method="POST" class="border p-1 border-gray-500 rounded-md flex justify-between">
                    @csrf
                    @method('put')
                    <input type="text" name="todo" class="w-full outline-none bg-transparent px-3" placeholder="Your todo..." value="{{$item->todo}}">
                    <button type="submit" class="bg-violet-600 text-white rounded-md font-semibold px-5 py-1">Update</button>
                </form>
                <button class="closeModal bg-gray-300 px-3 py-1 mt-2 rounded">Close</button>
            </div>
        </section>       
    @endforeach      
</body>
</html>