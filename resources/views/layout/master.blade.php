<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>POS</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{asset('css/simplebar.css')}}">
    <!-- Fonts CSS -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{asset('css/feather.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('css/uppy.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.steps.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/quill.snow.css')}}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{asset('css/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.css')}}">
    <!-- App CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('css/app-light.css')}}" id="lightTheme">
    <link rel="stylesheet" href="{{asset('css/app-dark.css')}}" id="darkTheme" disabled>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
<style>
  .loader{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.9);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    visibility: hidden;
  }
  .error{
    color: red !important ;
    margin-top: 10px;
  }
</style>
  </head>
  <body class="vertical  light"  onload='return my_curr_date();'>
    <div class="wrapper">
      <nav class="topnav navbar navbar-light">
        <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
          <i class="fe fe-menu navbar-toggler-icon"></i>
        </button>
        <form class="form-inline mr-auto searchform text-muted">
          <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
        </form>
        <ul class="nav">



          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="avatar avatar-sm mt-2">
                <img src="{{asset('./img/IMG-20220131-WA0019.jpg')}}" alt="..." class="avatar-img rounded-circle">
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Profile</a>
              <a class="dropdown-item" href="#">Settings</a>
              <a class="dropdown-item" href="{{url('logout')}}">Logout</a>
            </div>
          </li>
        </ul>
      </nav>
      <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
          <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">
          <!-- nav bar -->
          <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
              <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                <g>
                  <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                  <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                  <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                </g>
              </svg>
            </a>
          </div>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link" href="{{url('dashboard')}}">
                  <i class="fe fe-home fe-16"></i>
                  <span class="ml-3 item-text">Dashboard</span>
                </a>
              </li>
          </ul>
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Menu Section</span>
          </p>

          <ul class="navbar-nav flex-fill w-100 mb-2">


            <li class="nav-item">
                <a class="nav-link" href="{{url('product')}}">
                  <i class='bx bx-cart-download'></i>
                  <span class="ml-3 item-text">Product</span>
                </a>
              </li>
            <li class="nav-item dropdown">
              <a href="#tables" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class='bx bx-edit'></i>
                <span class="ml-3 item-text">Entry</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="tables">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('add_entry')}}"><span class="ml-1 item-text">Add Entry</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('entry')}}"><span class="ml-1 item-text">View Entry</span></a>
                </li>

              </ul>
            </li>
            <li class="nav-item w-100">
              <a class="nav-link" href="{{url('category')}}">
                <i class='bx bx-align-right'></i>
                <span class="ml-3 item-text">Category</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="nav-link" href="{{url('brand')}}">
                <i class='bx bxl-bootstrap'></i>
                <span class="ml-3 item-text">Brand</span>
              </a>
            </li>


            <li class="nav-item w-100">
              <a class="nav-link" href="{{url('price')}}">
                <i class='bx bx-dollar'></i>
                <span class="ml-3 item-text">Add Price</span>
              </a>
            </li>


            <li class="nav-item dropdown">
              <a href="#purchase" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class='bx bxl-product-hunt'></i>
                <span class="ml-3 item-text">Purchase</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="purchase">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('add_purchase')}}"><span class="ml-1 item-text">Add Purchase</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('purchase')}}"><span class="ml-1 item-text"> View Purchase</span></a>
                </li>

              </ul>
            </li>
            <li class="nav-item dropdown">
              <a href="#purchase_return" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class='bx bxl-product-hunt'></i>
                <span class="ml-3 item-text">Purchase Return</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="purchase_return">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('add_purchase_return')}}"><span class="ml-1 item-text">Add Purchase Return</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('purchase_return')}}"><span class="ml-1 item-text"> View Purchase Return</span></a>
                </li>

              </ul>
            </li>

            <li class="nav-item dropdown">
              <a href="#charts" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class='bx bxs-dollar-circle'></i>
                <span class="ml-3 item-text">Sale Invoice</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="charts">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('add_bill')}}"><span class="ml-1 item-text">Add Sale Invoice</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('bill')}}"><span class="ml-1 item-text">View Sale Invoice</span></a>
                </li>

              </ul>
            </li>

            <li class="nav-item dropdown">
              <a href="#sale_return" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class='bx bxs-dollar-circle'></i>
                <span class="ml-3 item-text">Sale Return</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="sale_return">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('add_sale_return')}}"><span class="ml-1 item-text">Add Sale Return</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('sale_return')}}"><span class="ml-1 item-text"> View Sale Return</span></a>
                </li>

              </ul>
            </li>


            <li class="nav-item dropdown">
              <a href="#contact" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class='bx bxs-spreadsheet'></i>
                <span class="ml-3 item-text">Expense</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="contact">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('add_expense')}}"><span class="ml-1 item-text">Add Expense</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('expense')}}"><span class="ml-1 item-text">View Expense</span></a>
                </li>
                <li class="nav-item w-100">
                  <a class="nav-link" href="{{url('cash')}}">
                    <span class="ml-3 item-text">Cash On Hand</span>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a href="#employee" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class='bx bxs-user'></i>
                <span class="ml-3 item-text">Employee</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="employee">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('add_employee')}}"><span class="ml-1 item-text">Add Employee</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('employee')}}"><span class="ml-1 item-text">View Employee</span></a>
                </li>

              </ul>
            </li>

            <li class="nav-item dropdown">
              <a href="#attendance" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class='bx bx-fingerprint'></i>
                <span class="ml-3 item-text">Attendance</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="attendance">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('attendance')}}"><span class="ml-1 item-text">Add Attendance</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('view_attendance')}}"><span class="ml-1 item-text">View Attendance</span></a>
                </li>

              </ul>
            </li>

            <li class="nav-item dropdown">
              <a href="#stock" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class='bx bxs-cart-alt'></i>
                <span class="ml-3 item-text">Stock</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="stock">


                <li class="nav-item">
                    <a class="nav-link pl-3" href="{{url('check_stock')}}"><span class="ml-1 item-text">Check Stock</span></a>
                 </li>

                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('add_stock')}}"><span class="ml-1 item-text">Stock Transfer</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('stock')}}"><span class="ml-1 item-text">View  Stock Transfer</span></a>
                </li>



              </ul>
            </li>



            <li class="nav-item dropdown">
              <a href="#salary" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class='bx bxs-bank'></i>
                <span class="ml-3 item-text">Salary</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="salary">

            <li class="nav-item w-100">
              <a class="nav-link" href="{{url('advance')}}">

                <span class="ml-3 item-text">Advance</span>
              </a>
            </li>

            <li class="nav-item w-100">
              <a class="nav-link" href="{{url('salary')}}">

                <span class="ml-3 item-text">Salary</span>
              </a>
            </li>

              </ul>
            </li>
            <li class="nav-item dropdown">
              <a href="#Account" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class='bx bxs-bank'></i>
                <span class="ml-3 item-text">Account</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="Account">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('add_account')}}"><span class="ml-1 item-text">Add Account</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('account')}}"><span class="ml-1 item-text">View Account</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('account_type')}}"><span class="ml-1 item-text"> View Account Type</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('add_account_type')}}"><span class="ml-1 item-text">Add Account Type</span></a>
                </li>


              </ul>
            </li>

            <li class="nav-item dropdown">
              <a href="#quat" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-grid fe-16"></i>
                <span class="ml-3 item-text">Quotation</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="quat">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('add_quotation')}}"><span class="ml-1 item-text">Add Quotation</span></a>
                </li>

                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('quotation')}}"><span class="ml-1 item-text"> View Quotation</span></a>
                </li>



              </ul>
            </li>




            <li class="nav-item w-100">
              <a class="nav-link" href="{{url('user')}}">
                <i class='bx bxs-user-circle'></i>
                <span class="ml-3 item-text">Users</span>
              </a>
            </li>

            <li class="nav-item w-100">
                <a class="nav-link" href="{{url('today_activity')}}">
                    <i class='bx bxs-report'></i>
                  <span class="ml-3 item-text">Today Activity</span>
                </a>
            </li>
             <li class="nav-item w-100">
                <a class="nav-link" href="{{url('stock_activity')}}">
                    <i class='bx bxs-report'></i>
                  <span class="ml-3 item-text">Daily Stock Activity</span>
                </a>
            </li>

            <li class="nav-item w-100">
                <a class="nav-link" href="{{url('profit')}}">
                    <i class='bx bxs-report'></i>
                  <span class="ml-3 item-text">Profit Reports</span>
                </a>
              </li>

            <li class="nav-item w-100">
              <a class="nav-link" href="{{url('sale_report_view')}}">
                <i class='bx bxs-report'></i>
                <span class="ml-3 item-text">Sales Reports</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="nav-link" href="{{url('purchase_report_view')}}">
                <i class='bx bxs-report'></i>
                <span class="ml-3 item-text">Purchase Reports</span>
              </a>
            </li>










            <li class="nav-item dropdown">
              <a href="#branch" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class='bx bx-store'></i>
                <span class="ml-3 item-text">Branch</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="branch">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('add_branch')}}"><span class="ml-1 item-text">Add Brach</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{url('branch')}}"><span class="ml-1 item-text">View Branch</span></a>
                </li>

              </ul>
            </li>

          </ul>

        </nav>
      </aside>


     @yield('main-content')




  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/simplebar.min.js')}}"></script>
    <script src='{{asset('js/daterangepicker.js')}}'></script>
    <script src='{{asset('js/jquery.stickOnScroll.js')}}'></script>
    <script src="{{asset('js/tinycolor-min.js')}}"></script>
    <script src="{{asset('js/config.js')}}"></script>
    <script src="{{asset('js/d3.min.js')}}"></script>
    <script src="{{asset('js/topojson.min.js')}}"></script>
    <script src="{{asset('js/datamaps.all.min.js')}}"></script>
    <script src="{{asset('js/datamaps-zoomto.js')}}"></script>
    <script src="{{asset('js/datamaps.custom.js')}}"></script>
    <script src="{{asset('js/Chart.min.jss')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- <script>
      /* defind global options */
      Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
      Chart.defaults.global.defaultFontColor = colors.mutedColor;
    </script> --}}
    <script src="{{asset('js/gauge.min.js')}}"></script>
    <script src="{{asset('js/jquery.sparkline.min.js')}}"></script>
    {{-- <script src="{{asset('')}}js/apexcharts.min.js"></script> --}}
    <script src="{{asset('js/apexcharts.custom.js')}}"></script>
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/jquery.steps.min.js')}}"></script>
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/jquery.timepicker.js')}}"></script>
    <script src="{{asset('js/dropzone.min.js')}}"></script>
    <script src="{{asset('js/uppy.min.js')}}"></script>
    <script src="{{asset('js/quill.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>


    <script>

