<div class='row'>
  <div class='col-md-12'>
      <div class='form-group'>
          <label for=''>Name</label>
          <input type='text' class='form-control' id='name' name='name' value='' required>
        </div>
  </div>
  <div class='col-md-12'>
      <div class='form-group'>
          <label for=''>Number</label>
          <input type='text' class='form-control' id='number' name='number' value='' required>
        </div>
  </div>
  <div class='col-md-12'>
      <div class='form-group'>
          <label for=''>CNIC NUMBER</label>
          <input type='text' class='form-control' id='cnic' name='cnic'  value='' required>
        </div>
  </div>
  <div class='col-md-12'>
      <div class='form-group'>
          <label for=''>Employee Code</label>
          <input type='text' class='form-control' id='code' name='code'  value='' required>
        </div>
  </div>
  <div class='col-md-12'>
      <div class='form-group'>
          <label for=''>Select  Branch</label>
          <select name='branch' id='branch' class='form-control' required>
              @foreach ($branch as $data)
                  
              <option value='{{$data->id}}'>{{$data->name}}</option>
              @endforeach
          </select>
        </div>
  </div>
  <div class='col-md-12'>
      <div class='form-group'>
          <label for='Invoice No'>Salary</label>
          <input type='text' class='form-control' id='salary' name='salary' value='' required>
        </div>
  </div>

</div>
  
  





  
  <button type='submit'  class='btn btn-primary'>Add Employee </button>


</div>
