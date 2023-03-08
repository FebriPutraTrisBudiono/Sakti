<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>{{ $title_bar }}</title>
    <link href="/assets/css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.png" />
    <script data-search-pseudo-elements="" defer=""
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous">
    </script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body style="background-color: rgb(47, 47, 172)">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="/assets/js/scripts.js"></script>
    <script>
        $(document).ready(function() {
            formatStrNum('fee');
            formatStrNum('trx_amount');

            $('#username').on('keyup', function() {
                const username = $(this).val().toLowerCase().replace(/\W/g, '');
                $('#username').val(username);
            });

            const name = document.querySelector('#name');
            if (name) {
                name.addEventListener('change', function() {
                    fetch('/users/username?name=' + name.value)
                        .then(response => response.json())
                        .then(data => username.value = data.username)
                });
            }
        });

        function previewImage(fieldId, previewClass) {
            const image = document.querySelector('#' +
                fieldId);
            const imgPreview = document.querySelector('.' + previewClass);

            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(img) {
                imgPreview.src = img.target.result;
            }
        }

        function formatStrNum(inputId) {
            return $('#' + inputId).val() ? $('#' + inputId).val(numFormat($('#' + inputId).val().replace('.',
                    ','))) :
                '';
        }

        function strToNum(inputId) {
            const result = numFormat($('#' + inputId).val());
            return $('#' + inputId).val(result);
        }

        function numFormat(bilangan, prefix) {
            var number_string = bilangan.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
</body>

</html>
