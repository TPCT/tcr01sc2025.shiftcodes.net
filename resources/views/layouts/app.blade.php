<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @section('seo')
    @show

    <style>
        a {
            text-decoration: none;

        }
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }
        .container {
            text-align: center;
            padding: 30px;
            border-radius: 10px;
            /* box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); */
            max-width: 400px;
            width: 100%;
        }
        h1 {
            font-size: 6rem;
            color: #3a1b50;
            margin: 0;
        }
        h2 {
            font-size: 1.5rem;
            color: #666;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 15px 30px;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .main-btn {
            background-color: #3a1b50;
            color: rgba(250, 250, 250, 1);
            padding: 0.5rem 2rem;
            border-radius: 45px;
            border: 1px solid transparent;
            width: fit-content;
            margin-block: 1rem;
        }
        .main-btn:hover {
            background-color: transparent;
            color: #3a1b50;
            border: 1px solid #3a1b50;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