$(document).ready(function() {
    $('.js-example-basic-single').select2({
      tags: true
    });
});

      $('#dataTable-1').DataTable(
      {
        buttons: [
        'copy', 'excel', 'pdf'
    ],
    "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]

      });
    </script>
    <script>
      $('.select2').select2(
      {
        theme: 'bootstrap4',
      });
      $('.select2-multi').select2(
      {
        multiple: true,
        theme: 'bootstrap4',
      });
      $('.drgpicker').daterangepicker(
      {
        singleDatePicker: true,
        timePicker: false,
        showDropdowns: true,
        setData:'today',
        locale:
        {
          format: 'MM/DD/YYYY'
        }
      });
      $('.time-input').timepicker(
      {
        'scrollDefault': 'now',
        'zindex': '9999' /* fix modal open */
      });
      /** date range picker */
      if ($('.datetimes').length)
      {
        $('.datetimes').daterangepicker(
        {
          timePicker: true,
          startDate: moment().startOf('hour'),
          endDate: moment().startOf('hour').add(32, 'hour'),
          locale:
          {
            format: 'M/DD hh:mm A'
          }
        });
      }
      var start = moment().subtract(29, 'days');
      var end = moment();

      function cb(start, end)
      {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      }
      $('#reportrange').daterangepicker(
      {
        startDate: start,
        endDate: end,
        ranges:
        {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
      }, cb);
      cb(start, end);
      $('.input-placeholder').mask("00/00/0000",
      {
        placeholder: "__/__/____"
      });
      $('.input-zip').mask('00000-000',
      {
        placeholder: "____-___"
      });
      $('.input-money').mask("#.##0,00",
      {
        reverse: true
      });
      $('.input-phoneus').mask('(000) 000-0000');
      $('.input-mixed').mask('AAA 000-S0S');
      $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ',
      {
        translation:
        {
          'Z':
          {
            pattern: /[0-9]/,
            optional: true
          }
        },
        placeholder: "___.___.___.___"
      });
      // editor
      var editor = document.getElementById('editor');
      if (editor)
      {
        var toolbarOptions = [
          [
          {
            'font': []
          }],
          [
          {
            'header': [1, 2, 3, 4, 5, 6, false]
          }],
          ['bold', 'italic', 'underline', 'strike'],
          ['blockquote', 'code-block'],
          [
          {
            'header': 1
          },
          {
            'header': 2
          }],
          [
          {
            'list': 'ordered'
          },
          {
            'list': 'bullet'
          }],
          [
          {
            'script': 'sub'
          },
          {
            'script': 'super'
          }],
          [
          {
            'indent': '-1'
          },
          {
            'indent': '+1'
          }], // outdent/indent
          [
          {
            'direction': 'rtl'
          }], // text direction
          [
          {
            'color': []
          },
          {
            'background': []
          }], // dropdown with defaults from theme
          [
          {
            'align': []
          }],
          ['clean'] // remove formatting button
        ];
        var quill = new Quill(editor,
        {
          modules:
          {
            toolbar: toolbarOptions
          },
          theme: 'snow'
        });
      }
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function()
      {
        'use strict';
        window.addEventListener('load', function()
        {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form)
          {
            form.addEventListener('submit', function(event)
            {
              if (form.checkValidity() === false)
              {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
    <script>
      var uptarg = document.getElementById('drag-drop-area');
      if (uptarg)
      {
        var uppy = Uppy.Core().use(Uppy.Dashboard,
        {
          inline: true,
          target: uptarg,
          proudlyDisplayPoweredByUppy: false,
          theme: 'dark',
          width: 770,
          height: 210,
          plugins: ['Webcam']
        }).use(Uppy.Tus,
        {
          endpoint: 'https://master.tus.io/files/'
        });
        uppy.on('complete', (result) =>
        {
          console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
      }
    </script>
    <script src="js/apps.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>

    <script>


      $(document).ready(function(){
// Category section End

        $("#add_salary_btn").on("click",function(e){
      e.preventDefault();
      let salary = $("#date").val();

      if(salary==""){

         $("#date").css("borderColor","red");
         return false;


      }else{
           $("#salary_from").submit();

      }

        });



// category Eidt
$(document).on("click","#category_edit",function(e){
e.preventDefault();
let id = $(this).attr("data-ceid");

$.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('edit_category')}}",
    type:"POST",
    data:{id:id},
    success:function(data){
            $("#edit_category_form").html(data);
            $("#update_btn").trigger("click");

    }


     });
});



//  UPDATE CATEGORY




// add entry code start here

   $("#add_entry_btn").on("click",function(e){
    e.preventDefault();

     let name = $("#name").val();
     let qty = $("#qty").val();
     let price = $("#price").val();
     let code = $("#code").val();

         if(name == ""){

             $("#name").css("borderColor","red");
             return false;
         }else if(qty ==""){

            $("#qty").css("borderColor","red");
             return false;

         }else if(price==""){

            $("#price").css("borderColor","red");
             return false;
         }else if(code==""){
            $("#code").css("borderColor","red");
             return false;
         }else{
            $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('add_entry')}}",
    type:"POST",
    data: $("#entry_from").serialize(),
    beforeSend:function(){

      $("#loader").show();

    },
    complete:function(){

  $("#loader").hide();

    },
    success:function(data){
      if(data==1){
        Swal.fire(
      'Entry Added',
      '',
      'success'
    )

          location.reload();
      }


    }



          });
         }





   });


//    remove entry
$(document).on("click","#entry_remove",function(e){

  e.preventDefault();
  let id = $(this).attr("data-erid");


  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {

      $.ajax({

        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('remove_entry')}}",
    type:"POST",
    data:{id:id},
    success:function(data){
     if(data==1){
        Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )

    location.reload();

     }


    }


      });

  }
})


});






