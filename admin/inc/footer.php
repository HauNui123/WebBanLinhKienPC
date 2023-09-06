<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>

<script>
    // Lấy tham chiếu đến các phần tử cần sử dụng
    const searchInput = document.getElementById('search_query');
    const searchButton = document.getElementById('search_button');

    // Bắt sự kiện click trên nút tìm kiếm
    searchButton.addEventListener('click', function() {
        // Lấy giá trị nhập liệu từ ô tìm kiếm
        const searchQuery = searchInput.value;

        // Chuyển hướng đến trang tìm kiếm với giá trị nhập liệu
        window.location.href = 'search.php?search_query=' + encodeURIComponent(searchQuery);
    });
</script>

</body>

<footer class="bg-light">
    <div class="d-flex justify-content-center mt-4">
        <p>©Sunshine All rights reserved</h2>
    </div>
</footer>

</html>