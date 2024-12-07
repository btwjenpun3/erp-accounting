<div>
    @script
        <script>
            $wire.on('show-success', function(data) {
                Toastify({
                    text: data,
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top",
                    position: "center",
                    stopOnFocus: true,
                    style: {
                        background: "green",
                    }
                }).showToast();
            });
            $wire.on('show-error', function(data) {
                Toastify({
                    text: data,
                    duration: 5000,
                    newWindow: true,
                    close: true,
                    gravity: "bottom",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "red",
                    }
                }).showToast();
            });
        </script>
    @endscript
</div>
