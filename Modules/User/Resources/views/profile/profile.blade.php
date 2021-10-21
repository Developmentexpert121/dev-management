
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<header>
	@include('user::profile.header')
</header>

<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h4>
                                       Worked on
                                    </h4>
                                    <span>Others will only see what they can access.</span>
                                    <p class="proile-rating">RANKINGS : <span>8/10</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>WORK LINK</p>
                            <h4>{{$task->name}}</h4>
                            <svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><path fill="currentColor" fill-rule="evenodd" d="M17 14h2V9H5v5h2v-1a1 1 0 012 0v1h6v-1a1 1 0 012 0v1zm0 2v1a1 1 0 01-2 0v-1H9v1a1 1 0 01-2 0v-1H5v3h14v-3h-2zM9 7h6V6H9v1zM7 7V5a1 1 0 011-1h8a1 1 0 011 1v2h2a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2h2z"></path></svg>
                            <a href=""><input type="text" name="your-job-tittle" placeholder="your-job-tittle"></a><br/><br/>

                            <svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><path fill="currentColor" d="M11 5v2h2V5h-2zm0 6V9h-1a1 1 0 01-1-1V4a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-1v2h5a1 1 0 011 1v3h1a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4a1 1 0 011-1h1v-2H7v2h1a1 1 0 011 1v4a1 1 0 01-1 1H4a1 1 0 01-1-1v-4a1 1 0 011-1h1v-3a1 1 0 011-1h5zm-6 6v2h2v-2H5zm12 0v2h2v-2h-2z"></path></svg>
                            <a href=""><input type="text" name="" placeholder="Your department"></a><br/><br/>

                            <svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><g fill="currentColor" fill-rule="evenodd"><path d="M8 6H5.009C3.902 6 3 6.962 3 8.15v10.7C3 20.04 3.9 21 5.009 21h5.487H8v-2.145c-1.616-.001-3-.003-3-.004 0 0 .005-10.708.009-10.708L8 8.144V6z" fill-rule="nonzero"></path><path d="M12 7h2v2h-2zm-6 3h2v2H6zm0 3h2v2H6zm6-3h2v2h-2zm0 3h2v2h-2zm2 3h2v3h-2zm2-9h2v2h-2zm0 3h2v2h-2zm0 3h2v2h-2z"></path><path d="M18.991 19C18.998 19 19 4.995 19 4.995c0 .006-7.991.005-7.991.005C11.002 5 11 19 11 19h7.991zM9 4.995C9 3.893 9.902 3 11.009 3h7.982C20.101 3 21 3.893 21 4.995v14.01A2.004 2.004 0 0118.991 21H9V4.995z" fill-rule="nonzero"></path></g></svg>
                            <a href=""><input type="text" name="your-organisation" placeholder="Your organisation"></a><br><br>

                           
                            <svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><path d="M12 21c-2.28 0-6-8.686-6-12a6 6 0 1112 0c0 3.314-3.72 12-6 12zm0-9a2.912 2.912 0 100-5.824A2.912 2.912 0 0012 12z" fill="currentColor" fill-rule="evenodd"></path></svg>
                            <a href=""><input type="text" name="your-location" placeholder="Your location"></a><br/><br/>
                            <span>Contact</span>
                            <div><svg width="24" height="24" viewBox="0 0 24 24" role="presentation"><g fill="currentColor" fill-rule="evenodd"><path d="M5 7v10h14V7H5zm14-2c1.1 0 2 .9 2 2v10c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2V7c0-1.1.9-2 2-2h14z" fill-rule="nonzero"></path><path d="M5.498 6.5H3.124c.149.44.399.854.75 1.205l5.882 5.881a3.117 3.117 0 004.41 0l5.882-5.881c.35-.351.6-.765.749-1.205h-2.373l-5.672 5.672a1.119 1.119 0 01-1.583 0L5.498 6.5z"></path></g></svg>
                            <span>{{$task->email}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Kshiti123</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Kshiti Ghelani</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>kshitighelani@gmail.com</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>123 456 7890</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Profession</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Web Developer and Designer</p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Experience</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Expert</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Hourly Rate</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>10$/hr</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Total Projects</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>230</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>English Level</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Expert</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Availability</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>6 months</p>
                                            </div>
                                        </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Your Bio</label><br/>
                                        <p>Your detail description</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>

        