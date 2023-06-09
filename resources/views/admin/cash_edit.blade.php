

<div class="form-group">
    <label for="recipient-name" class="col-form-label">Date</label>
    <input type="Date" class="form-control" id="edit_date" name="date" value="{{$result->date}}">
  </div>

  <input type="hidden"  value="{{$result->id}}" name="id"  id="u_id">

  <div class="form-group">
    <label for="recipient-name" class="col-form-label">Amount</label>
    <input type="text" class="form-control" id="edit_amount" name="amount" value="{{$result->amount}}">
  </div>
