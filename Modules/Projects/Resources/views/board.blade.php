@include('projects::admin.header')
<div class="main-panel">    
  <div class="content-wrapper">


    <div class="row">
      <div class="col-md-6">
        <div class="project_detail">
           <p>Project / teammmmm</p>  
           <h2>TM Sprint 2</h2>  
           <p>fd</p>
      </div>
     </div>
     </div>


    <div class="row mt-3">
      <div class="col-md-6">
        <div class="filer-search">  
            <input type="text" placeholder="filter issues"> 
            <i class="icon-search"></i>
        </div>
      </div> 
      <div class="col-md-6"></div>
    </div>  
     
    <div class="row mt-3">

      <div class="col-md-4 table_head border-right">
        <p>TO DO 2 ISSUES</p>  
        <div class="ticket">
          <span>USER</span>
          <p>TM-3</p> 
        </div>

      </div> 
      
      <div class="col-md-4 table_head border-right">
        <p>IN PROGRESS</p>
          
      </div>

      <div class="col-md-4 table_head" >
        <p>DONE</p> 
        
      </div>  

    </div>  

  </div>
</div>


@include('projects::team.footer')

<style>
  .table_head p{

    font-size:14px;
    color:#5e6c84;
    font-weight:600;

  }
  .filer-search {

    width: 40%;
    float: left;
    position: relative;

} 
.filer-search input { 

    width: 100%;  
    border: 1px solid #999;  
    border-radius: 4px;  
    padding: 5px 6px; 

}
.filer-search i.icon-search {

    position: absolute;  
    right: 5px;  
    top: 50%;  
    transform: translate(0px, -50%);  

}
.project_detail p {

  color:#6B778C !important; 

}
.project_detail h2 {
  font-size: 28px;  
}
.ticket {
    width: 100%;
    float: left;
    box-shadow: -1px 1px 3px #999;
    padding: 15px 10px;
    border-radius: 5px;
    margin-bottom:20px;
}
.ticket span {
  font-size: 15px;
    font-weight: 600;
    margin-bottom:10px;
}
.ticket p{
  margin-top: 20px;
}
</style>