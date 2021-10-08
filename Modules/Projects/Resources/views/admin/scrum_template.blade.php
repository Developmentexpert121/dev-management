@include('projects::admin.header')
<div class="container">  
  <div class="row">
    <div class="col">
      <div class="t_heading">Team Management</div>
      <div class="t_desc">Set up and maintained by your team.</div>
      <a href='{{url("admin/project/scrum/team_management")}}'> 
        <button class="t_btn" data-testid="project-template-select.ui.layout.screens.project-types.footer.select-project-button-team-managed" type="button" tabindex="0"><span class="css-19r5em7">Select a team management project</span></button>
      </a>
    </div>
    <div class="col">
      <div class="c_heading">Company Management</div>
      <div class="c_desc">Set up and maintained by your Jira admins</div>
      <a href='{{url("admin/project/scrum/company_management")}}'>  
        <button class="c_btn" data-testid="project-template-select.ui.layout.screens.project-types.footer.select-project-button-company-managed" type="button" tabindex="0"><span class="css-19r5em7">Select a company management project</span></button>
      </a>      
    </div>
  </div>
</div>
<style type="text/css">
  .t_heading , .c_heading { text-align: center; height: 30px; border-bottom: 2px solid rgb(101, 84, 192); border-top-color: rgb(101, 84, 192);
    border-right-color: rgb(101, 84, 192); border-left-color: rgb(101, 84, 192); margin-top: 32px; padding-bottom: 8px; color: rgb(82, 67, 170); font-size: 16px; font-weight: 500; }
  .t_desc, .c_desc { margin: 20px; font-weight: bold; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif; font-size: 14px; height: inherit; letter-spacing: normal; }
  .c_btn { -webkit-box-align: center; align-items: center; border-width: 0px; border-radius: 3px; box-sizing: border-box; display: flex; font-size: inherit; font-style: normal; font-family: inherit; font-weight: 500; max-width: 100%; position: relative;    text-align: center; text-decoration: none; transition: background 0.1s ease-out 0s, box-shadow 0.15s cubic-bezier(0.47, 0.03, 0.49, 1.38) 0s; white-space: nowrap; background: rgb(0, 82, 204); color: rgb(255, 255, 255); cursor: pointer; height: 48px; line-height: 40px; padding: 0px 10px; vertical-align: middle; width: 420px; -webkit-box-pack: center; justify-content: center;
    outline: none; margin: 0px 0px 6px; }
  .t_btn { -webkit-box-align: center; align-items: center; border-width: 0px; border-radius: 3px; box-sizing: border-box; display: flex; font-size: inherit; font-style: normal; font-family: inherit; font-weight: 500; max-width: 100%; position: relative; text-align: center; text-decoration: none; transition: background 0.1s ease-out 0s, box-shadow 0.15s cubic-bezier(0.47, 0.03, 0.49, 1.38) 0s; white-space: nowrap; background: rgb(82, 67, 170); color: rgb(255, 255, 255); cursor: pointer; height: 48px;  line-height: 40px; padding: 0px 10px; vertical-align: middle; width: 420px; -webkit-box-pack: center; justify-content: center;  outline: none; margin: 0px 0px 6px; }
  a { text-decoration: none; }
</style>
@include('projects::admin.footer')