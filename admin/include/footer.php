<footer class="main-footer">
    <div class="footer-left">
        <a href="templateshub.net">Templateshub</a></a>
    </div>
    <div class="footer-right">
    </div>
</footer>
</div>
</div>

<!-- General JS Scripts -->
<script src="assets/js/app.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>

<!-- Custom JS File -->
<script src="assets/js/custom.js"></script>
<script>
    let alert = document.querySelector('.alert');

    setTimeout(() => {
        let params = new URLSearchParams(window.location.search);

        let success = params.get("success") || params.get("delete-success");

        if (success)
            window.location.assign("/admin/export-table.php");
    }, 2000);
</script>

</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->

</html>