<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>

<style type="text/css">
div.dataTables_wrapper {
  width: 100%;
  margin: 0 auto;
}
</style>
</head>

<body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://almsaeedstudio.com/themes/AdminLTE/plugins/datatables/dataTables.bootstrap.css">

<script src="https://almsaeedstudio.com/themes/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://almsaeedstudio.com/themes/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js"></script>
<table class="data-table table table-bordered table-striped">
  <thead>
    <tr>
      <th class="all name">Name</th>
      <th class="all position">Position 1</th>
      <th class="all position">Position 2</th>
      <th class="all">Age</th>
      <th class="all">Start date</th>
      <th class="all">Salary</th>
      <th class="all">Name</th>
      <th class="all">Something</th>
      <th class="all">Something</th>
      <th class="all">Age</th>
      <th class="all">Start date</th>
      <th class="all">Salary</th>
      <th class="all">Name</th>
      <th class="all">Something</th>
      <th class="all">Something</th>
      <th class="all">Age</th>
      <th class="all">Start date</th>
      <th class="all">Salary</th>
      <th class="all">Something</th>
      <th class="all">Something</th>
      <th class="all">Something else</th>
      <th class="all">Age</th>
      <th class="all">Start date</th>
      <th class="all">Salary</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="all name">Tiger Nixon</td>
      <td class="all position">System Architect</td>
      <td class="all position">Edinburgh</td>
      <td class="all">61</td>
      <td class="all">2011/04/25</td>
      <td class="all">$320,800</td>
      <td class="all">Tiger Nixon</td>
      <td class="all">System Architect</td>
      <td class="all">Edinburgh</td>
      <td class="all">61</td>
      <td class="all">2011/04/25</td>
      <td class="all">$320,800</td>
      <td class="all">Tiger Nixon</td>
      <td class="all">System Architect</td>
      <td class="all">Edinburgh</td>
      <td class="all">61</td>
      <td class="all">2011/04/25</td>
      <td class="all">$320,800</td>
      <td class="all">Tiger Nixon</td>
      <td class="all">System Architect</td>
      <td class="all">Edinburgh</td>
      <td class="all">61</td>
      <td class="all">2011/04/25</td>
      <td class="all">$320,800</td>
    </tr>
    <tr>
      <td class="all name">Garrett Winters</td>
      <td class="all position">Accountant</td>
      <td class="all position">Tokyo</td>
      <td class="all">63</td>
      <td class="all">2011/07/25</td>
      <td class="all">$170,750</td>
      <td class="all">Tiger Nixon</td>
      <td class="all">System Architect</td>
      <td class="all">Edinburgh</td>
      <td class="all">61</td>
      <td class="all">2011/04/25</td>
      <td class="all">$320,800</td>
      <td class="all">Tiger Nixon</td>
      <td class="all">System Architect</td>
      <td class="all">Edinburgh</td>
      <td class="all">61</td>
      <td class="all">2011/04/25</td>
      <td class="all">$320,800</td>
      <td class="all">Tiger Nixon</td>
      <td class="all">System Architect</td>
      <td class="all">Edinburgh</td>
      <td class="all">61</td>
      <td class="all">2011/04/25</td>
      <td class="all">$320,800</td>
    </tr>
    <tr>
      <td class="all name">Ashton Cox</td>
      <td class="all position">Junior Technical Author</td>
      <td class="all position">San Francisco</td>
      <td class="all">66</td>
      <td class="all">2009/01/12</td>
      <td class="all">$86,000</td>
      <td class="all">Tiger Nixon</td>
      <td class="all">System Architect</td>
      <td class="all">Edinburgh</td>
      <td class="all">61</td>
      <td class="all">2011/04/25</td>
      <td class="all">$320,800</td>
      <td class="all">Tiger Nixon</td>
      <td class="all">System Architect</td>
      <td class="all">Edinburgh</td>
      <td class="all">61</td>
      <td class="all">2011/04/25</td>
      <td class="all">$320,800</td>
      <td class="all">Tiger Nixon</td>
      <td class="all">System Architect</td>
      <td class="all">Edinburgh</td>
      <td class="all">Edinburgh</td>
      <td class="all">Edinburgh</td>
      <td class="all">61</td>
    </tr>
  </tbody>
</table>
<script type="text/javascript">
$('.data-table').DataTable({
  "scrollX": true,
  initComplete: function(settings) {
    $('<div style="float:right;min-width:200px"><div style="float:right;"><select name="productgroup" class="productgroup form-control select2" style="width: 100%;"><option value="all">All</option><option value="name">Name</option><option value="position">Position</option><option value="office">Office</option><option value="age">Age</option><option value="startdate">Startdate</option><option value="salary">Salary</option></select></div><div style="float:right;margin:4px 10px 10px">Filter</div></div>').appendTo($("#DataTables_Table_0_filter"));
    $("select").on("change", function() {
      var product = $(this).val();
      $(".all").hide();
      $("." + product).show();
      var api = new $.fn.dataTable.Api(settings);
      api.columns.adjust().draw();
    });

  }
});
</script>
</body>
</html>