<!DOCTYPE html>
<html lang="en">
    <header>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
         <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="http://localhost/dev-management/Modules/User/Resources/views/profile/js/scripts.js"></script>
        <title>Manage Your Account</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="http://localhost/dev-management/Modules/User/Resources/views/profile/css/styles.css" rel="stylesheet" />

    </header>
    <body>
        
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">

                <div class="sidebar-heading border-bottom bg-light">Atlassian account</div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{  url('admin/user/manage-profile/profile-and-visibility') }}">profile-and-visibility</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{url('admin/user/profile-email')}}">Email</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{  url('admin/user/change-password') }}">Security</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Account preferences</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Connected apps</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Products</a>
                </div>
            </div>
        
    </body>

</html>
<style type="text/css">
    #sidebar-wrapper {
    margin-left: 65px;
}
.fa-eye{

cursor: pointer;
}
div#wrapper {
    margin-top: 18px;
}
.container {
    margin-left: 5%;
    margin-right: 10%;
    margin-bottom: 2%;
}
span {
    font-size: 13px;
}
.col-sm-8 {
    padding: 10px;
}
form {
    font-size: small;
}
.profile_box {
    background-color: #d5d746ab;
}
img#image_preview_container {
    height: 100px;
    margin-top: 10px;
}
.contentdata {
    padding-top: 25px;
}
.mt-2 {
    margin-bottom: 10%;
}
</style>