<?php
include "./includes/header.php";
?>

<div class="container">
    <h2>Signup</h2>
    <form action="" class=" my-5 px-5">
        <div class="d-flex justify-content-between">
            <div class="w-50">
                <label for="">First Name</label><span class="text-danger"> *</span>
                <input class=" w-75 form-control" type="text">
            </div>
            <div class="w-50">
                <label for="">Last Name</label><span class="text-danger"> *</span>
                <input class=" w-75 form-control" type="text">
            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <div class="w-50">
                <label for="">Email</label><span class="text-danger"> *</span>
                <input class=" w-75 form-control" type="email">
            </div>
            <div class="w-50">
                <label for="">Phone No.</label><span class="text-danger"> *</span>
                <input class=" w-75 form-control" type="tel">
            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <div class="w-50">
                <label for="">Country</label><span class="text-danger"> *</span><br>
                <select class="w-75 custom-select">
                    <option value="">Select Country</option>          
                </select>
            </div>
            <div class="w-50">
                <label for="">State</label><span class="text-danger"> *</span>
                <input class=" w-75 form-control" type="text">
            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <div class="w-50">
                <label for="">City</label><span class="text-danger"> *</span>
                <input class=" w-75 form-control" type="text">
            </div>
            <div class="w-50">
                <label for="">Postal Code</label><span class="text-danger"> *</span>
                <input class=" w-75 form-control" type="number">
            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <div class="w-50">
                <label for="">Address</label><span class="text-danger"> *</span>
                <input class=" w-75 form-control" type="text">
            </div>
            <div class="w-50">
                <label for="">Profile Picture</label><span class="text-danger"> *</span>
                <input class=" w-75 form-control" type="file">
            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <div class="w-50">
                <label for="">Password</label><span class="text-danger"> *</span>
                <input class=" w-75 form-control" type="password">
            </div>
            <div class="w-50">
                <label for="">Confirm Password</label><span class="text-danger"> *</span>
                <input class=" w-75 form-control" type="password">
            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <div class="w-50">
                <a type="submit" class="btn btn-dark w-50" href="">Signup</a>
            </div>
            <div class="w-50">
                <a  class="btn btn-danger w-50" href="">Back to Login</a>
            </div>
        </div>

    </form>
</div>


<?php
include "./includes/footer.php"
?>