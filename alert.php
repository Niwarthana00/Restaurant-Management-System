<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alert Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.onload = function() {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const type = urlParams.get('type') || 'info'; 
            const title = urlParams.get('title') || 'Notification';
            const message = urlParams.get('message') || 'No message provided.';
            const redirect = urlParams.get('redirect') || '';

            Swal.fire({
                title: title,
                text: message,
                icon: type,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed && redirect) {
                    window.location.href = redirect;
                }
            });
        };
    </script>
</body>
</html>
