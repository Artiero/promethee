    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script>
        function updateBobot(selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const selectedBobot = selectedOption.getAttribute('data-bobot');
            const selectedKriteria = selectElement.name;

            // Kirim data bobot dan kriteria ke server menggunakan AJAX
            // Misalnya dengan menggunakan fetch atau library jQuery $.ajax()

            // Contoh menggunakan fetch:
            fetch('sub_kriteria.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        kriteria: selectedKriteria,
                        bobot: selectedBobot
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Lakukan sesuatu dengan respons dari server (jika diperlukan)
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>