// entry edit

$(document).on("click","#entry_edit",function(e){

e.preventDefault();
let id = $(this).attr("data-eeid");
$.ajax({

  headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('edit_entry')}}",
    type:"POST",
    data:{id:id},
    success:function(data){


       $("#entry_data").html(data);
       $("#edit_btn_entry").trigger("click");

    }

})


});


$("#update_entry_btn").on("click",function(e){

e.preventDefault();
$.ajax({

  headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('update_entry')}}",
    type:"POST",
    data:$("#update_entry_from").serialize(),
    beforeSend:function(){
      $("#edit_loader").show();
    },
    complete:function(){
    $("#edit_loader").hide();

    },
    success:function(data){

      if(data==1){
        Swal.fire(
      'Update!',
      '',
      'success'
    )

  location.reload();

      }
    }


});


});

//    remove entry
$(document).on("click","#entry_remove",function(e){

  e.preventDefault();
  let id = $(this).attr("data-erid");


  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {

      $.ajax({

        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('remove_entry')}}",
    type:"POST",
    data:{id:id},
    success:function(data){
     if(data==1){
        Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )

    location.reload();

     }


    }


      });

  }
})


});





// expense or more btn




$("#add_bill_").on("click",function(e){
e.preventDefault();
$.ajax({

  headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('add_bill')}}",
    type:"get",
    data:$("#bill_from_add").serialize(),
    beforeSend:function(){
      $("#loader").show();
    },
    complete:function(){
    $("#loader").hide();

    },
    success:function(data){
       if(data==1){
        Swal.fire(
      'Bill Created!',
      '',
      'success'
    )

  location.reload();

       }


    }


});



});


