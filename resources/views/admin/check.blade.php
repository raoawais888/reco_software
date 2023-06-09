<form id='price_from'>
  <div class='form-group'>
    <label for='recipient-name' class='col-form-label'>Select Brand</label>
     <select name='brand' id='product' class='form-control'>
       @foreach ($brand as $item)
           
       <option value='{{$item->id}}'>{{$item->brand}}</option>
       @endforeach
     </select>
  </div>
  <div class='form-group'>
    <label for='recipient-name' class='col-form-label'>Select Category</label>
     <select name='category' id='product' class='form-control'>
       @foreach ($category as $item)
           
       <option value='{{$item->id}}'>{{$item->category}}</option>
       @endforeach
     </select>
  </div>
  <div class='form-group'>
    <label for='recipient-name' class='col-form-label'>Product</label>
     <select name='product_id' id='product' class='form-control'>
       @foreach ($entry as $item)
           
       <option value='{{$item->id}}'>{{$item->name}}</option>
       @endforeach
     </select>
  </div>
  <div class='form-group'>
    <label for='recipient-name' class='col-form-label'>Actual Price</label>
    <input type='text' class='form-control'  name='a_price'>
  </div>
  <div class='form-group'>
    <label for='recipient-name' class='col-form-label'>Sale Price</label>
    <input type='text' class='form-control' id='price' name='price'>
  </div>
  
</form>