<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    @page {
        margin: 0 0pt;
        font-family: 'Roboto', sans-serif, monospace
    }


    main {
        margin: 0px;
        padding: 0px;
        width: 100%;
        font-size: 7.5pt;
    }

    table {
        width: 100%;
    }

    h6 {
        margin: 0;
    }
</style>

<body>
    <main>
        <table>
            <tbody>
                @foreach ($data as $group)
                <tr>
                    @foreach ($group as $item)
                    @if (isset($item['id']))
                    <td style="text-align:center; padding: 2.5pt 8.3386pt; width: 33%">
                        <h6>INVENTARIO 2024</h6>
                        <img style="margin: 3pt 0;"
                            src="data:image/png;base64,{{ $item["barcode64"] }}" alt=""
                            width="100%" height="14pt">
                        <h6>{{ $item['barcode'] }}</h6>
                    </td>
                    @else
                    <td style="text-align:center; padding: 2.5pt 8.3386pt; width: 33%">

                    </td>
                    @endif
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>

    </main>
</body>

</html>