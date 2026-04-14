<footer class="main-footer">
    <div class="footer-left">
        <a href="templateshub.net">Templateshub</a></a>
    </div>
    <div class="footer-right">
    </div>
</footer>
</div>
</div>

<!-- jQuery (required for template) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

<!-- Template JS -->
<script src="assets/js/app.min.js"></script>
<script src="assets/js/scripts.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom JS -->
<script src="assets/js/custom.js"></script>
<script>
    let alert = document.querySelector('.alert');
    // category
    setTimeout(() => {
        let params = new URLSearchParams(window.location.search);

        let success = params.get("success") || params.get("delete-success");

        if (success)
            window.location.assign("/admin/cat_table.php");
    }, 2000);
    // category

    // subcategoty
    setTimeout(() => {
        let params = new URLSearchParams(window.location.search);

        let progress = params.get("progress") || params.get("delete-progress");

        if (progress)
            window.location.assign("/admin/subcat_table.php");
    }, 2000);
    // subcategoty

    // supplier
    setTimeout(() => {
        let params = new URLSearchParams(window.location.search);

        let progress = params.get("supp") || params.get("delete-supp");

        if (progress)
            window.location.assign("/admin/supplier_table.php");
    }, 2000);
    // supplier
    // qty
    setTimeout(() => {
        let params = new URLSearchParams(window.location.search);

        let progress = params.get("qty") || params.get("qty-delete");

        if (progress)
            window.location.assign("/admin/qtyUnit_table.php");
    }, 2000);
    // qty
</script>

</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->

</html>