// bill remove code


$(document).on("click","#bill_remove",function(e){

  e.preventDefault();
  let id = $(this).attr("data-brid");

  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('remove_bill')}}",
    type:"POST",
    data:{id:id},
    success:function(data){
if(data==1){
      Swal.fire(
      'Deleted!',
      '',
      'success'
    )
    location.reload();

}
    }


    });

  }
})



})

$(document).on("click","#bill_edit",function(e){

let id = $(this).attr("data-beid");

$.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('bill_edit')}}",
    type:"POST",
    data:{id:id},
    success:function(data){
    $("#bill_data").html(data);
    $("#bill_edit_btn").trigger("click");

    $('.js-example-basic-single').select2({
      tags: true
    });
    }

});
});
// bill paid code start

$(document).on("click","#bill_paid",function(e){

e.preventDefault();
let id = $(this).attr("data-bpid");

Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('paid_bill')}}",
    type:"POST",
    data:{id:id},
    success:function(data){
if(data==1){
      Swal.fire(
      'Bill Paid!',
      '',
      'success'
    )
    location.reload();

}
    }


    });
  }
})


});



      $("#add_user_btn").on("click",function(e){

          $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('add_user')}}",
    type:"POST",
    data:$("#user_from").serialize(),
    beforeSend:function(){
      $("#loader").show();
    },
    complete:function(){
      $("#loader").hide();
    },
    success:function(data){

      if(data==1){
        Swal.fire(
      'User Added!',
      '',
      'success'
    )
    location.reload();
      }else if(data==2){
        Swal.fire(
      'User Already Exist!',
      '',
      'error'
    )

      }
    }




          });




      });


