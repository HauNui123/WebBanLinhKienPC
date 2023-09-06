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

<script>
    var showPasswordCheckbox = document.getElementById("showPasswordCheckbox");
    var passwordInput = document.getElementById("password");

    showPasswordCheckbox.addEventListener("change", function() {
        if (showPasswordCheckbox.checked) {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });
</script>

</body>

<footer class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4><b>Liên kết</b></h4>
                <ul>
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="#">Về chúng tôi</a></li>
                    <li><a href="#">Dịch vụ</a></li>
                    <li><a href="contact.php">Liên hệ</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4><b>Liên hệ</b></h4>
                <p>Địa chỉ: 123 ABC, Quận 1, TP.HCM</p>
                <p>Email: info@website.com</p>
                <p>Điện thoại: 123456789</p>
                <div class="col-md-4">
                    <div class="d-flex">
                        <a href="#" class="btn btn-light btn-sm me-2"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="btn btn-light btn-sm me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="btn btn-light btn-sm me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-light btn-sm me-2"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h4><b>Bản đồ</b></h4>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.0574538963074!2d106.62602617490832!3d10.806911689343718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752be27d8b4f4d%3A0x9f7b3cc581e940f5!2zMTQwIEzDqiBUcuG7jW5nIFThuqVuLCBUw6J5IFRo4bqhbmgsIFTDom4gUGjDuiwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1684656341087!5m2!1svi!2s" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</footer>


</html>