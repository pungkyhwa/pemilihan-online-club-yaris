<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('assets/js/main.js')) }}"></script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
<script>
    function fetchData() {
        fetch('/api/monitoring')
            .then(response => response.json())
            .then(responseData => {
                // Dapatkan elemen ul
                const dataList = document.getElementById('realtime-data-list');
                
                // Bersihkan elemen ul sebelum menambahkan item baru
                dataList.innerHTML = "";
                // Dapatkan array data dari properti 'data' objek respons
                const data = responseData.data;
                data.forEach(item => {
                    dataList.insertAdjacentHTML('beforeend', `<h6 class="mb-0">Nama: ${item.nm_mahasiswa}</h6> <small>Status: ${item.status_memilih}</small><hr>`);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    }
    // Panggil fetchData setiap 5 detik (misalnya)
    setInterval(fetchData, 5000);
    
    // Panggil fetchData untuk pertama kali saat halaman dimuat
    fetchData();
</script>