// user remove
$(document).on("click","#user_remove",function(e){
  e.preventDefault();

  let id = $(this).attr("data-urid");
  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('remove_user')}}",
    type:"POST",
    data:{id:id},
    success:function(data){
if(data==1){
      Swal.fire(
      'User Remove',
      '',
      'success'
    )
    location.reload();

}
    }


    });
  }
})

})


// uer edit

$(document).on("click","#user_edit",function(e){

e.preventDefault();
let id = $(this).attr("data-ueid");

$.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('edit_user')}}",
    type:"get",
    data:{id:id},
    success:function(data){

$("#user_data").html(data);
$("#edit_btn").trigger("click");


    }


    });

});

// update user

$("#update_user_btn").on("click",function(e){
e.preventDefault();
   $.ajax({

    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('update_user')}}",
    type:"post",
    data:$("#update_user_from").serialize(),
    beforeSend:function(){
      $("#edit_loader").show();
    },
    complete:function(){
      $("#edit_loader").hide();
    },
    success:function(data){
      if(data==1){
        Swal.fire(
      'User Updated',
      '',
      'success'
    )
    location.reload();
      }
    }


   });


});

// $("#add_expense_btn").on("click",function(e){

//    e.preventDefault();
//   $.ajax({

//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     },
//     url:"{{url('add_expense')}}",
//     type:"post",
//     data:$("#expense_from").serialize(),
//     beforeSend:function(){
//       $("#loader").show();
//     },
//     complete:function(){
//       $("#loader").hide();
//     },
//    success:function(data){
//      if(data==1){
//       Swal.fire(
//       'expense Added',
//       '',
//       'success'
//     )
//     location.reload();

