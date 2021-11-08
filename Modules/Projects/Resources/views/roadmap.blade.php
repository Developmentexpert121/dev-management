@include('projects::admin.header')



<div class="container">
 <section class="" style="background-color: #eee;">
    <div class="custom_div">
      <div class="row">
        <div class="col-md-12">
          <div class="card rounded-3">
            <div class="card-body p-4">
              <a href=""><span class="project-button"> Projects</a> / <a href="">Team</a>
              <h3 class="button my-3 pb-3">Roadmap</h3>
          
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<style type="text/css">
  .form-outline { margin: 7px; }
  .btn { width: 100%; }
  section { height: auto!important; }
  #projects_table_wrapper{ margin-left: 15px; margin-top: 15px; }
  .table-striped tbody tr:nth-of-type(odd){ background-color: unset !important; }
  .table-striped > tbody > tr:nth-of-type(odd){ --bs-table-accent-bg: unset !important; }
  .form-control:disabled, .asColorPicker-input:disabled, .dataTables_wrapper select:disabled, .select2-container--default .select2-selection--single:disabled, .select2-container--default .select2-selection--single .select2-search__field:disabled, .typeahead:disabled, .tt-query:disabled, .tt-hint:disabled, .form-control:read-only, .asColorPicker-input:read-only, .dataTables_wrapper select:read-only, .select2-container--default .select2-selection--single:read-only, .select2-container--default .select2-selection--single .select2-search__field:read-only, .typeahead:read-only, .tt-query:read-only, .tt-hint:read-only {
    background-color: #fff !important;
    opacity: 1; }
    input#attachment {
    height: 37px;
}
</style>
@include('projects::admin.footer')