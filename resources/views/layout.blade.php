<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    @yield('styles')
</head>
<body>
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const flashData = {
                success: @json(session('success')),
                error: @json(session('error')),
                info: @json(session('info'))
            };

            const styles = {
                success: { icon: 'success', iconColor: '#16a34a', progressColor: '#22c55e' },
                error: { icon: 'error', iconColor: '#dc2626', progressColor: '#ef4444' },
                info: { icon: 'info', iconColor: '#2563eb', progressColor: '#3b82f6' }
            };

            Object.entries(flashData).forEach(([type, message]) => {
                if (!message) {
                    return;
                }

                const style = styles[type];

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: style.icon,
                    iconColor: style.iconColor,
                    title: message,
                    showConfirmButton: false,
                    showCloseButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#ffffff',
                    customClass: {
                        popup: 'toast-premium'
                    },
                    showClass: {
                        popup: 'swal2-show'
                    },
                    hideClass: {
                        popup: 'swal2-hide'
                    },
                    didOpen: (toast) => {
                        const progressBar = toast.querySelector('.swal2-timer-progress-bar');
                        if (progressBar) {
                            progressBar.style.backgroundColor = style.progressColor;
                        }
                    }
                });
            });
        });
    </script>
    <style>
        .swal2-popup.toast-premium.swal2-toast {
            border-radius: 15px;
            box-shadow: 0 12px 26px rgba(15, 23, 42, 0.14);
            border: 1px solid #edf2f7;
        }
    </style>

    @yield('scripts')
</body>
</html>