//      }
//    }

//   });

// });


// expense remove
// $(document).on("click","#expense_remove",function(e){
//  e.preventDefault();
//  let id = $(this).attr("data-erid");
//  Swal.fire({
//   title: 'Are you sure?',
//   text: "You won't be able to revert this!",
//   icon: 'warning',
//   showCancelButton: true,
//   confirmButtonColor: '#3085d6',
//   cancelButtonColor: '#d33',
//   confirmButtonText: 'Yes, delete it!'
// }).then((result) => {
//   if (result.isConfirmed) {
//     $.ajax({
//       headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     },
//     url:"{{url('remove_expense')}}",
//     type:"get",
//     data:{id:id},
//     success:function(data){
// if(data==1){
//       Swal.fire(
//       'Expense Remove',
//       '',
//       'success'
//     )
//     location.reload();

// }
//     }


//     });
//   }
// })

// });

// expesnse edit
// $(document).on("click","#expense_edit",function(e){

//  e.preventDefault();
//    let id = $(this).attr("data-exeid");
//    $.ajax({

//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     },
//     url:"{{url('edit_expense')}}",
//     type:"post",
//     data:{id:id},
//     success:function(data){

//          $("#expense_data").html(data);
//          $("#edit_btn").trigger("click");

//     }
//    });

// });

// // update expense
// $("#update_expense_btn").on("click",function(e){



// $.ajax({
//   headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     },
//     url:"{{url('update_expense')}}",
//     type:"post",
//     data:$("#update_expense_from").serialize(),
//     beforeSend:function(){
//      $("#edit_loader").show();

//     },
//     complete:function(){
//       $("#edit_loader").hide();
//     },
//     success:function(data){
//           if(data==1){
//             Swal.fire(
//       'Expense Update',
//       '',
//       'success'
//     )
//     location.reload();

//           }

//     }

// });


// });


  // brach add

  $("#branch_from").on("submit",function(e){
    e.preventDefault();

     $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url:"{{url('add_branch')}}",
      type:'POST',
      data:$("#branch_from").serialize(),
      beforeSend:function(){
        $("#loader").show();
      },
      complete:function(){
        $("#loader").hide();
      },
      success:function(data){


       if(data==1){
        Swal.fire(
      'Branch Added',
      '',
      'success'
    )
    $("#branch_from").trigger("reset");
       }else{
        Swal.fire(
      'Branch Already Exist',
      '',
      'error'
    )
       }

      }


     });



  })










// edit branch


$(document).on("click","#branch_edit",function(e){
e.preventDefault();

let id = $(this).attr("data-beid");
$.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('edit_branch')}}",
    type:"get",
    data:{id:id},
    success:function(data){

$("#branch_data").html(data);
$("#edit_btn").trigger("click");


    }


    });


})
// branch_update_from
$("#update_branch_btn").on("click",function(e){

$.ajax({
  headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('update_branch')}}",
    type:"get",
    data:$("#branch_update_from").serialize(),
    beforeSend:function(){
     $("#edit_loader").show();

    },
    complete:function(){
      $("#edit_loader").hide();
    },
    success:function(data){
          if(data==1){
            Swal.fire(
      'Branch Update',
      '',
      'success'
    )
    location.reload();

          }

    }

});


});



