<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>


<div class="max-w-xl mx-auto bg-gray-800 p-6 rounded-lg shadow mt-6 text-gray-200">

    <form action="/store" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block font-medium mb-1" for="question">Title</label>
            <input type="text" name="title"
                   class="w-full bg-gray-700 text-white border border-gray-600 rounded p-2 mb-2 focus:outline-none focus:ring focus:ring-indigo-500">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Body</label>
            <input type="text" name="content"
                   class="w-full bg-gray-700 text-white border border-gray-600 rounded p-2 mb-2 focus:outline-none focus:ring focus:ring-indigo-500">
        </div>

        <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded transition">
            Create
        </button>
    </form>
</div>
</body>
</html>
