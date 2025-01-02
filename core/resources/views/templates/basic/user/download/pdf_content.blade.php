<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@lang('Document')</title>
    <!-- favicon -->
    <link type="image/png" href="https://picsum.photos/16/16" rel="icon" sizes="16x16" />
</head>
<style>
    @page {
        size: 8.27in 11.7in;
        margin: .5in;
    }

    body {
        font-family: "Arial", sans-serif;
        font-size: 14px;
        line-height: 1.5;
        color: #023047;
    }
</style>

<body>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="body">
                        <p>@php echo $content @endphp</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
