@include('user::admin.header')
<div class="container">
  <div class="row add_project">
    <div class="col-md-2">
      <img src="{{asset('storage/create_project/scrum1.svg')}}">
    </div>
    <div class="col-md-10 mr_top">
      <a href=''>
        <h4 algin='center'>Kanban</h4>
      </a>
    </div>
  </div>
  <div class="row add_project">
    <div class="col-md-2">
      <img src="{{asset('storage/create_project/scrum2.svg')}}">
    </div>
    <div class="col-md-10 mr_top">
      <a href='{{url("cto/project/scrum/template")}}'> 
        <h4  algin='center'>Scrum</h4> 
      </a>
    </div>
  </div>
  <div class="row add_project">
    <div class="col-md-2">
      <img src="{{asset('storage/create_project/scrum3.svg')}}">
    </div>
    <div class="col-md-10 mr_top">
      <a href=''>
        <h4  algin='center'>Bug tracking</h4> 
      </a>
    </div> 
  </div>
  <style type="text/css">
    .mr_top{ width: 70%; display: flex; -webkit-box-pack: center; justify-content: center; flex-direction: column; padding: 0px 24px; }
    a { text-decoration: none; }
    a:hover { text-decoration: none; }
    .mr_top h4 { font-size: 1.42857em; font-style: inherit; line-height: 1.2; color: var(--text-highEmphasis,#172B4D); font-weight: 500; letter-spacing: -0.008em; /* margin-top: 28px; */ display: flex; -webkit-box-align: center; align-items: center; }
    .add_project{ display: flex; overflow: hidden; margin: 16px 0px; padding: 0px; width: 100%; border: none; height: 110px;
    background-color: rgb(255, 255, 255); border-radius: 8px; box-shadow: rgb(9 30 66 / 13%) 0px 1px 1px, rgb(9 30 66 / 13%) 0px 0px 1px; cursor: pointer; }
    .add_project:hover {  box-shadow: rgb(9 30 66 / 13%) 0px 4px 8px 0px; }
    img { width: 105px; height: 70px; }
  </style>
</div>
@include('projects::admin.footer')