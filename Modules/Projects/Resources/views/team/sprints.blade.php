
  <form method="post" action="{{ url('admin/project/team/save_sprint') }}"> 
   	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
   Sprint Name	<input type="text" name="sprint_name" value=""><br><br>
   Duration:<select name="duration" >
   	<option value="1">1week</option>
   	<option value="2">2week</option>
   	<option value="3">3week</option>
   	<option value="4">Custom</option>
   </select><br><br>
   Start date:<input type="date" name="start_date"><br><br>
   End date:<input type="date" name="end_date" ><br><br>
   Sprint goal:
   <textarea name="sprint_goal" rows="4" cols="50"></textarea>
  <br><br>
   <input type="submit" name="" value="Start Sprint">

   </form>