// Branch Remove

$(document).on("click","#branch_remove",function(e){

e.preventDefault();
let id = $(this).attr("data-brid")

Swal.fire({
title: 'Are you sure?',
text: "You won't be able to revert this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, delete it!'
}).then((result) => {
if (result.isConfirmed) {
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:"{{url('remove_branch')}}",
  type:"get",
  data:{id:id},
  success:function(data){
if(data==1){
    Swal.fire(
    'Branch Remove',
    '',
    'success'
  )
  location.reload();

}
  }


  });
}
})




})


  // Account Type add

  $("#add_account_type_btn").on("click",function(e){
    e.preventDefault();

     $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url:"{{url('add_account_type')}}",
      type:'POST',
      data:$("#account_type_from").serialize(),
      beforeSend:function(){
        $("#loader").show();
      },
      complete:function(){
        $("#loader").hide();
      },
      success:function(data){


       if(data==1){
        Swal.fire(
      'Account Type Added',
      '',
      'success'
    )
    $("#account_type_from").trigger("reset");
       }

      }


     });



  })





// edit branch


$(document).on("click","#account_type_edit",function(e){
e.preventDefault();
let id = $(this).attr("data-ateid");
$.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('edit_account_type')}}",
    type:"get",
    data:{id:id},
    success:function(data){

$("#account_type_data").html(data);
$("#edit_btn").trigger("click");


    }


    });


})
// // branch_update_from
$("#update_account_type_btn").on("click",function(e){

$.ajax({
  headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('account_type_update')}}",
    type:"get",
    data:$("#account_type_update_from").serialize(),
    beforeSend:function(){
     $("#edit_loader").show();

    },
    complete:function(){
      $("#edit_loader").hide();
    },
    success:function(data){
          if(data==1){
            Swal.fire(
      'Branch Update',
      '',
      'success'
    )
    location.reload();

          }

    }

});


});

// purchase remove

$(document).on("click","#account_type_remove",function(e){

e.preventDefault();
let id = $(this).attr("data-atrid")

Swal.fire({
title: 'Are you sure?',
text: "You won't be able to revert this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, delete it!'
}).then((result) => {
if (result.isConfirmed) {
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:"{{url('remove_account_type')}}",
  type:"get",
  data:{id:id},
  success:function(data){
if(data==1){
    Swal.fire(
    'Account Type Remove',
    '',
    'success'
  )
  location.reload();

}
  }


  });
}
})




})






// purchase update


$("#update_purchase_btn").on("click",function(e){



$.ajax({
  headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url:"{{url('update_purchase')}}",
    type:"post",
    data:$("#update_purchase_from").serialize(),
    beforeSend:function(){
     $("#edit_loader").show();

    },
    complete:function(){
      $("#edit_loader").hide();
    },
    success:function(data){
          if(data==1){
            Swal.fire(
      'purchase Update',
      '',
      'success'
    )
    location.reload();

          }

    }

});


});


// Add account
$("#add_account_btn").on("click",function(e){
   e.preventDefault()

$.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url:"{{url('add_account')}}",
      type:'POST',
      data:$("#account_from").serialize(),
      beforeSend:function(){
        $("#loader").show();
      },
      complete:function(){
        $("#loader").hide();
      },
      success:function(data){
       if(data==1){
        Swal.fire(
      'Amount Added',
      '',
      'success'
    )
    $("#account_from").trigger("reset");
       }

      }


     });




});


 $("#add_advance_btn").on("click",function(){

   $("#advance_form").submit();

 });

        });



    </script>

<script>
  function my_curr_date() {
      var currentDate = new Date()
      var day = currentDate.getDate();
      var month = currentDate.getMonth() + 1;
      var year = currentDate.getFullYear();
      var my_date = month+"/"+day+"/"+year;
      document.getElementById("date").value=my_date;
  }
  </script>
  </body>
</html>
