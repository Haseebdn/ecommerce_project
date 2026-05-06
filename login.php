<?php  
include "./includes/header.php";
?>

<div class="container my-5">
    <h2>Login</h2>
    <form class="my-4 px-5" action="">
        <div class="d-flex justify-content-between">
            <div class="w-50">
                <label for="">Email</label>
                <input class="form-control w-75" type="email">
            </div>
            <div class="w-50">
                <label for="">Password</label>
                <input class="form-control w-75" type="password ">
            </div>
        </div>
        <div class=" my-4 d-flex justify-content-between">
            <div class="w-50">
            <a type="submit" class="btn btn-dark w-25" href="">Login</a>
            </div>
            <div class="w-50">
            <a class="btn btn-danger w-25" href="">Signup</a>
            </div>
        </div>
        
    </form>
</div>

<?php  
include "./includes/footer.php";
?>